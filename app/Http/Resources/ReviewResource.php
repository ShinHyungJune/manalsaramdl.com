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
        return [
            "id" => $this->id,
            "type" => $this->type,
            "title" => $this->title,
            "description" => $this->description,
            "sex" => $this->sex,
            "age" => $this->age,
            "job" => $this->job,
            "img" => $this->img ?? "",
            "created_at" => Carbon::make($this->created_at)->format("Y.m.d")
        ];
    }
}
