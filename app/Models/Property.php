<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
