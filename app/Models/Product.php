<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "brand_id",
        "name",
        "slug",
        "description",
        "image",
        "price",
        "color",
        "weight",
        "material",
        "is_active",
        "is_popular",
        "is_sale",
        "is_new"
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
