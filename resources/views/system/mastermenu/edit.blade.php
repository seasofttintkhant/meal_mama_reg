

@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')
	<div class="row">
	<span class="page_title">
		マスター献立
	</span>
		<a class="back_to_list" href="{{route('master-menu.index')}}">マスター献立に戻る</a>
	</div>
	<div class="row">
		
		<!-- Left Column -->
		<div class="menu-col menu-col-left">
			<h3 class="menu_main_title mb_20">{{ $kondate1->japanese_month_day }}昼食の献立（{{ $mealtype_name }}）</h3>
			<!-- Dish Image -->
			<div class="menu-row">
				@if ($errors->has('upload_image'))
				     <h4 class="error_header">{{ $errors->first('upload_image') }}</h4><br>  
				@endif

				@if ($errors->has('image_url'))
				     <h4 class="error_header">{{ $errors->first('image_url') }}</h4><br>  
				@endif
			    <div class="menu-thumbnail menu-col-sm-10">
			      <img src="{{ isset($dish->img_1) && !empty($dish->img_1) ? $dish->img_1 : '/img/no_image.png'}}" alt="Image">
			    </div>
			    <a href="#" id="image-form-btn" class="btn menu-btn-gray menu-btn-lg mt_10">ファイルを選択</a> 
			    <?php if(isset($dish->img_1) && !empty($dish->img_1)):?>
			    <a href="#" id="image-delete-form-btn" class="btn menu-btn-gray menu-btn-lg mt_10">ファイルを削除</a> 
			    <?php endif;?>
			</div>
			
			<div id="dialog-image-delete" title="ファイルを削除">
				<br/>
				<p>画像ファイルを本当に削除しますか？</p>
			  	<form id="image-delete-form" method="POST" action="<?php echo route('master-menu.image.delete', $kondate1->id);?>">
			      	{{ csrf_field() }}
			      	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			  	</form>
			</div>
			
			<div id="dialog-image-form" title="画像登録">
				
			  	<form id="image-form" method="POST" enctype="multipart/form-data" action="<?php echo route('master-menu.image', $kondate1->id);?>">

			    	{{ csrf_field() }}
			    	<label for="name">登録種別</label><br>
			    	  	<input type="radio" class="upload_type" name="upload_type" value="1" checked> 画像ファイルアップロード<br>
  						<input type="radio" class="upload_type" name="upload_type" value="2"> 画像リンクURL登録<br>
			      		<div class="upload_image_wrapper">
			      			<label for="upload_image">画像ファイル選択</label><br>
			      			<input type="file" id="upload_image" name="upload_image" class="text ui-widget-content ui-corner-all" accept="image/*">
			      		</div>
			      	    <div class="image_url_wrapper" style="display:none;">
			      	    	<label for="image_url">画像リンクURL</label><br>
			      			<input type="text" id="image_url" name="image_url" class="text ui-widget-content ui-corner-all">
			      	    </div>
			 
			      	<!-- Allow form submission with keyboard without duplicating the dialog button -->
			      	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			      	
			  	</form>
			  	
			</div>
			
			<!-- Dish Image -->

			<!--Dishes -->
			<div class="menu-row mt_20">
				<h4 class="menu_section_title mb_10">今日の献立</h4>
				<span class="menu-dishes_list bold">
					{{ $kondate1->dishes_str}}
				</span>
			</div>
			<!--Dishes -->
		

			<!--Comment-->
			
			<div class="menu-row mt_20">
				<h4 class="menu_section_title mb_10">園のコメント</h4>
				<form action="{{route('master-menu.comment', $kondate1->id)}}" method="POST">
					{{ csrf_field() }}

					<textarea name="comment" id="comment" rows="10" class="menu-form-control bordered">{{ $kondate1->comment }}</textarea>
					<a href="#" class="btn menu-btn-gray menu-btn-lg mt_10 update-btn">変更を保存</a> 
				</form>
			
			</div>
			<!--Comment-->	

		</div>
		<!-- Left Column -->


		<!-- Middle Column -->
		<div class="menu-col menu-col-center">
	
				<!-- Foreach -->
				@foreach($kondate2_records as $kondate2)
				<div class="menu-row">
					<div class="menu-row">
						<h5 class="menu_section_sub_title mb_10">{{ $kondate2->name_1 }}</h5>
						<?php $allergies = $kondate2->getAllergies();?>
						@if(count($allergies) > 0)

							<div class="menu-col-md-4 menu-icon_section">	
								@foreach($allergies as $key => $value)
									@if( $value['status'] == 1)
									<img src="/img/icon/{{ $key }}_1.png" alt="" class="menu-img-xs" title="{{$value['title']}}"> {{$value['title']}} <br/>
									@endif
								@endforeach
							</div>
						@endif
					</div>
					<div class="menu-row">
						<div class="menu-col-md-4">
							<table class="menu-table menu-table-bordered">
								<tr>
									<th>エネルギー</th>
									<th>たんぱく質</th>
									<th>脂質</th>
									<th>炭水化物</th>
									<th>食塩相当量</th>
									<th>カルシウム</th>
								</tr>
								<tr>
									<td>{{ $kondate2->getEnergy() }}</td>
									<td>{{ $kondate2->getProtein() }}</td>
									<td>{{ $kondate2->getLipid() }}</td>
									<td>{{ $kondate2->getCarbohydrate() }}</td>
									<td>{{ $kondate2->getSalt() }}</td>
									<td>{{ $kondate2->getCalcium() }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				@endforeach
				<!--End Foreach -->
			

		</div>
		<!-- Middle Column -->

		
		<!-- Right Column -->
		<div class="menu-col menu-col-right">
			
			<div class="menu-row">
				<div class="menu-col-xs-4">
					<h4 class="menu_section_title mb_10">作り方ビデオ</h4>
					<button id="video-form-btn" class="btn menu-btn-gray menu-btn-lg">ビデオURL登録</button>
					<div class="url_guide">
						* 注意 * <br/>
						YouTubeビデオはエンベッド形式で登録してください。 <br/>
						例: <br/>
						元のURL:  https://www.youtube.com/watch?v=dyfPOPcAyTk&feature=youtu.be <br/>
						短縮URL:  https://youtu.be/dyfPOPcAyTk <br/>
						↓ <br/>
						Embedded URL:  https://www.youtube.com/embed/dyfPOPcAyTk <br/>
					</div>
				</div>
				
				<div id="dialog-video-form" title="Video Upload">
				
				  	<form id="video-form" method="POST" action="<?php echo route('master-menu.video', $kondate1->id);?>">
				    	
				    	{{ csrf_field() }}
			      		<label for="email">ビデオURL</label><br>
			      		<input type="text" id="video_url" name="video_url" class="text ui-widget-content ui-corner-all">
				 
				      	<!-- Allow form submission with keyboard without duplicating the dialog button -->
				      	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
				      	
				  	</form>
				  	
				</div>
				
				<div class="col-xs-8">
					
					@if($errors->has('video_url'))
						<h4 class="error_header">{{$errors->first()}}</h4><br>
					@endif
					<div class="menu-embed-responsive menu-embed-responsive-16by9">
						<!-- If Video Exist -->
						<?php if(isset($dish->img_2) && !empty($dish->img_2)) :?>
				  		<iframe class="menu-embed-responsive-item" src="{{ $dish->img_2 }}"></iframe>
				  		<!-- Else if Video not Exist -->
						<?php else:?>
						<img src="https://dummyimage.com/600x400/fff/000&text=No+Video" class="menu-embed-responsive-item" alt="No Video">
					    <!-- Endif -->
					    <?php endif;?>
					</div>
				
				</div>
			
			</div>
			
			<div class="menu-row mt_20 bc">
					<div class="menu-row">
						<h4 class="menu_section_title">作り方手順</h4>
					</div>
					
					<form id="guild-form" method="POST" action="<?php echo route('master-menu.guild', $kondate1->id);?>">
						
						{{ csrf_field() }}
						
						<?php if(!empty($kondate1->tejyun) && $kondate1->isTejyunDataExists()) :?>
							
							<?php foreach($kondate1->tejyun as $guild) :?>
								
								<?php if(empty($guild)) break;?>
								<div class="how-to-cook menu-row pt_10">
									<div class="menu-col-xs-8">
										<textarea name="guild[]" rows="6" class="guild-field menu-form-control bordered"><?php echo $guild;?></textarea>
									</div>
									<div class="menu-col-xs-4">
										<button class="btn-delete btn menu-btn-gray menu-btn-lg mt_10">削除</button>
										<button class="btn-move btn menu-btn-gray menu-btn-lg mt_10">下へ移動</button>
									</div>
								</div>
							
							<?php endforeach;?>
							
						<?php else :?>
							
							<div class="how-to-cook menu-row pt_10">
								<div class="menu-col-xs-8">
									<textarea name="guild[]" rows="6" class="guild-field menu-form-control bordered"></textarea>
								</div>
								<div class="menu-col-xs-4">
									<button class="btn-delete btn menu-btn-gray menu-btn-lg mt_10">削除</button>
									<button class="btn-move btn menu-btn-gray menu-btn-lg mt_10">下へ移動</button>
								</div>
							</div>
							
						<?php endif;?>
						
						<button type="button" id="how-to-cook-add-btn" class="btn menu-btn-gray menu-btn-lg mt_10">ステップを追加</button>
						<button type="submit" class="btn-save btn menu-btn-gray menu-btn-lg mt_10">変更を保存</button>
						
					</form>
			
			</div>
		</div>
		<!-- Right Column -->
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
			
			var upload_type_value = $("input[name='upload_type']:checked").val();
            if (typeof upload_type_value === "undefined") {
                alert("登録種別を選択してください。");
                return false;
            }
            
            if(upload_type_value == 1)
            {
            	if( document.getElementById("upload_image").files.length == 0 ){
			    	alert("画像ファイルを選択してください。");
                	return false;
				}
            }
            else
            {
            	if( $("#image_url").val().length === 0 ) {
			    	alert("画像リンクURLを入力してください。");
                	return false;
				}
            }
			
    		return true;
		});
		
		$( "#image-form-btn" ).click(function(e) {
			e.preventDefault();
			image_dialog.dialog( "open" );
		});
		
		// ::::::::::::::::: Video Upload :::::::::::::::::
		
		var video_dialog = $( "#dialog-video-form" ).dialog({
			autoOpen: false,
			height: 400,
			width: 350,
			modal: true,
			buttons: {
				"はい": function() {
					$("#video-form").submit();
				},
				"いいえ": function() {
					video_dialog.dialog( "close" );
				}
			},
			close: function() {
			}
		});
		
		$('#video-form').submit(function() {
			
        	if( $("#video_url").val().length === 0 ) {
		    	alert("ビデオのURLを入力してください。");
            	return false;
			}
			
    		return true;
		});
		
		$( "#video-form-btn" ).click(function(e) {
			e.preventDefault();
			video_dialog.dialog( "open" );
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
		
		// ::::::::::::::::: How To Cook :::::::::::::::::
		if($(".how-to-cook").length < 2){
			$(".how-to-cook .btn-delete").attr("disabled", "disabled");
			$(".how-to-cook .btn-delete").addClass('btn-disabled');
			$(".how-to-cook .btn-move").attr("disabled", "disabled");
			$(".how-to-cook .btn-move").addClass('btn-disabled');
		}

	    if($(".how-to-cook").length === 60){
			$("#how-to-cook-add-btn").attr("disabled", "disabled");
			$("#how-to-cook-add-btn").addClass('btn-disabled');
		}

		$(".btn-delete").click(function(e){
			e.preventDefault();
		
			$(this).closest(".how-to-cook").remove();
			
			if($(".how-to-cook").length < 2){
				$(".how-to-cook .btn-delete").attr("disabled", "disabled");
				$(".how-to-cook .btn-delete").addClass('btn-disabled');
				$(".how-to-cook .btn-move").attr("disabled", "disabled");
				$(".how-to-cook .btn-move").addClass('btn-disabled');
			}

			if($(".how-to-cook").length < 60){
				$("#how-to-cook-add-btn").removeAttr("disabled", "disabled");
				$("#how-to-cook-add-btn").removeClass('btn-disabled');
			}

		});
		
		$(".btn-move").click(function(e){
			e.preventDefault();
			var current = $(this).closest(".how-to-cook");
			if(current.next(".how-to-cook").length)
			{
				current.next(".how-to-cook").after(current.clone(true, true));
				current.remove();
			}
		});
		
	 	$("#how-to-cook-add-btn").click(function(){ 
        	var html = $(".how-to-cook").first().clone();
        	$(html).find(".guild-field").val("");
	        $(".how-to-cook").last().after(html);

	        if($(".how-to-cook").length > 1){
				$(".how-to-cook .btn-delete").removeAttr("disabled");
				$(".how-to-cook .btn-delete").removeClass('btn-disabled');
				$(".how-to-cook .btn-move").removeAttr('disabled');
				$(".how-to-cook .btn-move").removeClass('btn-disabled');
			}

			 if($(".how-to-cook").length === 60){
				$("#how-to-cook-add-btn").attr("disabled", "disabled");
				$("#how-to-cook-add-btn").addClass('btn-disabled');
			}
	    });
	
		
	});
	
</script>
@endpush