<div class="pager_area">
    <table width="100%">
        <tbody>
        	<tr>
	            <td align="left">
	            	<div class="page_btn">
	                	<?php if(isset($previous_page_url) && !empty($previous_page_url)):?>
	                    	<a href="{{ $previous_page_url }}">前のページ</a>
	                    <?php else :?>
	                    	<a href="#" class="paging-disabled">前のページ</a>
	                    <?php endif;?>
	                </div>
	            </td>
	            <td align="center" class="page_counter">
	                <form action="">
	                    <input name="page" value="<?php echo $current_page;?>">
	                    <?php foreach($_GET as $key => $value) :?>
	                    	<?php if($key != "page" && $key != "submit") :?>
	                    		<input type="hidden" name="<?php echo $key;?>" value="<?php echo $value;?>">
	                    	<?php endif;?>
	                    <?php endforeach;?>
	                    &nbsp; <b class="big_slash">/</b> &nbsp;<p><?php echo $total_page;?>ページ</p>
	                </form>
	            </td>
	             
	            <td align="right">
	                <div class="page_btn">
	                	<?php if(isset($next_page_url) && !empty($next_page_url)):?>
	                    	<a href="{{ $next_page_url }}">次のページ</a>
	                    <?php else :?>
	                    	<a href="#" class="paging-disabled">次のページ</a>
	                    <?php endif;?>
	                </div>
	            </td>
        	</tr>
    	</tbody>
    </table>
</div>