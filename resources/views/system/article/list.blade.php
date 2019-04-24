@extends('system.layouts.app')


@section('content')

<?php
	$current_page = $categories->currentPage();
	$current_page_count = $categories->count();
	$total_page = ceil($categories->total()/$limit);
	$next_page_url= $categories->nextPageUrl();
	$previous_page_url = $categories->previousPageUrl();
	$total_items = $categories->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $categories->url($categories->lastPage());
?>

<span class="page_title">
	educe食育コラム
</span>

      
<table class="common_tb clear_both inline_table">
    <tbody>
    	<tr class="tr_top">
	        <th class="th_date">コラム名</th>
    	</tr>
    	@if(count($categories)> 0 )
	        @foreach($categories as $category)
	        <tr class="tr_middle">
	            <td class="text_name"><a href="{{ route('article.index',$category->id)}}" class="category_link">{{ $category->name }}</a></td>
	        </tr>
	        @endforeach
    	@endif
	</tbody>
</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif




@endsection