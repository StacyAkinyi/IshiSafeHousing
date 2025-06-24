<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Property extends Model
{
    use HasFactory; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'address',
        'city',
        'description',
        'status',
        'latitude',
        'longitude',
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Booking::class, 'room_id', 'booking_id', 'id', 'id');
    }
    public function bookings(): HasManyThrough
    {
        return $this->hasManyThrough(Booking::class, Room::class);
    }
   
}
