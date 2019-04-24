@extends('system.layouts.app')


@section('content')


<table class="common_tb inline_table">
    <tbody>
        <tr class="tr_top">
            <th class="th_date">身長(cm)</th>
            <th class="th_name">体重(kg)</th>
            <th class="th_date">測定日</th>
            <th class="th_address">機能</th>
        </tr>
    @if(count($logs) > 0 )
        @foreach($logs as $log)
        <tr class="tr_middle">
            <td class="text_name">{{ $log->decimalFomart($log->height) }}</td>
            <td class="text_name">{{ $log->decimalFomart($log->weight) }}</td>
            <td class="text_name">
                <div class="address_text">{{ date('Y年n月j日', strtotime($log->date)) }}</div>
            </td>
            <td class="text_address">
                <div class="address_edit_btn">
                    <a href="{{ route('kid.hw_edit',[$log->kid_id,$log->id])}}">編集</a>
                </div>
                <form action="{{ route('kid.hw_delete',[$log->kid_id,$log->id])}}" id="log-delete-{{ $log->id}}" method="post">
                        {{ csrf_field( )}}
                        {{ method_field('DELETE') }}
                </form>
                <div class="address_delete_btn">
                    <a href="#" data-id="{{ $log->id }}">削除</a>
                </div>
            </td>    
        </tr>   
        @endforeach
    @endif
    </tbody>
</table>
@if($logs->total() > $log_limit)
<div class="pager_area">
    <table width="100%">
        <tbody>
            <tr>
                <td align="left">
                    <div class="page_btn">
                        <a href="{{ $logs->previousPageUrl() }}">前のページ</a>
                    </div>
                </td>

                <td align="right">
                    <div class="page_btn">
                        <a href="{{ $logs->nextPageUrl() }}">次のページ</a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endif
<div id="dialog-message" title="" style="display:none">
	<p>
    	この測定結果を本当に削除してもよろしいですか？
  	</p>
</div>
<script type="text/javascript">
	$(document).ready(function(){
            $(".address_delete_btn a").click(function(e){
            
            e.preventDefault();
            var id = $(this).data("id");
            
            $( "#dialog-message" ).dialog({
                modal: true,
                buttons: {
                    はい: function() {
                        $('#log-delete-'+id).submit();
                    },
                    いいえ: function() {
                        $( this ).dialog( "close" );
                    },
                }
            });
        });
	});
</script>

@endsection

