<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'rooms',
        'beds',
        'toilets',
        'square_meters',
        'address',
        'latitude',
        'longitude',
        'image',
        'visible',
        'messages'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
}
