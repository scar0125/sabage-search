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
    
    <div class="review">
        <table>
            <tr><th>Comment</th><th>Name</th></tr>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->user->name }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection