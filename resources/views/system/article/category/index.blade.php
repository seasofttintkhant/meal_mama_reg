@extends('system.layouts.app')


@section('content')


<span class="page_title">
	educe食育コラム
</span>
      
<table class="common_tb clear_both inline_table">
    <tbody id="sortable">
    	<tr class="tr_top not_sort">
	        <th class="th_date">コラム名</th>
	        <th class="th_title">機能</th>
    	</tr>
    	@if(count($categories)> 0 )
	        @foreach($categories as $category)
	        <tr class="tr_middle" id="{{ $category->id }}">
	            <td class="text_name">{{ $category->name }}</td>
	            <td class="text_title">
	                <div class="title_btn_area">
	                    <div class="title_edit_btn">
	                        <a href="{{ route('article.category.edit',$category->id)}}">編集</a>
						</div>
						<form action="{{ route('article.category.delete',$category->id)}}" id="article-delete-{{ $category->id}}" method="post">
							{{ csrf_field( )}}
							{{ method_field('DELETE') }}
						</form>
						<div class="title_delivery_btn">
							<a class="delete-button" href="#" data-id="{{ $category->id}}">削除</a>
						</div>
					</div>
	            </td>
	        </tr>
	        @endforeach
    	@endif
	</tbody>
</table>

<div class="eds02_01_btn_area">
	<div id="order_btn" class="post_btn" style="display: none">
		<form method="POST" action="{{ route('article.category.order') }}">
			{{ csrf_field() }}
			<input type="hidden" name="sort_val" id="sort_val">
    		<a onclick="event.preventDefault(); $('#order_btn form').submit();" href="#">Save Order</a>
    	</form>
    </div>
    <div class="post_btn">
        <a href="{{route('article.category.create')}}">新規作成</a>
    </div>
</div>

<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(".delete-button").click(function(event){
        	event.preventDefault();
        	var id = $(this).data('id');
    	 	$( "#dialog-message" ).dialog({
	      		modal: true,
		      	buttons: {
	        		はい: function() {
			          	$('#article-delete-'+id).submit();
			        },
	        		いいえ: function() {
			          $( this ).dialog( "close" );
			        },
		      	}
		    });
        });
        
         $("#sortable").sortable({
	    	items: "tr:not(.not_sort)",
	    	update: function( event, ui ) {
    		 	var idsInOrder = $("#sortable").sortable("toArray");
    		 	$("#order_btn").show();
    		 	$("#sort_val").val(idsInOrder.toString());
	    	}
	    })
	    $("#sortable tr").disableSelection();
		
	});
	
</script>

@endsection