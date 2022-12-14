<?php

namespace App\Http\Resources;

use App\Models\Allergy;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dayOfWeeks = [
            "일","월","화","수","목","금","토","일"
        ];

        $openedAt = $this->opened_at ? Carbon::make($this->opened_at)->format("m.d (").$dayOfWeeks[Carbon::make($this->opened_at)->dayOfWeek].")"." ".Carbon::make($this->opened_at)->format("H:i") : "";

        $img = $this->img ? $this->img : "";
        $imgsParty = $this->imgs_party ? $this->imgs_party : "";
        $imgsFood = $this->imgs_food ? $this->imgs_food : "";

        if($this->originProduct) {
            $img = $this->originProduct->img ? $this->originProduct->img : "";
            $imgsParty = $this->originProduct->imgs_party ? $this->originProduct->imgs_party : "";
            $imgsFood = $this->originProduct->imgs_food ? $this->originProduct->imgs_food : "";
        }

        $tags = [];

        if($this->tags) {
            $items = explode("#",$this->tags);

            foreach($items as $item){
                if($item != "")
                    $tags[] = str_replace(" ", "", $item);
            }
        }

        return [
            "id" => $this->id,
            "type" => $this->type,
            "title" => $this->title,
            "price" => $this->price,
            "options" => OptionResource::collection($this->options), // 옵션상품
            "count" => $this->count, // 구매용 상품으로 만들면서 세팅된 개수
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
            "origin_product_id" => $this->origin_product_id, // 구매용 상품으로 만들어진 경우 본래 상품 id

            "img" => $img,
            "imgs_party" => $imgsParty,
            "imgs_food" => $imgsFood,

            "count_dating" => $this->count_dating,
            "opened_at" => $openedAt,
            "place" => $this->place,
            "address" => $this->address,
            "age" => $this->age,
            "max_women" => $this->max_women,
            "max_men" => $this->max_men,
            "accept_women" => $this->accept_women,
            "accept_men" => $this->accept_men,
            "must_do" => $this->must_do,
            "tags" => $tags,
            "ongoing" => $this->ongoing ? 1 : 0,
        ];
    }
}
