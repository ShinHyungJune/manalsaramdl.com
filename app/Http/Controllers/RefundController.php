<?php

namespace App\Http\Controllers;

use App\Enums\OrderState;
use App\Enums\RefundType;
use App\Http\Resources\BannerResource;
use App\Http\Resources\EventBannerResource;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\RefundResource;
use App\Models\EventBanner;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $refunds = auth()->user()->refunds()->paginate(10);

        return Inertia::render("Shopping/Refunds/Index", [
            "refunds" => RefundResource::collection($refunds),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "order_product_id" => "required|integer"
        ]);

        $orderProduct = OrderProduct::whereHas("order", function($query){
            $query->where("state", "!=", OrderState::FAIL);
        })->where("id", $request->order_product_id)->first();

        if(!$orderProduct)
            return redirect()->back()->with("error", "존재하지 않는 주문상품입니다.");

        if($orderProduct->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 주문상품만 반품요청할 수 있습니다.");

        if(!$orderProduct->can_refund)
            return redirect()->back()->with("error", "반품요청할 수 없는 주문입니다.");

        $types = RefundType::getValues();

        return Inertia::render("Shopping/Refunds/Create", [
            "orderProduct" => OrderProductResource::make($orderProduct),
            "types" => $types
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "order_product_id" => "required|integer",
            "reason_request" => "required|string|max:50000",
            /*"bank" => "required|string|max:50000",
            "account" => "required|string|max:50000",
            "owner" => "required|string|max:50000",*/

            "type" => "required|string|max:50000",
            "order_name" => "required|string|max:50000",
            "email" => "required|email|max:50000",
            "name" => "required|string|max:50000",
            "contact" => "required|string|max:50000",
            "contact_time" => "required|string|max:50000",
            "address" => "required|string|max:50000",
            "address_detail" => "required|string|max:50000",
            "address_zipcode" => "required|string|max:50000",
        ]);

        $orderProduct = OrderProduct::whereHas("order", function($query){
            $query->where("state", "!=", OrderState::FAIL);
        })->where("id", $request->order_product_id)->first();

        if(!$orderProduct)
            return redirect()->back()->with("error", "존재하지 않는 주문상품입니다.");

        if($orderProduct->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 주문건만 반품요청할 수 있습니다.");

        if(!$orderProduct->can_refund)
            return redirect()->back()->with("error", "반품요청 할 수 없는 주문입니다.");

        $refund = auth()->user()->refunds()->create(array_merge($request->all()));

        return redirect("/shopping/refunds");
    }
}
