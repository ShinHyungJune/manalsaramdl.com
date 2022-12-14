<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatingResource extends JsonResource
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
            "women" => UserResource::make($this->women),
            "men" => UserResource::make($this->men),
            "read_men" => $this->read_men,
            "read_women" => $this->read_women,
            "check_address" => $this->check_address,
            "address" => $this->address,
            "address_detail" => $this->address_detail,
            "city1" => $this->city1,
            "area1" => $this->area1,
            "city2" => $this->city2,
            "area2" => $this->area2,
            "schedule1" => $this->schedule1,
            "schedule2" => $this->schedule2,
            "schedule3" => $this->schedule3,
            "schedule4" => $this->schedule4,
            "schedule5" => $this->schedule5,
            "scheduled_at" => $this->scheduled_at,
            "ongoing"
        ];
    }
}
