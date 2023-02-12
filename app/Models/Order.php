<?php

namespace App\Models;

use App\Enums\KakaoTemplate;
use App\Enums\OrderProductState;
use App\Enums\OrderState;

use App\Enums\ProductType;
use App\Enums\Sex;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "imp_uid",
        "merchant_uid",

        "user_id",
        "user_name",

        "pay_method_id",
        "pay_method_name",
        "pay_method_pg",
        "pay_method_method",
        "pay_method_commission",

        "price",
        "product_title",

        "refund_owner",
        "refund_bank",
        "refund_account",

        "state",

        "reason",

        "vbank_num",
        "vbank_date",
        "vbank_name",
    ];

    protected $casts = [

    ];


    public $take = 50;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::updated(function ($order) {

            $prevState = $order->getOriginal("state");

            $user = $order->user;

            /*if ($prevState == OrderState::FAIL) {
                if ($order->state == OrderState::SUCCESS) {

                    // 결제상품 주문성공처리
                    $order->orderProducts()->update([
                        "state" => OrderProductState::SUCCESS
                    ]);

                    $products = $order->products()->where("products.product_id", null)->cursor();

                    foreach($products as $product){
                        if($product->type == ProductType::DATING)
                            $user->update([
                                "count_dating" => $user->count_dating + $product->count_dating
                            ]);
                    }
                }
            }*/
        });
    }

    public static function getTake()
    {
        return (new static)->take;
    }

    public function getCanRefundAttribute()
    {
        return $this->refunds()->count() == 0;
    }

    public function getCanReviewAttribute()
    {
        return;
    }

    public function payMethod()
    {
        return $this->belongsTo(PayMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot([
            "user_id",
            "state",
            "accept",
            "partner"
        ]);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    // 결제시도
    public function attempt(Request $request)
    {
        $payMethod = PayMethod::find($request->pay_method_id);

        $product = Product::find($request->product_id);

        $option = Product::find($request->option_id);

        $priceTotal = $product->price + $option->price;

        if (!$payMethod)
            return ["state" => "error", "message" => "존재하지 않는 결제수단입니다."];

        if (!$product)
            return ["state" => "error", "message" => "주문할 수 있는 상품이 없습니다."];

        if (!$option)
            return ["state" => "error", "message" => "주문할 수 있는 옵션이 없습니다."];

        if($product->type == ProductType::PARTY){

            if($product->opened_at <= Carbon::now())
                return ["state" => "error", "message" => "파티일지가 지난 파티는 구매할 수 없습니다."];

            $acceptMemberCount = auth()->user()->sex == Sex::MEN ? $product->accept_men : $product->accept_women;

            $maxCount = auth()->user()->sex == Sex::MEN ? $product->max_men : $product->max_women;

            if($acceptMemberCount >= $maxCount)
                return ["state" => "error", "message" => "더 이상 참여할 수 없습니다."];
        }


        $order = Order::create([
            "merchant_uid" => rand() . Carbon::now()->timestamp,
            "user_id" => auth()->user()->id,
            "user_name" => auth()->user()->name,
            "user_contact" => auth()->user()->contact,
            "user_email" => auth()->user()->email,
            "product_title" => $product->title,
            "pay_method_id" => $payMethod->id,
            "pay_method_name" => $payMethod->name,
            "pay_method_pg" => $payMethod->pg,
            "pay_method_method" => $payMethod->method,
            "pay_method_commission" => $payMethod->commission,

            "price" => $priceTotal,

            "state" => OrderState::FAIL,
        ]);

        $order->products()->attach($product->id, [
            "user_id" => $order->user->id
        ]);

        $order->products()->attach($option->id, [
            "user_id" => $order->user->id
        ]);

        return ["state" => "success", "message" => "성공적으로 처리되었습니다.", "data" => $order];
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
