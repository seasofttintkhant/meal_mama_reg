@extends('system.layouts.app')


@section('content')

{!! Form::model($tayori,['route' => ['kondate.update',$kinder->id,$tayori->id],'files'=>true,'method' => 'PATCH','id'=>'create-form']) !!}
    @include('common.errors')

    <h2> {{ isset($tayori->status) ? config('newsletter.statuses')[$tayori->status] :'' }}</h2>

    {{ csrf_field() }}
    {!! Form::hidden('kinder_id',$kinder->id) !!}
    @include('system.tayori.form',['edit'=>true, 'is_kondate'=>true, 'meal_types'=>$meal_types])
{!! Form::close() !!}


<div class="eds03_02_btn_area">
        <div class="registration_btn">
            <a href="#" id="save">下書き保存</a>
        </div>

        <form action="{{ route('kondate.publish',$tayori->id)}}" id="publish-form" method="post">
        <input type="hidden" name="status" value="1">
                {{ csrf_field() }}
        </form>
        <div class="registration_btn">
            <a href="" id="publish-menu">配信</a>
        </div>  

        <form action="{{ route('kondate.delete',[$tayori->kinder_id,$tayori->id]) }}" id="delete-form" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
    
        <div class="delete_btn">
            <a href="" id="delete">削除</a>
        </div>
       
</div>

@endsection

