<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	
	protected $fillable = ['text','user_id','thread_id'];

    public function user() {
        return $this->belongsTo('\App\User');
    }

    public function thread() {
    	return $this->belongsTo('\App\Thread');
    }

}
