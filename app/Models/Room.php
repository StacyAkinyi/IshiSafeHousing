<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'agent_id',
        'room_number',
        'description',
        'rent',
        'capacity',
        'is_available',
    ];

    // Optional: Define relationships to Property and Agent (User)
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
      public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
