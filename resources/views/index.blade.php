<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <body>
        @if (Auth::check())
            <p>User: {{$user->name}}</p>
        @else
            <p>
                ログインしていません(<a href="/login">ログイン</a>|
                <a href="/register">登録</a>)
            </p>
        @endif
        <h1>検索条件を入力</h1>
        <form action="/search" method="post">
            @csrf
            @method('GET')
    
        <div class="form-group">
        <label>キーワード検索</label>
        <input type="text" class="form-control col-md-5" placeholder="渋谷" name="name">
        </div>
    
        <!--<div class="form-group">
        <label>本文</label>
        <input type="text" class="form-control col-md-5" placeholder="本文を入力してください" name="body" value="{{ old("body")}}">
        </div>
        -->

        <button type="submit" class="btn btn-primary col-md-5">検索</button>
        </form>
    
        @if(session('flash_message'))
            <div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
        @endif
    
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                <h2 class='name'>{{ $post->name }}</h2>
                <p class='body'>{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    
    </body>
</html>