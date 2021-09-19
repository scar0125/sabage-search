@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            
            <div class="favorite card" style="margin-top: 1rem;">
                <div class="card-header">お気に入りしたフィールド</div>
                    @foreach ($favorites as $favorite)
                        @if(!empty($favorite->user->id) && $favorite->user->id == $user->id)
                            <article class="card-body">
                                <h5><a href="/posts/{{ $favorite->post->id }}" target="_blank" rel="noopener noreferrer">{{ $favorite->post->name }}</a></h5>
                                <p style="color: #808080;">お気に入り日時：{{ $favorite->created_at }}</p>
                                <a href="{{ route('post.not-favorite', ['id' => $favorite->post->id]) }}" class="btn btn-secondary btn-sm">お気に入りから削除</a>
                            </article>
                        @endif
                    @endforeach
                    <div class='paginate'>
                        {{ $favorites->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
