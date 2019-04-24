@extends('errors::layout')

@section('title', 'サービスが停止中です')

@section('message')
    
    <img src="/img/common/kidsmeal_logo_new.png" style="width:300px">
    <p style="font-size: 24px;">サービスの提供を一時停止中です。<br />後ほど再度お試しください。</p>
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
