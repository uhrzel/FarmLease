<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'user_id',
        'landlisting_id',
        'comments',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function landListing()
    {
        return $this->belongsTo(LandListing::class, 'landlisting_id', 'id');
    }
}
