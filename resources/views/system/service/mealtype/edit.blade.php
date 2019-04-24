@extends('system.layouts.app')

@section('content')

{!! Form::model($mealtype, ['route' => ['service.mealtype.update', $mealtype->id], 'method' => 'PATCH', 'id'=>'create-form']) !!}
	@include('common.errors')
	{{ csrf_field() }}
    @include('system.service.mealtype.form', ['edit'=>true])
{!! Form::close() !!}

<div class="eds03_02_btn_area">
    <div class="registration_btn">
        <a href="" id="save">登録</a>
    </div>
    <form action="{{ route('service.mealtype.delete', $mealtype->id)}}" id="delete-form" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
    <div class="delete_btn">
        <a href="#" id="delete">削除</a>
    </div>
</div>
   
@endsection
