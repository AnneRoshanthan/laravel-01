<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'message',
        'data',
        'read_at',
    ];
}
