@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

<table class="eds04_01_search">
    <tbody>
    	<tr>
            <td>
                <span class="form_title_a">クラス名（＊）</span>
                {!! Form::text('name', null, ['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">備考</span>
                {!! Form::textarea('description', null, ['class'=>'input_field_b', 'rows' => 5, 'cols' => 30]) !!}
            </td>
    	</tr>
	</tbody>
</table>