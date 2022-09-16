<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public function course(){
        return $this->belongsTo(Course::Class);
    }

    public function assignments(){
        return $this->haMany(Assignment::class);
    }
}
