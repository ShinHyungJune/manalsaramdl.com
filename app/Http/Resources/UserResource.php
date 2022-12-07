<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "img" => $this->img ? $this->img : "",
            "name" => $this->name,
            "contact" => $this->contact,
            "social_platform" => $this->social_platform,
            /*"order_name" => $this->order_name,
            "order_contact" => $this->order_contact,*/
            "agree_ad" => $this->agree_ad,
            "point" => $this->point,

            "owner" => $this->owner,
            "bank" => $this->bank,
            "account" => $this->account,

            // 새로 작업
            "address" => $this->address,
            "address_detail" => $this->address_detail,
            "address_zipcode" => $this->address_zipcode,
            "email" => $this->email,
            "ids" => $this->ids,
            "count_review" => $this->reviews()->count(), // 리뷰수
            "elevator" => $this->elevator,

            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
            "updated_at" => Carbon::make($this->updated_at)->format("Y-m-d H:i")
        ];
    }
}
