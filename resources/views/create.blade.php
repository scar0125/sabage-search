@extends('layouts.app')

@section('content')
    
        <h1>新規投稿作成</h1>
        <form action="/" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group @if(!empty($errors->first('post.name'))) has-error @endif">
                <h2><label>Name</label></h2>
                <input type="text" name="post[name]" placeholder="タイトル" value="{{ old('post.name') }}"/>
                <p class="name__error" style="color:red">{{ $errors->first('post.name') }}</p>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.body'))) has-error @endif">
                <h2><label>Body</label></h2>
                <textarea name="post[body]" placeholder="本文">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.per_fee'))) has-error @endif">
                <h2><label>一人あたりの最低料金</label></h2>
                <input type="number" step="100" name="post[per_fee]" placeholder="3000" value="{{ old('post.per_fee') }}"/>
                <p class="per_fee__error" style="color:red">{{ $errors->first('post.per_fee') }}</p>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.charter_fee'))) has-error @endif">
                <h2><label>貸切の最低料金</label></h2>
                <input type="number" step="1000" name="post[charter_fee]" placeholder="50000" value="{{ old('post.charter_fee') }}"/>
                <p class="charter_fee__error" style="color:red">{{ $errors->first('post.charter_fee') }}</p>
            </div>
            
            <div class="form-group">
                <h2>フィールド条件</h2>
                <h3><label>屋内</label></h3>
                <select class="form-control col-md-5" name="post[indoor]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
                
                <h3><label>屋外</label></h3>
                <select class="form-control col-md-5" name="post[outdoor]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
            </div>
            
            <div class="form-group">
                <h2><label>レンタル</label></h2>
                <select class="form-control col-md-5" name="post[rental]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
            </div>
            
            <div class="form-group">
                <h2><label>送迎</label></h2>
                <select class="form-control col-md-5" name="post[shuttle]">
                    <option selected value="なし">なし</option>
                    <option value="あり">あり</option>
                </select>
            </div>
            
            <div class="form-group @if(!empty($errors->first('post.prefecture'))) has-error @endif">
                <h2><label>都道府県</label></h2>
                <select class="form-control col-md-5" name="post[prefecture]">
                    <option selected value="">選択...</option>
                    @foreach($prefectures as $key => $value)
	                <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <p class="prefecture__error" style="color:red">{{ $errors->first('post.prefecture') }}</p>
            </div>
            
            <div class="form-group">
                <h2><label>住所</label></h2>
                <input type="text" name="post[address]" placeholder="新宿区新宿0-0-0" value="{{ old('post.address') }}"/>
                <p class="address__error" style="color:red">{{ $errors->first('post.address') }}</p>
            </div>
            
            <div class="form-group">
                <h2><label>画像</label></h2>
                <input type="file" name="image"/>
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>

@endsection