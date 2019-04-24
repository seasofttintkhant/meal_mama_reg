@extends('system.layouts.app')


@section('content')


<form>
    <table class="edy06_01_search">
        <tbody><tr>
            <td nowrap="">
                <span class="form_title_d">受講コース</span>
                <input type="text" class="input_field_d" size="50">
                
                    <input type="submit" value="検索" class="submit_btn">
                
            </td>
        </tr>
        <tr>
            <td>
                <span class="form_title_a">&nbsp;</span>
                <div class="new_btn">
                    <a href="/learning/edit">新規作成</a>
                </div>
            </td>
        </tr>
    </tbody></table>


    <table class="common_tb">
    <tbody><tr class="tr_top">
        <th class="th_date" style="width: 835px;">コース</th>
    </tr>
    <tr class="tr_middle">
        <td class="text_title" style="width: 835px;">
            <div class="title_text">キッズコース</div>
            <div class="title_btn_area">
                <div class="title_edit_btn">
                    <a href="/learning/edit?id=1">編集</a>
                </div>

                <div class="title_delivery_btn">
                    <a href="/learning/ref?id=1">受講状況</a>
                </div>
            </div>
        </td>
    </tr>
    <tr class="tr_bottom">
        <td class="text_title" style="width: 835px;">
            <div class="title_text">アクティブシニアコース</div>
            <div class="title_btn_area">
                <div class="title_edit_btn">
                    <a href="/learning/edit?id=2">編集</a>
                </div>

                <div class="title_delivery_btn">
                    <a href="/learning/ref?id=2">受講状況</a>
                </div>
            </div>
        </td>
    </tr>
    </tbody></table>
    </form>

@endsection