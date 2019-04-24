
@extends('system.layouts.app')

@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')

    <div class="top_row">   
        <span class="page_title">
            今日の献立
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
            <input type="submit" value="表示する" class="calendar-btn btn-red" >
            
       
        </form>
        @if($service && $publishable)
            @if($status== \App\Buono\Kondate1::PUBLISH_STATUS)
                <button href="#" class="calendar-btn btn-publish publish-status fl_right" data-status="{{$status}}">非公開にする</button>
            @elseif($status== \App\Buono\Kondate1::NOT_PUBLISH_STATUS)
                <button href="#" class="calendar-btn btn-publish publish-status fl_right" data-status="{{$status}}">公開する</button>
            @endif
            <img class="btn-loading" style="display:none" src="/img/common/loading.gif">
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


        $('.publish-status').click(function(e){
            e.preventDefault();
            $(this).hide();
            $('.btn-loading').show();
            
            var status =$(this).data('status');


            var not_publish_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> この月の献立を本当に非公開にしますか？"</p>' +'</div>';
            var publish_dialog='<div id="dialog-message" title="" style="display:none">' +'<p>  この月の献立を本当に公開しますか？</p>' +'</div>';
            var loading_dialog='<div id="dialog-message" title="処理中です..." style="display:none">' +'<p><img class="btn-loading" src="/img/common/loading.gif">  処理中です...</p>' +'</div>';
            var dialog = null;
            if(status === 0)
            {
                dialog = publish_dialog;
            }
            else if(status === 1)
            {
                dialog = not_publish_dialog;
            }

            $(dialog).dialog({
                modal: true,
                buttons: {
                    はい: function() {
                        $( this ).dialog( "close" );
                        callAjax(status);
                        $(loading_dialog).dialog();
                    },
                    いいえ: function() {
                        $( this ).dialog( "close" );
                       
                    },
                },
                close:function(){
                    $('.btn-loading').hide();
                    $('.publish-status').show();
                }
            });      

        });


        function callAjax(status)
        {

           var url='{{ route("kinder-menu.publish") }}';
            $.ajax({
                 headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data :{status:status},
            type : 'POST',
            url: url,
           }).done(function() {
                location.reload();
           }); 
        }
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