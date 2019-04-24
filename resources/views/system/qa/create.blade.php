@extends('system.layouts.app')

@section('content')

    {!! Form::open(['route' => 'qa.store', 'files'=>true,'method' => 'POST', 'id'=>'create-form']) !!}
    	@include('common.errors')
    	{{ csrf_field() }}
        @include('system.qa.form',['edit'=>false, 'categories' => $categories])
    {!! Form::close() !!}

    <div class="eds03_02_btn_area">
        <div class="registration_btn">
            <a href="" id="save">登録</a>
        </div>
    </div>
        

@endsection