@extends('errors::layout')

@section('title', 'ログアウトしました')

@section('message')
    
    <img src="/img/common/kidsmeal_logo_new.png" style="width:300px">
    <p style="font-size: 24px;">長時間操作が行われませんでしたので、自動的にログアウトしました。<br />
    ログインページより再度ログインしてください。</p>
    <a href="/" style="
        text-decoration: none;
        font-size: 22px;
        border: solid 2px #c9151e;
        color: #fff;
        background-color: #e60012;
        padding: 10px 20px;
        border-radius: 10px;
    ">ログインページを開く</a>
@stop
