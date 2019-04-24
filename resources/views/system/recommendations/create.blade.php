@extends('system.layouts.app')


@section('content')    <div class="top_row">   
<div class="row">   
    <span class="page_title">
        今日のおすすめ
    </span>  
    <a class="back_to_list" href="{{route('recommendation.index')}}">今日のおすすめに戻る</a>
</div>
<div class="row">	

{!! Form::open(['route' => 'recommendation.store', 'method' => 'POST', 'id'=>'create-form']) !!}

@include('common.errors')
{{ csrf_field() }}
    @include('system.recommendations.form')
{!! Form::close() !!}

<div class="eds03_02_btn_area">
      <button class="reg_btn" id="save">投稿</button>
</div>
</div>


@endsection