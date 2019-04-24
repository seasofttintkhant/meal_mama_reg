@extends('system.layouts.app')

@section('content')

<div class="notification_top">
@if($notification->sent_status==1)
@if( isset($notification->sent_date) && !empty($notification->sent_date))
<span class="datetime left">送信日 : <?php echo  date('Y年m月d日',$notification->sent_date); ?></span>
@endif
@endif
<span class="datetime right">作成日 : <?php echo date('Y年m月d日',$notification->created_at->timestamp);?></span>
</div>

<div class="notification_row">
    <div class="notification_label">タイトル</div>
    <div class="notification_title"><?php echo $notification->title;?></div>
</div>

<div class="notification_row">
    <div class="notification_label">投稿内容</div>
    <div class="notification_body"><?php echo $notification->content;?></div>
</div>


<br/>

<a class="button-default notification-back" href="{{route('notification')}}">戻る</a>

@endsection