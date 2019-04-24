@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

<?php
  $limit = $kinderregistrationlogs->perPage();
	$current_page = $kinderregistrationlogs->currentPage();
	$current_page_count = $kinderregistrationlogs->count();
	$total_page = ceil($kinderregistrationlogs->total()/$limit);
	$next_page_url= $kinderregistrationlogs->nextPageUrl();
	$previous_page_url = $kinderregistrationlogs->previousPageUrl();
	$total_items = $kinderregistrationlogs->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
  $last_page_url = $kinderregistrationlogs->url($kinderregistrationlogs->lastPage());
  
?>

@section('content')
<form action="{{route('kinder_registration_log')}}" id="kinder-search">
  <table class="eds03_01_search reg_form">
    <tbody>
      <tr>
        <td>
            <span class="form_title_a">幼稚園・保育園 名称</span>
            <input type="text" class="input_field_a" name="name" value="{{ isset($_GET['name']) ? $_GET['name'] : ''}}">
        </td>
        <td>
            <span class="form_title_b">担当者名</span>
            <input type="text" class="input_field_b" name="contact_name" value="{{ isset($_GET['contact_name']) ? $_GET['contact_name'] : ''}}">
        </td>
      </tr>
      <tr>
        <td>
            <span class="form_title_a">都道府県</span>
            <input type="text" class="input_field_a" name="prefecture" value="{{ isset($_GET['prefecture']) ? $_GET['prefecture'] : ''}}">
        </td>
        <td>
            <span class="form_title_b">電話番号</span>
            <input type="text" class="input_field_b" name="phone" value="{{ isset($_GET['phone']) ? $_GET['phone'] : ''}}">
        </td>
      </tr>
      <tr>
        <td>
            <span class="form_title_c">メールアドレス</span>
            <input type="text" class="input_field_c" name="email" value="{{ isset($_GET['email']) ? $_GET['email'] : ''}}">
        </td>
      </tr>
      <tr>
        <td colspan="2">
            <span class="form_title_a">登録申請結果通知日</span>
            <input type="text" class="input_field_a datepicker" name="from" value="{{ isset($_GET['from']) ? $_GET['from'] :'' }}" readonly>
        </td>
        <td>
            <span class="form_title_b">～</span>
            <input type="text" class="input_field_b datepicker" name="to" value="{{ isset($_GET['to']) ? $_GET['to'] :'' }}" readonly>
        </td>
      </tr>
      <tr>
        <td>
            <input type="submit" value="検索" class="submit_btn">
            &nbsp;&nbsp;
            <input id="reset-btn" type="button" value="クリア" class="submit_btn">
        </td>
      </tr>
    </tbody>
  </table>
</form>

<span class="page_title">
  園ユーザー登録申請履歴
</span>
<br>

<div class="row">
  <div class="col col-right">
    <table class="common_tb clear_both inline_table auto_width bold_table">
      <tbody>
        <tr class="tr_top">
          <th class="th_name">幼稚園・保育園 名称</th>
          <th class="th_city">担当者名</th>
          <th class="th_city">都道府県</th>
          <th class="th_city">電話番号</th>
          <th class="th_email">メールアドレス</th>
          <th class="th_email">ステータス</th>
          <th class="th_email">登録申請結果通知日時</th>
        </tr>
        
          @foreach($kinderregistrationlogs as $kinderregistrationlog)
            <tr class="tr_middle">
              <td class="td_border">{{ $kinderregistrationlog->name}}</td>
              <td class="td_border">{{$kinderregistrationlog->contact_name}}</td>
              <td class="td_border">{{$kinderregistrationlog->prefecture}}</td>
              <td class="td_border">{{$kinderregistrationlog->phone}}</td>
              <td class="td_border">{{$kinderregistrationlog->email}}</td>
              <td class="td_border">{{$kinderregistrationlog->status == 1 ? '承認' : '却下'}}</td>
              <td class="td_border">{{isset($kinderregistrationlog->created_at) && !empty($kinderregistrationlog->created_at) ? date('Y-m-d H:i:s',$kinderregistrationlog->created_at->timestamp) : "" }}</td>
            </tr>
          @endforeach
      </tbody>
    </table>

    @if($total_items > $limit)
      @include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
    @endif
  </div>
</div>
@endsection

@push('custom_js')
    <script type="text/javascript">
        $( function() {
        	
            $(".datepicker").datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
      });
		    
    </script>
@endpush
