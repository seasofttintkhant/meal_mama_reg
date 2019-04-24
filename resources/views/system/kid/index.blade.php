@extends('system.layouts.app')

@section('content')

<?php
	$current_page = $kids->currentPage();
	$current_page_count = $kids->count();
	$total_page = ceil($kids->total()/$limit);
	$next_page_url= $kids->nextPageUrl();
	$previous_page_url = $kids->previousPageUrl();
	$total_items = $kids->total();
	$start_index = ($current_page-1)*$limit+1;
	$end_index = ($start_index-1) + $current_page_count;
	$last_page_url = $kids->url($kids->lastPage());
?>

<form>
    <table class="edy06_01_search">
        <tbody>
        	
    	<tr>
            <td>
                <span class="form_title_a">園児コード</span>
                <input type="text" class="input_field_a" name="code" value="{{ isset($_GET['code']) ? $_GET['code'] :''}}">
            </td>

            <td>
                <span class="form_title_a">クラス名</span>
                <input type="text" class="input_field_a" name="classname" value="{{ isset($_GET['classname']) ? $_GET['classname'] : ''}}">
            </td>
        </tr>
		
        <tr>
            <td>
                <span class="form_title_a">お名前</span>
                <input type="text" class="input_field_a" name="name" value="{{ isset($_GET['name']) ? $_GET['name'] :'' }}">
            </td>

            <td>
                <span class="form_title_a">ニックネーム</span>
                <input type="text" class="input_field_a" name="nickname" value="{{ isset($_GET['nickname']) ? $_GET['nickname'] :'' }}">
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <span class="form_title_a">生年月日</span>
                <input type="text" class="input_field_a datepicker" name="birthday_1" value="{{ isset($_GET['birthday_1']) ? $_GET['birthday_1'] :'' }}" readonly>
                <span class="mglr">～</span>
                <input type="text" class="input_field_a datepicker" name="birthday_2" value="{{ isset($_GET['birthday_2']) ? $_GET['birthday_2'] :'' }}" readonly>
            </td>
        </tr>

        <tr>
            <td class="td_method">
            <span class="form_title_a extend_width">アレルギー</span>
            <ul class="ul_02">
                <?php
                    $allergies_data = ['えび', 'かに', '小麦', 'そば', '卵', '乳', '小麦', '落花生', 'あわび', 'いか', 'いくら', 'オレンジ', 'カシューナッツ', 'キウイフルーツ', '牛肉', 'くるみ', 'ごま', 'さけ', 'さば', '大豆', '鶏肉', 'バナナ', '豚肉', 'まつたけ', 'もも', 'やまいも', 'りんご', 'ゼラチン',];
                
                foreach($allergies_data as $key => $allergie):?>
                <li class="chkbox">
                    <label class="label-check">
                        <input type="checkbox" name="{{ 'allergie_'.($key+1), isset($allergies['allergie_'.($key+1)]) ? $allergies['allergie_'.($key+1)] : 0 }}" {{ isset($_GET['allergie_'.($key+1)]) && $_GET['allergie_'.($key+1)]== "on" ? 'checked' : ''}} >
                        <span class="lever"><?php echo $allergie;?>&nbsp;</span>
                    </label>
                </li>
                <?php endforeach;?> 
                <br/>
                <label class="label-check">
                    <span class="lever">その他&nbsp;</span><input type="text" class="input_field_a kid_other" size="30" name="other" value="{{ isset($_GET['other']) ? $_GET['other'] : ''}}">
                </label>
            </ul>
          
        </td>
    </tr>

        <tr>
            <td>
                <input type="submit" value="検索" class="submit_btn">
                &nbsp;&nbsp;
                <input id="reset-btn" type="button" value="クリア" class="submit_btn">
            </td>
        </tr>
    </tbody></table>
</form>

<!-- Import CSV -->
<form id="import-form" method="post" enctype="multipart/form-data" action="{{ route('kid.import', $kinder_id)}}">
	{{ csrf_field() }}
	<input type="hidden" name="class_json" id="class_json">
    <table class="edy06_02_search">
        <tbody>
            <tr>
                <td>
                    <span class="form_title_custom">園児情報インポート（CSV形式）</span>
                    <input type="text" id="import_file_name" class="input_field_a" readonly>
                    <div class="reference_btn">
            		参照
                        {!! Form::file('import_file', ['id'=>'import_file']) !!}
                    </div>
                  
                    <div class="custom_btn">
                        <a id="import_file_clear">削除</a>
                    </div>
                    
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="eds02_01_btn_area">
	    <div class="post_btn">
	        <a href="#" id="csv-save">保存する</a>
	    </div>
	</div>
