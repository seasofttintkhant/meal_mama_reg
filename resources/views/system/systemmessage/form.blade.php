@extends('system.layouts.app')


@section('content')

<form method="post" name="form" id="create-form" action="{{route('system.message.send')}}">
	@include('common.errors')
	{{ csrf_field() }}
	<table class="eds04_01_search">
	    <tbody>
	    <tr>
	    	<td>
                <span class="form_title_a">受信者（＊）</span>
                {!! Form::select('receiver_id', $receivers , null, ['id'=>'receiver', 'class'=>'input_field_c', 'placeholder' => '選択してください']) !!}
            </td>
	        <td>
		        <span class="form_title_a">件名（＊）</span>
		        {!! Form::text('title', null, ['class'=>'input_field_d']) !!}
	        </td>
	        <td>
	        	<span class="form_title_a">送信内容（＊）</span>
	        	{!! Form::textarea('content', null, ['class'=>'input_field_b', 'rows' => 5, 'cols' => 30]) !!}
	        </td>
	    </tr>
	    </tbody>
	</table>
</form>

<div class="eds04_01_btn_area">
	<div class="post_btn">
    	<a href="" id="save">送信</a>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#receiver option[value='system_user']").attr('disabled', 'disabled');
		$("#receiver option[value='kinder_user']").attr('disabled', 'disabled');
	});
</script>

@endsection