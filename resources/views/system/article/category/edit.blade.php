@extends('system.layouts.app')

@section('content')

    <span class="page_title k-no-f">
        educe食育コラム名編集
    </span>

    {!! Form::model($category, ['route' => ['article.category.update', $category->id],'files'=>true,'method' => 'PATCH', 'id'=>'create-form']) !!}
    	@include('common.errors')
    	{{ csrf_field() }}
        @include('system.article.category.form',['edit'=>true])
    {!! Form::close() !!}
    <div class="eds03_02_btn_area">
        <div class="registration_btn">
                <a href="" id="save">登録</a>
        </div>
        <form action="{{ route('article.category.delete',$category->id)}}" id="delete-form" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
        </form>
        <div class="delete_btn">
            <a href="#" id="delete">削除</a>
        </div>
    </div>
   
@endsection
