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
        <form action="/result" method="GET">
            @csrf
    
        <div class="form-group">
        <label>キーワード検索</label>
        <input type="text" class="form-control col-md-5" placeholder="渋谷" name="keyword">
        </div>
        
        <div class="form-group">
        <label>1人当たりの料金</label>
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
            <option selected value="0">指定なし</option>
            <option value="1">茨城県</option>
            <option value="2">栃木県</option>
            <option value="3">群馬県</option>
            <option value="4">埼玉県</option>
            <option value="5">千葉県</option>
            <option value="6">東京都</option>
            <option value="7">神奈川県</option>
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
        
        <!--仮表示：全投稿一覧
        <div class='posts'>
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
        -->
    
    </body>
</html>