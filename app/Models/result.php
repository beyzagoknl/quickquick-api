<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'point', 'correct', 'wrong'];
    public $timestamps = true;
    
    public function user(){
        return $this->belongsTo (User::class);
    }
}
