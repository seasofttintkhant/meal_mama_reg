@extends('system.layouts.app')

@section('content')


<?php $group = \Auth::user()->group;?>

<?php
	$current_page = $kinders->currentPage();
	$current_page_count = $kinders->count();
	$total_page = ceil($kinders->total()/$limit);
	$next_page_url= $kinders->nextPageUrl();
	$previous_page_url = $kinders->previousPageUrl();
	$total_items = $kinders->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $kinders->url($kinders->lastPage());
?>

<span class="page_title">
	<?php echo ($kbn == 1)? '給食だより' : '献立表' ;?>
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
            <th class="th_date">コード</th>
            <th class="th_name">名称</th>
            <th class="th_name">住所</th>
            <th class="th_address">機能</th>
        </tr>
        @if(count($kinders) > 0)
            @foreach($kinders as $kinder)
            <tr class="tr_middle">
                @if($kbn==0)
                <td class="text_date">{{ $kinder->code }}</td>
                <td class="text_name"><a href="{{ route('kondate.list',$kinder->id)}}">{{ $kinder->name }}</a></td>
                @elseif($kbn==1)
                <td class="text_date">{{ $kinder->code }}</td>
                <td class="text_name"><a href="{{ route('kyusyoku.list',$kinder->id)}}">{{ $kinder->name }}</a></td>
                @endif
                <td class="text_name">
                    <div class="address_text">{{ $kinder->prefecture . $kinder->city . $kinder->building }}
                    </div>
                    <?php if($group == 0):?>
                    <div class="address_post_btn">
                        <a href="{{ route('kid',$kinder->id)}}">園児・新規作成</a>
                    </div>
                    <?php endif;?>
                </td>
                <td class="text_title">
                	<div class="title_btn_area">
	                	<div class="title_edit_btn">
                         @if($kbn==0)	                		
                         <a href="{{ route('kondate.list',$kinder->id)}}">編集</a>
                         @elseif($kbn==1)
                         <a href="{{ route('kyusyoku.list',$kinder->id)}}">編集</a>
                         @endif
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

@endsection