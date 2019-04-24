

@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')
	<div class="row">
	<span class="page_title">
		今日の献立
	</span>
		<a class="back_to_list" href="{{route('kinder-menu.index')}}">今日の献立に戻る</a>
	</div>

	<div class="row">
		
		<!-- Left Column -->
		<div class="menu-col menu-col-left">
			<h3 class="menu_main_title mb_20">{{ $japanese_month_day }}昼食の献立（{{ $mealtype_name }}）</h3>
			<!-- Dish Image -->
			<div class="menu-row">
				@if ($errors->has('upload_image'))
				     <h4 class="error_header">{{ $errors->first('upload_image') }}</h4><br>  
				@endif

			    <div class="menu-thumbnail menu-col-sm-10">
			      <img src="{{ isset($menu_image) && !empty($menu_image) ? $menu_image : '/img/no_image.png'}}" alt="Image">
			    </div>
			    <a href="#" id="image-form-btn" class="btn menu-btn-gray menu-btn-lg mt_10">ファイルを選択</a>  
			    <?php if(isset($has_image) && !empty($has_image)):?>
			    <a href="#" id="image-delete-form-btn" class="btn menu-btn-gray menu-btn-lg mt_10">ファイルを削除</a> 
			    <?php endif;?>
			</div>
			
			<div id="dialog-image-delete" title="ファイルを削除">
				<br/>
				<p>画像ファイルを本当に削除しますか？</p>
			  	<form id="image-delete-form" method="POST" action="<?php echo route('kinder-menu.image.delete');?>">
			      	{{ csrf_field() }}
			      	@if(isset($menu_id) && !empty($menu_id))
					<input type="hidden" name="menu_id" value="{{$menu_id}}">
					@endif
			      	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			  	</form>
			</div>
			
			<div id="dialog-image-form" title="画像登録">
				
			  	<form id="image-form" method="POST" enctype="multipart/form-data" action="<?php echo route('kinder-menu.image');?>">
			  		@if(isset($menu_id) && !empty($menu_id))
					<input type="hidden" name="menu_id" value="{{$menu_id}}">
					@endif
					<input type="hidden" name="category_id" value="{{$category_id}}">
					<input type="hidden" name="timezone_id" value="{{$timezone_id}}">
					<input type="hidden" name="date" value="{{$date}}">

					
			    	{{ csrf_field() }}
			    	<label for="name">登録種別</label><br>
			      		<div class="upload_image_wrapper">
			      			<label for="upload_image">画像ファイル選択</label><br>
			      			<input type="file" id="upload_image" name="upload_image" class="text ui-widget-content ui-corner-all" accept="image/*">
			      		</div>
			 
			      	<!-- Allow form submission with keyboard without duplicating the dialog button -->
			      	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			      	
			  	</form>
			  	
			</div>
			
			<!-- Dish Image -->

			<!--Dishes -->
			<div class="menu-row mt_20">
				<h4 class="menu_section_title mb_10">今日の献立</h4>

				<form action="{{route('kinder-menu.dishes')}}" method="POST">
					<input type="hidden" name="category_id" value="{{$category_id}}">
					<input type="hidden" name="timezone_id" value="{{$timezone_id}}">
					<input type="hidden" name="date" value="{{$date}}">
					{{ csrf_field() }}
				<span class="menu-dishes_list bold">
					<textarea name="dish" id="" rows="10" class="menu-form-control bordered">{{ $dishes}}</textarea>
					<a href="#" class="btn menu-btn-gray menu-btn-lg mt_10 update-btn">変更を保存</a>
				</span>
			    </form>
			</div>
			<!--Dishes -->
		

			<!--Comment-->
			
			<div class="menu-row mt_20">
				<h4 class="menu_section_title mb_10">園のコメント</h4>
				<form action="{{route('kinder-menu.comment')}}" method="POST">
					<input type="hidden" name="category_id" value="{{$category_id}}">
					<input type="hidden" name="timezone_id" value="{{$timezone_id}}">
					<input type="hidden" name="date" value="{{$date}}">
					{{ csrf_field() }}
		
					<textarea name="comment" id="comment" rows="10" class="menu-form-control bordered">{{ $comment }}</textarea>
					<a href="#" class="btn menu-btn-gray menu-btn-lg mt_10 update-btn">変更を保存</a> 
				</form>
			
			</div>
			<!--Comment-->	

		</div>
		<!-- Left Column -->
		<div class="clear_both"></div>
	</div>
@endsection

@push('custom_js')

<script type="text/javascript">
	
	$(document).ready(function(){
		
		// ::::::::::::::::: Image Delete :::::::::::::::::
		
		var image_delete_dialog = $( "#dialog-image-delete" ).dialog({
			autoOpen: false,
			height: 200,
			width: 350,
			modal: true,
			buttons: {
				"はい": function() {
					$("#image-delete-form").submit();
				},
				"いいえ": function() {
					image_delete_dialog.dialog( "close" );
				}
			},
			close: function() {
			}
		});
		
		$( "#image-delete-form-btn" ).click(function(e) {
			e.preventDefault();
			image_delete_dialog.dialog( "open" );
		});
		
		// ::::::::::::::::: Image Upload :::::::::::::::::
		
		var image_dialog = $( "#dialog-image-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 350,
			modal: true,
			buttons: {
				"はい": function() {
					$("#image-form").submit();
				},
				"いいえ": function() {
					image_dialog.dialog( "close" );
				}
			},
			close: function() {
			}
		});


		$('#image-form .upload_type').on('change',function(){
			var type=$(this).val();

			if(type==1){

				$('.upload_image_wrapper').show();
				$('.image_url_wrapper').hide();

			}else if(type==2){

				$('.image_url_wrapper').show();
				$('.upload_image_wrapper').hide();
				
			}
		});
		
		$('#image-form').submit(function() {		
          
        	if( document.getElementById("upload_image").files.length == 0 ){
		    	alert("画像ファイルを選択してください。");
	        	return false;
			}
            	
    		return true;
		});
		
		$( "#image-form-btn" ).click(function(e) {
			e.preventDefault();
			image_dialog.dialog( "open" );
		});
	
		
		// ::::::::::::::::: General Upload :::::::::::::::::
				
		var update_dialog = '<div id="update-dialog-message" title="" style="display:none">' +'<p> 保存しますか？</p>' +'</div>';
		$(".update-btn").click(function(e){
			var form = $( this ).closest("form");
	        e.preventDefault();
	     	$(update_dialog).dialog({
	      		modal: true,
	          	buttons: {
					"はい": function() {
	                    form.submit();
	                },
	        		"いいえ": function() {
	              		$( this ).dialog( "close" );
	                },
	          	}
	        });
	    });
	
	});
	
</script>
@endpush