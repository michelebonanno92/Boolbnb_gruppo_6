<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
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

    protected $appends = [
        'full_image_url'
    ];

    // Costum Attributes

    public function getFullImageUrlAttribute()
    {
        $fullImageUrl = null;

        if ($this->image) {
            $fullImageUrl = asset('storage/'.$this->image);
        }

        return $fullImageUrl;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class, 'apartment_sponsorship')
                    ->withPivot('start_time', 'end_time')
                    ->withTimestamps();
    }
    
}
