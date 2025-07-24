<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'weekdays',
        'open_time',
        'close_time',
        'studio_id',
        'room_id'
    ];

    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }

    public function studios()
    {
        return $this->belongsTo(Studio::class);
    }
}
