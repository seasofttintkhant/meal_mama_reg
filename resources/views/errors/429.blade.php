@extends('errors::layout')

@section('title', 'リクエスト数制限超過')

@section('message')
    <img src="/img/common/kidsmeal_logo_new.png" style="width:300px">
    <p style="font-size: 24px;">サイトへのリクエスト数の制限を超過しました。</p>
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
