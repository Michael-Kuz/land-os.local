<div id="<?=$input->name?>">
	<input type="file" id="<?=$input->type.'_'.$input->name?>" name="<?=$input->name?>" <?php if ($check) { ?>onchange = "return checkFile(this)"<?php } ?> <?php include "jsv.tpl"; ?> />
</div>