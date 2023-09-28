<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyUserClaseTeam extends Model
{
    protected $table = 'apply_user_class_team';
    protected $guarded = ['id'];
    
    public function applyUser(){
        return $this->belongsTo(ApplyUser::class);
    }

    public function claseTeam(){
        return $this->belongsTo(ClaseTeam::class);
    }
}
