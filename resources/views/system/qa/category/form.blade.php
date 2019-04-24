@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

<table class="edy06_02_search">
    <tbody>
    	<tr>
            <td>
                <span class="form_title_a">Q&Aカテゴリー名（＊）</span>
                {!! Form::text('name', null, ['class'=>'input_field_a']) !!}
            </td>
            
    	</tr>
    	<tr>
    		  <td>
            	<span class="form_title_a">公開</span>
                {!! Form::checkbox('published', '1') !!}
            </td>
    	</tr>
	</tbody>
</table>