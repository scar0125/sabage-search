@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="css/index.css">
@endpush

@section('content')
        
        <div class="center-block" style="margin:0 auto; width: 80%;">
            <h1 style="text-align: center;">検索条件を入力</h1>
            <form action="/result" method="GET" style="margin-bottom: 1rem; text-align: center;">
                @csrf
        
            <div class="form-group col-xl-10 keyword">
            <label>キーワード検索</label>
            <input type="text" class="form-control" placeholder="渋谷" name="keyword">
            </div>
            
            <div class="form-group col-xl-5" style="display: inline-block;">
            <label>1人あたりの料金</label>
            <input type="text" class="form-control" placeholder="3000" name="per_fee" value="{{ old("per_fee")}}">
            <select class="form-control" name="per_fee_condition">
                <option selected value="0">選択...</option>
                <option value="1">以上</option>
                <option value="2">以下</option>
            </select>
            </div>
            
            <div class="form-group col-xl-5" style="display: inline-block;">
            <label>貸切料金</label>
            <input type="text" class="form-control" placeholder="50000" name="charter_fee" value="{{ old("charter_fee")}}">
            <select class="form-control" name="charter_fee_condition">
                <option selected value="0">選択...</option>
                <option value="1">以上</option>
                <option value="2">以下</option>
            </select>
            </div>
            
            <div class="form-group col-xl-5" style="display: inline-block;">
            <label>フィールド条件</label>
            <select class="form-control" name="field_condition">
                <option selected value="0">指定なし</option>
                <option value="1">屋内</option>
                <option value="2">屋外</option>
                <option value="3">両方</option>
            </select>
            </div>
        
            <div class="form-group col-xl-5" style="display: inline-block;">
            <label>レンタル</label>
            <select class="form-control" name="rental_condition">
                <option selected value="0">指定なし</option>
                <option value="1">あり</option>
                <option value="2">なし</option>
            </select>
            </div>
            
            <div class="form-group col-xl-5" style="display: inline-block;">
            <label>送迎</label>
            <select class="form-control" name="shuttle_condition">
                <option selected value="0">指定なし</option>
                <option value="1">あり</option>
                <option value="2">なし</option>
            </select>
            </div>
            
            <div class="form-group col-xl-5" style="display: inline-block;">
            <label>都道府県</label>
            <select class="form-control" name="prefecture_condition">
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
    
            <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
        
        <p style="text-align: center;">
            例：都道府県に「東京都」を選択<br>
            ↓<br>
            検索ボタンをクリック
        </p>
        
        @if (Auth::guard('admin')->check())
        <div style="text-align: center;">
            <p class="create btn btn-outline-primary"><a href='/create'>投稿作成</a></p>
        </div>
        @endif
        
@endsection