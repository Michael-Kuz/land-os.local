<div <?php if ($name) { ?>id="<?=$name?>"<?php } ?>>
	<?php if ($header) { ?>
		<p><?=$header?></p>
	<?php } ?>
	<?php if (isset($hornav)) { ?>
		<?=$hornav?>
	<?php } ?>
	<div class="form">
		<?php if($message) { ?><p class="message"><?=$message?></p><?php } ?>
		<form <?php if ($name) { ?>name="<?=$name?>"<?php } ?> action="<?=$action?>" method="<?=$method?>" <?php if ($check) { ?>onsubmit="return checkForm(this)"<?php } ?> <?php if ($enctype) { ?>enctype="<?=$enctype?>"<?php } ?>>
			<table>
				<?php foreach ($inputs as $input) { ?>
					<?php include "f_".$input->type.".tpl"; ?>
				<?php } ?>
			</table>
		</form>
	</div>
</div>
<?php if (isset($hornav)) { ?><div></div><?php } ?>

	