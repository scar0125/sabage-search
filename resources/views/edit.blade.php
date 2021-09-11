@extends('layouts.app')

@section('content')
    <h1 class="title">編集画面</h1>
    <div class="content">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group @if(!empty($errors->first('post.name'))) has-error @endif">
                <h2><label>Name</label></h2>
                <input type="text" name="post[name]" placeholder="タイトル" value="{{ $post->name }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('post.name') }}</p>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.body'))) has-error @endif">
                <h2><label>Body</label></h2>
                <textarea name="post[body]" placeholder="本文">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.per_fee'))) has-error @endif">
                <h2><label>一人あたりの最低料金</label></h2>
                <input type="number" step="100" placeholder="3000" name="post[per_fee]" value="{{ $post->per_fee }}"/>
                <p class="per_fee__error" style="color:red">{{ $errors->first('post.per_fee') }}</p>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.charter_fee'))) has-error @endif">
                <h2><label>貸切の最低料金</label></h2>
                <input type="number" step="1000" name="post[charter_fee]" placeholder="50000" value="{{ $post->charter_fee }}"/>
                <p class="charter_fee__error" style="color:red">{{ $errors->first('post.charter_fee') }}</p>
            </div>
            
            <div class="form-group">
                <h2>フィールド条件</h2>
                <h3><label>屋内</label></h3>
                @if($post->indoor == "なし")
                <select class="form-control col-md-5" name="post[indoor]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
                @elseif($post->indoor == "あり")
                <select class="form-control col-md-5" name="post[indoor]">
                    <option value="なし">なし</option>
                    <option selected value="あり">あり</option>
                </select>
                @endif
                
                <h3><label>屋外</label></h3>
                @if($post->outdoor == "なし")
                <select class="form-control col-md-5" name="post[outdoor]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
                @elseif($post->outdoor == "あり")
                <select class="form-control col-md-5" name="post[outdoor]">
                    <option value="なし">なし</option>
                    <option selected value="あり">あり</option>
                </select>
                @endif
            </div>
            
            <div class="form-group">
                <h2><label>レンタル</label></h2>
                @if($post->rental == "なし")
                <select class="form-control col-md-5" name="post[rental]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
                @elseif($post->rental == "あり")
                <select class="form-control col-md-5" name="post[rental]">
                    <option value="なし">なし</option>
                    <option selected value="あり">あり</option>
                </select>
                @endif
            </div>
            
            <div class="form-group">
                <h2><label>送迎</label></h2>
                @if($post->shuttle == "なし")
                <select class="form-control col-md-5" name="post[shuttle]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
                @elseif($post->shuttle == "あり")
                <select class="form-control col-md-5" name="post[shuttle]">
                    <option value="なし">なし</option>
                    <option selected value="あり">あり</option>
                </select>
                @endif
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.prefecture'))) has-error @endif">
                <h2><label>都道府県</label></h2>
                <select class="form-control col-md-5" name="post[prefecture]">
                @foreach($prefectures as $key => $value)
                @if($key == $post->prefecture)
                    <option selected value="{{ $post->prefecture }}">{{ $post->prefecture }}</option>
                @else
	                <option value="{{ $key }}">{{ $value }}</option>
	            @endif
                @endforeach
                </select>
                <p class="prefecture__error" style="color:red">{{ $errors->first('post.prefecture') }}</p>
            </div>
            
            <div class="form-group">
                <h2><label>住所</label></h2>
                <input type="text" name="post[address]" placeholder="新宿区新宿0-0-0" value="{{ $post->address}}"/>
                <p class="address__error" style="color:red">{{ $errors->first('post.address') }}</p>
            </div>
            
            <input type="submit" value="保存"/>
        </form>
    </div>
    <div class="back">[<a href="/posts/{{ $post->id }}">戻る</a>]</div>
@endsection