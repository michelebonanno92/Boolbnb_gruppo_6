<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    protected $fillable = [
        'apartment_id',
        'package',
        'price',
        // 'start_time',
        // 'end_time'
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'apartment_sponsorship')
                    ->withPivot('start_time', 'end_time')
                    ->withTimestamps();
    }
}
