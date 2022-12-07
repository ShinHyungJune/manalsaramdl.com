<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "title",
        "order"
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function($model){
            $model->order = Usage::count() + 1;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
