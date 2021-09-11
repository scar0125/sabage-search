<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //検索機能・検索結果表示
    public function search(Request $request) {
        //検索条件の受け取り
        $keyword = $request->keyword;
        $per_fee = $request->per_fee;
        $per_fee_condition = $request->per_fee_condition;
        $charter_fee = $request->charter_fee;
        $charter_fee_condition = $request->charter_fee_condition;
        $field_condition = $request->field_condition;
        $rental_condition = $request->rental_condition;
        $shuttle_condition = $request->shuttle_condition;
        $prefecture_condition = $request->prefecture_condition;
        //AND・OR条件
        $search_condition = $request->search_condition;
        
        //都道府県配列(関東)
        $prefectures = array(
            '茨城県'    => '茨城県',
            '栃木県'    => '栃木県',
            '群馬県'      => '群馬県',
            '埼玉県'    => '埼玉県',
            '千葉県'      => '千葉県',
            '東京都'      => '東京都',
            '神奈川県'   => '神奈川県',
            );
        
        //検索条件が入力された場合
        if(
            !empty($keyword)
            || !empty($per_fee)
            || !empty($charter_fee)
            || !empty($field_condition)
            || !empty($rental_condition)
            || !empty($shuttle_condition)
            || !empty($prefecture_condition)
            )
        {
            //Postモデルクエリ準備
            $posts = Post::query();
            
            //keyword検索
            if(!empty($keyword)) {
                $posts->where(function($posts) use($keyword) {
                $posts->where('name','like', '%' .$keyword. '%')
                ->orWhere('body','like', "%" .$keyword. "%")
                ->orWhere('prefecture','like', "%" .$keyword. "%")
                ->orWhere('address','like', "%" .$keyword. "%")
                ->orWhere('per_fee','like', "%" .$keyword. "%")
                ->orWhere('charter_fee','like', "%" .$keyword. "%");
                });
            }
            
            //per_fee検索
            if(!empty($per_fee)) {
                //AND検索
                if($search_condition == 1) {
                    switch ($per_fee_condition) {
                        case 0://条件未入力
                            $message = "料金条件を選択してください";
                            break;
                        case 1://以上
                            $posts->where('per_fee', '>=', $per_fee);
                            break;
                        case 2://以下
                            $posts->where('per_fee', '<=', $per_fee);
                            break;
                    }
                }
                //OR検索
                elseif($search_condition == 2) {
                    switch ($per_fee_condition) {
                        case 0://条件未入力
                            $message = "料金条件を選択してください";
                            break;
                        case 1://以上
                            $posts->orWhere('per_fee', '>=', $per_fee);
                            break;
                        case 2://以下
                            $posts->orWhere('per_fee', '<=', $per_fee);
                            break;
                    }
                }
            }
            
            //charter_fee検索
            if(!empty($charter_fee)) {
                //AND検索
                if($search_condition == 1) {
                    switch ($charter_fee_condition) {
                        case 0://条件未入力
                            $message = "料金条件を選択してください";
                            break;
                        case 1://以上
                            $posts->where('charter_fee', '>=', $charter_fee);
                            break;
                        case 2://以下
                            $posts->where('charter_fee', '<=', $charter_fee);
                            break;
                    }
                }
                //OR検索
                elseif($search_condition == 2) {
                    switch ($charter_fee_condition) {
                        case 0://条件未入力
                            $message = "料金条件を選択してください";
                            break;
                        case 1://以上
                            $posts->orWhere('charter_fee', '>=', $charter_fee);
                            break;
                        case 2://以下
                            $posts->orWhere('charter_fee', '<=', $charter_fee);
                            break;
                    }
                }
            }
            
            //field_condition検索
            if(!empty($field_condition)) {
                //AND検索
                if($search_condition == 1) {
                    switch ($field_condition) {
                        case 0://条件未入力
                            break;
                        case 1://indoor検索
                            $posts->where('indoor', 'あり');
                            break;
                        case 2://outdoor検索
                            $posts->where('outdoor', 'あり');
                            break;
                        case 3://両方検索
                            $posts->where('indoor', 'あり')->where('outdoor', 'あり');
                            break;
                    }
                }
                //OR検索
                elseif($search_condition == 2) {
                    switch ($field_condition) {
                        case 0://条件未入力
                            break;
                        case 1://indoor検索
                            $posts->orWhere('indoor', 'あり');
                            break;
                        case 2://outdoor検索
                            $posts->orWhere('outdoor', 'あり');
                            break;
                        case 3://両方検索
                            $posts->orWhere('indoor', 'あり')->orWhere('outdoor', 'あり');
                            break;
                    }
                }
            }
            
            //rental_condition検索
            if(!empty($rental_condition)) {
                //AND検索
                if($search_condition == 1) {
                    switch ($rental_condition) {
                        case 0://条件未入力
                            break;
                        case 1://あり
                            $posts->where('rental', 'あり');
                            break;
                        case 2://なし
                            $posts->where('rental', 'なし');
                            break;
                    }
                }
                //OR検索
                elseif($search_condition == 2) {
                    switch ($rental_condition) {
                        case 0://条件未入力
                            break;
                        case 1://あり
                            $posts->orWhere('rental', 'あり');
                            break;
                        case 2://なし
                            $posts->orWhere('rental', 'なし');
                            break;
                    }
                }
            }
            
            //shuttle_condition検索
            if(!empty($shuttle_condition)) {
                //AND検索
                if($search_condition == 1) {
                    switch ($shuttle_condition) {
                        case 0://条件未入力
                            break;
                        case 1://あり
                            $posts->where('shuttle', 'あり');
                            break;
                        case 2://なし
                            $posts->where('shuttle', 'なし');
                            break;
                    }
                }
                //OR検索
                elseif($search_condition == 2) {
                    switch ($shuttle_condition) {
                        case 0://条件未入力
                            break;
                        case 1://あり
                            $posts->orWhere('shuttle', 'あり');
                            break;
                        case 2://なし
                            $posts->orWhere('shuttle', 'なし');
                            break;
                    }
                }
            }
            
            //prefecture_condition検索
            if(!empty($prefecture_condition)) {
                //AND検索
                if($search_condition == 1) {
                    $posts->where('prefecture', $prefectures[$prefecture_condition]);
                }
                //OR検索
                elseif($search_condition == 2) {
                    $posts->orWhere('prefecture', $prefectures[$prefecture_condition]);
                }
            }
            
            //view表示
            if(!empty($posts)) {
                $url = url()->full();//検索結果のurl取得
                
                $message = "検索が完了しました。";
                return view('result')->with([
                    'posts' => $posts->orderBy('updated_at', 'DESC')->paginate(10),
                    'message' => $message,
                    'url' => $url,
                ]);
            }
            //fee条件未入力
            else {
                $message = "料金条件を選択してください";
                return view('result')->with('message',$message);
            }
            
        }
        //全項目未入力等
        else {
            $message = "検索結果はありません";
            return view('result')->with('message',$message);
        }
        
    }
    
    
    //トップページの表示
    public function index(Post $post)
    {
        //都道府県配列(関東)
        $prefectures = array(
            '茨城県'    => '茨城県',
            '栃木県'    => '栃木県',
            '群馬県'      => '群馬県',
            '埼玉県'    => '埼玉県',
            '千葉県'      => '千葉県',
            '東京都'      => '東京都',
            '神奈川県'   => '神奈川県',
            );
            
        //ログイン状態を識別
        $user = Auth::user();
        
        return view('index')->with([
            'posts' => $post->getPaginateByLimit(),
            'user' => $user,
            'prefectures' => $prefectures,
            ]);
    }
    
    
    //特定IDのPost詳細画面表示
    public function show(Post $post)
    {
        return view('show')->with(['post' => $post]);
    }
    
    
    //投稿作成画面
    public function create()
    {
        //都道府県配列(関東)
        $prefectures = array(
            '茨城県'    => '茨城県',
            '栃木県'    => '栃木県',
            '群馬県'      => '群馬県',
            '埼玉県'    => '埼玉県',
            '千葉県'      => '千葉県',
            '東京都'      => '東京都',
            '神奈川県'   => '神奈川県',
            );
        return view('create')->with([
            'prefectures' => $prefectures,
            ]);
    }
    
    
    //投稿保存
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/');
    }
    
    
    //投稿編集画面
    public function edit(Post $post)
    {
        //都道府県配列(関東)
        $prefectures = array(
            '茨城県'    => '茨城県',
            '栃木県'    => '栃木県',
            '群馬県'      => '群馬県',
            '埼玉県'    => '埼玉県',
            '千葉県'      => '千葉県',
            '東京都'      => '東京都',
            '神奈川県'   => '神奈川県',
            );
        return view('edit')->with([
            'post' => $post,
            'prefectures' => $prefectures,
            ]);
    }
    
    
    //投稿更新
    public function update(Post $post, PostRequest $request)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    
    //投稿削除
    public function delete(Post $post, Request $request)
    {
        $url = $request->url;
        $post->delete();
        return redirect($url);//検索結果にリダイレクト
    }
    
    
}
