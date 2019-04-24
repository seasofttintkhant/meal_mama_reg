@extends('system.layouts.app')


@section('content')

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

<?php $group = \Auth::user()->group;?>
<form action="{{route('kinder')}}" id="kinder-search">
    <table class="eds03_01_search reg_form">
            <tbody><tr>
                <td>
                    <span class="form_title_a">コード</span>
                    <input type="text" class="input_field_a" name="code" value="{{ isset($_GET['code']) ? $_GET['code'] : ''}}">
                </td>
                <td>
                    <span class="form_title_a">名称</span>
                    <input type="text" class="input_field_c" name="name" value="{{ isset($_GET['name']) ? $_GET['name'] : ''}}">
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_c">住所</span>
                    <input type="text" class="input_field_b" name="address" value="{{ isset($_GET['address']) ? $_GET['address'] : ''}}">
                </td>
            </tr>
        </tbody>
    </table>
</form>

<div class="eds03_01_btn_area">
    <div class="search_btn e-search_btn">
        <a href="{{route('kinder.search')}}" class="kid_search_btn" onclick="event.preventDefault();document.getElementById('kinder-search').submit();">検索</a>
    </div>
</div>

<span class="page_title">
	幼稚園・保育園管理
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
            <th class="th_address">住所</th>
        </tr>
    	@if(count($kinders) > 0)
	        @foreach($kinders as $kinder)
		        <tr class="tr_middle">
		            <td class="text_date">{{ $kinder->link_code }}</td>
		            <td class="text_name"><a href="{{ route('kinder.edit',$kinder->id)}}">{{ $kinder->name }}</a></td>
		            <td class="text_address">
		                <div class="address_text">{{ $kinder->prefecture . $kinder->city . $kinder->building }}
		                </div>
		                <?php if($group == 0):?>
		                <div class="address_post_btn">
		                    <a href="{{route('kid',$kinder->id)}}">園児・新規作成</a>
		                </div>
		                <?php endif;?>
		            </td>
		        </tr>  
	        @endforeach
    	@endif
    </tbody>
</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<?php if($group == 2):?>
<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{ route('kinder.create')}}">追加</a>
    </div>
</div>
<?php endif;?>

@endsection