<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_name',
        'room_id',
        'user_id',
        'photo',
        'description',
    ];

    public function application(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}

