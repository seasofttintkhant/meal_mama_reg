@extends('system.layouts.app')


@section('content')

<span class="page_title">
	Q&Aカテゴリー
</span>
      
<table class="common_tb clear_both inline_table">
    <tbody id="sortable">
    	<tr class="tr_top not_sort">
	        <th class="th_date">Name</th>
    	</tr>
    	@if(count($categories)> 0 )
	        @foreach($categories as $category)
	        <tr class="tr_middle" id="{{ $category->id }}">
	            <td class="text_name"><a href="{{route('qa.index',$category->id)}}" class="category_link">{{ $category->name }}</a></td>
	        </tr>
	        @endforeach
    	@endif
	</tbody>
</table>

<div class="eds02_01_btn_area">
	<div id="order_btn" class="post_btn" style="display: none">
		<form method="POST" action="{{ route('qa.category.order') }}">
			{{ csrf_field() }}
			<input type="hidden" name="sort_val" id="sort_val">
    		<a onclick="event.preventDefault(); $('#order_btn form').submit();" href="#">Save Order</a>
    	</form>
    </div>
    <div class="post_btn">
        <a href="{{route('qa.category.create')}}">新規作成</a>
    </div>
</div>

@endsection