<table class="eds03_02_search">
	<tbody>
		<tr>
            <td>
                <span class="form_title_a">担当者名（＊）</span>
                {!! Form::text('contact_name',isset($educe_user->contact_name) ? $educe_user->contact_name : '',['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">貴社名（＊）</span>
                {!! Form::text('company_name',isset($educe_user->company_name) ? $educe_user->company_name : '',['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">メールアドレス（＊）</span>
                {!! Form::text('email',isset($educe_user->email) ? $educe_user->email : '',['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">パスワード（＊）</span>
                {!! Form::password('password',['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">パスワード確認（＊）</span>
                {!! Form::password('password_confirm',['class'=>'input_field_a']) !!}
            </td>
    
        </tr>
    </tbody>
</table>

