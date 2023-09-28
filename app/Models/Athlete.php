<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;
    protected $appends = ['full_name', 'category_name'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }

}
