<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->string("type")->default(\App\Enums\RefundType::REFUND);
            $table->unsignedBigInteger("order_id")->nullable();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
            $table->unsignedBigInteger("order_product_id")->nullable();
            $table->foreign("order_product_id")->references("id")->on("order_product")->onDelete("cascade");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");

            $table->text("reason_request"); // 환불사유
            $table->text("reason_deny")->nullable(); // 반려사유
            $table->text("memo")->nullable(); // 기타 메모

            $table->string("bank")->nullable(); // 환불계좌 은행
            $table->string("account")->nullable(); // 환불계좌 번호
            $table->string("owner")->nullable(); // 환불계좌 예금주

            $table->double("price")->nullable(); // 환불가격
            $table->boolean("refunded")->nullable(); // 환불여부

            $table->index(["order_id", "user_id"]);

            // #복붙주의 - 특수
            $table->string("order_name")->nullable(); // 구입고객명
            $table->string("email")->nullable();
            $table->string("name")->nullable();
            $table->string("contact")->nullable();
            $table->string("contact_time")->nullable();
            $table->string("address")->nullable();
            $table->string("address_detail")->nullable();
            $table->string("address_zipcode")->nullable();

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
        Schema::dropIfExists('refunds');
    }
}
