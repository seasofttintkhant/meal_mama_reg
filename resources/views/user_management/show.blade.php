@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

@section('content')

   {!! Form::model($tempuser,['route' => ['kinder_request.store',$tempuser->id],'files'=>true,'method' => 'PATCH','id'=>'create-form','class'=>'h-adr']) !!}
    @include('common.errors')
    {{ csrf_field() }}  

    <input type="hidden" class="p-country-name" value="Japan">


    <div class="space-xm"></div>

    <div class="">
        <span class="form_title_a"><b>園ユーザー登録申請管理</b></span>
    </div>
    <div class="space-xm"></div>

    <table class="e-table_a">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_a">登録申請日時</span>
                </td>
                <td>
                   {{isset($tempuser->created_at) && !empty($tempuser->created_at) ? date('Y年m月d日 H:i',$tempuser->created_at->timestamp) : ""}}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a"> 献立ソフト</span>
                </td>
                <td>    
                   {!! Form::radio('service', '0') !!} &nbsp; 利用なし 
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
                    <span class="form_title_a">名称（＊）</span>
                </td>
                <td>
                    {!! Form::text('name',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr>
            {{-- <tr>
                <td>
                    <span class="form_title_a">ユーザー名（＊）</span>
                </td>
                <td>
                    {!! Form::text('username',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr> --}}
    
            <tr>
                <td>
                    <span class="form_title_a">郵便番号（＊）</span>
                </td>
                <td>
                    {!! Form::text('zipcode',null,['class'=>'e-input_field_a p-postal-code','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">都道府県（＊）</span>
                </td>
                <td>
                    {!! Form::select('prefecture', config('prefectures') , null, ['class'=>'e-input_field_a p-region','placeholder' => '選択してください','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">市区町村〜番地（＊）</span>
                </td>
                <td>
                    {!! Form::text('city',null,['class'=>'e-input_field_a p-locality p-street-address p-extended-address','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">住所</span>
                </td>
                <td>
                    {!! Form::text('street_address',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">建物名等</span>
                </td>
                <td>
                    {!! Form::text('building',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">電話番号</span>
                </td>
                <td>
                    {!! Form::tel('phone',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">FAX番号</span>
                </td>
                <td>
                    {!! Form::tel('fax',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">メールアドレス（＊）</span>
                </td>
                <td>
                    {!! Form::email('email',null,['class'=>'e-input_field_a','readonly']) !!}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">担当者名</span>
                </td>
                <td>
                    {!! Form::text('contact_name',null,['class'=>'e-input_field_a','readonly']) !!}
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

{!! Form::close() !!}

<div class="eds03_02_btn_area e-f-start m-l-205">

        <div class="registration_btn">
            <a href="" id="save">承認 </a>
        </div>
   
        <form action="{{ route('kinder_request.delete',$tempuser->id)}}" id="delete-form" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        
        <div class="delete_btn">
            <a href="" id="delete">却下</a>
        </div>

        <div class="kinder_request_back_btn">
            <a href="" id="delete">戻る</a>
        </div>
        
</div>
        
@endsection


