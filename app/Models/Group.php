<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        "classe_id", 
        "title", 
        "delegate",
        "theme", 
        "description", 
        "link",
        "token",
    ];

    public function student_groups(){
        return $this->hasMany(StudentGroup::class);
    }

    public function classe(){
        return $this->belongsTo(Classe::class);
    }
}
