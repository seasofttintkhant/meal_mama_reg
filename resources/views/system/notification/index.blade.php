@extends('system.layouts.app')


@section('content')


<?php
	$current_page = $notifications->currentPage();
	$current_page_count = $notifications->count();
	$total_page = ceil($notifications->total()/$limit);
	$next_page_url= $notifications->nextPageUrl();
	$previous_page_url = $notifications->previousPageUrl();
	$total_items = $notifications->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $notifications->url($notifications->lastPage());
?>

<span class="page_title">
	お知らせ
</span>
<span class="page_index">
	<?php if($total_items > 0) :?>
	    <?php if($total_items >= $start_index):?>
	    	<?php echo $total_items;?>件中<?php echo $start_index; ?>～<?php echo $end_index; ?>件目を表示中
	    <?php else:?>
	        <?php header('Location: '.$last_page_url); exit();?>
	    <?php endif;?>
    <?php endif;?>
</span>

<table class="common_tb clear_both inline_table">
    <tbody>
        <tr class="tr_top">
            <th class="th_date">日時</th>
            <th class="th_name">タイトル</th>
            <th class="th_name">ステータス</th>
            <th class="th_title">機能</th>
        </tr>
        
        <?php $index = 1;?>
        @if(count($notifications) > 0 )
            @foreach($notifications as $notification)
            <tr class="<?php echo ($index == count($notifications))? 'tr_bottom' : 'tr_middle';?>">       
                <td class="text_date">
                   {{ isset($notification->updated_at) && !empty($notification->updated_at) ? date('Y年n月j日 H:i', $notification->updated_at->timestamp) : ''}}
                </td>
                <td class="text_name">
                    <a href="{{ route('notification.detail', $notification->id) }}">{{ $notification->title }}</a>
                </td>
                <td class="text_name">
                	<?php echo ($notification->sent_status)? "送信済み" : "下書き";?>
                </td>
                <td class="text_contents">
                    <div class="title_delivery_btn send">
                	 	<?php if(\Auth::user()->member(2)) :?>
	                    	<?php if($notification->sent_status) :?>
	                    		<a class="disabled" href="#" onclick="return false;" disabled="disabled">編集</a>
	                    	<?php else :?>
	                    		<a href="{{ route('notification.edit', $notification->id) }}">編集</a>
	                    	<?php endif;?>
                    	<?php else :?>
                    		<a href="{{ route('notification.detail', $notification->id) }}">閲覧</a>
                    	<?php endif;?>
                    </div>
                </td>
            </tr>
            <?php $index++;?>
            @endforeach
        @endif
    </tbody>
 </table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<?php if(\Auth::user()->member(2)) :?>
<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{route('notification.create')}}">お知らせの新規作成</a>
    </div>
</div>
<?php endif;?>

 @endsection