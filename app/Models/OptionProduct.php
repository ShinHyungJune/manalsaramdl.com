<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "title",
        "price",
        "count",
        "for_order"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
