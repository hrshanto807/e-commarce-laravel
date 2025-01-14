<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    use HasFactory;

    // Define the table if it's different from the default (plural of the model name)
    protected $table = 'customer_profiles';

    // Fillable fields for mass assignment
    protected $fillable = [
        "cus_name",
        "cus_add",
        "cus_city",
        "cus_state",
        "cus_postcode",
        "cus_country",
        "cus_phone",
        "cus_fax",
        "ship_name",
        "ship_add",
        "ship_city",
        "ship_state",
        "ship_postcode",
        "ship_country",
        "ship_phone",
        "user_id"
    ];

    // If you want to automatically handle timestamps
    public $timestamps = true;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
