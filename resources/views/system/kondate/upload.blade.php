@extends('system.layouts.app')

@push('custom_css')
	<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush

@section('content')
<?php
    $current_page = $logs->currentPage();
    $current_page_count = $logs->count();
    $total_page = ceil($logs->total()/$limit);
    $next_page_url= $logs->nextPageUrl();
    $previous_page_url = $logs->previousPageUrl();
    $total_items = $logs->total();
    $start_index = ($current_page-1)*$limit+1;
    $end_index = ($start_index-1) + $current_page_count;
    $last_page_url = $logs->url($logs->lastPage());
?>
@include('common.errors')
<div class="top_row">
     <span class="page_title">献立情報CSVファイルアップロード</span> 
</div>
<div class="clear_both"></div>

<form id="create-form" method="post" enctype="multipart/form-data" action="">
    <input type="hidden" name="kondate_json" id="kondate_json">
    <table class="edy06_02_search csv_upload">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_custom"> 献立情報（kondate_x_x.csv）</span>
                    <input type="text" id="kondate_name" class="input_field_a" readonly>
                    <div class="reference_btn">                
			    	参照
                    	{!! Form::file('kondate_file',['id'=>'kondate_file']) !!}
                    </div>
                    <div class="custom_btn">
                        <a id="kondate_clear">削除</a>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_custom">料理情報（ryouri_x_x.csv）</span>
                    
                    <input type="text" id="ryori_name" class="input_field_a" readonly>
                    <div class="reference_btn">
            		参照
                        {!! Form::file('ryori_file',['id'=>'ryori_file']) !!}
                    </div>
                    <div class="custom_btn">
                        <a id="ryori_clear">削除</a>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <span class="form_title_custom">食品情報（shokuhin_x_x.csv）</span>
                    <input type="text" id="syokuhin_name" class="input_field_a" readonly>
                    <div class="reference_btn">
            		参照
                        {!! Form::file('syokuhin_file',['id'=>'syokuhin_file']) !!}
                    </div>
                  
                    <div class="custom_btn">
                        <a id="syokuhin_clear">削除</a>
                    </div>
                    
                </td>
            </tr>
        </tbody>
    </table>
    
</form>


<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="" id="csv-save">保存する</a>
    </div>
</div>

 
 
<span class="page_index">
    <?php if($total_items > 0) :?>
        <?php if($total_items >= $start_index):?>
            <?php echo $total_items;?>件中<?php echo $start_index; ?>～<?php echo $end_index; ?>件目を表示中
        <?php else:?>
            <?php header('Location: '.$last_page_url); exit();?>
        <?php endif;?>
    <?php endif;?>
</span>
<table class="common_tb clear_both inline_table">
    <tbody><tr class="tr_top">
        <th class="th_name">ファイル名</th>
        <th class="th_name">アップロード日時</th>
        <th class="th_name">処理結果</th>
        <th class="th_name">データ年月</th>
        <th class="th_name">データ件数</th>
    </tr>
    <?php foreach($logs as $log) :?>
    <tr class="tr_middle">
        <td class="text_name"><?php echo $log->file_name;?></td>
        <td class="text_name"><?php echo $log->created_at->format('Y/m/d H:i:s');?></td>
        <td class="text_name"><?php echo ($log->status == 1)? "成功" : "失敗";?></td>
        <td class="text_name"><?php echo $log->month;?></td>
        <td class="text_name"><?php echo $log->success_count."/".($log->success_count + $log->failure_count)?></td>
    </tr>
    <?php endforeach;?>
</tbody>
</table>
 @if($total_items > $limit)
    @include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif
@endsection

@push('custom_js')
<script>
    $('#kondate_file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#kondate_name').val(fileName);
        
    });

    $('#ryori_file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#ryori_name').val(fileName);
    });

    $('#syokuhin_file').change(function(e) {
        var fileName = e.target.files[0].name;
        $('#syokuhin_name').val(fileName);
    });

    $("#kondate_clear").click(function () {
        $("#kondate_file").val("");
        $("#kondate_name").val("");
    });

	$("#ryori_clear").click(function () {
        $("#ryori_file").val("");
        $("#ryori_name").val("");
    });
    
    $("#syokuhin_clear").click(function () {
        $("#syokuhin_file").val("");
        $("#syokuhin_name").val("");
    });
    
</script>
@endpush

@push('custom_js')
<script>

  
    $(document).ready(function(){
        $("#csv-save").click(function(e){
            e.preventDefault();
            var save_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> 保存しますか？</p>' +'</div>';
            var loading_dialog='<div id="dialog-message" title="処理中です..." style="display:none">' +'<p><img class="btn-loading" src="/img/common/loading.gif">  処理中です...</p>' +'</div>';
            var returned_data;

            var formdata = new FormData($('#create-form')); 
            $(save_dialog).dialog({
                modal: true,
                buttons: {
                    はい: function() {
                        $( this ).dialog( "close" );
                        $(loading_dialog).dialog();
                        ajax_data(formdata);
                        
                       
                    },
                    いいえ: function() {
                        $( this ).dialog( "close" );
                    },
                }
            });
        });
    
        function ajax_data(formdata)
        {
            formdata.append('csv_file', $("#kondate_file")[0].files[0]);
            var url='{{ route("buono.kondate.ajax_check") }}';
            $.ajax({
                 headers: {
                 'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            processData: false,
            contentType: false,
            dataType: "json",
            type : 'POST',
            data : formdata,
            url: url,
            }).done(function(res){
                if(res.status === 'fail')
                {
                    alert('不正なCSVファイルです。');
                    location.reload();
                }
                else if(res.status==='nofile')
                {
                    alert('CSVファイルをアップロードしてください。');
                    location.reload();
                }
                else{
                    process_data(res.data);
                }
            }
            );

        }
  
       function process_data(data){       
            for (var i = 0; i < data.timezone.length; i++) {
                 
                if(data.timezone[i]['check_flag'] === true)
                {
                    str = 'Do you want to update the timezone '+ data.timezone[i]['current_name']  +' with name ' + data.timezone[i]['name1'] ;
                    if(confirm(str) === false)
                    {
                        data.timezone.splice(i, 1);
                    }
                }
            }

             for (var i = 0; i < data.mealtype.length; i++) {
                 
                if(data.mealtype[i]['check_flag'] === true)
                {
                    str = 'Do you want to update the mealtype '+ data.mealtype[i]['current_name']  +' with name ' + data.mealtype[i]['name1'] ;
                    if(confirm(str) === false)
                    {
                        data.mealtype.splice(i, 1);
                    }
                }
            }
            
            var dataString=JSON.stringify(data);

             $('#kondate_json').val(dataString);
             $('#create-form').submit();
       }

    
      
    });
</script>
@endpush