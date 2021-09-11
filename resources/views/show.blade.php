@extends('layouts.app')

@section('content')
        
        <h1 class="title">
            {{ $post->title }}
        </h1>
        
        @if (Auth::guard('admin')->check())
        <p class="edit">[<a href="/posts/{{ $post->id }}/edit">編集</a>]</p>
        @endif
        
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p class='body'>{{ $post->body }}</p>
                <p class='per_fee'>一人あたりの最低料金：{{ $post->per_fee }}円</p>
                <p class='charter_fee'>貸し切り最低料金：{{ $post->charter_fee }}円</p>
                <p class='indoor'>屋内：{{ $post->indoor }}</p>
                <p class='outdoor'>屋外：{{ $post->outdoor }}</p>
                <p class='rental'>レンタル：{{ $post->rental }}</p>
                <p class='shuttle'>送迎：{{ $post->shuttle }}</p>
                <p class='address'>住所：{{ $post->prefecture }}{{ $post->address }}</p>
            </div>
        </div>
        
@endsection