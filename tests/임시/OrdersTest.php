<?php

namespace Tests\Feature;

use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Models\OptionProduct;
use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $cart;

    protected $payMethods;

    protected $delivery;

    protected $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        $this->products = Product::factory()->count(10)->create();

        $this->cart = $this->user->cart;

        foreach($this->products as $product){
            $this->addToCart($product);
        }

        $this->payMethods = PayMethod::factory()->count(3)->create();

        $this->delivery = Delivery::factory()->create([
            "user_id" => $this->user->id,
            "default" => true
        ]);

        $this->form = [
            "direct" => true,
            "product_ids" => $this->cart->products->pluck("id")->toArray(),

            "pay_method_id" => $this->payMethods->first()->id,
            "memo" => "떡볶이 많이",

            "delivery_title" => $this->delivery->title,
            "delivery_name" => $this->delivery->name,
            "delivery_contact" => $this->delivery->contact,
            "delivery_address" => $this->delivery->address,
            "delivery_address_detail" => $this->delivery->address_detail,
            "delivery_address_zipcode" => $this->delivery->address_zipcode,
            "delivery_memo" => $this->delivery->memo,
            "service_time" => "10:00"
        ];

    }

    public function addToCart($product, $count = 1, $options = [])
    {
        $this->post("/carts", [
            "product_id" => $product->id,
            "count" => $count,
            "options" => $options,
            "color" => "블랙"
        ]);
    }

    /** @test */
    public function 장바구니에_담겨있는_상품을_주문할_수_있다()
    {
        $this->post("/orders", $this->form);

        $order = $this->user->orders()->first();

        $this->assertCount(count($this->products), $order->products);
    }

    /** @test */
    public function 장바구니에_담지_않고_바로_주문할_수_있다()
    {
        $this->form["direct"] = 1;

        $this->post("/orders", $this->form);

        $order = $this->user->orders()->first();

        $this->assertCount(count($this->products), $order->products);
    }

    /** @test */
    function 한번에_최대_99개의_상품만_주문할_수_있다()
    {
        $products = Product::factory()->count(100)->create();

        $this->cart->products()->attach($products->pluck("id"));

        $this->form["product_ids"] = $products->pluck("id")->toArray();

        $this->post("/orders", $this->form);

        $order = $this->user->orders()->first();

        $this->assertNull($order);


        // 99개
        $products = Product::factory()->count(99)->create();

        $this->form["product_ids"] = $products->pluck("id")->toArray();

        $this->cart->products()->attach($products->pluck("id"));

        $this->post("/orders", $this->form);

        $order = $this->user->orders()->first();

        $this->assertCount(count($products), $order->products);
    }

    /** @test */
    function 주문을_생성하면_출고목록이_생성된다()
    {
        $this->post("/orders", $this->form);

        $order = $this->user->orders()->first();

        $this->assertCount(count($this->products), $order->products);
    }

    /** @test */
    public function 한_상품을_여러개_주문할_수_있다()
    {
        $count = 4;

        $product = Product::factory()->create([
            "count" => $count,
            "for_order" => true
        ]);

        $this->addToCart($product);

        $this->form["product_ids"] = [$product->id];

        $this->post("/orders", $this->form);

        $product = $this->user->load("orders")->orders()->first()->products()->first();

        $this->assertEquals($count, $product->count);
    }

    /** @test */
    public function 주문서가_성공상태로_수정되면_관련_상품들은_장바구니에서_삭제된다()
    {
        $this->post("/orders", $this->form);

        $this->assertCount(count($this->products), $this->cart->products);

        $order = Order::first();

        $order->update([
            "state" => OrderState::SUCCESS
        ]);

        $this->assertCount(0, $this->cart->load("products")->products);
    }

    /** @test */
    public function 주문서가_성공상태로_수정되면_출고목록은_주문접수_상태가_된다()
    {
        $this->post("/orders", $this->form);

        $order = Order::first();

        $order->update([
            "state" => OrderState::SUCCESS
        ]);

        $products = $order->load("products")->products;

        foreach($products as $product){
            $this->assertEquals(OrderProductState::WAIT, $product->pivot->state);
        }
    }

    public function 주문서가_가상계좌입금대기상태로_수정되면_사용한_쿠폰이_사용처리된다()
    {
        $coupon = Coupon::factory()->create([
            "price_min" => 1,
            "price_discount" => 1
        ]);

        $this->user->coupons()->attach($coupon, [
            "expired_at" => Carbon::now()->addDays(7)
        ]);

        $this->form["coupon_id"] = $coupon->id;

        $this->post("/orders", $this->form);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $coupon = $this->user->load("coupons")->coupons()->find($coupon->id);

        $this->assertEquals(1, $coupon->pivot->used);

        $this->assertEquals($order->price_total - $coupon->price_discount + $order->delivery_price, $order->price_real);
    }

    public function 주문서가_가상계좌입금대기상태로_수정되면_관련_상품들은_장바구니에서_삭제된다()
    {
        $this->post("/orders", $this->form);

        $this->assertCount(count($this->products), $this->cart->load("products")->products);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $this->assertCount(0, $this->cart->load("products")->products);
    }

    public function 주문서가_가상계좌입금대기상태로_수정되면_사용적립금은_차감되지만_적립금은_추가되지_않는다()
    {
        $this->user->update([
            "point" => 1
        ]);

        $prevUser = $this->user;

        $this->form["point_use"] = $this->user->point;

        $this->post("/orders", $this->form);

        $this->assertCount(count($this->products), $this->cart->load("products")->products);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $user = User::find($this->user->id);

        $this->assertEquals($prevUser->point - $order->point_use, $user->point);

        $this->assertEquals($order->price_total - $this->form["point_use"] + $order->delivery_price, $order->price_real);
    }

    public function 주문서가_가상계좌입금대기상태로_수정되도_출고목록은_주문접수_상태가_되지_않는다()
    {
        $this->post("/orders", $this->form);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $outgoings = $order->load("outgoings")->outgoings;

        foreach($outgoings as $outgoing){
            $this->assertEquals(OutgoingState::FAIL, $outgoing->state);
        }
    }

    public function 가상계좌입금대기상태였던_주문은_입금기한이_지나면_실패처리된다()
    {

    }

    public function 가상계좌_주문건은_입금완료처리_됐을때_적립금이_추가된다()
    {
        $this->user->update([
            "point" => 1
        ]);

        $prevUser = $this->user;

        $this->form["point_use"] = $this->user->point;

        $this->post("/orders", $this->form);

        $this->assertCount(count($this->products), $this->cart->load("products")->products);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $order->update([
            "state" => OrderState::SUCCESS
        ]);


        $user = User::find($this->user->id);

        $this->assertEquals($prevUser->point + $order->point_give - $order->point_use, $user->point);

        $this->assertEquals($order->price_total - $this->form["point_use"] + $order->delivery_price, $order->price_real);
    }

    public function 실패처리된_가상계좌_주문건의_사용적립금은_반환된다()
    {
        $this->user->update([
            "point" => 1
        ]);

        $prevUser = $this->user;

        $this->form["point_use"] = $this->user->point;

        $this->post("/orders", $this->form);

        $this->assertCount(count($this->products), $this->cart->load("products")->products);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $order->update([
            "state" => OrderState::FAIL
        ]);

        $user = User::find($this->user->id);

        $this->assertEquals($prevUser->point, $user->point);
    }

    public function 실패처리된_가상계좌_주문건의_쿠폰은_미사용_처리된다()
    {
        $coupon = Coupon::factory()->create([
            "price_min" => 1,
            "price_discount" => 1
        ]);

        $this->user->coupons()->attach($coupon, [
            "expired_at" => Carbon::now()->addDays(7)
        ]);

        $this->form["coupon_id"] = $coupon->id;

        $this->post("/orders", $this->form);

        $order = Order::first();

        $order->update([
            "state" => OrderState::WAIT
        ]);

        $order->update([
            "state" => OrderState::FAIL
        ]);

        $coupon = $this->user->load("coupons")->coupons()->find($coupon->id);

        $this->assertEquals(0, $coupon->pivot->used);
    }

    /** @test */
    function 상품정보에_기반하여_주문금액이_계산한다()
    {
        $this->cart->products()->delete();

        $products = [
            Product::factory()->create([
                "price" => 1580,
                "value_discount" => 0
            ]),
            Product::factory()->create([
                "price" => 3222,
                "value_discount" => 0
            ]),
            Product::factory()->create([
                "price" => 5000,
                "value_discount" => 0
            ]),
        ];

        $optionProduct = Product::factory()->create([
            "product_id" => $products[0]->id,
            "price" => 500
        ]);

        $options[] = [
            "id" => $optionProduct->id,
            "count" => 3
        ];

        $this->addToCart($products[0], 2, $options);

        $options = [];

        $optionProduct = Product::factory()->create([
            "product_id" => $products[1]->id,
            "price" => 350
        ]);

        $options[] = [
            "id" => $optionProduct->id,
            "count" => 2
        ];

        $this->addToCart($products[1], 1, $options);

        $this->addToCart($products[2], 3);

        $this->form["product_ids"] = $this->cart->load("products")->products->pluck("id")->toArray();

        $this->post("/orders", $this->form);

        $order = $this->user->load("orders")->orders()->first();

        $this->assertEquals(25082,$order->price_total);
    }

    /** @test */
    function 유효하지_않은_결제수단으로는_주문을_진행할_수_없다()
    {
        $this->form["pay_method_id"] = 0;

        $this->post("/orders", $this->form);

        $this->assertNull($this->user->load("orders")->orders()->first());
    }

    /** @test */
    public function 총_금액이_최소배송무료금액_미만이라면_기본배송비가_붙는다()
    {
        $this->cart->products()->delete();

        // 최소배송무료금액 미만일 경우
        $basic = Basic::factory()->create([
            "price_min_delivery_discount" => 10000,
            "price_delivery" => 3000
        ]);

        $products = Product::factory()->count(3)->create([
            "price" => 1000
        ]);

        foreach($products as $product){
            $this->addToCart($product);
        }

        $this->form["product_ids"] = $this->cart->load("products")->products->pluck("id")->toArray();

        $this->post("/orders", $this->form);

        $order = $this->user->load("orders")->orders()->first();

        $this->assertEquals($products->sum("price"),$order->price_total);

        $this->assertEquals($basic->price_delivery, $order->delivery_price);

        $this->assertEquals($order->price_total + $order->delivery_price,$order->price_real);
    }


    // 반품으로 갈거 ============================================
    // 상품준비로 넘어가면서부터는 환불신청 안됨
    function 구매자는_주문접수상태_상품만_주문취소할_수_있다()
    {

    }

    function 구매자는_다른_사람의_상품을_주문취소할_수_없다()
    {

    }

    public function 주문취소시_사용했던_적립금은_반환된다()
    {

    }

    public function 주문취소시_사용했던_쿠폰은_미사용_상태로_전환된다()
    {

    }

    public function 주문취소시_관련_출고목록은_삭제된다()
    {

    }

    public function 결제취소가_불가능한_상품은_계좌환불_진행중_상태로_전환된다()
    {

    }

    public function 지금_예약배송_최대_4주로_설정되어있는데_2주로_바꿔야돼()
    {

    }

    /** @test */
    public function 가상계좌및_웹훅_포함해서_결제_후_알림메세지_넣어야돼()
    {

    }

    /** @test */
    public function 주문취소안될경우계좌환불관련테스트케이스도만들어야돼()
    {

    }

    /** @test */
    public function 주문접수상태_상품만_상품준비상태로_전환할_수_있도록_관리자세팅해야하고_운송장등록할_데이터_엑셀_추출할때도_마찬가지임()
    {

    }

    /** @test */
    public function 관리자에서_오늘_나가면_안되는_배송예정일_출고상품을_준비완료처리하려고할_때도_막아야돼()
    {
        // 이번주 금요일날 예약배송 희망했는데, 월요일날 상품준비 찍어버리면 안되겠지? 수요일날 찍어야겠지(2일차이 나는지? 계산하는식으로 해야할듯)
        // 아니면 렌즈나 필터기능을 통해서 오늘 나가야 하는 출고목록을 만들 수 있게하던지(순차출고 대비해서 나갔어야했는데 아직 못나간것도 포함하게 해야됨)
    }

    /** @test */
    public function 관리자에서_오늘_나가야할_상품_렌즈나_필터링을_할_수_있게하자()
    {
        // 가상계좌같은건 결제 자체를 3일뒤에 할 수도 있어
        // 그렇기때문에 출고일자가 오늘인거 뿐만 아니라 그전 일자에 안나간거도 포함해서 오늘 나가야할 상품 목록에 나오게끔 해야돼
    }

    /** @test */
    public function 주문용_상품은_본래_상품이_삭제될_때_같이_삭제된다()
    {
        // 같이 삭제돼야 장바구니에서도 날라가니까(본래 상품 내렸는데 장바구니에 구매용으로 만들어진 상품을 남는걸 방지)
    }
}
