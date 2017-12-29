<tr>
	<?php if( $input->label && $input->label_pos == "<td>" ){?>
		<td>
			<label for="<?=$input->name?>"><?=$input->label?></label>
		</td>
	<?php } ?>
	<td <?php if($input->colspan) { ?>colspan=<?=$input->colspan?><?php } ?> >
		<?php if( $input->label && $input->label_pos == "<p>" ){?>
			<p>
				<label for="<?=$input->name?>"><?=$input->label?></label>
			</p>
		<?php } ?>
		<select id="<?=$input->name?>" name="<?=$input->name?>" <?php if($input->multiple){ ?>multiple<?php } ?> size="<?=$input->size?>" <?php include "jsv.tpl"; ?>  >
			<?php $i=0; ?>
			<?php foreach( $input->options as $option  ){ ?>
				<option value="<?=$i?>" <?php if($input->value == "$i") { ?>selected="selected"<?php } ?> ><?=$option?></option>
				<?php $i++; ?>
			<?php } ?>
		</select>
	</td>
</tr>
