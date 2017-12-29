<div id="<?=$input->name?>">
	<label for="<?=$input->name?>"><?=$input->label?></label>
	<textarea name="<?=$input->name?>" placeholder="<?=$input->default_v?>" <?php if($input->cols) { ?>cols="<?=$input->cols?>"<?php } ?> <?php if($input->rows) { ?>rows="<?=$input->rows?>"<?php } ?> <?php include "jsv.tpl"; ?> ><?=$input->value?></textarea>
</div>