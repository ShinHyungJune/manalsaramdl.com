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

    public function story(Request $request)
    {
        return Inertia::render("Contents/Story", [

        ]);
    }

    public function privacy01(Request $request)
    {
        return Inertia::render("Contents/Privacy01", [

        ]);
    }

    public function privacy02(Request $request)
    {
        return Inertia::render("Contents/Privacy02", [

        ]);
    }

    public function privacy03(Request $request)
    {
        return Inertia::render("Contents/Privacy03", [

        ]);
    }


}
