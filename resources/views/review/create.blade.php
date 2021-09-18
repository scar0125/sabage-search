@extends('layouts.app')

@section('content')
    <div class="review-create">
        <form action="/review" method="post">
            @csrf
        
            <div class="form-group">
                <h2><label>Post_id</label></h2>
                <input type="number" name="review[post_id]" value="{{ $post->id }}"/>
            </div>
        
            <div class="form-group">
                <h2><label>User_id</label></h2>
                <input type="number" name="review[user_id]" value="{{ $user->id }}"/>
            </div>
            
            <div class="form-group">
                <h2><label>レビュー</label></h2>
                <textarea name="review[comment]" placeholder="comment">{{ old('review.comment') }}</textarea>
            </div>
            
            <input type="submit" value="投稿"/>
        </form>
    </div>    
@endsection