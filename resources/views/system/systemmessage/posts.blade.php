<table class="common_tb inline_table">
    <tbody>
        <tr class="tr_top">
		    <th class="th_date">送信日時</th>
		    <th class="th_name">送信者</th>
		    <th class="th_name">受信者</th>
		    <th class="th_name">タイトル</th>
		    <th class="th_title">機能</th>
		</tr>
		<?php $index = 1;?>
		@foreach($system_messages as $system_message)
		<?php
			$sender = $system_message->getSender();
			$receiver = $system_message->getReceiver();
		?>
	    <tr class="<?php echo ($index == count($system_messages))? 'tr_bottom' : 'tr_middle';?>">
		    <td class="text_date">{{ isset($system_message->sent_date) && !empty($system_message->sent_date) ? date('Y年n月j日 H:i',$system_message->sent_date) :'' }}</td>
		    <td class="text_name"><?php echo (isset($sender) && !empty($sender))? $sender->username : NULL;?></td>
		    <td class="text_name"><?php echo (isset($receiver) && !empty($receiver))? $receiver->username : NULL;?></td>
		    <td class="text_name">{{ $system_message->title }}</td>
		    <td class="text_contents">
		    	<?php if($system_message->canView()):?>
                <div class="title_delivery_btn send">
        			<a href="{{route('system.message.view',$system_message->id)}}">開く</a>
                </div>
                <?php endif;?>
            </td>
	    </tr>
	    <?php $index++;?>
		@endforeach
    </tbody>
 </table>


@if($system_messages->total() > $limit)
<div class="pager_area system_message_ajax_pager">
    <table width="100%">
        <tbody><tr>
            <td align="left">
                <div class="page_btn">
                    <a href="{{ $system_messages->previousPageUrl() }}">前のページ</a>
                </div>
            </td>

            <td align="right">
                <div class="page_btn">
                    <a href="{{ $system_messages->nextPageUrl() }}">次のページ</a>
                </div>
            </td>
        </tr>
    </tbody></table>
</div>
@endif

