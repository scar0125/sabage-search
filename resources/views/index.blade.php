@extends('layouts.app')

@section('content')

        @if (Auth::check())
            <p>User: {{$user->name}}</p>
        @else
            <p>
                ログインしていません(<a href="/login">ログイン</a>|
                <a href="/register">登録</a>)
            </p>
        @endif
        <h1>検索条件を入力</h1>
        <form action="/result" method="GET" style="margin-bottom: 1rem;">
            @csrf
    
        <div class="form-group">
        <label>キーワード検索</label>
        <input type="text" class="form-control col-md-5" placeholder="渋谷" name="keyword">
        </div>
        
        <div class="form-group">
        <label>1人あたりの料金</label>
        <input type="text" class="form-control col-md-5" placeholder="3000" name="per_fee" value="{{ old("per_fee")}}">
        <select class="form-control col-md-5" name="per_fee_condition">
            <option selected value="0">選択...</option>
            <option value="1">以上</option>
            <option value="2">以下</option>
        </select>
        </div>
        
        <div class="form-group">
        <label>貸切料金</label>
        <input type="text" class="form-control col-md-5" placeholder="50000" name="charter_fee" value="{{ old("charter_fee")}}">
        <select class="form-control col-md-5" name="charter_fee_condition">
            <option selected value="0">選択...</option>
            <option value="1">以上</option>
            <option value="2">以下</option>
        </select>
        </div>
        
        <div class="form-group">
        <label>フィールド条件</label>
        <select class="form-control col-md-5" name="field_condition">
            <option selected value="0">指定なし</option>
            <option value="1">屋内</option>
            <option value="2">屋外</option>
            <option value="3">両方</option>
        </select>
        </div>
    
        <div class="form-group">
        <label>レンタル</label>
        <select class="form-control col-md-5" name="rental_condition">
            <option selected value="0">指定なし</option>
            <option value="1">あり</option>
            <option value="2">なし</option>
        </select>
        </div>
        
        <div class="form-group">
        <label>送迎</label>
        <select class="form-control col-md-5" name="shuttle_condition">
            <option selected value="0">指定なし</option>
            <option value="1">あり</option>
            <option value="2">なし</option>
        </select>
        </div>
        
        <div class="form-group">
        <label>都道府県</label>
        <select class="form-control col-md-5" name="prefecture_condition">
            <option selected value="">指定なし</option>
            @foreach($prefectures as $key => $value)
	        <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        </div>
        
        <div class="form-group">
            <p>
            <input type="radio" name="search_condition" value="1" checked>AND検索
            <input type="radio" name="search_condition" value="2">OR検索
            </p>
        </div>

        <button type="submit" class="btn btn-primary col-md-5">検索</button>
        </form>
    
        @if(session('flash_message'))
            <div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
        @endif
        
        @if (Auth::guard('admin')->check())
        <p class='create'>[<a href='/create'>投稿作成</a>]</p>
        @endif
        
        <!--投稿一覧画面仮表示-->
        <div class='posts'>
            <h3>投稿一覧画面(仮)</h3>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='name'>{{ $post->name }}</h2>
                    <p class='body'>{{ $post->body }}</p>
                    <p class='per_fee'>一人あたり最低料金：{{ $post->per_fee }}円</p>
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
        
@endsection