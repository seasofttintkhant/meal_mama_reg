<?php foreach($data as $key => $value) :?>
<li class="chkbox">
    <label class="label-check">
        <input type="checkbox" value="<?php echo $key;?>">
        <span class="lever"><?php echo $value;?></span>
    </label>
</li>
<?php endforeach;?>