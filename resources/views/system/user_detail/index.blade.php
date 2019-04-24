@extends('system.layouts.app')

@push('custom_css')

@endpush

@section('content')

<?php
	$current_page = $user_details->currentPage();
	$current_page_count = $user_details->count();
	$total_page = ceil($user_details->total()/10);
	$next_page_url= $user_details->nextPageUrl();
	$previous_page_url = $user_details->previousPageUrl();
	$total_items = $user_details->total();
	$start_index = ($current_page-1)*10+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $user_details->url($user_details->lastPage());
?>
<span class="page_title">
	園連携ユーザー一覧
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

<table class="user_detail_table">

    <thead>
    	<tr>
	        <th class="user_detail_id">ID</th>
	        <th>保護者名</th>
	        <th>都道府県</th>
	        <th class="user_detail_email">メールアドレス</th>
	        <th>お子様名</th>
	        <th>登録日</th>
	        <th>お子様性別</th>
         	<th>お子様生年月日</th>
	        <th class="user_detail_option">操作</th>
    	</tr>
    </thead>

    <tbody>

    	@if(count($user_details)> 0 )
	        @foreach($user_details as $user_detail)

		        <tr>
		            <td>{{ $user_detail->id }}</td>
		            <td>{{ $user_detail->name }}</td>
		            <td>{{ $user_detail->prefecture }}</td>
		            <td class="k-email">{{ $user_detail->email }}</td>
		            <td>{{ $user_detail->child_name }}</td>
		            <td>{{ $user_detail->created_at->format('Y年n月j日') }}</td>
		            <td><?php echo ($user_detail->gender == 1)? '男 ' : '女';?></td>
		            <td>{{ isset($user_detail->birthday) && !empty($user_detail->birthday) ? date('Y年n月j日', strtotime($user_detail->birthday)) : '' }}</td>
		            <td class="text_title">
		           		@if( $user_detail->active )
							<a href="#" data-id ="{{$user_detail->id}}" class="user_option_button_disable disable">無効化</a>
						@else
							<a href="#" data-id ="{{$user_detail->id}}" class="user_option_button_active active">有効化</a>
						@endif
		            </td>
		        </tr>

	        @endforeach
    	@endif

	</tbody>

</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<script type="text/javascript">
	$(document).ready(function(){
		var user_active_message ='<div id="dialog-message" title="" style="display:none">' +'<p> 本当にこのユーザーとの園連携を有効化しますか？有効化すると同ユーザーは貴園が園連携ユーザーに提供する情報全てを閲覧できるようになります。</p>' +'</div>';
		var user_ban_message ='<div id="dialog-message" title="" style="display:none">' +'<p> 本当にこのユーザーとの園連携を無効化しますか？無効化すると同ユーザーは貴園が園連携ユーザーに提供する情報全てを閲覧できなくなります。</p>' +'</div>';

	    $(".active").click(function(e){	        
	        e.preventDefault();
	        var id = $(this).data('id');
            var url = '{{ route("user_detail.user_active", ":id") }}';
            url = url.replace(':id', id);
	      	$(user_active_message).dialog({
	          	modal: true,
	            buttons: {
	        		はい: function() {
	                	window.location = url;
	                },
	            	いいえ: function() {
	                	$( this ).dialog( "close" );
	                },
	            }
	        });
	    });

	    $(".disable").click(function(e){	    	        
	        e.preventDefault();
	        var id = $(this).data('id');
            var url = '{{ route("user_detail.user_ban", ":id") }}';
            url = url.replace(':id', id);
	     	$(user_ban_message).dialog({
	      		modal: true,
	          	buttons: {
					はい: function() {
	                	window.location = url;
	                },
	        		いいえ: function() {
	              		$( this ).dialog( "close" );
	                },
	          	}
	        });
	    });

	})
</script>

@endsection