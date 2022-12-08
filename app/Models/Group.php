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

    public function note(){
        return $this->hasOne(Note::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }
}
