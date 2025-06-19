<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     * This automatically converts your date strings into powerful Carbon objects.
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
