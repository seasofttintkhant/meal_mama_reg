<?php use App\NutritionValue;?>

@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
<script src="/templateEditor/ckeditor/ckeditor.js"></script>  
@endpush

@section('content')

    <div class="top_row">
        <span class="page_title">
            栄養評価基準
        </span><br>
    </div>

<form action="" method="POST">
	@include('common.errors')
  	{{ csrf_field() }} 

  	<div class="nutri-data-container d-inline">
		<?php foreach($meal_types as $meal_type) :?>
		  	<div class="nutri-data-cart">
		  		<div class="nutri-data-part">
		  			<div class="nutri-data-header">
		  				<h3><?php echo $meal_type;?></h3>
		  			</div>
		  			<div class="nutri-data-body">
		  				<table class="nutri-table">
		  					<?php foreach($nutritions as $nutrition) :?>
			  					<tr>
			  						<td><?php echo NutritionValue::getLabel($nutrition);?></td>
			  						<td>
			  							{!! Form::text($meal_type.'['.$nutrition.']', isset($data[$meal_type][$nutrition])? $data[$meal_type][$nutrition] : '') !!}
			  						</td>
			  						<td><?php echo NutritionValue::getUnit($nutrition);?></td>
			  					</tr>
			  				<?php endforeach ?>
		  				</table>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="space-xm"></div>
		<?php endforeach ?>
		<input type="submit" class="f-r btn-sbmit-blue" value="設定する"> 
	</div>

</form>

@endsection