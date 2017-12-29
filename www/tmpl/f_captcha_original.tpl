<div id="<?=$input->name?>">
	<label for="<?=$input->name?>">Введите код с картинки:</label>
	<input type="text" name="<?=$input->name?>"  <?php include "jsv.tpl"; ?> />
</div>
<div class="captcha">
	<img src="/images/update.png" alt="Обновить" />
	<img src="../captcha.php" alt="Капча" />
</div>