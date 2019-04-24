@extends('system.layouts.app')


@section('content')
<ol class="breadcrumb">
    <li><a href="/">ホーム</a></li>
    <li><a href="{{route('message')}}">メッセージ</a></li>
    <li class="active">新規作成</li>
</ol>

{!! Form::open(['route' => 'message.store','files'=>true,'method' => 'POST','id'=>'create-form']) !!}

@include('common.errors')
{{ csrf_field() }}
    @include('system.message.form')
{!! Form::close() !!}

<div class="eds03_02_btn_area">
    <div class="registration_btn">
        <a href="" id="save">投稿</a>
    </div>
</div>


@endsection