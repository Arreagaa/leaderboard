<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function workouts(){
        return $this->belongsToMany(Workout::class);
    }

    public function athletes(){
        return $this->hasMany(Athlete::class);
    }
}
