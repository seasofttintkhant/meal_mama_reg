@extends('system.layouts.app')


@section('content')


{!! Form::open(['route' => 'kyusyoku.store','files'=>true,'method' => 'POST','id'=>'create-form']) !!}

    @include('common.errors')

    <h2>新規</h2>

    {{ csrf_field() }}

    @include('system.tayori.form',['edit'=>false])

    {!! Form::close() !!}
    
<div class="edy06_02_btn_area">
    <div class="registration_btn">
        <a id="save">下書き保存</a>
    </div>
</div>
@endsection

