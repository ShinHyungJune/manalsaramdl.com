<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string("imp_uid")->unique()->nullable(); // 주문 번호(아임포트측에서 넘겨주는 id)
            $table->string("merchant_uid")->unique()->index(); // 주문 번호(우리 서비스에서 만드는 id)

            // 주문자
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->on("users")->references("id");
            $table->string("user_name")->nullable(); // 주문자명

            // 결제수단
            $table->unsignedBigInteger("pay_method_id");
            $table->foreign("pay_method_id")->on("pay_methods")->references("id");
            $table->string("pay_method_name");
            $table->string("pay_method_pg");
            $table->string("pay_method_method");
            $table->string("pay_method_commission");

            // 배송
            // 배송지는 id 안받고 그냥 배송지 중 하나 클릭 시 자동입력용으로 사용
            $table->string("delivery_title"); // 배송지명
            $table->string("delivery_name"); // 받는분 성함
            $table->string("delivery_contact"); // 받는분 전화번호
            $table->string("delivery_contact2")->nullable(); // 받는분 전화번호2
            $table->string("delivery_address"); // 받는분 주소
            $table->string("delivery_address_detail"); // 받는분 상세주소
            $table->string("delivery_address_zipcode"); // 받는분 상세주소
            $table->string("delivery_memo")->nullable(); // 전달사황
            $table->integer("delivery_price")->default(0); // 배송비

            // 금액
            $table->double("price_total"); // 총 금액
            $table->double("price_real"); // 결제예정금액

            $table->double("point_use")->default(0); // 사용한 포인트
            $table->double("point_give")->default(0); // 적립될 포인트

            // 가상계좌
            $table->string("vbank_num")->nullable(); // 계좌번호
            $table->string("vbank_name")->nullable(); // 은행명
            $table->string("vbank_date")->nullable(); // 입금기한

            // 환불계좌
            $table->string("refund_owner")->nullable(); // 환불계좌 예금주
            $table->string("refund_bank")->nullable(); // 환불계좌 은행명
            $table->string("refund_account")->nullable(); // 환불계좌 계좌번호

            $table->string("state")->default(\App\Enums\OrderState::FAIL);
            $table->text("memo")->nullable(); // 메모(전하고싶은말 등 적기)
            $table->text("reason")->nullable(); // 결제실패사유

            $table->string("service_time")->nullable(); // #복붙주의 - 서비스가능시간

            // 게스트용 주문확인 비밀번호
            $table->string("password")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
