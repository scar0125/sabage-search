<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Favorite;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        //お気に入りしたフィールドを表示
        $favorites = Favorite::with('post');
        
        return view('home')->with([
            'favorites' => $favorites->orderBy('created_at', 'DESC')->paginate(10),
            'user' => $user,
            ]);
    }
}
