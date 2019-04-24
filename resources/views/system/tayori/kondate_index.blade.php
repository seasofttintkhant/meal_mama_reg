@push('custom_css')
    <style>
    .ui-datepicker-calendar {
        display: none;
        }
    </style>
@endpush

@extends('system.layouts.app')


@section('content')


<?php
	$current_page = $tayoris->currentPage();
	$current_page_count = $tayoris->count();
	$total_page = ceil($tayoris->total()/$limit);
	$next_page_url= $tayoris->nextPageUrl();
	$previous_page_url = $tayoris->previousPageUrl();
	$total_items = $tayoris->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $tayoris->url($tayoris->lastPage());
?>

<form>
    <table class="edy06_01_search">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_a">保育園・幼稚園</span>
                    <input type="text" class="input_field_a" name="kinder_name" value="{{ isset($_GET['kinder_name']) ? $_GET['kinder_name'] : '' }}">
                </td>
                <td>
                    <span class="form_title_c">タイトル</span>
                    <input type="text" class="input_field_c" name="title"  value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}">
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_a">配信状態</span>
                    <select name="status" id="status" class="input_field_a">
                            <option value="">選択してください</option>
                        @foreach(config('newsletter.statuses') as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>  
                </td>
                <td>
                    <span class="form_title_a">配膳月</span>
                    <input type="text" class="input_field_a datepicker" name="date"  value="{{ isset($_GET['date']) ? $_GET['date'] : '' }}" readonly>  
                        
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
	献立表
</span>
<span class="page_index">
	<?php if($total_items > 0) :?>
	    <?php if($total_items >= $start_index):?>
	    	<?php echo $total_items;?>件中<?php echo $start_index; ?>～<?php echo $end_index; ?>件目を表示中
	    <?php else:?>
	        <?php header('Location: '.$last_page_url); exit();?>
	    <?php endif;?>
    <?php endif;?>
</span>

<table class="common_tb clear_both">
    <tbody>
        <tr class="tr_top">
            <th class="th_date">配膳月</th>
            <th class="th_name">保育園・幼稚園</th>
            <th class="th_date">タイトル</th>
            <th class="th_date">献立区分</th>
            <th class="th_date">配信状態</th>
            @if(\Auth::user()->group == 2)
             <th class="th_option">機能</th>   
            @else
             <th class="th_option">機能</th>   
            @endif
            
        </tr>

   
            @foreach($tayoris as $tayori)
            <tr class="tr_middle">
                <td class="text_date">{{ $tayori->year }}年{{ $tayori->month }}月</td>
                <td class="text_date">{{ $tayori->getKinderName() }}</td>
                <td class="text_date">{{ $tayori->title }}</td>
                <td class="text_date">{{ $tayori->getMealTypeText() }}</td>
                <td class="text_name">
                        {{ isset($tayori->status) ? config('newsletter.statuses')[$tayori->status] :'' }}
                    </td>
                <td class="text_title">
                    <div class="title_btn_area">
                            @if(isset($tayori->pdf) && !empty($tayori->pdf))
                            <div class="title_edit_btn">
                                <a href="/meal_newsletter/pdf/{{ $tayori->year }}/{{ sprintf("%02d", $tayori->month) }}/{{  $tayori->pdf }}" target="_blank">閲覧</a>
                            </div>
                            @endif

                            @if($access)
                                @if($tayori->status==\App\Tayori::PUBLISHED)
                                <div class="title_edit_btn">
                                        <a class="disabled">編集</a>            
                                 </div>
                                @else
                                 <div class="title_edit_btn">
                                        <a href="{{ route('kondate.edit',[$tayori->kinder_id,$tayori->id])}}">編集</a>            
                                 </div>
                                @endif
            
            
                                @if($tayori->status==\App\Tayori::PUBLISHED)
                                    <form action="{{ route('kondate.cancel',$tayori->id)}}" id="kondate-cancel-{{$tayori->id}}" method="post">
                                        <input type="hidden" name="status" value="2">
                                        {{ csrf_field() }}
                                    </form>
                                    <div class="title_delivery_btn"> 
                                        <a href="" onclick="event.preventDefault();document.getElementById('kondate-cancel-{{$tayori->id}}').submit();">取消</a>
                                    </div>
                                @else
                                    <form action="{{ route('kondate.publish',$tayori->id)}}" id="kondate-publish-{{$tayori->id}}" method="post">
                                        <input type="hidden" name="status" value="1">
                                        {{ csrf_field() }}
                                    </form>
                                    <div class="title_delivery_btn"> 
                                        <a href="" onclick="event.preventDefault();document.getElementById('kondate-publish-{{$tayori->id}}').submit();">配信</a>
                                    </div>
                                @endif   
                             
                            @endif
                        </div>
                </td>
            </tr>
            @endforeach
        
    </tbody>
</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif
    
<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{ route('kondate.create',$kinder->id) }}">新規作成</a>  
    </div>
</div>

@endsection


@push('custom_js')
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy/mm',
                onClose: function(dateText, inst) {  
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val(); 
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val(); 
                        $.datepicker.setDefaults($.datepicker.regional['ja']);
                        $(this).val($.datepicker.formatDate('yy/mm', new Date(year, month, 1)));
                    }
            });
            
            <?php if(isset($_GET['status'])): ?>
                $('#status').val("<?php echo $_GET['status'] ?>");
            <?php endif; ?>
            } );
        </script>
@endpush