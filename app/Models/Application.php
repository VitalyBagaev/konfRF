<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['user_id', 'date', 'payment', 'room_id', 'app_name'])]

class Application extends Model
{
    protected $casts = [
        'date' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
