@extends('system.layouts.app')


@section('content')

<form>
	<table class="edy06_01_search">
		<tbody>
			<tr>
				<td nowrap="">
					<span class="form_title_d">タイトル</span>
					<input type="text" class="input_field_c" size="50" name="title" value="{{ isset($_GET['title']) ? $_GET['title'] : ''}}">
							
				</td>
			    <td>
                    <span class="form_title_d">公開/非公開&nbsp;</span><br>

                    <select name="status" class="input_field_a" id="status">
                        <option value="">----</option>
                  		<option value="published">公開</option>
                        <option value="unpublished">非公開</option>
                    </select>
           
			</tr>
		  		<tr>
                 <td>
                    <span class="form_title_d">公開日&nbsp;</span><br>
                    <input type="text" class="input_field_c datepicker" name="date_1" readonly value="{{ isset($_GET['date_1']) ? $_GET['date_1'] :'' }}">
                </td> 
                <td>
                    <span class="form_title_d">～&nbsp;</span><br>
                    <input type="text" class="input_field_c datepicker" name="date_2" readonly value="{{ isset($_GET['date_2']) ? $_GET['date_2'] :'' }}">
                </td> 
                <td nowrap="">
                     <input type="submit" value="検索" class="submit_btn">
                     &nbsp;&nbsp;
                	<input id="reset-btn" type="button" value="クリア" class="submit_btn">			
                </td> 
            </tr>
	
		</tbody>
	</table>	
</form>

<span class="page_title">
	Q&A
</span>

      
<table class="common_tb clear_both inline_table">
    <tbody id="sortable">
    	<tr class="tr_top not_sort">
	        <th class="th_date">記事番号</th>
	        <th class="th_name">記事名</th>
	        <th class="th_name"> 公開日</th>
	        <th class="th_title">機能</th>
    	</tr>
    	@if(count($qas)> 0 )
	        @foreach($qas as $qa)
	        <tr class="tr_middle" id="{{ $qa->id }}">
	            <td class="text_date">{{ $qa->id}}</td>
	            <td class="text_name">{{ $qa->title }}</td>
	            <td class="text_name">{{ isset($qa->published_date) && !empty($qa->published_date) ? date('Y年n月j日',$qa->published_date) :'' }}</td>
	            <td class="text_title">
	                <div class="title_btn_area">
	                    <div class="title_edit_btn">
	                        <a href="{{ route('qa.edit',[$qa->category_id,$qa->id])}}">編集</a>
						</div>
						<form action="{{ route('qa.delete',$qa->id)}}" id="qa-delete-{{ $qa->id}}" method="post">
							{{ csrf_field( )}}
							{{ method_field('DELETE') }}
						</form>
						<div class="title_delivery_btn">
							<a class="delete-button" href="#" data-id="{{ $qa->id}}">削除</a>
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
		<form method="POST" action="{{ route('qa.order',$category_id) }}">
			{{ csrf_field() }}
			<input type="hidden" name="sort_val" id="sort_val">
    		<a onclick="event.preventDefault(); $('#order_btn form').submit();" href="#">Save Order</a>
    	</form>
    </div>
    <div class="post_btn">
        <a href="{{ route('qa.create',$category_id)}}">新規作成</a>
    </div>
</div>

<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>

@push('custom_js')
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
        } );
        </script>
<script type="text/javascript">
	$(document).ready(function(){

		@if(isset($_GET['status']) && !empty($_GET['status']))
	    	$('#status').val("{{ $_GET['status'] }}");
	    @endif

		$(".delete-button").click(function(event){
        	event.preventDefault();
        	var id = $(this).data('id');
    	 	$( "#dialog-message" ).dialog({
	      		modal: true,
		      	buttons: {
	        		はい: function() {
			          	$('#qa-delete-'+id).submit();
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
@endpush
@endsection



