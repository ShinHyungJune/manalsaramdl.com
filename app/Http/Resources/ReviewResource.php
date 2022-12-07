<?php

namespace App\Http\Resources;

use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = null;

        if($this->product)
            $product = $this->product;

        if($this->orderProduct)
            $product = $this->orderProduct->product;

        return [
            "id" => $this->id,
            "best" => $this->best,
            "imgs" => $this->imgs ?? "",
            "user" => UserResource::make($this->user),
            "product_id" => $this->product->origin_product_id ?? $this->product->id,
            "product" => $product ? ProductResource::make($this->product) : $product,
            "orderProduct" => $this->orderProduct ? OrderProductResource::make($this->orderProduct) : "",
            "title" => $this->title,
            "description" => $this->description,
            "point" => $this->point,
            "photo" => $this->photo,
            "replies" => ReplyResource::collection($this->replies),
            "created_at" => Carbon::make($this->created_at)->format("Y.m.d")
        ];
    }
}
