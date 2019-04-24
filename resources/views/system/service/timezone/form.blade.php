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
                <span class="form_title_a">区分ID（＊）</span>
                {!! Form::text('timezone_id', null, ['class' => 'input_field_a']) !!}
            </td>
            <?php else :?>
            	<input type="hidden" name="timezone_id" value="0">
            <?php endif;?>
            <td>
                <span class="form_title_a">	区分名称（＊）</span>
                {!! Form::text('timezone_name', null, ['class' => 'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">配膳時刻（＊）</span>
                <?php 
                	$arrHours = array();
                	for($i = 0; $i <= 24; $i++)
					{
						$arrHours[sprintf('%02d', $i)] = sprintf('%02d', $i);
					}
				?>
                {!! Form::select('hour', $arrHours, null, [ 'class'=>'input_field_c' ]); !!}
                {!! Form::select('minute', ['00' => '00', '30' => '30'], null, [ 'class'=>'input_field_c' ]); !!}
            </td>
    	</tr>
	</tbody>
</table>