<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "file_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function file(){
        return $this->belongsTo(File::class);
    }
}
