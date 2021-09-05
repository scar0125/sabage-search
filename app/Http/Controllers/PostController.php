<?php

namespace App\Http\Controllers;

use App\Post;
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
                    switch ($prefecture_condition) {
                        case 0://条件未入力
                            break;
                        case 1://茨城県
                            $posts->where('prefecture', '茨城県');
                            break;
                        case 2://栃木県
                            $posts->where('prefecture', '栃木県');
                            break;
                        case 3://群馬県
                            $posts->where('prefecture', '群馬県');
                            break;
                        case 4://埼玉県
                            $posts->where('prefecture', '埼玉県');
                            break;
                        case 5://千葉県
                            $posts->where('prefecture', '千葉県');
                            break;
                        case 6://東京都
                            $posts->where('prefecture', '東京都');
                            break;
                        case 7://神奈川県
                            $posts->where('prefecture', '神奈川県');
                            break;
                    }
                }
                //OR検索
                elseif($search_condition == 2) {
                    switch ($prefecture_condition) {
                        case 0://条件未入力
                            break;
                        case 1://茨城県
                            $posts->orWhere('prefecture', '茨城県');
                            break;
                        case 2://栃木県
                            $posts->orWhere('prefecture', '栃木県');
                            break;
                        case 3://群馬県
                            $posts->orWhere('prefecture', '群馬県');
                            break;
                        case 4://埼玉県
                            $posts->orWhere('prefecture', '埼玉県');
                            break;
                        case 5://千葉県
                            $posts->orWhere('prefecture', '千葉県');
                            break;
                        case 6://東京都
                            $posts->orWhere('prefecture', '東京都');
                            break;
                        case 7://神奈川県
                            $posts->orWhere('prefecture', '神奈川県');
                            break;
                    }
                }
            }
            
            //view表示
            if(!empty($posts)) {
                $message = "検索が完了しました。";
                return view('result')->with([
                    'posts' => $posts->orderBy('updated_at', 'DESC')->paginate(10),
                    'message' => $message,
                ]);
            }
            //fee条件未入力等
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
    
    
    //Post一覧の表示
    public function index(Post $post)
    {
        $user = Auth::user();
        return view('index')->with([
            'posts' => $post->getPaginateByLimit(),
            'user' => $user,
            ]);
    }
    
    
    public function show(Post $post)
    {
        return view('show')->with(['post' => $post]);
    }
    
    public function create()
    {
        return view('create');
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
}
