<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
     use HasFactory;

    // Allow the 'path' and 'room_id' fields to be filled
    protected $fillable = ['room_id', 'path'];

    // Define the inverse relationship: an image belongs to a room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
