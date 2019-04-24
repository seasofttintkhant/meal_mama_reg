@extends('system.layouts.app')

@section('content')
<form>
    <table class="edy06_01_search">
        <tbody><tr>
            <td nowrap="">
                <span class="form_title_d">受講コース</span>
                <input type="text" class="input_field_d" size="50">
                
                    <input type="submit"  value="検索" class="submit_btn">
                
            </td>
        </tr>
    </tbody>
</table>
    

    <table class="common_tb">
        <tbody><tr class="tr_top">
            <th class="th_date">日時</th>
            <th class="th_date">コース</th>
            <th class="th_name">保育園・幼稚園</th>
            <th class="th_name">氏名</th>
            <th class="th_title">受講済み</th>
        </tr>

        <tr class="tr_middle">
            <td class="text_date">2017/10/01 12:30</td>
            <td class="text_date">キッズコース</td>
            <td class="text_name">XX保育園</td>
            <td class="text_name">ミール　太郎</td>
            <td class="text_title">
                <div class="title_text">受講済み</div>
                <div class="title_btn_area">
                    <div class="title_delivery_btn">
                        <a href="/learning/answer?id=2">参照</a>
                    </div>
                </div>
            </td>
        </tr>

        <tr class="tr_bottom">
            <td class="text_date">&nbsp;</td>
            <td class="text_date">キッズコース</td>
            <td class="text_name">〇〇〇保育園</td>
            <td class="text_name">△△△　△△</td>
            <td class="text_title">
                <div class="title_text"></div>
                <div class="title_btn_area">
                    <div class="title_delivery_btn">
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</form>

@endsection