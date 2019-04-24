@extends('system.layouts.app')

@section('content')

{!! Form::open(['route' => 'kondate.store',$kinder->id,'files'=>true,'method' => 'POST','id'=>'create-form']) !!}
    @include('common.errors')

   {{ csrf_field() }}

   {!! Form::hidden('kinder_id',$kinder->id) !!}

   <h2>新規</h2>

    @include('system.tayori.form',['edit'=>false, 'is_kondate'=>true, 'meal_types'=>$meal_types])

{!! Form::close() !!}

<div class="edy06_02_btn_area">
    <div class="registration_btn">
        <a href="#" id="save">下書き保存</a>
    </div>
</div>


@endsection

