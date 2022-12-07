<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Notice;
use App\Models\OptionProduct;
use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\Review;
use App\Models\Usage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;
use PhpOption\Option;
use Symfony\Component\Console\Question\Question;

class InitSeeder extends Seeder
{
    protected $user;

    protected $singleProducts;

    protected $dietProducts;

    protected $dietIncludeProducts;

    protected $imgs = [
        "https://swiperjs.com/demos/images/nature-1.jpg",
        "https://swiperjs.com/demos/images/nature-2.jpg",
        "https://swiperjs.com/demos/images/nature-3.jpg",
        "https://swiperjs.com/demos/images/nature-4.jpg",
        "https://swiperjs.com/demos/images/nature-5.jpg",
        "https://swiperjs.com/demos/images/nature-6.jpg",
        "https://swiperjs.com/demos/images/nature-7.jpg",
        "https://swiperjs.com/demos/images/nature-8.jpg",
        "https://swiperjs.com/demos/images/nature-9.jpg",
        "https://swiperjs.com/demos/images/nature-10.jpg",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Product::truncate();
        User::truncate();
        PayMethod::truncate();
        DB::statement("SET foreign_key_checks=1");

        $this->createProducts();
        $this->createPayMethods();

        // $this->createReviews();
    }

    public function createUser()
    {
        $users = User::get();

        foreach($users as $user){
            $user->delete();
        }

        User::factory()->create([
            "ids" => "ssa4141",
            "contact" => "01030217486",
            "password" => Hash::make("shin1109")
        ]);

        User::factory()->create([
            "ids" => "admin1234",
            "contact" => "00000000000",
            "password" => Hash::make("!admin1234")
        ]);
    }

    public function createPayMethods()
    {
        $payMethods = PayMethod::get();

        foreach($payMethods as $payMethod){
            $payMethod->delete();
        }

        $payMethods = [
            [
                "pg" => "html5_inicis",
                "method" => "card",
                "name" => "신용카드",
                "commission" => "7",
            ],
            [
                "pg" => "html5_inicis",
                "method" => "phone",
                "name" => "휴대폰",
                "commission" => "10",
            ],
        ];

        foreach($payMethods as $payMethod){
            PayMethod::factory()->create([
                "pg" => $payMethod["pg"],
                "method" => $payMethod["method"],
                "name" => $payMethod["name"],
                "commission" => $payMethod["commission"],
            ]);
        }
    }

    public function createProducts()
    {
        $datingProducts = [
            [
                "title" => "1개월",
                "price" => 1000,
                "options" => [
                    [
                        "title" => "10대",
                        "price" => "10",
                    ],
                    [
                        "title" => "20대",
                        "price" => "20",
                    ],
                    [
                        "title" => "30대",
                        "price" => "30",
                    ],
                ]
            ],
            [
                "title" => "2개월",
                "price" => 1000,
                "options" => [
                    [
                        "title" => "10대",
                        "price" => "10",
                    ],
                    [
                        "title" => "20대",
                        "price" => "20",
                    ],
                ]
            ]
        ];

        foreach($datingProducts as $datingProduct){
            $createdItem = Product::factory()->create([
                "title" => $datingProduct["title"],
                "price" => $datingProduct["price"]
            ]);

            foreach($datingProduct["options"] as $option){
                Product::factory()->create([
                    "product_id" => $createdItem->id,
                    "title" => $option["title"],
                    "price" => $option["price"]
                ]);
            }

        }
    }
}
