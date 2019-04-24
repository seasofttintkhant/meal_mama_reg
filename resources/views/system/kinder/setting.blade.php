<?php use \App\Kinder; ?>

@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

@section('content')

<span class="page_title">
	各種設定
</span>
<br>
<?php if(!$kinder->isService(Kinder::NON_SERVICE)) :?>

<h2 class="setting_header_h2">{{ config('app.name') }} アプリ連携設定</h2>	

<form action="" method="POST">
	@include('common.errors')
  	{{ csrf_field() }} 
	  
	<table class="setting_table width_95">
		<tr>
			<td colspan="2">
				<label class="col-form-label bold">保護者との成長記録データ共有</label>
			</td>
			<td>
				<input type="radio" name="share_growth_log" value="1" checked>共有する
			</td>
			<td>
				<input type="radio" name="share_growth_log" value="0">共有しない	
			</td>
			
			<td>
				<input type="submit" class="btn btn-submit bold" value="設定する"> 
			</td>
		
		</tr>
	</table>
</form>

<?php endif;?>

<?php if(!$kinder->isService(Kinder::BUONO_SERVICE)) :?>

<h2 class="setting_header_h2 mt_50">献立項目設定</h2>

<div class="row">
	<div class="col col-left">
		<span class="section_label">食種</span>
	</div>
	<div class="col col-right">
		<div class="col_inner">
			<table class="common_tb clear_both inline_table auto_width bold_table">
				<tbody>
					<tr class="tr_top">
						<?php if(!$kinder->isService(Kinder::NON_SERVICE)) :?>
						<th class="th_name pd_020">食種ID</th>
						<?php endif;?>
						<th class="th_name pd_020">食種名称</th>
						<th class="th_title w_250px h_40px">操作</th>
					</tr>
					
					@if(count($mealtypes) > 0)
						@foreach($mealtypes as $mealtype)
							<tr class="tr_middle">
								<?php if(!$kinder->isService(Kinder::NON_SERVICE)) :?>
								<td class="td_border">{{ $mealtype->mealtype_id }}</td>
								<?php endif;?>
								<td class="td_border pd_020">{{ $mealtype->mealtype_name }}</td>
								<td class="text_title h_40px">    
									<div class="btn-wrapper">
										<a href="#"class="btn btn-submit bold" onclick="openWindow('{{ route('service.mealtype.edit',$mealtype->id) }}?popup=1'); return false;">編集</a>
									
										<form action="{{ route('service.mealtype.delete',$mealtype->id)}}" id="mealtype-delete-{{ $mealtype->id}}" method="post">
											<input type="hidden" name="popup" value="1"/>
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
										</form>
										
										<a class="btn btn-submit bold mealtype-delete-button" href="#" data-id="{{ $mealtype->id}}">削除</a>
									</div>
								
								</td>
							</tr>
						@endforeach
					@endif
					
				</tbody>
			</table>
			<div class="eds02_01_btn_area mg_20030">
				<a href="#" class="btn btn-submit btn-lg bold mr_30" onclick="openWindow('{{ route('service.mealtype.create') }}?popup=1'); return false;">新規作成</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col col-left">
		<span class="section_label">献立区分</span>
	</div>
	<div class="col col-right">
		<div class="col_inner">
			<table class="common_tb clear_both inline_table auto_width bold_table">
				<tbody>
					<tr class="tr_top">
						<?php if(!$kinder->isService(Kinder::NON_SERVICE)) :?>
						<th class="th_name pd_020">区分ID</th>
						<?php endif;?>
						<th class="th_name pd_020">区分名称</th>
						<th class="th_name">配膳時刻</th>
						<th class="th_title w_250px h_40px">操作</th>
					</tr>
					
					@if(count($timezones) > 0)
						@foreach($timezones as $timezone)
							<tr class="tr_middle">
								<?php if(!$kinder->isService(Kinder::NON_SERVICE)) :?>
								<td class="td_border">{{ $timezone->timezone_id }}</td>
								<?php endif;?>
								<td class="td_border pd_020">{{ $timezone->timezone_name }}</td>
								<td class="td_border">{{$timezone->getTime() }}</td>
								<td class="text_title h_40px">			 
									<div class="btn-wrapper">
										<a href="#" class="btn btn-submit bold" onclick="openWindow('{{ route('service.timezone.edit',$timezone->id) }}?popup=1'); return false;">編集</a>
							
										<form action="{{ route('service.timezone.delete',$timezone->id)}}" id="timezone-delete-{{ $timezone->id}}" method="post">
											<input type="hidden" name="popup" value="1"/>
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
										</form>
										
										<a class="btn btn-submit bold timezone-delete-button" href="#" data-id="{{ $timezone->id}}">削除</a>
									</div>				   
								</td>
							</tr>
						@endforeach
					@endif
					
				</tbody>
			</table>
			<div class="eds02_01_btn_area mg_20030">
				<a href="#" class="btn btn-submit btn-lg bold mr_30" onclick="openWindow('{{ route('service.timezone.create')}}?popup=1'); return false;">新規作成</a>
			</div>
		</div>
	</div>
</div>

<div class="clear_both"></div>
<div id="dialog-message" title="" style="display:none">
	<p>
    	一度削除した項目は復旧できません。この項目を本当に削除してもよろしいですか？
  	</p>
</div>

<input type="hidden" id="reload_check" value="0"/>

<script type="text/javascript">
	
	var myWindow = "";
	var isOpen = false;
		
	function openWindow(url)
	{
		if(!isOpen)
		{
			myWindow = window.open(url, "_blank", "width=800, height=600");
			isOpen = true;
  		}
  		else
  		{
  			myWindow.close();
  			isOpen = false;
  			openWindow(url);
  		}
	}
	
	setInterval(function(){ 
		var reload_check = $("#reload_check").val();
		if(reload_check == '1')
		{
			window.location.reload();
		}
	}, 500);
	
	$(document).ready(function(){
		
		$('input[type="radio"][value="<?php echo $setting['share_growth_log'];?>"]').attr("checked", "checked");
		
		$(".mealtype-delete-button").click(function(e)
		{
        	e.preventDefault();
        	var id = $(this).data('id');
    	 	$( "#dialog-message" ).dialog({
	      		modal: true,
		      	buttons: {
	        		はい: function() {
			          	$('#mealtype-delete-'+id).submit();
			        },
	        		いいえ: function() {
			          $( this ).dialog( "close" );
			        },
		      	}
		    });
		    
        });
        
        $(".timezone-delete-button").click(function(e)
        {
        	e.preventDefault();
        	var id = $(this).data('id');
    	 	$( "#dialog-message" ).dialog({
	      		modal: true,
		      	buttons: {
	        		はい: function() {
			          	$('#timezone-delete-'+id).submit();
			        },
	        		いいえ: function() {
			          $( this ).dialog( "close" );
			        },
		      	}
		    });
		    
        });
		
	});
</script>

<?php endif;?>

@endsection
