<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_text',
        'sent_date',
        'user_email'
        
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
        
    }
}
