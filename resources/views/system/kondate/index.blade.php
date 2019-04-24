@extends('system.layouts.app')


@section('content')

<form>
    <table class="edy10_02_search eds_05_01">
        <tbody><tr>
            <td>
                <span class="form_title">日付</span>
                <ul>
                    <li class="chkbox">
                        <label class="label-check">
                            <input type="checkbox" value="日付の指定を行う">
                            <span class="lever">日付の指定を行う</span>
                        </label>
                    </li>
                </ul>
                <input type="date" class="input_field_a">
                <span class="tilde">~</span>
                <input type="date" class="input_field_a">
            </td>
            <td>
                <span class="form_title_a">検索キーワード</span>
                <ul>
                    <li>料理名(呼出名)</li>
                    <li>食材名(呼出名)</li>
                    <li class="chkbox">
                        <label class="label-check">
                            <input type="checkbox" value="もしくは">
                            <span class="lever">もしくは</span>
                        </label>
                    </li>
                    <li class="chkbox">
                        <label class="label-check">
                            <input type="checkbox" value="除外">
                            <span class="lever">除外</span>
                        </label>
                    </li>
                </ul>
                <ul>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                </ul>
                <ul>
                    <li><span>&amp;</span></li>
                    <li><span>&amp;</span></li>
                    <li><span>&amp;</span></li>
                    <li><span>と</span></li>
                </ul>
                <ul>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                </ul>
                <ul>
                    <li><span>&amp;</span></li>
                    <li><span>&amp;</span></li>
                    <li><span>&amp;</span></li>
                    <li><span>と</span></li>
                </ul>
                <ul>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                    <li><input class="input_field_e"></li>
                </ul>
            </td>
            <td>
                <span class="form_title_a">施設</span>
                <select id="shisetsus-select" name="pref" class="input_field_c">
                    <option value="" selected="">選択してください</option>
                    <?php foreach($shisetsus as $key => $value) :?>
                    	<option value="<?php echo $key;?>"><?php echo $value;?></option>
                    <?php endforeach;?>
                </select>
            </td>
        </tr><tr>
        </tr>
    </tbody></table>

    <table class="eds_05_01_02">
        <tbody><tr>
            <td>
                <span class="form_title_a">献立種類</span>
                <ul>
                    <li>
                        <ul id="category-data">
                        </ul>
                    </li>
                </ul>
            </td>
            <td class="td_time">
                <span class="form_title_a">時間帯</span>
                <ul id="timezone-data" class="ul_02">
                </ul>
            </td>
            
            <td class="td_method">
                <span class="form_title_a bunruis">分類</span>
                <ul class="ul_02 bunruis">
                    <?php foreach($bunruis as $key => $value) :?>
                        <li class="chkbox">
                            <label class="label-check">
                                <input type="checkbox" value="<?php echo $key;?>">
                                <span class="lever"><?php echo $value;?></span>
                            </label>
                        </li>
                    <?php endforeach;?>  
                </ul>
            </td>
            
            <td class="td_time">
                <span class="form_title_a">動画</span>
                <ul class="ul_02">
                    <li class="chkbox">
                        <label class="label-check">
                            <input type="checkbox" value="有り">
                            <span class="lever">有り</span>
                        </label>
                    </li>
                </ul>
            </td>
            <td class="td_time">
                <span class="form_title_a">ジャンル</span>
                <ul class="ul_02">
                    <li class="chkbox">
                        <label class="label-check">
                            <input type="checkbox" value="和食">
                            <span class="lever">和食</span>
                        </label>
                    </li>
                </ul>
            </td>
            <td class="td_method">
                <span class="form_title_a">調理方法</span>
                <ul>
                    <li>
                        <ul class="ul_02">
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="揚げる">
                                    <span class="lever">揚げる</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="炒める">
                                    <span class="lever">炒める</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="焼く">
                                    <span class="lever">焼く</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="煮る">
                                    <span class="lever">煮る</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="蒸す">
                                    <span class="lever">蒸す</span>
                                </label>
                            </li>
                        </ul>
                        <ul class="ul_02">
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="和える">
                                    <span class="lever">和える</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="その他">
                                    <span class="lever">その他</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="その他">
                                    <span class="lever">その他</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                </ul>
            </td>
            <td class="td_method">
                <span class="form_title_a">旬の食材月</span>
                <ul>
                    <li>
                        <ul class="ul_02">
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="1月">
                                    <span class="lever">1月&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="2月">
                                    <span class="lever">2月&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="3月">
                                    <span class="lever">3月&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="4月">
                                    <span class="lever">4月&nbsp;&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="5月">
                                    <span class="lever">5月&nbsp;&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="6月">
                                    <span class="lever">6月</span>
                                </label>
                            </li>
                        </ul>
                        <ul class="ul_02">
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="7月">
                                    <span class="lever">7月&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="8月">
                                    <span class="lever">8月&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="9月">
                                    <span class="lever">9月&nbsp;</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="10月">
                                    <span class="lever">10月</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="11月">
                                    <span class="lever">11月</span>
                                </label>
                            </li>
                            <li class="chkbox">
                                <label class="label-check">
                                    <input type="checkbox" value="12月">
                                    <span class="lever">12月</span>
                                </label>
                            </li>
                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
    </tbody></table>

    <table class="edy10_02_search eds_05_01">
        <tbody><tr>
            <td>
                <span class="form_title_a">価格</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">円</span>
            </td>
            <td>
                <span class="form_title_a">エネルギー</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">kcal</span>
            </td>
            <td>
                <span class="form_title_a">たんぱく質</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">g</span>
            </td>
            <td>
                <span class="form_title_a">脂質</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">g</span>
            </td>
            <td>
                <span class="form_title_a">ナトリウム</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">カルシウム</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">マグネシウム</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">鉄</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">レチ当量</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">μg</span>
            </td>
            <td>
                <span class="form_title_a">VB1</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">VB2</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">VC</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">mg</span>
            </td>
            <td>
                <span class="form_title_a">食物繊維</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">g</span>
            </td>
            <td>
                <span class="form_title_a">食塩相当量</span>
                <input class="input_field_a">
                <span class="tilde">~</span>
                <input class="input_field_a">
                <span class="number">g</span>
            </td>
        </tr>
    </tbody></table>
</form>

<div class="edy10_02_btn_area">
    <div class="registration_btn">
        <a href="{{route('buono.kondate.search')}}">検索</a>
    </div>
    <div class="delete_btn">
        <a href="{{route('buono.kondate')}}">クリア</a>
    </div>
</div>


<div id="dialog-message" title="" style="display:none">
        <p>
            献立管理機能は有償オプションとなります。機能の詳細に関しましてはご遠慮なくお問い合わせください。
          </p>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
        
        $('#dialog-message').dialog({
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
	

		$('#shisetsus-select').on('change', function() {
	  		
	  		$.ajax({
		  		type: 'POST',
		      	url: "<?php echo route('buono.kondate.category');?>",
		      	data: { shisetsu_id : this.value },
		      	dataType: "json",
		      	success: function(resultData) { $("#category-data").html(resultData.data); }
			});
			
			$.ajax({
		  		type: 'POST',
		      	url: "<?php echo route('buono.kondate.timezone');?>",
		      	data: { shisetsu_id : this.value },
		      	dataType: "json",
		      	success: function(resultData) { $("#timezone-data").html(resultData.data); }
			});
		});
	});
</script>

@endsection