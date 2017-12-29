<div class="request admin-input admin-form-margin">
	<div class="admin-input-padding">
		<h2 class="admin-input-h2"><?=$header?></h2>
		<form class="form-admin-auth" <?php if( $name ) { ?> name="<?=$name?>" <?php } ?> action = "<?=$action?>" onsubmit="return false" method="<?=$method?>" >
			<div class="form-table form-table-admin-height">
				<img src="<?=Config::DIR_IMG?>call_back_form_name.png" alt="" title="">
				<input type="text" name="login" maxlength="100" value="" pattern="^[0-9a-zA-Z_]+$" required />
				<img src="<?=Config::DIR_IMG?>img_pass.png" alt="" title="">
				<input type="password" name="password" pattern='^[0-9a-zA-Z]+$' value="" required />
				<input type="hidden" name="func" value="admin_auth" />
				<input type="hidden" name="message_name" value="<?=$message?>" />
				<label>Введите код с картинки:</label>
				<input type="text" name="captcha" value="" autocomplete="off" required />
				<div class="captcha">
					<img class="change" src="images/update.png" alt="Обновить" />
					<img class="canvas" src="captcha.php" alt="Капча" />
				</div>
			</div>
			<button class="button" name="admin_auth" type="submit" value = "ОТПРАВИТЬ" data-hover="Отправить" >Отправить</button>
		</form>
	</div>
</div>