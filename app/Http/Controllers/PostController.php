<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //検索画面
    
    public function search(Request $request) {
      $keyword_name = $request->name;
      $keyword_body = $request->body;

      if(!empty($keyword_name) && empty($keyword_body)) {
      $query = Post::query();
      $posts = $query->where('name','like', "%" .$keyword_name. "%")->get();
      $message = "「". $keyword_name."」を含む名前の検索が完了しました。";
      return view('search')->with([
        'posts' => $posts,
        'message' => $message,
      ]);
    }
    elseif(empty($keyword_name) && !empty($keyword_body)) {
      $query = Post::query();
      $posts = $query->where('name','like', "%" .$keyword_body. "%")->get();
      $message = "「". $keyword_body."」を含む本文の検索が完了しました。";
      return view('search')->with([
        'posts' => $posts,
        'message' => $message,
      ]);
    }
    else {
      $message = "検索結果はありません。";
      return view('search')->with('message',$message);
      }
    }
    
    
    
    
    
    
    
    //Post一覧の表示
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    
    public function show(Post $post)
    {
        return view('show')->with(['post' => $post]);
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}
