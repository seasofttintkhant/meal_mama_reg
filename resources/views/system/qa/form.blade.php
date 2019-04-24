@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
<script src="/templateEditor/ckeditor/ckeditor.js"></script>  
@endpush

<table class="eds04_01_search">
    <tbody>
    	<tr>
    		<td>
	    		<span class="form_title_a">カテゴリ</span>
	            {!! Form::select('category_id', $categories, null, ['class'=>'input_field_a','placeholder'=>'選択してください']) !!}
            </td>
            <td>
                <span class="form_title_a">記事名（＊）</span>
                {!! Form::text('title', null, ['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">記事本文（＊）</span>
                {!! Form::textarea('content', null, ['class'=>'input_field_b ckeditor', 'rows' => 5, 'cols' => 30]) !!}
            </td>
            <td>
            	<span class="form_title_a">公開</span>
            	{!! Form::checkbox('published', '1') !!}
            </td>
    	</tr>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
 		CKEDITOR.replace( 'content' ); 
 		CKEDITOR.config.extraPlugins = 'justify';
 		CKEDITOR.config.language = 'ja';
	});
</script>