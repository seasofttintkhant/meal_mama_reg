@push('custom_css')
<link rel="stylesheet" href="{{ asset('css/edy_10_02_tsuika.css') }}" media="all">
@endpush
    <input type="hidden" class="p-country-name" value="Japan">
    @if(isset($kinder_id) && !empty($kinder_id))
    {{ Form::hidden('kinder_id', $kinder_id) }}
    @else
    {{ Form::hidden('kinder_id') }}
    @endif
    <table class="edy10_02_search">
        <tbody>
            <tr>
            @if($edit)
            <td>
                <span class="form_title_a">コード</span>
                {!! Form::text('code',null,['class'=>'input_field_a','readonly'=>'readonly']) !!}
            </td>
            @endif
            <td>
                <span class="form_title_a">お名前（＊）</span>
                {!! Form::text('name',null,['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">ニックネーム</span>
                {!! Form::text('nickname',null,['class'=>'input_field_a']) !!}
            </td>

            <td>
                <span class="form_title_a">生年月日（＊）</span>
                 {!! Form::text('birthday',isset($kid->birthday) && !empty($kid->birthday) ? date('Y/m/d', strtotime($kid->birthday)) : '' ,['class'=>'input_field_a','id'=>'datepicker','readonly'=>'readonly']) !!}
            </td>
            <td>
                <span class="form_text_example">記入例：2017年7月7日の場合 → 2017/07/07と入力</span>
            </td>
            <td>
                <span class="form_title_a">性別（＊）</span>
                男{{ Form::radio('gender', 1,  (isset($kid->gender) && $kid->gender== 1  ? true : false),['class'=>'radio_man'])  }} 
                女{{ Form::radio('gender', 2, (isset($kid->gender) && $kid->gender== 2  ? true : false),['class'=>'radio_woman'])  }} 


            </td>
            <td>
                <span class="form_title_a">郵便番号（＊）</span>
                {!! Form::text('zipcode',null,['class'=>'input_field_a p-postal-code','size'=>8]) !!}
            </td>
            <td>
                <span class="form_title_a">都道府県（＊）</span>
                {!! Form::select('prefecture', config('prefectures') , null, ['class'=>'input_field_c p-region','placeholder' => '選択してください']) !!}
            </td>
            <td>
                <span class="form_title_a">市区町村〜番地（＊）</span>
                {!! Form::text('city',null,['class'=>'input_field_b p-locality p-street-address p-extended-address']) !!}
            </td>
            <td>
                <span class="form_title_a">マンション名等</span>
                {!! Form::text('building',null,['class'=>'input_field_b']) !!}
            </td>
            <td>
                <span class="form_title_a">電話番号</span>
                {!! Form::tel('phone',null,['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">FAX番号</span>
                {!! Form::tel('fax',null,['class'=>'input_field_a']) !!}
            </td>
            <td>
                <span class="form_title_a">メールアドレス</span>
                {!! Form::email('email',null,['class'=>'input_field_b']) !!}
            </td>
            <td>
                <span class="form_title_a">備考</span>
                {!! Form::textarea('remark',null, ['size' => '30x5','class'=>'input_field_d'])!!}
            </td>
            <td>
                <span class="form_title_a">クラス名</span>
                {!! Form::select('classroom', $classes, null, ['class'=>'input_field_c','placeholder' => '選択してください']) !!}
            </td>
            
            @if(isset($menus) && !empty($menus))
            <td>
                <span class="form_title_a">献立種類</span>
                {!! Form::select('menu_type', $menus, null, ['class'=>'input_field_c','placeholder' => '選択してください']) !!}
            </td>
            @endif
			
			<td class="td_method">
                <span class="form_title_a">アレルギー</span>
                <ul class="ul_02">
                    <?php
                        $allergies_data = ['えび', 'かに', '小麦', 'そば', '卵', '乳', '落花生', 'あわび', 'いか', 'いくら', 'オレンジ', 'カシューナッツ', 'キウイフルーツ', '牛肉', 'くるみ', 'ごま', 'さけ', 'さば', '大豆', '鶏肉', 'バナナ', '豚肉', 'まつたけ', 'もも', 'やまいも', 'りんご', 'ゼラチン',];
                    
                    foreach($allergies_data as $key => $allergie):?>
                    <li class="chkbox">
                        <label class="label-check">
                            {{ Form::checkbox('allergie_'.($key+1), isset($allergies['allergie_'.($key+1)]) ? $allergies['allergie_'.($key+1)] : 0, isset($allergies['allergie_'.($key+1)]) && $allergies['allergie_'.($key+1)]== 1 ? true : false)}}
                            <span class="lever"><?php echo $allergie;?>&nbsp;</span>
                        </label>
                    </li>
                    <?php endforeach;?> 
                </ul>
            </td>
			
            <td>
                <span class="form_title_a">その他</span>
                {!! Form::text('other',null,['class'=>'input_field_a']) !!}
            </td>
            {{--  <td class="search_10_02">
                <span class="form_title_a">検索</span>
                    <input type="search" name="search" placeholder="キーワードを入力" class="input_field_a">
                    <input type="submit" name="submit" value="検索" class="submit_btn">
            </td>
            <td>
                <span class="form_title_a"></span>
                <div class="table-scroll">
                    <table class="common_tb03">
                        <tbody><tr class="tr_top">
                            <th class="th_01"></th>
                            <th class="th_02"></th>
                            <th class="th_03">えび</th>
                            <th class="th_03">かに</th>
                            <th class="th_03">小麦</th>
                            <th class="th_03">そば</th>
                            <th class="th_03">卵</th>
                            <th class="th_03">乳</th>
                            <th class="th_03">小麦</th>
                            <th class="th_03">落花生</th>
                            <th class="th_03">あわび</th>
                            <th class="th_03">いか</th>
                            <th class="th_03">いくら</th>
                            <th class="th_03">オレンジ</th>
                            <th class="th_03">カシューナッツ</th>
                            <th class="th_03">キウイフルーツ</th>
                            <th class="th_03">牛肉</th>
                            <th class="th_03">くるみ</th>
                            <th class="th_03">ごま</th>
                            <th class="th_03">さけ</th>
                            <th class="th_03">さば</th>
                            <th class="th_03">大豆</th>
                            <th class="th_03">鶏肉</th>
                            <th class="th_03">バナナ</th>
                            <th class="th_03">豚肉</th>
                            <th class="th_03">まつたけ</th>
                            <th class="th_03">もも</th>
                            <th class="th_03">やまいも</th>
                            <th class="th_03">りんご</th>
                            <th class="th_03">ゼラチン</th>
                        </tr>
                        <tr class="tr_middle">
                            <td class="td_01"><a href="" class="add_btn">追加</a></td>
                            <td class="td_02">白米</td>
                            <td class="td_03">●</td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                            <td class="td_03"></td>
                        </tr>
                    </tbody></table>
                </div>
            </td>  --}}
        </tr>
    </tbody>
</table>



@push('custom_js')
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <script>
        $( function() {
        	$( "#datepicker" ).datepicker({
	      		changeMonth: true,
	      		changeYear: true,
	      		yearRange: "-100:+0",
		    });
        } );
        </script>
@endpush