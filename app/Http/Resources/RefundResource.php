<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RefundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $state = "접수대기";

        if($this->refunded)
            $state = "완료";

        if($this->refunded === 0)
            $state = "반려";


        return [
            "id" => $this->id,
            "state" => $state,

            "reason_request" => $this->reason_request,
            "reason_deny" => $this->reason_deny,
            "memo" => $this->memo,
            "refunded" => isset($this->refunded) ? $this->refunded : "",

            "bank" => $this->bank,
            "account" => $this->account,
            "owner" => $this->owner,

            "orderProduct" => OrderProductResource::make($this->orderProduct),
            "user" => $this->user ? UserResource::make($this->user) : "",
            "price" => $this->price,

            "type" => $this->type,

            "order_name" => $this->order_name,
            "email" => $this->email,
            "name" => $this->name,
            "contact" => $this->contact,
            "contact_time" => $this->contact_time,

            "address" => $this->address,
            "address_detail" => $this->address_detail,
            "address_zipcode" => $this->address_zipcode,

            "created_at" => Carbon::make($this->created_at)->format("Y.m.d"),
            "updated_at" => Carbon::make($this->updated_at)->format("Y.m.d"),
        ];
    }
}
