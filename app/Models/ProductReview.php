<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{


    protected $fillable = [
        "user_id",
        'product_id',
        'customer_id',
        "rating",
        "description",
       
    ];

    public function profile():BelongsTo
    {
        return $this->belongsTo(CustomerProfile::class,'customer_id');
    }
}
