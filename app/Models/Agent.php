<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agent extends Model
{
     use HasFactory;
    protected $fillable = ['user_id', 'phone_number', 'license_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
