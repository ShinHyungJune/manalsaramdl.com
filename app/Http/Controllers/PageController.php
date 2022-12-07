<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render("Index", [
        ]);
    }

    /*public function privacyPolicy()
    {
        return Inertia::render("Contents/PrivacyPolicy");
    }

    public function servicePolicy()
    {
        return Inertia::render("Contents/ServicePolicy");
    }
    */

    public function mypage()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);

        return Inertia::render("Mypage", [
            "orders" => OrderResource::collection($orders),
        ]);
    }
}
