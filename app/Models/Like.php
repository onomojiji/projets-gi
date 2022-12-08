<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ["unliked", "student_id", "group_id"];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
