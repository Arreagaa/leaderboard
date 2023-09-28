<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaseTeam extends Model
{
    protected $table = 'clase_teams';
    protected $guarded = ['id'];

    public function claseScheduleTeam(){
        return $this->hasMany(ClaseScheduleTeam::class);
    }

    public function users(){
        return $this->belongsToMany(ApplyUser::class, 'apply_user_class_team', 'clase_team_id', 'apply_user_id');
    }
}
