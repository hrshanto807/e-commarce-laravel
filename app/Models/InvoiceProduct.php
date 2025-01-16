<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default plural model name
    protected $table = 'invoice_products';

    // Fillable fields for mass assignment
    protected $fillable = [
        "invoice_id",
        "product_id",
        "user_id",
        "qty",
        "sale_price"
    ];


    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Define the relationship with the User model
  
}