</form>

<span class="page_title">
	園児
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

<table class="common_tb clear_both inline_table">
    <tbody>
    	<tr class="tr_top">
	        <th class="th_date">園児コード</th>
	        <th class="th_date">園連携コード</th>
	        <th class="th_name">お名前</th>
	        <th class="th_name">ニックネーム</th>
	        <th class="th_name">生年月日</th>
	        <th class="th_option_2">&nbsp;</th>
    	</tr>
    	@if(count($kids)> 0 )
        @foreach($kids as $kid)
        <tr class="tr_middle">
            <td class="text_date">{{ $kid->code }}</td>
            <td class="text_date">{{ $kid->link_code }}</td>
            <td class="text_name">{{ $kid->name }}</td>
            <td class="text_name">{{ $kid->nickname}}</td>
            <td class="text_name">{{ isset($kid->birthday) && !empty($kid->birthday) ? date('Y年n月j日', strtotime($kid->birthday)) : '' }}</td>
            <td class="text_title">
                <div class="title_btn_area">
                    <div class="title_edit_btn">
                        <a href="{{ route('kid.hw',$kid->id)}}">身長・体重</a>
                    </div>
                    <div class="title_edit_btn">
                        <a href="{{ route('kid.edit',[$kinder_id,$kid->id])}}">編集</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    	@endif
	</tbody>
</table>

@if($total_items > $limit)
	@include('system.layouts.paging', ['previous_page_url' => $previous_page_url, 'next_page_url' => $next_page_url, 'current_page' => $current_page, 'total_page' => $total_page])
@endif

<div class="eds02_01_btn_area">
    <div class="post_btn">
        <a href="{{route('kid.create',$kinder_id)}}">新規作成</a>
    </div>
</div>

<div id="dialog-message-paid" title="" style="display:none">
        <p>
            献立管理機能は有償オプションとなります。機能の詳細に関しましてはご遠慮なくお問い合わせください。
          </p>
    </div>

@push('custom_js')
    <script type="text/javascript">
        $( function() {
        	
            $(".datepicker").datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
		    
		    $('#import_file').change(function(e) {
		        var fileName = e.target.files[0].name;
		        $('#import_file_name').val(fileName);
		        
		    });
		
		    $("#import_file_clear").click(function () {
		        $("#import_file").val("");
		        $("#import_file_name").val("");
		    });
		    
        } );
        
        $(document).ready(function(){
        	$("#csv-save").click(function(e){
	            e.preventDefault();
	            var save_dialog='<div id="dialog-message" title="" style="display:none">' +'<p> 保存しますか？</p>' +'</div>';
	            var loading_dialog='<div id="dialog-message" title="処理中です..." style="display:none">' +'<p><img class="btn-loading" src="/img/common/loading.gif">  処理中です...</p>' +'</div>';
	            var returned_data;
	
	            var formdata = new FormData($('#import-form')); 
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


            $('#dialog-message-paid').dialog({
                  modal: true,
                  close: function(){
                    window.history.back();
                  },
                  buttons: {
                    はい: function() {
                        window.history.back();
                    },
                  }
            });
	    
	        function ajax_data(formdata)
	        {
	            formdata.append('csv_file', $("#import_file")[0].files[0]);
	            var url='{{ route("kid.import.check", $kinder_id) }}';
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
	            });
	
	        }
	  
	       	function process_data(data){       
				for (var i = 0; i < data.classes.length; i++) {
					
            		data.classes[i]['register'] = false;
            		data.classes[i]['cancel'] = false;
            		
	                if(data.classes[i]['check_flag'] === true)
	                {
	                    str = 'Do you want to register this class ' + data.classes[i]['name'] + '?' ;
	                    if(confirm(str) == true)
	                    {
	                        data.classes[i]['register'] = true;
	                    }
	                    else
	                    {
	                    	data.classes[i]['cancel'] = true;
	                    }
	                }
	            }
	
	            var dataString=JSON.stringify(data);
	
             	$('#class_json').val(dataString);
             	$('#import-form').submit();
       		}
        });
        
    </script>
@endpush

@endsection