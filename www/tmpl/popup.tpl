<div class="parent-popup">
	<div class="popup">
		<div class="request main-popup">
			<form class="form-popup" <?php if( $form_name ) { ?> name="<?=$form_name?>" <?php } ?> action="<?=$action?>" method="<?=$method?>" >
				<div class="form-table form-table-add">
					<div class="close-popup">
						<img src="images/but_close.png" alt="Закрыть">
					</div>
					<h3>Заполните форму<br>и я свяжусь с Вами!</h3>
					<img src="<?=Config::DIR_IMG?>call_back_form_name.png" alt="" title=""><input type="text" name="name" maxlength="100" value="<?=$name?>" pattern="^[0-9a-zA-Zа-яА-ЯёЁ_ ]+$" title="Допустимы буквы и цифры" maxlength="100" required />
					<img src="<?=Config::DIR_IMG?>call_back_form_phone.png" alt="" title=""><input type="tel" name="phone" title="Десять цифр без пробелов" pattern='[0-9]{10}' value="<?=$phone?>" required />
					<img src="<?=Config::DIR_IMG?>call_back_form_email.png" alt="" title=""><input type="email" name="email"  pattern='^[a-z0-9_][a-z0-9\._-]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+$' value="<?=$email?>" />
					<input type="hidden" name="func" value="landing_order" />
					<label>Введите код с картинки:</label>
					<input type="text" name="captcha" value="" autocomplete="off" required />
					<div class="captcha">
						<img class="change" src="images/update.png" alt="Обновить" />
						<img class="canvas" src="captcha.php" alt="Капча" />
					</div>
				</div>
				<button class="button-bot" name="call_back" type="submit" value = "ОТПРАВИТЬ" data-hover="Отправить">Отправить</button>
			</form>
		</div>
	</div>
</div>
<div class="parent-message">
	<div class="message">
		<p class="result"></p>
		<div class="ok-button">OK</div>
	</div>
</div>