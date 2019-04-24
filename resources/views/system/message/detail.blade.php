@extends('system.layouts.app')


@section('content')

<div class="message_top">
        @if($message->message_sent==1)
            @if( isset($message->sent_date) && !empty($message->sent_date))
            <span class="datetime left">送信日 : <?php echo  date('Y年m月d日',$message->sent_date); ?></span>
            @endif
        @endif
        
<span class="datetime right">作成日 : <?php echo date('Y年m月d日',$message->created_at->timestamp);?></span>
</div>


<div class="message_row">
    <div class="message_label">タイトル</div><div class="message_title"><?php echo $message->message_title;?></div>
</div>

<div class="message_row">
    <div class="message_label">投稿内容</div>
    <div class="message_body"><?php echo $message->message_body;?></div>
</div>

<br/>
<a class="button-default message-back" href="{{route('message')}}" >戻る</a>

@endsection
