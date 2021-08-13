<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //Post一覧の表示
    public function index(Post $post)
    {
        return $post->get();
    }
}
