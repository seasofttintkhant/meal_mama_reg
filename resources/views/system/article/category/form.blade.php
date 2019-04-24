@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

<table class="edy06_02_search">
    <tbody>
    	<tr>
            <td>
                <span class="form_title_a k-form-title-1">コラム名（＊）</span>
                {!! Form::text('name', null, ['class'=>'input_field_a']) !!}
            </td>
            <!--
            <tr>
                <td>
                    <span class="form_title_a k-form-title-1">アイコン画像</span>
                    <input type="text" id="image_name" class="input_field_a" readonly>
                    <div class="reference_btn">                
			    	参照
                    	{!! Form::file('image_file', ['id'=>'image_file', 'accept' => 'image/*']) !!}
                    </div>
                    <div class="custom_btn">
                        <a id="image_clear">削除</a>
                    </div>
                </td>
            </tr>
            -->
            <tr>
                 <td>
                <span class="form_title_a k-form-title-1">公開</span>
                    {!! Form::checkbox('published', '1') !!}
                </td>
            </tr>
    	</tr>
	</tbody>
</table>

@push('custom_js')
<script type="text/javascript">
	
	$(document).ready(function(){
		$('#image_file').change(function(e) {
	        var fileName = e.target.files[0].name;
	        $('#image_name').val(fileName);
	        
	    });
	
	    $("#image_clear").click(function () {
	        $("#image_file").val("");
	        $("#image_name").val("");
	    });
	});
	
</script>
@endpush