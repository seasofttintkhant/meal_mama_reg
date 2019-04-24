<input type="hidden" class="p-country-name" value="Japan">

    <div class="">
        <span class="form_title_a"><b>園登録情報</b></span>
    </div>
    <div class="space-xm"></div>

    <table class="e-table_a">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_a"> 献立ソフト</span>
                </td>
                <td>    
                    {!! Form::radio('service', '0') !!} &nbsp; 利用なし 
                    {{-- &nbsp;{!! Form::radio('service', '1') !!} &nbsp; BUONO --}}
                    &nbsp;{!! Form::radio('service', '2') !!} EIBUN
                </td>
            </tr>
        </tbody>        
    </table>

    <table class="e-table_a">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_a">コード</span>
                </td>
                <td>
                    {!! Form::text('code',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">施設名（＊）</span>
                </td>
                <td>
                    {!! Form::text('name',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">メールアドレス（＊）</span>
                </td>
                <td>
                    {!! Form::email('email',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">パスワード（＊）</span>
                </td>
                <td>
                    {!! Form::password('password',['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">パスワード確認（＊）</span>
                </td>
                <td>
                    {!! Form::password('password_confirm',['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">郵便番号（＊）</span>
                </td>
                <td>
                    {!! Form::text('zipcode',null,['class'=>'e-input_field_a p-postal-code']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">都道府県（＊）</span>
                </td>
                <td>
                    {!! Form::select('prefecture', config('prefectures') , null, ['class'=>'e-input_field_a p-region','placeholder' => '選択してください']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">市区町村〜番地（＊）</span>
                </td>
                <td>
                    {!! Form::text('city',null,['class'=>'e-input_field_a p-locality p-street-address p-extended-address']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">マンション名等</span>
                </td>
                <td>
                    {!! Form::text('building',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">電話番号</span>
                </td>
                <td>
                    {!! Form::tel('phone',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">FAX番号</span>
                </td>
                <td>
                    {!! Form::tel('fax',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
       
            <tr>
                <td>
                    <span class="form_title_a">担当者名</span>
                </td>
                <td>
                    {!! Form::text('contact_name',null,['class'=>'e-input_field_a']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">備考</span>
                </td>
                <td>
                    {!! Form::textarea('remark',null, ['size' => '30x5','class'=>'e-input_field_a no-height'])!!}
                </td>
            </tr>
        </tr>
    </tbody>
</table>
@push('custom_js')
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
@endpush

<script type="text/javascript">
    
    function processService(value)
    {
        if (value== '1') {
            //Buono input code
            $('input[name=code]').val("");
            $('input[name=code]').removeAttr('disabled');
        }
        else {
            $('input[name=code]').val("");
            $('input[name=code]').attr('disabled', 'disabled');
        }
    }
    
    $(document).ready(function() {
        
        var service = $('input[type=radio][name=service]:checked').val();
        if(service != 1)
        {
            processService(service);
        }
        
        $('input[type=radio][name=service]').change(function() {
            processService(this.value);
        });

        $(".cus-copy").click(function(event) {
            event.preventDefault();
            var code = $('.cus-code').val().trim();
            $('body').append("<input type='text' class='tak-code' value='"+code+"'>");
            $(".tak-code").select();
            document.execCommand("copy");
            $(".tooltiptext").text("コピーしました");
            $(".tak-code").remove();
        });

        $(".cus-copy").mouseleave(function(event) {
            $(".tooltiptext").text("クリップボードにコピーします");
        });

    });

</script>
