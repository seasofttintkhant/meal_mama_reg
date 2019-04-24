@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
<script src="/templateEditor/ckeditor/ckeditor.js"></script>  
@endpush

@section('content')

<div class="top_row">
	<span class="page_title">アプリ起動時設定</span>
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
					<input type="radio" name="mode" value="off" checked> 通常起動<br>
			  		<input type="radio" name="mode" value="maintenance"> メンテナンスモード（メッセージを設定してください。）<br>
				  	<input type="radio" name="mode" value="message"> メッセージ表示モード（メッセージを設定してください。）<br>
				  	<input type="radio" name="mode" value="update"> 強制アップデートモード（メッセージを設定してください。）<br>	
				</td>
			</div>
			<tr>
				<td>
					<label class="col-form-label">バージョン</label>
				</td>
				<td>
					<br/>
					Android<br/>
					{!! Form::text('android_version', isset($setting->android_version)? $setting->android_version : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
					iOS<br/>
					{!! Form::text('ios_version', isset($setting->ios_version)? $setting->ios_version : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
				</td>
			</tr>
			<tr>
				<td>
					<label class="col-form-label">メッセージ</label>
				</td>
				<td>
					{!! Form::textarea('message', isset($setting->message)? $setting->message : '', ['class'=>'ckeditor', 'rows' => 5, 'cols' => 30]) !!}
				</td>
			</tr>
			<tr>
				<td>
					<label class="col-form-label">メールアドレス認証</label>
				</td>
				<td>
					<hr/><br/>
					タイトル<br/>
					{!! Form::text('verification_email_title', isset($setting->verification_email_title)? $setting->verification_email_title : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
					本文<br/>
					{!! Form::textarea('verification_email_content', isset($setting->verification_email_content)? $setting->verification_email_content : '', ['class'=>'ckeditor', 'rows' => 5, 'cols' => 30]) !!}
				</td>
			</tr>
			<tr>
				<td>
					<label class="col-form-label">ユーザー登録完了</label>
				</td>
				<td>
					<hr/><br/>
					タイトル<br/>
					{!! Form::text('registration_completed_email_title', isset($setting->registration_completed_email_title)? $setting->registration_completed_email_title : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
					本文<br/>
					{!! Form::textarea('registration_completed_email_content', isset($setting->registration_completed_email_content)? $setting->registration_completed_email_content : '', ['class'=>'ckeditor', 'rows' => 5, 'cols' => 30]) !!}
				</td>
			</tr>
			<tr>
				<td>
					<label class="col-form-label">パスワード忘れ（再設定）</label>
				</td>
				<td>
					<hr/><br/>
					タイトル<br/>
					{!! Form::text('password_recovery_email_title', isset($setting->password_recovery_email_title)? $setting->password_recovery_email_title : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
					本文<br/>
					{!! Form::textarea('password_recovery_email_content', isset($setting->password_recovery_email_content)? $setting->password_recovery_email_content : '', ['class'=>'ckeditor', 'rows' => 5, 'cols' => 30]) !!}
				</td>
			</tr>
			<tr>
				<td>
					<label class="col-form-label">パスワード変更完了</label>
				</td>
				<td>
					<hr/><br/>
					タイトル<br/>
					{!! Form::text('password_changed_email_title', isset($setting->password_changed_email_title)? $setting->password_changed_email_title : '', ['class' => 'form-text-field']) !!}
					<br/><br/>
					本文<br/>
					{!! Form::textarea('password_changed_email_content', isset($setting->password_changed_email_content)? $setting->password_changed_email_content : '', ['class'=>'ckeditor', 'rows' => 5, 'cols' => 30]) !!}
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
 		CKEDITOR.replace( 'message' );
 		CKEDITOR.replace( 'verification_email_content' );
 		CKEDITOR.replace( 'registration_completed_email_content' );
 		CKEDITOR.replace( 'password_recovery_email_content' );
 		CKEDITOR.replace( 'password_changed_email_content' );
 		
 		CKEDITOR.config.extraPlugins = 'justify';
 		CKEDITOR.config.language = 'ja';
 		
 		<?php if(isset($setting->mode) && !empty($setting->mode)) :?>
 			$('input[type="radio"][value="<?php echo $setting->mode;?>"]').attr("checked", "checked");
 		<?php endif;?>
 		
	});
</script>

@endsection
