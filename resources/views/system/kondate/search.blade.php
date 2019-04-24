@extends('system.layouts.app')


@section('content')


<table class="common_tb">
    <tbody>
    <tr class="tr_top">
        <th class="th_date">年月日</th>
        <th class="th_name">献立種類</th>
        <th class="th_name">時間帯</th>
        <th class="th_address">献立</th>
        <th class="th_name">&nbsp;</th>
    </tr>

    <tr class="tr_middle">
        <td class="text_date">2017/10/02</td>
        <td class="text_name">ミールケア幼保基本献立</td>
        <td class="text_name">朝おやつ</td>
        <td class="text_name">
            <div class="address_text">
                人参煮　麦茶
            </div>
        </td>
        <td class="text_name">
            <div class="address_post_btn">
                <a href="/kondate/list">詳細</a>
            </div>
        </td>
    </tr>

    <tr class="tr_middle">
        <td class="text_date">2017/10/02</td>
        <td class="text_name">ミールケア幼保基本献立</td>
        <td class="text_name">昼食</td>
        <td class="text_name">
            <div class="address_text">
                ご飯　味噌汁　さばの煮付け　きのことじゃが芋のソテー　オレンジ　麦茶
            </div>
        </td>
        <td class="text_name">
            <div class="address_post_btn">
                <a href="/kondate/list">詳細</a>
            </div>
        </td>
    </tr>

    <tr class="tr_bottom">
        <td class="text_date">2017/10/02</td>
        <td class="text_name">ミールケア幼保基本献立</td>
        <td class="text_name">午後おやつ</td>
        <td class="text_name">
            <div class="address_text">
                ホットケーキ　牛乳
            </div>
        </td>
        <td class="text_name">
            <div class="address_post_btn">
                <a href="/kondate/detail">詳細</a>
            </div>
        </td>
    </tr>
    </tbody>
</table>

@endsection