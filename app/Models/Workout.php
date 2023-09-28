<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $appends = ['competition_type_name'];

    public function competition_type(){
        return $this->belongsTo(CompetitionType::class, 'competition_type_id', 'id');
    }

    public function getCompetitionTypeNameAttribute()
    {
        return $this->competition_type?->name;
    }
}
