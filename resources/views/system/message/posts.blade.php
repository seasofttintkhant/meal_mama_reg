<table class="common_tb inline_table">
    <tbody>
        <tr class="tr_top">
            <th class="th_date">日時</th>
            <th class="th_name">投稿者</th>
            <th class="th_name">タイトル</th>
            <th class="th_name">ステータス</th>
            <th class="th_title">機能</th>
        </tr>
        
        <?php $index = 1;?>
        @if(count($messages) > 0 )
            @foreach($messages as $message)
            <tr class="<?php echo ($index == count($messages))? 'tr_bottom' : 'tr_middle';?>">       
                <td class="text_date">
                   {{ isset($message->updated_at) && !empty($message->updated_at) ? date('Y年n月j日 H:i', $message->updated_at->timestamp) : ''}}
                </td>
                <td class="text_name"><?php echo $message->getKinderName();?></td>
                <td class="text_name">
                    <a href="{{ route('message.detail', $message->message_id) }}">{{ $message->message_title }}</a>
                </td>
                <td class="text_name">
                	<?php echo ($message->message_sent)? "送信済み" : "下書き";?>
                </td>
                <td class="text_contents">
                    <div class="title_delivery_btn send">
                    	<?php if(\Auth::user()->member(0)) :?>
	                    	<?php if($message->message_sent) :?>
	                    		<a class="disabled" href="#" onclick="return false;" disabled="disabled">編集</a>
	                    	<?php else :?>
	                    		<a href="{{ route('message.edit', $message->message_id) }}">編集</a>
	                    	<?php endif;?>
                    	<?php else :?>
                    		<a href="{{ route('message.detail', $message->message_id) }}">閲覧</a>
                		<?php endif;?>
                    </div>
                </td>
            </tr>
            <?php $index++;?>
            @endforeach
        @endif
    </tbody>
 </table>


@if($messages->total() > $limit)
<div class="pager_area ajax_pager">
    <table width="100%">
        <tbody><tr>
            <td align="left">
                <div class="page_btn">
                    <a href="{{ $messages->previousPageUrl() }}">前のページ</a>
                </div>
            </td>

            <td align="right">
                <div class="page_btn">
                    <a href="{{ $messages->nextPageUrl() }}">次のページ</a>
                </div>
            </td>
        </tr>
    </tbody></table>
</div>
@endif

