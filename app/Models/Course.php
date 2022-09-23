<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title','status'];

    public function user(){
        return $this->belongsToMany(User::class);
    }
    
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
}
