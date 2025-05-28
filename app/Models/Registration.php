<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'event_id'];

    // Registration belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Registration belongs to an event
        public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
