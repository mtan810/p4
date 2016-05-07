<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
	
    protected $fillable = ['name','text','user_id','subject_id'];

    public function comments() {
        return $this->hasMany('\App\Comment');
    }

    public function user() {
        return $this->belongsTo('\App\User');
    }

    public function thread() {
    	return $this->belongsTo('\App\Subject');
    }

}
