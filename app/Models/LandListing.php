<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'landowner_name',
        'location',
        'price',
        'phone_number',
        'size',
        'soil_quality',
        'land_condition',
        'description',
        'image',
        'landowner_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'landowner_id');
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'land_listing_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'landowner_id');
    }
}
