<?php use \App\Kinder; ?>

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

<input type="hidden" name="popup" value="<?php echo ( isset($_GET['popup']) && !empty($_GET['popup']) )? $_GET['popup'] : 0;?>">

<table class="eds04_01_search">
    <tbody>
    	<tr>
    		<?php if(!isset($kinder) || empty($kinder) || !$kinder->isService(Kinder::NON_SERVICE)) :?>
    		<td>
                <span class="form_title_a">食種ID（＊）</span>
                {!! Form::text('mealtype_id', null, ['class' => 'input_field_a']) !!}
            </td>
            <?php else :?>
            	<input type="hidden" name="mealtype_id" value="0">
            <?php endif;?>
            <td>
                <span class="form_title_a">食種名称（＊）</span>
                {!! Form::text('mealtype_name', null, ['class' => 'input_field_a']) !!}
            </td>
    	</tr>
	</tbody>
</table>