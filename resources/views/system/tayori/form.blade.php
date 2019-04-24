@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

<input type="hidden" name="header_img" class="header_img" value="{{ isset($tayori->header_img) ? $tayori->header_img : '' }}">
<input type="hidden" name="body_img" class="body_img" value="{{ isset($tayori->body_img) ? $tayori->body_img : '' }}">
<input type="hidden" name="footer_img" class="footer_img" value="{{ isset($tayori->footer_img) ? $tayori->footer_img : '' }}">
<input type="hidden" name="pdf_file" class="pdf_file" value="{{ isset($tayori->pdf) ? $tayori->pdf : '' }}">

<table class="edy06_02_search">
    <tbody>
    <tr>
    	<td>
     		<span class="form_title_b">登録方法</span>
        	 新規PDF作成 &nbsp;{{ Form::radio('method', 1,  (isset($tayori->gender) && $tayori->gender== 1  ? true : false), ['class'=>'method_change', 'checked' => ''])  }}  &nbsp;&nbsp;
    		PDFファイルアップロード &nbsp;{{ Form::radio('method', 2, (isset($tayori->gender) && $tayori->gender== 2  ? true : false), ['class'=>'method_change']) }} 
    	</td>
    </tr>
    <tr>
        <td>
        	<span class="form_title_b">配膳月（＊）</span>
        	<?php if($edit) :?>
        		{!! Form::text('year',null,['class'=>'input_field_a', 'maxlength' =>"4", 'size' =>"4"]) !!}
        	<?php else:?>
        		<?php 
        		$yearArr = array(
	        		date("Y")-1 => date("Y")-1, 
	        		date("Y") => date("Y"), 
	        		date("Y")+1 => date("Y")+1
				);	
        		?>
        		{!! Form::select('year', $yearArr , null, ['class'=>'input_field_a','placeholder' => '選択してください']) !!}
            <?php endif;?>
        </td>
    </tr>
    <tr>
    	 <td>
    	 	<span class="form_title_b">&nbsp;</span>
    		<?php $monthArr = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12);	?>
    		{!! Form::select('month', $monthArr , null, ['class'=>'input_field_a','placeholder' => '選択してください']) !!}
            <div class="menu_reference_btn">
                <a href="/kondate">献立の参照</a>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <span class="form_title_b">タイトル（＊）</span>
            {!! Form::text('title',null,['class'=>'input_field_a']) !!}
            
        </td>
    </tr>
    <tr class="create-field">
        <td>
            <span class="form_title_b">ヘッダ背景画像</span>
            <input type="text" class="input_field_a header_img"  value="{{ isset($tayori->header_img) ? $tayori->header_img : '' }}" readonly>
            <div class="reference_btn">
    			参照
                {!! Form::file('header_img',['id'=>'header_img']) !!}
            </div>
            <div class="custom_btn">
                    <a id="header_clear">削除</a>
            </div>
        </td>
    </tr>
    <tr class="create-field">
        <td>
            <span class="form_title_b">ヘッダ文章</span>
            {!! Form::textarea('header',null, ['size' => '30x5','class'=>'input_field_e'])!!}
            
        </td>
    </tr>
    <tr class="create-field">
        <td>
            <span class="form_title_b">本文背景画像</span>
            <input type="text" class="input_field_a body_img" value="{{ isset($tayori->body_img) ? $tayori->body_img :'' }}" readonly>
           
            <div class="reference_btn">
    			参照
                <input type="file">
                {!! Form::file('body_img',['id'=>'body_img']) !!}    
            </div>
            <div class="custom_btn">
                <a id="body_clear">削除</a>
            </div>
        </td>
    </tr>
    <tr class="create-field">
        <td>
            <span class="form_title_b">本文文章</span>
            {!! Form::textarea('body',null, ['size' => '30x5','class'=>'input_field_e'])!!}
        </td>
    </tr>
    <tr class="create-field">
        <td>
            <span class="form_title_b">フッタ背景画像</span>
            <input type="text" class="input_field_a footer_img" value="{{ isset($tayori->footer_img) ? $tayori->footer_img : '' }}" readonly>
            <div class="reference_btn">
        		参照
                {!! Form::file('footer_img',['id'=>'footer_img']) !!}
            </div>
            <div class="custom_btn">
                <a id="footer_clear">削除</a>
            </div>
        </td>
    </tr class="create-field">
    <tr class="create-field">
        <td>
            <span class="form_title_b">フッタ文章</span>
            {!! Form::textarea('footer',null, ['size' => '30x5','class'=>'input_field_e'])!!}
        </td>
    </tr>
	   
	<tr class="upload-field" style="display:none;">
        <td>
            <span class="form_title_b">PDFファイル（＊）</span>
            <input type="text" class="input_field_a pdf_file" value="{{ isset($tayori->pdf) ? $tayori->pdf :'' }}" readonly>
           
            <div class="reference_btn">
    			参照
                <input type="file">
                {!! Form::file('pdf_file',['id'=>'pdf_file']) !!}    
            </div>
            <div class="custom_btn">
                <a id="pdf_file_clear">削除</a>
            </div>
        </td>
    </tr>
    
    <?php if(isset($is_kondate)) :?>
    <tr>
        <td>
        <span class="form_title_b">献立区分（＊）</span>
        
            <?php if(isset($meal_types) && !empty($meal_types)):?>
                <?php
                    $meal_types_val = old('meal_types');
                    if(!isset($meal_types_val) || empty($meal_types_val))
                    {
                        if(isset($tayori) && !empty($tayori))
                        {
                            $meal_types_val = $tayori->meal_type;
                            $meal_types_val = explode(',', $meal_types_val);
                        }
                    }
                ?>
                <?php foreach($meal_types as $meal_type) :?>
                    <input <?php echo (!empty($meal_types_val) && in_array($meal_type->id, $meal_types_val))? 'checked=true' : '';?> name="meal_types[]" type="checkbox" value="<?php echo $meal_type->id;?>">&nbsp;<?php echo $meal_type->category_name;?>&nbsp;<br/>
                <?php endforeach;?>
            <?php endif;?>
        </td>
    </tr>
    <?php endif;?>
    
