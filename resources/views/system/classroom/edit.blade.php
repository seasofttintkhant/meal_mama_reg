@extends('system.layouts.app')

@section('content')

    {!! Form::model($classroom, ['route' => ['classroom.update', $classroom->id],'files'=>true,'method' => 'PATCH', 'id'=>'create-form']) !!}
    	@include('common.errors')
    	{{ csrf_field() }}
        @include('system.classroom.form',['edit'=>true])
    {!! Form::close() !!}
    <div class="eds03_02_btn_area">
        <div class="registration_btn">
                <a href="" id="save">登録</a>
        </div>
        <form action="{{ route('classroom.delete',$classroom->id)}}" id="delete-form" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
        </form>
        <div class="delete_btn">
            <a href="#" id="delete">削除</a>
        </div>
    </div>
   
@endsection
