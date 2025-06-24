<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

   
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
      public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews(): HasManyThrough
    {
        // A Room has many Reviews through the Booking model.
        return $this->hasManyThrough(Review::class, Booking::class);
    }
}
