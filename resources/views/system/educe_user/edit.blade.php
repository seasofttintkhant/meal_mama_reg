@extends('system.layouts.app')

@section('content')
    
    {!! Form::model($educe_user,['route' => ['mypage.update',$educe_user->id], 'method' => 'PATCH','id'=>'create-form']) !!}
    @include('common.errors')
    {{ csrf_field() }}
        @include('system.educe_user.form',['edit'=>true])
    {!! Form::close() !!}

    <div class="eds03_02_btn_area">
            <div class="registration_btn">
                <a href="" id="save">登録</a>
            </div>
        </div>
@endsection
