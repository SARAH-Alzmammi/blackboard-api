<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['chapter_id','name','instructions','file','weight','allowed_attempts','deadline'];

    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function studentAssignments(){
        return $this->hasMany(StudentAssignment::class);
    }
}
