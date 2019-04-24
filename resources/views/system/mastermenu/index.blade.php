
@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')

    <div class="top_row">   
        <span class="page_title">
            マスター献立
        </span>  
        <form action="" class="calendar-search-form">
            <input type="text" name="y" size="4" class="form-input-calendar" value="<?php echo isset($year) ? $year:'' ?>">&nbsp;年
            <input type="text" name="m" size="2" class="form-input-calendar" value="<?php echo isset($month) ? $month:'' ?>">&nbsp;月
            <select name="timezone" class="form-input-calendar" id="timezone">
                @foreach($timezones as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            <select name="meal_type" class="form-input-calendar" id="meal_type">
                @foreach($meal_types as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            <input type="submit" value="表示する" class="calendar-btn btn-red">
        </form>
    </div>
    
    <div class="clear_both"></div>

    <div class="km-cal-table-responsive">
        <table class="calendar_table">
            <tr>
                <th class="th_day"><span>日曜日</span></th>
                <th class="th_day"><span>月曜日</span></th>
                <th class="th_day"><span>火曜日</span></th>
                <th class="th_day"><span>水曜日</span></th>
                <th class="th_day"><span>木曜日</span></th>
                <th class="th_day"><span>金曜日</span></th>
                <th class="th_day"><span>土曜日</span></th>
            </tr>

            @foreach($weeks as $week)
                {!! $week !!}
            @endforeach
        </table>
    </div>

<div id="how-to-cook-dialog" title="" style="display:none">
</div>

<div id="video-dialog" title="" style="display:none">
	<p>
    	<iframe class="menu-embed-responsive-item" src=""></iframe>
  	</p>
</div>


@endsection

@push('custom_js')

<script type="text/javascript">
    $(document).ready(function(){
        @if(isset($timezone_id) && !empty($timezone_id))
            $('#timezone').val({{$timezone_id}});
        @endif

        @if(isset($category_id) && !empty($category_id))
            $('#meal_type').val({{$category_id}});
        @endif
    });
</script>

<script type="text/javascript">
		
	function openHowToCook(data)
	{
		var content = "";
		myStringArray = data.split("@_@");
		for (var i = 0; i < myStringArray.length; i++) {
			content += "<p>" + (i+1) + ". " +myStringArray[i] + "</p>\r\n";
		}
		$("#how-to-cook-dialog").html(content);
	 	$( "#how-to-cook-dialog" ).dialog({
      		modal: true,
      		title: '作り方',
	    });
	    return false;
    }
    
    function openVideo(data)
    {
    	$("#video-dialog").find('iframe').attr('src', data);
	 	$( "#video-dialog" ).dialog({
      		modal: true,
      		title: 'ビデオ',
      		width: 560,
      		height: 349,
	    });
	    return false;
    }
    
		
</script>

@endpush