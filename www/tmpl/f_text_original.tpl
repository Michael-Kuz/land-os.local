<div id="<?=$input->name?>">
	<label for="<?=$input->name?>"><?=$input->label?></label>
	<input type="text" name="<?=$input->name?>" value="<?=$input->value?>" placeholder="<?=$input->default_v?>" <?php include "jsv.tpl"; ?> />
</div>