@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
<script src="/templateEditor/ckeditor/ckeditor.js"></script>  
@endpush

@section('content')

<h3 class="setting_header">カメラアプリお知らせ</h3>

<form action="" method="POST">
	@include('common.errors')
	  {{ csrf_field() }} 
	  <table class="setting_table">
			<tr>
	            <td>
	                <span class="form_title_a">タイトル（＊）</span> 
	                {!! Form::text('title', null, ['class' => 'form-text-field']) !!}
	            </td>
	        </tr>
	            <td>
	                <span class="form_title_a">投稿内容（＊）</span>
	                {!! Form::textarea('content', null, ['class'=>'input_field_b ckeditor', 'rows' => 5, 'cols' => 30]) !!}
	            </td>
	        </tr>
			<tr>
				<td colspan="2">
					<input type="submit" class="float_right btn btn-submit" value="送信"> 
				</td>
			</tr>	
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
 		CKEDITOR.replace( 'content' );
 		
 		CKEDITOR.config.extraPlugins = 'justify';
 		CKEDITOR.config.language = 'ja';
 		
	});
</script>

@endsection
