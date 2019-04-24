
@extends('system.layouts.app')


@section('content')

<?php
	$current_page = $messages->currentPage();
	$current_page_count = $messages->count();
	$total_page = ceil($messages->total()/$limit);
	$next_page_url= $messages->nextPageUrl();
	$previous_page_url = $messages->previousPageUrl();
	$total_items = $messages->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $messages->url($messages->lastPage());
?>

<span class="page_title">
	管理者メッセージ
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
		    <th class="th_date">送信日時</th>
		    <th class="th_name">送信者</th>
		    <th class="th_name">受信者</th>
		    <th class="th_name">タイトル</th>
		    <th class="th_title">機能</th>
		</tr>
		<?php $index = 1;?>
		@foreach($messages as $message)
		<?php
			$sender = $message->getSender();
			$receiver = $message->getReceiver();
		?>
	    <tr class="<?php echo ($index == count($messages))? 'tr_bottom' : 'tr_middle';?>">
		    <td class="text_date">{{ isset($message->sent_date) && !empty($message->sent_date) ? date('Y年n月j日 H:i',$message->sent_date) :'' }}</td>
		    <td class="text_name"><?php echo (isset($sender) && !empty($sender))? $sender->contact_name : NULL;?></td>
		    <td class="text_name"><?php echo (isset($receiver) && !empty($receiver))? $receiver->contact_name : NULL;?></td>
		    <td class="text_name">{{ $message->title }}</td>
		    <td class="text_contents">
		    	<?php if($message->canView()):?>
                <div class="title_delivery_btn send">
        			<a href="{{route('system.message.view',$message->id)}}">開く</a>
                </div>
                <?php endif;?>
            </td>
	    </tr>
	    <?php $index++;?>
		@endforeach
    </tbody>
</table>
 

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{route('system.message.form')}}">新規メッセージ送信</a>
    </div>
</div>

@endsection