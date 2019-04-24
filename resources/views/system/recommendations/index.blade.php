
@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')

    <div class="top_row">   
        <span class="page_title">
            今日のおすすめ
        </span>  
        <form action="" class="calendar-search-form">
            <input type="text" name="y" size="4" class="form-input-calendar" value="<?php echo isset($year) ? $year:'' ?>">&nbsp;年
            <input type="text" name="m" size="2" class="form-input-calendar" value="<?php echo isset($month) ? $month:'' ?>">&nbsp;月
            <input type="submit" value="表示する" class="calendar-btn btn-red">
        </form>
        
        @if($assign)
        <button href="#" class="calendar-btn btn-publish assign-dishes fl_right" ">おすすめ自動設定</button>
        <img class="btn-loading" style="display:none" src="/img/common/loading.gif">
        @else
        <button href="#" class="calendar-btn btn-publish assign-disabled fl_right">おすすめ自動設定</button>
        @endif

  
    </div>
 
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

<div id="how-to-cook-dialog" title="" style="display:none">
</div>

<div id="video-dialog" title="" style="display:none">
	<p>
    	<iframe class="menu-embed-responsive-item" src=""></iframe>
  	</p>
</div>

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

<script>
    $(document).ready(function(){
        $('.assign-dishes').click(function(){
            var dialog='<div id="dialog-message" title="" style="display:none">' +'<p>  この月の献立を本当に公開しますか？</p>' +'</div>';
            var loading_dialog='<div id="dialog-message" title="処理中です..." style="display:none">' +'<p><img class="btn-loading" src="/img/common/loading.gif">  処理中です...</p>' +'</div>';
            $(dialog).dialog({
                modal: true,
                buttons: {
                    はい: function() {
                        $( this ).dialog( "close" );
                        callAjax();
                        $(loading_dialog).dialog();
                    },
                    いいえ: function() {
                        $( this ).dialog( "close" );
                    },
                }
            }); 
            

            function callAjax()
            {
                  var url='{{ route("recommendation.assigndishes") }}';
                $(this).hide();
                $('.btn-loading').show();
                $.ajax({
                     headers: {
                     'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type : 'POST',
                url: url,
               }).done(function(data) {
                    location.reload();
               }); 
            }
        });
    });
</script>

@endsection
