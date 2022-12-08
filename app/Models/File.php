<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ["group_id", "title", "src", "delected"];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function downloads(){
        return $this->hasMany(Download::class);
    }
}
