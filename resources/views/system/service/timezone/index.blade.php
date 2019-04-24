@extends('system.layouts.app')

@section('content')

<?php if( isset($popup) && !empty($popup) ) :?>
	
<script type="text/javascript">
	opener.document.getElementById('reload_check').value = '1';
    window.close();
</script>

<?php endif;?>

<ol class="breadcrumb">
    <li><a href="/">ホーム</a></li>
    <li class="active">献立区分</li>
</ol>

<?php
	$current_page = $timezones->currentPage();
	$current_page_count = $timezones->count();
	$total_page = ceil($timezones->total()/$limit);
	$next_page_url= $timezones->nextPageUrl();
	$previous_page_url = $timezones->previousPageUrl();
	$total_items = $timezones->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $timezones->url($timezones->lastPage());
?>

<span class="page_title">
	献立区分
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

<table class="common_tb clear_both">
    <tbody>
        <tr class="tr_top">
            <th class="th_date">ID</th>
            <th class="th_name">区分ID</th>
            <th class="th_name">区分名称</th>
            <th class="th_name">配膳時刻</th>
            <th class="th_title">操作</th>
        </tr>
        
        @if(count($timezones) > 0)
            @foreach($timezones as $timezone)
                <tr class="tr_middle">
                    <td class="text_date">{{ $timezone->id }}</td>
                    <td class="text_name">{{ $timezone->timezone_id }}</td>
                    <td class="text_name">{{ $timezone->timezone_name }}</td>
                    <td class="text_name">{{ $timezone->getTime()}}</td>
                    <td class="text_title">
                        <div class="title_btn_area">
                            <div class="title_edit_btn">
                                <a href="{{ route('service.timezone.edit',$timezone->id) }}">編集</a>
                            </div>
                            <form action="{{ route('service.timezone.delete',$timezone->id)}}" id="timezone-delete-{{ $timezone->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <div class="title_delivery_btn">
                                <a class="delete-button" href="#" data-id="{{ $timezone->id}}">削除</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        
    </tbody>
</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{ route('service.timezone.create') }}">新規作成</a>
    </div>
</div>

<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(".delete-button").click(function(){
        	
        	var id = $(this).data('id');
    	 	$( "#dialog-message" ).dialog({
	      		modal: true,
		      	buttons: {
	        		はい: function() {
			          	$('#timezone-delete-'+id).submit();
			        },
	        		いいえ: function() {
			          $( this ).dialog( "close" );
			        },
		      	}
		    });
        });
		
	});
</script>

@endsection