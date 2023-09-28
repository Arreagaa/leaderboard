<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaseScheduleTeam extends Model
{
    protected $table = 'clase_schedule_team';
    protected $guarded = ['id'];

    public function claseSchedule(){
        return $this->belongsTo(ClaseSchedule::class);
    }

    public function claseTeam(){
        return $this->belongsTo(ClaseTeam::class);
    }
}
