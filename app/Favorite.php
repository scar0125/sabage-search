<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'post_id', 'user_id',
        ];
    
    //リレーション：Post
    public function post() {
        return $this->belongsTo('\App\Post');
    }
    
    //リレーション：User
    public function user() {
        return $this->belongsTo('\App\User');
    }
    
}
