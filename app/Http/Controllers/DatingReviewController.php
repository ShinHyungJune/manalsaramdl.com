<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DatingReviewController extends Controller
{
    public function index(Request $request)
    {
        $items = Review::where("type", ProductType::DATING)->latest()->paginate(12);

        return Inertia::render("DatingReviews/Index", [
            "items" => ReviewResource::collection($items)
        ]);
    }

    public function show(Review $review)
    {
        return Inertia::render("DatingReviews/Show", [
            "item" => ReviewResource::make($review)
        ]);
    }
}
