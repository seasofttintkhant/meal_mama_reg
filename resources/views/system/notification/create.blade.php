@extends('system.layouts.app')


@section('content')

{!! Form::open(['route' => 'notification.store', 'method' => 'POST', 'id'=>'create-form']) !!}

@include('common.errors')
{{ csrf_field() }}
    @include('system.notification.form')
{!! Form::close() !!}

<div class="eds03_02_btn_area">
    <div class="registration_btn">
        <a href="" id="save">投稿</a>
    </div>
</div>


@endsection