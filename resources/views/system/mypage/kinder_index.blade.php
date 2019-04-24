@extends('system.layouts.app')


@section('content')



<h2 class="h2_edy_02_01">管理者メッセージ</h2>
<div class="system_message_ajax_posts">
    @include('system.systemmessage.posts')
</div>

<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{route('system.message.form')}}">新規メッセージ送信</a>
    </div>
</div>

<h2 class="h2_edy_02_01">お知らせ</h2>
<div class="notification_ajax_posts">
    @include('system.notification.posts')
</div>

<?php if (\Auth::user()->member(2)) :?>
<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{route('notification.create')}}">お知らせの新規作成</a>
    </div>
</div>
<?php endif;?>

<h2 class="h2_edy_02_01">保護者への連絡</h2>
<div class="message_ajax_posts">
    @include('system.message.posts')
</div>

<?php if (\Auth::user()->member(0)) :?>
<div class="eds02_01_btn_area">
    <div class="search_btn">
        <a href="{{route('kid',$kinder_id)}}">保護者・園児検索</a>
    </div>
    <div class="post_btn">
        <a href="{{route('message.create')}}">新規メッセージ送信</a>
    </div>
</div>
<?php endif;?>

<script type="text/javascript">

		
 	$(document).ready(function() {
 		
 		//System Message
 		 $(document).on('click', '.pager_area.system_message_ajax_pager a', function (e) {
        	var href = $(this).attr('href');
        	if(href == "")
        	{
        		return false;
        	}
            getSystemMessagePosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
 		
 		//Notification
 		 $(document).on('click', '.pager_area.notification_ajax_pager a', function (e) {
        	var href = $(this).attr('href');
        	if(href == "")
        	{
        		return false;
        	}
            getNotificationPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
 		
 		//Message
        $(document).on('click', '.pager_area.ajax_pager a', function (e) {
        	var href = $(this).attr('href');
        	if(href == "")
        	{
        		return false;
        	}
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
        
        
    });
    
     //System Message
    function getSystemMessagePosts(page) {
        $.ajax({
            url : '?type=system_message&page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.system_message_ajax_posts').html(data);
            location.hash = page;
        }).fail(function () {
        });
    }
    
    //Notification
    function getNotificationPosts(page) {
        $.ajax({
            url : '?type=notification&page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.notification_ajax_posts').html(data);
            location.hash = page;
        }).fail(function () {
        });
    }
    
    //Message
    function getPosts(page) {
        $.ajax({
            url : '?type=message&page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.message_ajax_posts').html(data);
            location.hash = page;
        }).fail(function () {
        });
    }
    
</script>

 @endsection