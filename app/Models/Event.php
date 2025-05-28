<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'location'];
    protected $casts = [
    'date' => 'datetime',
];


    // One event has many registrations
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

}
