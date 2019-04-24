<?php use App\PushMessage;?>

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
	  		<?php foreach($types as $type) :?>
			<tr>
				<td>
					<label class="col-form-label"><?php echo PushMessage::getLabel($type);?></label>
				</td>
				<td>
					<br/>
					タイトル<br/>
					{!! Form::text($type."[title]", isset($messages[$type]['title'])? $messages[$type]['title'] : '', ['class' => 'form-text-field','maxlength' => 10 ]) !!}
					<br/><br/>
					本文<br/>
					{!! Form::textarea($type."[body]", isset($messages[$type]['body'])? $messages[$type]['body'] : '', ['class'=>'ckeditor', 'rows' => 1, 'cols' => 10,'maxlength' => 10 ]) !!}
				</td>
			</tr>
			<?php endforeach;?>
			<tr>
				<td colspan="2">
					<input type="submit" class="float_right btn btn-submit" value="設定する"> 
				</td>
			</tr>			
	</table>
</form>

@endsection
