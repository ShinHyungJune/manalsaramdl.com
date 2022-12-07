<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DatingProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where("origin_product_id", null)
            ->where("product_id", null)
            ->where("type", ProductType::DATING)
            ->paginate(30);

        return Inertia::render("DatingProducts/Index", [
            "products" => ProductResource::collection($products),
        ]);
    }

    public function show(Product $product)
    {

    }
}
