@extends('layouts.app')

@section('content')
        
    <div style="margin-top:50px;">
        <h1>検索結果</h1>
        @if(!empty($message))
        <div class="alert alert-primary" role="alert">{{ $message}}</div>
        @endif
        
        @if(isset($posts))
        <div class="table">
        @foreach($posts as $post)
            <div class='post'>
                <h3><a href="/posts/{{ $post->id }}" target="_blank" rel="noopener noreferrer">{{ $post->name }}</a>
                <p class='body'>{{ $post->body }}</p>
                <p class='per_fee'>一人あたりの最低料金：{{ $post->per_fee }}円</p>
                <p class='charter_fee'>貸し切り最低料金：{{ $post->charter_fee }}円</p>
                <p class='indoor'>屋内：{{ $post->indoor }}</p>
                <p class='outdoor'>屋外：{{ $post->outdoor }}</p>
                <p class='rental'>レンタル：{{ $post->rental }}</p>
                <p class='shuttle'>送迎：{{ $post->shuttle }}</p>
                <p class='address'>住所：{{ $post->prefecture }}{{ $post->address }}</p>
            </div>
            @if (Auth::guard('admin')->check())
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" onSubmit="return check()" style="display:inline">
                @csrf
                @method('DELETE')
                <input type="hidden" name="url" value="{{ $url }}">
                <button type="submit">削除</button>
            </form>
            @endif
        @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        @endif
    
    </div>

@endsection