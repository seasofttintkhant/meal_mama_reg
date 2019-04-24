@extends('system.layouts.app')


@section('content')

<div class="row">   
<span class="page_title">
    今日のおすすめ
</span>  
<a class="back_to_list" href="{{route('recommendation.index')}}">今日のおすすめに戻る</a>
</div>

<div class="row">	
{!! Form::model($recommendation, ['route' => ['recommendation.update', $recommendation->id], 'method' => 'PATCH', 'id'=>'create-form']) !!}

@include('common.errors')
{{ csrf_field() }}
    @include('system.recommendations.form')
{!! Form::close() !!}

<div class="eds03_02_btn_area">  
	@if($edit)
  		<button class="reg_btn" id="save">投稿</button>
  		<form action="{{ route('recommendation.delete', $recommendation->id)}}" id="delete-form" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        <div class="delete_btn">
            <a href="#" id="delete">削除</a>
        </div>
  	@else
  		<button class="reg_btn reg_btn-disabled">投稿</button>
	 	<div class="delete_btn" style="opacity: 0.5;">
            <a onclick="event.preventDefault();" class="disabled" href="#">削除</a>
        </div>
  	@endif
</div>
</div>

@endsection