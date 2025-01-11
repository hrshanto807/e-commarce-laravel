<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table if it's different from the default (plural of the model name)
    protected $table = 'products';

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'short_des',
        'price',
        'discount',
        'discount_price',
        'image',
        'stock',
        'star',
        'remark',
        'category_id',
        'brand_id'
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with the Brand model
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
