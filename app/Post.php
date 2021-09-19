<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'body', 'outdoor', 'indoor', 'rental', 'shuttle', 'prefecture', 'address', 'per_fee', 'charter_fee'
        ];
    
    //リレーション:Review
    public function reviews() {
        return $this->hasMany('\App\Review');
    }
    
    //リレーション:Favorite
    public function favorites() {
        return $this->hasMany('\App\Favorite');
    }
    
    //フィールド一覧ペジネーション
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    //favoriteの識別
    public function is_favorited_by_auth_user()
    {
        $id = Auth::id();
        
        $likers = array();
        foreach($this->favorites as $favorite) {
          array_push($likers, $favorite->user_id);
        }
        
        if (in_array($id, $likers, true)) {
          return true;//
        }
        else
        {
          return false;
        }
    }
  
}
