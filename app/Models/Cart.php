<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'land_listing_id',
        'transaction_id',
        'total_payment',
        'payment_option',
        'plan',
        'reference_image',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function landListing()
    {
        return $this->belongsTo(LandListing::class, 'land_listing_id');
    }


    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
