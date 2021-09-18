<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'post_id', 'user_id', 'comment',
        ];
    
    //リレーション：User
    public function user() {
        return $this->belongsTo('\App\User');
    }
    
    //リレーション：Post
    public function post() {
        return $this->belongsTo('\App\Post');
    }
    
}
