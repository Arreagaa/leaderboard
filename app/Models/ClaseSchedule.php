<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaseSchedule extends Model
{

    protected $guarded = ['id'];

    public function users(){
        return $this->belongsToMany(ApplyUser::class, 'clase_schedule_user', 'clase_schedule_id', 'apply_user_id');
    }

    public function claseScheduleUser(){
        return $this->hasMany(ClaseScheduleUser::class);
    }
}
