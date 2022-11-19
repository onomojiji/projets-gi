<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;

    protected $fillable = ['classe_id', 'student_id'];

    public function classe(){
        return $this->hasOne(Classe::class);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }
}
