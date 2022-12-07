<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Review extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "user_id",
        "product_id",
        "order_product_id",
        "title",
        "description",
        "photo",
        "point",
        "best"
    ];

    protected $appends = ["imgs"];

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('imgs');
    }

    public function getImgsAttribute()
    {
        $items = [];

        if($this->hasMedia('imgs')) {
            $medias = $this->getMedia('imgs');

            foreach($medias as $media){
                $items[] = [
                    "name" => $media->file_name,
                    "url" => $media->getFullUrl()
                ];
            }
        }

        return $items;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }
}
