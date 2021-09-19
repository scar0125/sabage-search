@extends('layouts.app')

@section('content')
    <!-- フィールド詳細表示 -->
    <div class="post">
        
        <!-- 管理者ログイン時：編集リンク表示 -->
        @if (Auth::guard('admin')->check())
        <p class="edit">[<a href="/posts/{{ $post->id }}/edit">編集</a>]</p>
        @endif
        
        <!-- お気に入り表示 -->
        <div>
            @if($post->is_favorited_by_auth_user())
            <a href="{{ route('post.not-favorite', ['id' => $post->id]) }}" class="btn btn-success btn-sm">お気に入り<span class="badge">{{ $post->favorites->count() }}</span></a>
            @else
            <a href="{{ route('post.favorite', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">お気に入り<span class="badge">{{ $post->favorites->count() }}</span></a>
            @endif
        </div>
        
        <div class="content">
            <div class="content__post">
                <h3 class='name'>{{ $post->name }}</h3>
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
    </div>
    
    <!-- ログイン時：レビュー投稿モーダル表示 -->
    @if (Auth::check())
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCentered">
            レビューを投稿
        </button>

        <!-- Modal -->
        <div class="modal" id="ModalCentered" tabindex="-1" role="dialog" aria-labelledby="ModalCenteredLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCenteredLabel">レビュー</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- レビュー投稿フォーム -->
                <form action="/posts/{{ $post->id }}/review" method="post">
                    @csrf
                        <div class="modal-body" style="max-height: calc(100vh - 30vh);">
                            <input type="hidden" name="review[user_id]" value="{{ $user->id }}"/>
                            <input type="hidden" name="review[post_id]" value="{{ $post->id }}"/>
                            
                            <sup>※800字以内</sup>
                            <div class="@if(!empty($errors->first('review.comment'))) has-error @endif">
                                <textarea name="review[comment]" placeholder="コメント" class="container-fluid" style="height: calc( 1.3em * 5 ); border-radius: 0.2rem;" required>
                                    {{ old('review.comment') }}
                                </textarea>
                                <p class="comment__error" style="color:red">{{ $errors->first('review.comment') }}</p>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <p style="margin-right: 1rem;">ユーザー名：{{ $user->name}}</p>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <input type="submit" value="投稿" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
          </div>
        </div>
    @elseif (Auth::guard('admin')->check())
        <p class="alert alert-info">
            管理者ログイン中：削除できます(<a href="/admin">管理者画面</a>)
        </p>
    @else
        <p class="alert alert-info">
            レビューを投稿するにはログインしてください(<a href="/login">ログイン</a>|
            <a href="/register">登録</a>)
        </p>
    @endif
    
    <!-- レビュー表示 -->
    <div class="review" style="margin-top: 1rem;">
        @foreach ($reviews as $review)
            @if(!empty($review->post->id))
                @if($review->post->id == $post->id)
                    <article>
                        <h5 style="display: inline-block;">{{ $review->user->name }}</h5>
                        <p style="display: inline-block; margin-left: 0.2rem; color: #808080;"> {{ $review->created_at }}</p>
                        <p>{{ $review->comment }}</p>
                    </article>
                
                    @if((Auth::check() && $review->user->id == $user->id) || Auth::guard('admin')->check())<!-- レビュー削除 -->
                    <form action="{{ route('review.delete', [ 'post' => $post->id ])}}" method="POST" onSubmit="return check()">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $review->id }}">
                        <button type="submit" class="btn btn-secondary">削除</button>
                    </form>
                    @endif
                @endif
            @endif
        @endforeach
        <div class='paginate'>
            {{ $reviews->links() }}
        </div>
    </div>
        
@endsection

<script type="text/javascript">
    function check(){
	    if(window.confirm('本当に削除しますか？')){ // 確認ダイアログを表示
	        return true;
	    }
	    else{ // 「キャンセル」時の処理
		    return false;
	    }
    }
</script>