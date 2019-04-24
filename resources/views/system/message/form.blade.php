@push('custom_css')
<script src="/templateEditor/ckeditor/ckeditor.js"></script>  
@endpush

<table class="eds04_01_search">
    <tbody>
        <tr>
            <td>
                <span class="form_title_a">タイトル（＊）</span> 
                {!! Form::text('message_title',null,['class'=>'input_field_d']) !!}
            </td>
        </tr>
             <td>
                <span class="form_title_a">クラス名</span>
                {!! Form::select('kindergarten_class_id', $classes, null, ['class'=>'input_field_c','placeholder' => '選択してください']) !!}
            </td>
            <td>
                <span class="form_title_a">投稿内容（＊）</span>
                {!! Form::textarea('message_body', null, ['class'=>'input_field_b ckeditor', 'rows' => 5, 'cols' => 30]) !!}
            </td>
        </tr>

    </tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
 		CKEDITOR.replace( 'message_body' );
 		CKEDITOR.config.extraPlugins = 'justify';
 		CKEDITOR.config.language = 'ja';
	});
</script>

