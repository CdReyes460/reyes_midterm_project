<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'status',
        'room_type_id',
    ];

    public function roomtype()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
