@extends('system.layouts.app')

@section('content')

    <div class="top_row">
        <span class="page_title">
            アカウント情報
        </span><br>
    </div>

    {!! Form::model($kinder,['route' => ['kinder.update',$kinder->id],'files'=>true,'method' => 'PATCH','id'=>'create-form','class'=>'h-adr']) !!}
    @include('common.errors')
    {{ csrf_field() }}
        @include('system.kinder.form',['edit'=>true])
    {!! Form::close() !!}


    
    <div class="eds03_02_btn_area e-f-start m-l-205">
            <div class="registration_btn">
                <a href="" id="save">更新</a>
            </div>
            <form action="{{ route('kinder.delete',$kinder->id)}}" id="delete-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
            </form>
        @if(!\Auth::user()->member(0))
            <div class="delete_btn">
                <a href="" id="delete">削除</a>
            </div>
        @endif
        </div>
@endsection
