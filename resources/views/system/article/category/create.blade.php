@extends('system.layouts.app')

@section('content')

    <span class="page_title k-no-f">
        educe食育コラム名登録
    </span>

    {!! Form::open(['route' => 'article.category.store', 'files'=>true,'method' => 'POST', 'id'=>'create-form']) !!}
    	@include('common.errors')
    	{{ csrf_field() }}
        @include('system.article.category.form',['edit'=>false])
    {!! Form::close() !!}

    <div class="eds03_02_btn_area">
        <div class="registration_btn">
            <a href="" id="save">登録</a>
        </div>
    </div>
        

@endsection