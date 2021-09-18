<?php

namespace App\Http\Controllers;

use App\Post;
use App\Review;
use App\User;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //レビュー投稿
    public function store(ReviewRequest $request, Review $review, Post $post)
    {
        $input = $request['review'];
        $review->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    //レビュー削除
    public function delete(Request $request, Post $post)
    {
        $id = $request->id;
        $input = Review::find($id);
        $input->delete();
        return redirect('/posts/' . $post->id);
    }
    
}