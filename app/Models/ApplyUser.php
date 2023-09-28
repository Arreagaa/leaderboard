<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyUser extends Model
{
    protected $table = 'apply_users';
    protected $guarded = ['id'];
    // cast approved to boolean
    protected $casts = [
        'approved' => 'boolean',
    ];


    public function schedules(){
        return $this->belongsToMany(ClaseSchedule::class, 'clase_schedule_user', 'apply_user_id', 'clase_schedule_id');
    }

    public function teams(){
        return $this->belongsToMany(ClaseTeam::class, 'apply_user_class_team', 'apply_user_id', 'clase_team_id');
    }

}
