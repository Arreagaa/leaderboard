<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaseScheduleUser extends Model
{
    protected $table = 'clase_schedule_user';
    protected $guarded = ['id'];

    public function claseSchedule(){
        return $this->belongsTo(ClaseSchedule::class);
    }

    public function applyUser(){
        return $this->belongsTo(ApplyUser::class);
    }

    
}
