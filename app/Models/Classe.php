<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'token', 'year_id', 'teacher_id'];

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function students(){
        return $this->hasMany(ClassStudent::class);
    }

    public function groupes(){
        return $this->hasMany(Group::class);
    }
}
