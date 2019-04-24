@extends('system.layouts.app')

@section('content')


<?php
	$current_page = $users->currentPage();
	$current_page_count = $users->count();
	$total_page = ceil($users->total()/$limit);
	$next_page_url= $users->nextPageUrl();
	$previous_page_url = $users->previousPageUrl();
	$total_items = $users->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $users->url($users->lastPage());
?>

<span class="page_title">
	管理者管理
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
            <th class="th_date">ユーザー名</th>
            <th class="th_name">Eメール</th>
            <th class="th_address">機能</th>
        </tr>
	    @if(count($users) > 0)
	        @foreach($users as $user)
	        <tr class="tr_middle">
	            <td class="text_date">{{ $user->username }}</td>
	            <td class="text_name">{{ $user->email }}</td>
	            <td class="text_title">        
	                <div class="title_btn_area">
	                    <div class="title_edit_btn">
	                        <a href="{{ route('user.edit',$user->id)}}">編集</a>
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
        <a href="{{route('user.create')}}">追加</a>
    </div>
</div>

@endsection