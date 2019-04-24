<input type="hidden" name="image" class="image" value="{{ isset($menu->image) ? $menu->image : '' }}">

<table class="edy06_02_search">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_b">配膳日（＊）</span>
                    {!! Form::text('date',isset($menu->date) && !empty($menu->date) ? date('Y/m/d', strtotime($menu->date)) : '' ,['class'=>'input_field_a','id'=>'datepicker','readonly'=>'readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_b">時間帯（＊）</span>
                    {!! Form::select('timezone', $timezones , null, ['class'=>'input_field_a','placeholder' => '選択してください']) !!}
                </td>
            </tr>

            <tr>
                <td>
                    <span class="form_title_b">食種名称（＊）</span>
                    {!! Form::select('category', $meal_types , null, ['class'=>'input_field_a','placeholder' => '選択してください']) !!}
                </td>
            </tr>

            <tr>
                <td>
                    <span class="form_title_b">写真（＊）</span>
                    <input type="text" class="input_field_a image" value="{{ isset($menu->image) ? $menu->image : '' }}" readonly>
                    <div class="reference_btn">
        				参照
                        {!! Form::file('image',['id'=>'image']) !!}
                    </div>
                    <div class="custom_btn">
                        <a id="image_clear">削除</a>
                    </div>
                </td>
            </tr>
            <tr>
            	<td>
            		<span class="form_title_b"></span>
            		<p class="description">写真の最大サイズは5MBとなります。JPEGもしくはPNG形式の画像がアップロードいただけます。</p>
            	</td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_b">コメント</span>
                    {!! Form::textarea('comment', null, ['class'=>'input_field_e', 'rows' => 5, 'cols' => 30]) !!}        
                </td>
            </tr>
        </tbody>
    </table>

@push('custom_js')
    <script>
        $( function() {
        	$( "#datepicker" ).datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
        } );
        </script>

    <script>
        $('#image').change(function(e) {
            var fileName = e.target.files[0].name;
            $('.image').val(fileName);
            
        });
        $("#image_clear").click(function () {
            $("#image").val("");
            $(".image").val("");
        });
        
    </script>

@endpush

