<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'post.name' => 'required|string|max:40',
            'post.body' => 'required|string|max:2000',
            'post.per_fee' => 'required|numeric',
            'post.charter_fee' => 'required|numeric',
            'post.prefecture' => 'required',
            'post.address' => 'required',
        ];
    }
}