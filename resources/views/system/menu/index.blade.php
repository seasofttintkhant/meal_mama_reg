
@extends('system.layouts.app')


@section('content')

<?php
	$current_page = $menus->currentPage();
	$current_page_count = $menus->count();
	$total_page = ceil($menus->total()/$limit);
	$next_page_url= $menus->nextPageUrl();
	$previous_page_url = $menus->previousPageUrl();
	$total_items = $menus->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $menus->url($menus->lastPage());
?>

<form>
    <table class="edy06_01_search">
        <tbody>
            <tr>
                <td nowrap="">
                    <span class="form_title_c">並べ替え&nbsp;</span><br>
                    <select name="s" id="sort" class="input_field_a">
                            <option value="">----</option>
                            <option value="id">ID</option>
                            <option value="timezone">時間帯</option>
                            <option value="date">配膳日</option>
                    </select>
                </td>
                <td>
                    <span class="form_title_c">並び順&nbsp;</span><br>

                    <select name="d" id="direction" class="input_field_a">
                        <option value="">----</option>
                        <option value="asc">昇順</option>
                        <option value="desc">降順</option>
                    </select>
                </td> 
            </tr>
            <tr>
                <td nowrap="">&nbsp;</td>
                <td nowrap="">
                    <input type="submit" value="並べ替え" class="submit_btn">			
                </td> 
            </tr>
        </tbody>
    </table>	
</form>

<span class="page_title">
	今日の献立管理
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
	<thead>
		<tr class="tr_top">
		    <th class="th_date">ID</th>
		    <th class="th_name">配膳日</th>
            <th class="th_name">時間帯</th>
            <th>機能</th>
		</tr>			
    </thead>
 
    <tbody>
        @foreach($menus as $menu)
        <tr class="tr_middle">
            <td class="text_date">{{ $menu->id }}</td>
            <td class="text_date">{{ isset($menu->date) && !empty($menu->date) ? date('Y年n月j日', strtotime($menu->date)) :'' }}</td>
            <td class="text_name">{{ $menu->timezone }}</td>
            <td class="text_title">
                    <div class="title_btn_area">
                        <div class="title_edit_btn">
                            <a href="{{ route('menu.edit',$menu->id)}}">編集</a>
                        </div>
                        <form action="{{ route('menu.destroy',$menu->id)}}" id="menu-delete-{{ $menu->id}}" method="post">
                            {{ csrf_field( )}}
                            {{ method_field('DELETE') }}
                     	</form>
                        <div class="title_delivery_btn">
                        	<a class="delete-link" data-id="{{ $menu->id }}" href="#">削除</a>
                        </div>
                    </div>
                </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{ route('menu.create')}}">新規作成</a>
    </div>
</div>

<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>

@endsection

@push('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            @if(isset($_GET['s']) && !empty($_GET['s'])) 
                $('#sort').val("{{ $_GET['s'] }}");
            @endif

            @if(isset($_GET['d']) && !empty($_GET['d'])) 
                $('#direction').val("{{ $_GET['d'] }}");
            @endif
            
            $(".delete-link").click(function(e){
            	
            	e.preventDefault();
            	var delete_id = $(this).data('id');
            	
        	 	$( "#dialog-message" ).dialog({
		      		modal: true,
			      	buttons: {
		        		はい: function() {
				          	document.getElementById('menu-delete-'+delete_id).submit();
				        },
		        		いいえ: function() {
				          $( this ).dialog( "close" );
				        },
			      	}
			    });
            });
        });
        
    </script>
@endpush
