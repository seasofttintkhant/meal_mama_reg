@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
<script src="/templateEditor/ckeditor/ckeditor.js"></script>  
@endpush

@section('content')

<div class="top_row">
	<span class="page_title">カメラアプリ起動時設定</span>
</div>

<form action="" method="POST">
	@include('common.errors')
	  {{ csrf_field() }} 
	  <table class="setting_table">
			<tr>
				<td>
					<label class="col-form-label">起動モード</label>
				</td>
				<td>
					<input type="radio" name="camera_mode" value="off" checked> 通常起動<br>
			  		<input type="radio" name="camera_mode" value="maintenance"> メンテナンスモード（メッセージを設定してください。）<br>
				  	<input type="radio" name="camera_mode" value="message"> メッセージ表示モード（メッセージを設定してください。）<br>
				  	<input type="radio" name="camera_mode" value="update"> 強制アップデートモード（メッセージを設定してください。）<br>	
				</td>
			</div>
			<tr>
				<td>
					<label class="col-form-label">バージョン</label>
				</td>
				<td>
					<br/>
					Android<br/>
					{!! Form::text('camera_android_version', isset($setting->camera_android_version)? $setting->camera_android_version : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
					iOS<br/>
					{!! Form::text('camera_ios_version', isset($setting->camera_ios_version)? $setting->camera_ios_version : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
				</td>
			</tr>
			<tr>
				<td>
					<label class="col-form-label">メッセージ</label>
				</td>
				<td>
					{!! Form::textarea('camera_message', isset($setting->camera_message)? $setting->camera_message : '', ['class'=>'ckeditor', 'rows' => 5, 'cols' => 30]) !!}
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" class="float_right btn btn-submit" value="設定する"> 
				</td>
			</tr>	
	</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
 		CKEDITOR.replace( 'camera_message' );
 		
 		CKEDITOR.config.extraPlugins = 'justify';
 		CKEDITOR.config.language = 'ja';
 		
 		<?php if(isset($setting->camera_mode) && !empty($setting->camera_mode)) :?>
 			$('input[type="radio"][value="<?php echo $setting->camera_mode;?>"]').attr("checked", "checked");
 		<?php endif;?>
 		
	});
</script>

@endsection
