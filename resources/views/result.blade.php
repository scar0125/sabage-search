@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="css/result.css">
@endpush

<style>
    #map {
      height: 100%;
      width: 100%;
      }
      
    .map_content {
      width: 250px;
      height: 70px;
    }
</style>

@section('content')
    
    <div>
        <div class="top-content">
            <h1>検索結果</h1>
            @if(!empty($message))
            <div class="alert alert-primary" role="alert">{{ $message}}</div>
            @endif
        </div>
        
        @if(isset($posts))
        <div class="main-content col-xl-6">
        @foreach($posts as $post)
            <div class='post card'>
                <h3 class='card-title name url'><a href="/posts/{{ $post->id }}" target="_blank" rel="noopener noreferrer">{{ $post->name }}</a></h3>
                
                <!-- お気に入り表示 -->
                <div class="favorite">
                    @if($post->is_favorited_by_auth_user())
                    <a href="{{ route('post.not-favorite', ['id' => $post->id]) }}" class="btn btn-success btn-sm">お気に入り<span class="badge">{{ $post->favorites->count() }}</span></a>
                    @else
                    <a href="{{ route('post.favorite', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">お気に入り<span class="badge">{{ $post->favorites->count() }}</span></a>
                    @endif
                </div>
                
                <div class='card-body'>
                    <p class='per_fee'>一人あたりの最低料金：{{ $post->per_fee }}円</p>
                    <p class='charter_fee'>貸し切り最低料金：{{ $post->charter_fee }}円</p>
                    <p class='field_condition'>屋内：{{ $post->indoor }}・屋外：{{ $post->outdoor }}</p>
                    <p class='rental shuttle'>レンタル：{{ $post->rental }}・送迎：{{ $post->shuttle }}</p>
                    <p>住所：<span class='address'>{{ $post->prefecture }}{{ $post->address }}</span></p>
                </div>
                
                <!-- 投稿削除 -->
                @if (Auth::guard('admin')->check())
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" onSubmit="return check()" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="url" value="{{ $url }}">
                    <button type="submit">削除</button>
                </form>
                @endif
            
            </div>
        @endforeach
        </div>
        
        <!-- 地図表示 -->
        <div class="map-cover col-xl-6">
            <div id="map"></div>
        </div>
        
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        @endif
    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function addAddress() {
    var arr = new Array();
    
    function eachFunc(index, elem) {
    arr.push($(elem).text());
    }
    
    $('.address').each(eachFunc);
    return arr;
}

function addTitle() {
    var arr = new Array();
    
    function eachFunc(index, elem) {
    arr.push($(elem).text());
    }
    
    $('.name').each(eachFunc);
    return arr;
}

function addUrl() {
    var arr = new Array();
    
    function eachFunc(index, elem) {
    arr.push($(elem).attr('href'));
    }
    
    $('.url a').each(eachFunc);
    return arr;
}

function initMap() {
  jQuery(function($){
    var latlng = []; //緯度経度の値をセット
    var myLatLng; //地図の中心点をセット用
    
    //マーカーの内容
    var titles = addTitle();
    var urls = addUrl();
    var addresses = addAddress();
    var contents = [];
    
    //マップ生成
    var map;
    map = new google.maps.Map(document.getElementById("map"));
    
    //ジオコーディング生成
    var geocoder = new google.maps.Geocoder();
    
    geo(aftergeo);
    
    function geo(callback){
        var cRef = addresses.length;
        for (var i = 0; i < addresses.length; i++) {
            (function (i) {
                geocoder.geocode({'address': addresses[i]},
                    function(results, status) { // 結果
                        if (status === google.maps.GeocoderStatus.OK) {
                            latlng[i]=results[0].geometry.location;// マーカー位置取得
                            
                            //情報ウィンドウに表示するコンテンツ
                            contents[i] = '<div id="map_content"><p><a href="' + urls[i] + '" target="_blank" rel="noopener noreferrer"> ' + titles[i] + '</a><br />' + addresses[i] + '</p></div>';
                            
                            //マーカー・情報ウィンドウ作成
                            createMarker(latlng[i],contents[i],map);
                            
                        } else { // 失敗した場合
                            alert("一部の住所の取得に失敗しました。: " + status);
                        }
                        if (--cRef <= 0) {
                            callback();//全て取得できたらaftergeo実行
                        }
                    }//function(results, status)終了
                );//geocoder.geocodeの終了
            }) (i);
        }//for文終了
    }//function geo終了
    
    //最初の住所を地図の中心点に設定
    function aftergeo(){
        myLatLng = latlng[0];
        var opt = {
            center: myLatLng,
            zoom: 10
        };
        map.setOptions(opt);
    }//function aftergeo終了
    
    //マーカー・情報ウィンドウ作成
    function createMarker(latlng,content,map)
    {
        var infoWindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({position: latlng,map: map});
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(content);
            infoWindow.open(map,marker);
            map.panTo(latlng); 
        });
    }//function createMarker終了
    
  }); 
}
</script>

<!-- API 読み込み -->
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.key.api_key') }}&callback=initMap" async defer></script>

<script>
    function check(){
	    if(window.confirm('本当に削除しますか？')){ // 確認ダイアログを表示
	        return true;
	    }
	    else{ // 「キャンセル」時の処理
		    return false;
	    }
    }
</script>