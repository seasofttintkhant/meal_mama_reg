@extends('system.layouts.app')


@section('content')

{!! Form::model($notification, ['route' => ['notification.update', $notification->id], 'method' => 'PATCH', 'id'=>'create-form']) !!}

@include('common.errors')
{{ csrf_field() }}
    @include('system.notification.form')
{!! Form::close() !!}


<div class="eds03_02_btn_area">
    <div class="registration_btn">
        <a href="" id="save">投稿</a>
    </div>
    
    <div class="registration_btn">
        <a href="{{ $notification->sent_status == 0 ? route('notification.send',$notification->id) : '#' }}" id="send-message" data-type="notification">送信</a>
    </div>

    <form action="{{ route('notification.delete', $notification->id)}}" id="delete-form" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
    </form>
    <div class="delete_btn">
        <a href="" id="delete">削除</a>
    </div>
</div>


@endsection