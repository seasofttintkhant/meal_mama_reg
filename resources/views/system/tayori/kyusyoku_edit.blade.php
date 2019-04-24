@extends('system.layouts.app')


@section('content')

{!! Form::model($tayori,['route' => ['kyusyoku.update',$tayori->id],'files'=>true,'method' => 'PATCH','id'=>'create-form']) !!}

    @include('common.errors')

    <h2> {{ isset($tayori->status) ? config('newsletter.statuses')[$tayori->status] :'' }}</h2>

    {{ csrf_field() }}
    @include('system.tayori.form',['edit'=>true])

{!! Form::close() !!}


<div class="eds03_02_btn_area">
        <div class="registration_btn">
            <a href="#" id="save">下書き保存</a>
        </div>
    

    <form action="{{ route('kyusyoku.publish',$tayori->id)}}" id="publish-form" method="post">
            <input type="hidden" name="status" value="1" >
            {{ csrf_field() }}
    </form>
    <div class="registration_btn">
        <a href="" id="publish-school">配信</a>
    </div>  

    <form action="{{ route('kyusyoku.delete',$tayori->id) }}" id="delete-form" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    <div class="delete_btn">
        <a href="" id="delete">削除</a>
    </div>

</div>
@endsection

