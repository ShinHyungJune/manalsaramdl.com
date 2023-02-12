<?php

namespace Database\Seeders;

use App\Enums\Sex;
use App\Models\Notice;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Order::truncate();
        PayMethod::where("method", "phone")->delete();
        OrderProduct::truncate();
        User::truncate();
        $user = User::factory()->create([
            "email" => "girl@naver.com",
            "contact" => "01030217486",
            "name" => "여자1호",
            "sex" => Sex::WOMEN,
            "birth" => "1995",
            "job" => "간호사",
            "school" => "대졸",
            "city" => "서울시",
            "area" => "강남구",
            "need_service" => "소개팅 프로그램",
            "registration_way" => "인스타그램",
            "city_company" => "서울시",
            "area_company" => "강남구",

            "tall" => "174",
            "weight" => "79",
            "instagram" => "",

            "ideal" => "이상형",
            "introduce" => "잘 부탁드려요",
            "to_manager" => "매칭 잘해주세요",
            "marriage" => "미혼",
            "comment_manager" => "이분은 정말 성실한 여성분이세요",
            "count_dating" => 3,
            "password" => Hash::make("girl@naver.com")
        ]);
        DB::statement("SET foreign_key_checks=1");
    }
}
