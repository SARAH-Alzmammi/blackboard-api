<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    public function chapter(){
        return $this->belongsTo(Chapter::Class);
    }

    public function studentAssignments(){
        return $this->hasMany(StudentAssignment::Class);
    }
}