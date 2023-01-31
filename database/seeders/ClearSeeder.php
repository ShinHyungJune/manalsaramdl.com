<?php

namespace Database\Seeders;

use App\Models\Notice;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::statement("SET foreign_key_checks=1");
    }
}