</tbody>
</table>

@push('custom_js')
<script>
    $('#header_img').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.header_img').val(fileName);
        
    });

    $('#body_img').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.body_img').val(fileName);
    });

    $('#footer_img').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.footer_img').val(fileName);
    });

    $("#header_clear").click(function () {
        $("#header_img").val("");
        $(".header_img").val("");
    });

    $("#body_clear").click(function () {
        $("#body_img").val("");
        $(".body_img").val("");
    });

    $("#footer_clear").click(function () {
        $("#footer_img").val("");
        $(".footer_img").val("");
    });
    
     $('#pdf_file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.pdf_file').val(fileName);
    });
    
    $("#pdf_file_clear").click(function () {
        $("#pdf_file").val("");
        $(".pdf_file").val("");
    });
    
</script>
@endpush

@push('custom_js')
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <script>
        $( function() {
            $("#datepicker").datepicker({ 
                dateFormat: 'yy/mm',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,

                onClose: function(dateText, inst) {  
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
                    $(this).datepicker('setDate', new Date(year, month, 1)); 
                }
            });
            
            $("#datepicker").focus(function () {
                $(".ui-datepicker-calendar").hide();
                $("#ui-datepicker-div").position({
                    my: "center top",
                    at: "center bottom",
                    of: $(this)
                    });
                
            });
            
            $(".method_change").change(function(){
            	if($(this).val() == 1)
            	{
            		$(".upload-field").hide();
            		$(".create-field").show();
            	}
            	else
            	{
            		$(".upload-field").show();
            		$(".create-field").hide();
            	}
            });
            
            if($(".method_change:checked").val() == 1)
            {
        		$(".upload-field").hide();
        		$(".create-field").show();
        	}
        	else
        	{
        		$(".upload-field").show();
        		$(".create-field").hide();
        	}
            
        });
        </script>
@endpush

