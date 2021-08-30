<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //検索画面
    
    public function search(Request $request) {
      $keyword_name = $request->name;
      
      //フィールド名キーワード検索
      if(!empty($keyword_name)) {
          $query = Post::query();
          $posts = $query->where('name','like', '%' .$keyword_name. '%')->orWhere('body','like', "%" .$keyword_name. "%")->get();
          //検索結果がある場合
          if(strpos($posts, $keyword_name) !== false){
              $message = "「". $keyword_name."」を含む検索が完了しました。";
              return view('search')->with([
              'posts' => $posts,
              'message' => $message,
              ]);
          }
          //検索結果が無い場合
          else {
              $message = "「". $keyword_name."」を含む検索結果はありませんでした。";
              return view('search')->with('message',$message);
          }
      }
      //レンタル
      elseif(empty($keyword_name) && !empty($keyword_body)) {
          $query = Post::query();
          $posts = $query->where('body','like', "%" .$keyword_body. "%")->get();
          //検索結果がある場合
          if(strpos($posts, $keyword_body) !== false){
              $message = "「". $keyword_body."」を含む本文の検索が完了しました。";
              return view('search')->with([
              'posts' => $posts,
              'message' => $message,
              ]);
          }
          //検索結果が無い場合
          else {
              $message = "「". $keyword_body."」を含む本文の検索結果はありませんでした。";
              return view('search')->with('message',$message);
          }
      }
      else {
          $message = "検索結果はありません。";
          return view('search')->with('message',$message);
      }
    }
    
    
    
    //Post一覧の表示
    public function index(Post $post)
    {
        $user = Auth::user();
        return view('index')->with([
            'posts' => $post->getPaginateByLimit(),
            'user' => $user,
            ]);
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
