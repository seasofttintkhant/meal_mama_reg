@extends('errors::layout')

@section('title', 'エラーが発生しました')

@section('message')
    
    <img src="/img/common/kidsmeal_logo_new.png" style="width:300px">
    <p style="font-size: 24px;">処理中にエラーが発生しました。<br />エラーが繰り返し発生する場合はシステム管理者までご連絡ください。</p>
    <a href="/" style="
        text-decoration: none;
        font-size: 22px;
        border: solid 2px #c9151e;
        color: #fff;
        background-color: #e60012;
        padding: 10px 20px;
        border-radius: 10px;
    ">マイページを開く</a>
@stop
