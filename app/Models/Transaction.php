<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['land_listing_id', 'user_id', 'status'];

    public function landListing()
    {
        return $this->belongsTo(LandListing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
