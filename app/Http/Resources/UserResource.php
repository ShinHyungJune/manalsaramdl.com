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
            "imgs" => $this->imgs,

            "email" => $this->email,
            "contact" => $this->contact,
            "name" => $this->name,

            "sex" => $this->sex,
            "birth" => $this->birth,
            "job" => $this->job,
            "school" => $this->school,
            "city" => $this->city,
            "area" => $this->area,
            "need_service" => $this->need_service,
            "registration_way" => $this->registration_way,
            "city_company" => $this->city_company,
            "area_company" => $this->area_company,
            "tall" => $this->tall,
            "weight" => $this->weight,
            "instagram" => $this->instagram,
            "ideal" => $this->ideal,
            "introduce" => $this->introduce,
            "to_manager" => $this->to_manager,
            "marriage" => $this->marriage,
            "comment_manager" => $this->comment_manager,
            "count_dating" => $this->count_dating,

            "social_platform" => $this->social_platform,
            "agree_ad" => $this->agree_ad,
            "point" => $this->point,

            "owner" => $this->owner,
            "bank" => $this->bank,
            "account" => $this->account,

            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
            "updated_at" => Carbon::make($this->updated_at)->format("Y-m-d H:i")
        ];
    }
}
