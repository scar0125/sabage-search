<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'review.comment' => 'required|string|max:800',
        ];
    }
}