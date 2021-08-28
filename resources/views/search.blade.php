<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        
    <div style="margin-top:50px;">
        <h1>検索結果</h1>
        @if(isset($posts))
        <table class="table">
            <tr>
            <th>フィールド名</th><th>本文</th>
            </tr>
        @foreach($posts as $post)
            <tr>
            <td>{{$post->name}}</td><td>{{$post->body}}</td>
            </tr>
        @endforeach
        </table>
        @endif
    
        @if(!empty($message))
        <div class="alert alert-primary" role="alert">{{ $message}}</div>
        @endif
    </div>
        
    </body>
</html>