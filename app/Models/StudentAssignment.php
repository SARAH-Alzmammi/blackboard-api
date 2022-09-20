<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','assignment_id','file','file','grade','attempt'];

    public function assignment(){
        return $this->belongsTo(Assignment::class);
    }
}
