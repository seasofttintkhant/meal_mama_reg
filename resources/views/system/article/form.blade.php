@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
<script src="/templateEditor/ckeditor/ckeditor.js"></script>
@endpush

<table class="edy06_02_search">
	<tbody>
	    <tr><td>
            <span class="form_title_a k-form-title-1">コラム</span> 
            {!! Form::select('category_id', $categories, null, ['class'=>'input_field_a','placeholder'=>'選択してください']) !!} 
        </td></tr>
	    <tr><td>
            <span class="form_title_a k-form-title-1">Date（＊）</span> 
            {!! Form::text('date', null, ['class'=>'input_field_a datepicker']) !!} 
        </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">記事名（＊）</span> 
		    {!! Form::text('title', null, ['class'=>'input_field_a']) !!} 
	    </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">Top page title（＊）</span> 
		    {!! Form::text('top_page_title', null, ['class'=>'input_field_a']) !!} 
	    </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">記事本文（＊）</span> 
		    {!! Form::textarea('content', null, ['class'=>'input_field_b ckeditor', 'rows' => 5, 'cols' => 30]) !!} 
	    </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">Author（＊）</span> 
		    {!! Form::text('author', null, ['class'=>'input_field_a']) !!} 
	    </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">Tag（＊）</span> 
		    {!! Form::text('tag', null, ['class'=>'input_field_a']) !!} 
	    </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">Description（＊）</span> 
		    {!! Form::textarea('description', null, ['class'=>'input_field_b', 'rows' => 5, 'cols' => 30, 'style' => 'height:200px']) !!} 
	    </td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">アイコン画像</span>
		    <input type="text" id="image_name" class="input_field_a" readonly>
		    <div class="reference_btn">参照 {!! Form::file('image_file', ['id'=>'image_file', 'accept' => 'image/*']) !!}</div>
            <div class="custom_btn"><a id="image_clear">削除</a></div>
		</td></tr>
		<tr><td>
		    <span class="form_title_a k-form-title-1">公開</span> 
		    {!! Form::checkbox('published', '1') !!} 
	    </td></tr>
	</tbody>
</table>

<script type="text/javascript">

	$(document).ready(function() {

		CKEDITOR.replace('content');
		CKEDITOR.config.extraPlugins = 'justify';
		CKEDITOR.config.language = 'ja';

		$('#image_file').change(function(e) {
			var fileName = e.target.files[0].name;
			$('#image_name').val(fileName);

		});

		$("#image_clear").click(function() {
			$("#image_file").val("");
			$("#image_name").val("");
		});
		
		$( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
        });

	});

</script>