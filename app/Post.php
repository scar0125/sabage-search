<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'body', 'outdoor', 'indoor', 'rental', 'shuttle', 'prefecture', 'address', 'per_fee', 'charter_fee'
        ];
    
    //フィールド一覧ペジネーション
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
}
