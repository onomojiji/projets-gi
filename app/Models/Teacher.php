<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "grade", "type"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function classes(){
        return $this->hasMany(Classe::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
}
