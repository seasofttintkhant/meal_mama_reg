@extends('system.layouts.app')


@section('content')
    {!! Form::open(['route' => 'kid.store','files'=>true,'method' => 'POST','id'=>'create-form','class'=>'h-adr']) !!}
    @include('common.errors')
    {{ csrf_field() }}
        @include('system.kid.form',['edit'=>false])
    {!! Form::close() !!}

    <div class="eds03_02_btn_area">
        <div class="registration_btn">
            <a href="" id="save">登録</a>
        </div>
    </div>

 
@endsection