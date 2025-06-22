<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 

class Review extends Model
{
    protected $fillable = ['booking_id', 'rating', 'description'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
    
}
