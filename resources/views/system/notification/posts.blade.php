<table class="common_tb inline_table">
    <tbody>
        <tr class="tr_top">
            <th class="th_date">日時</th>
            <th class="th_name">タイトル</th>
            <th class="th_name">ステータス</th>
            <th class="th_title">機能</th>
        </tr>
        
        <?php $index = 1;?>
        @if(count($notifications) > 0 )
            @foreach($notifications as $notification)
            <tr class="<?php echo ($index == count($notifications))? 'tr_bottom' : 'tr_middle';?>">       
                <td class="text_date">
                   {{ isset($notification->updated_at) && !empty($notification->updated_at) ? date('Y年n月j日 H:i', $notification->updated_at->timestamp) : ''}}
                </td>
                <td class="text_name">
                    <a href="{{ route('notification.detail', $notification->id) }}">{{ $notification->title }}</a>
                </td>
                <td class="text_name">
                	<?php echo ($notification->sent_status)? "送信済み" : "下書き";?>
                </td>
                <td class="text_contents">
                    <div class="title_delivery_btn send">
                	 	<?php if(\Auth::user()->member(2)) :?>
	                    	<?php if($notification->sent_status) :?>
	                    		<a class="disabled" href="#" onclick="return false;" disabled="disabled">編集</a>
	                    	<?php else :?>
	                    		<a href="{{ route('notification.edit', $notification->id) }}">編集</a>
	                    	<?php endif;?>
                    	<?php else :?>
                    		<a href="{{ route('notification.detail', $notification->id) }}">閲覧</a>
                    	<?php endif;?>
                    </div>
                </td>
            </tr>
            <?php $index++;?>
            @endforeach
        @endif
    </tbody>
 </table>


@if($notifications->total() > $limit)
<div class="pager_area notification_ajax_pager">
    <table width="100%">
        <tbody><tr>
            <td align="left">
                <div class="page_btn">
                    <a href="{{ $notifications->previousPageUrl() }}">前のページ</a>
                </div>
            </td>

            <td align="right">
                <div class="page_btn">
                    <a href="{{ $notifications->nextPageUrl() }}">次のページ</a>
                </div>
            </td>
        </tr>
    </tbody></table>
</div>
@endif

