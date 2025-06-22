<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'student_id',
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
     public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
    
}
