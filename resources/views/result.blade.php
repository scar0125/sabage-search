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
            <div class='post card'>
                <h3 class='card-title'><a href="/posts/{{ $post->id }}" target="_blank" rel="noopener noreferrer">{{ $post->name }}</a></h3>
                <div class='card-body'>
                    <p class='per_fee'>一人あたりの最低料金：{{ $post->per_fee }}円</p>
                    <p class='charter_fee'>貸し切り最低料金：{{ $post->charter_fee }}円</p>
                    <p class='field_condition'>屋内：{{ $post->indoor }}・屋外：{{ $post->outdoor }}</p>
                    <p class='rental shuttle'>レンタル：{{ $post->rental }}・送迎：{{ $post->shuttle }}</p>
                    <p class='address'>住所：{{ $post->prefecture }}{{ $post->address }}</p>
                </div>
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