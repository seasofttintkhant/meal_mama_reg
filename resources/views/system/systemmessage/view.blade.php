@extends('system.layouts.app')

@section('content')

<div class="message_top">
	@if( isset($message->sent_date) && !empty($message->sent_date))
	<span class="datetime left">送信日時 : <?php echo  date('Y年m月d日',$message->sent_date); ?></span>
	@endif
</div>

<div class="message_row">
	<div class="message_label">タイトル</div><div class="message_title"><?php echo $message->title;?></div>
</div>

<div class="message_row">
	<div class="message_label">投稿内容</div>
	<div class="message_body"><?php echo $message->content;?></div>
</div>



<?php if($message->canReply()):?>
<form method="post" name="form" id="create-form" action="{{route('system.message.send')}}">
	@include('common.errors')
	{{ csrf_field() }}
	<input type="hidden" name="receiver_id" value="<?php echo $message->sender_id;?>" >
	<input type="hidden" name="reply_message_id" value="<?php echo $message->id;?>" >
	<table class="w-100-per">
	    <tbody>
	    <tr>
	        <td>
				<div class="message_row d-flex">
					<div class="message_label">タイトル</div>
					<div class="">{!! Form::text('title', null, ['class'=>'input_field_sytle_a']) !!}</div>
				</div>
	        </td>
	    </tr>
	    <tr>
	        <td>
				<div class="message_row d-flex">
					<div class="message_label">投稿内容</div>
					<div class="">{!! Form::textarea('content', null, ['class'=>'input_field_sytle_b', 'rows' => 5, 'cols' => 30]) !!}</div>
				</div>	        	
	        </td>
	    </tr>
	    </tbody>
	</table>
</form>

<div class="post_btn post_btn_style_1">
	<a href="" id="save">投稿</a>
</div>

<?php endif;?>

<br/>
<a class="button-default message-back" href="{{route('system.message')}}">一覧に戻る</a>

@endsection
