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
        @if(!empty($message))
        <div class="alert alert-primary" role="alert">{{ $message}}</div>
        @endif
        
        @if(isset($posts))
        <div class="table">
        @foreach($posts as $post)
            <div class='post'>
                <h2 class='name'>{{ $post->name }}</h2>
                <p class='body'>{{ $post->body }}</p>
                <p class='per_fee'>一人あたりの最低料金：{{ $post->per_fee }}円</p>
                <p class='charter_fee'>貸し切り最低料金：{{ $post->charter_fee }}円</p>
                <p class='indoor'>屋内：{{ $post->indoor }}</p>
                <p class='outdoor'>屋外：{{ $post->outdoor }}</p>
                <p class='rental'>レンタル：{{ $post->rental }}</p>
                <p class='shuttle'>送迎：{{ $post->shuttle }}</p>
                <p class='address'>住所：{{ $post->prefecture }}{{ $post->address }}</p>
            </div>
        @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        @endif
    
    </div>
        
    </body>
</html>