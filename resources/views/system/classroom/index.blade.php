@extends('system.layouts.app')

@section('content')


<?php
	$current_page = $classrooms->currentPage();
	$current_page_count = $classrooms->count();
	$total_page = ceil($classrooms->total()/$limit);
	$next_page_url= $classrooms->nextPageUrl();
	$previous_page_url = $classrooms->previousPageUrl();
	$total_items = $classrooms->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $classrooms->url($classrooms->lastPage());
?>

<form>
    <table class="edy06_01_search">
        <tbody>
            <tr>
                <td nowrap="">
                    <span class="form_title_c">クラス名&nbsp;</span>
                    <input type="text" class="input_field_d" size="50" name="name" value="{{ isset($_GET['name']) ? $_GET['name'] : ''}}">
                    <input type="submit" value="検索" class="submit_btn">			
                </td>
            </tr>
        </tbody>
    </table>	
</form>

<span class="page_title">
	クラス管理
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
            <th class="th_date">ID</th>
            <th class="th_name">クラス名</th>
            <th class="th_title">機能</th>
        </tr>
        @if(count($classrooms) > 0)
            @foreach($classrooms as $classroom)
                <tr class="tr_middle">
                    <td class="text_date">{{ $classroom->id }}</td>
                    <td class="text_name">{{ $classroom->name }}</td>
                    <td class="text_title">
                        <div class="title_btn_area">
                            <div class="title_edit_btn">
                                <a href="{{ route('classroom.edit',$classroom->id) }}">編集</a>
                            </div>
                            <form action="{{ route('classroom.delete',$classroom->id)}}" id="classroom-delete-{{ $classroom->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <div class="title_delivery_btn">
                                <a class="delete-button" href="#" data-id="{{ $classroom->id}}">削除</a>
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
        <a href="{{route('classroom.create')}}">新規作成</a>
    </div>
</div>

<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>

<div id="dialog-message-paid" title="" style="display:none">
        <p>
            献立管理機能は有償オプションとなります。機能の詳細に関しましてはご遠慮なくお問い合わせください。
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
			          	$('#classroom-delete-'+id).submit();
			        },
	        		いいえ: function() {
			          $( this ).dialog( "close" );
			        },
		      	}
		    });
        });

        $('#dialog-message-paid').dialog({
              modal: true,
              close: function(){
                window.history.back();
              },
              buttons: {
                はい: function() {
                    window.history.back();
                },
              }
        });
		
	});
</script>

@endsection