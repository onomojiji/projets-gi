<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "birth_date", "birth_place"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function classe_students(){
        return $this->hasMany(ClassStudent::class);
    }
    public function student_groups(){
        return $this->hasMany(StudentGroup::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
