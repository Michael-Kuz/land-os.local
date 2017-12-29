<div class="popup">
	<div class="popup_message_window">
		<p class="popup_message_window-content"></p>
		<div class="popup_message_window-btn_ok">OK</div>
	</div>
</div>
<div class="adminH1">
	<h1 class="adminH1_titel"><?=$title?></h1>
</div>

<form class="admin_form_statistics" name="admin_statistics" action="<?=$action?>" method="<?=$method?>" >
	<div>
		<label>From</label><input type="date" name="from" value="<?=$data_form['from']?>" >
		<label>To</label><input type="date" name="to" value="<?=$data_form['to']?>" >
	</div>
	<div>
		<label>Анимация</label><input type="text" name="split" value="<?=$data_form['split']?>" >
		<label>Тип формы</label><input type="text" name="func" value="<?=$data_form['func']?>" >
	</div>
	<div>
		<label>UTM-Source</label><input type="text" name="utm_source" value="<?=$data_form['utm_source']?>" >
		<label>UTM-Campaing</label><input type="text" name="utm_campaing" value="<?=$data_form['utm_campaing']?>" >
	</div>
	<div>
		<label>UTM-Content</label><input type="text" name="utm_content" value="<?=$data_form['utm_content']?>" >
		<label>UTM-Term</label><input type="text" name="utm_term" value="<?=$data_form['utm_term']?>" >
	</div>
	<div>
		<label>ref</label><input type="text" name="ref" value="<?=$data_form['ref']?>" >
		<label>Date</label><input type="date" name="date" value="<?=$data_form['date']?>" >
	</div>
	<div>
		<label>И</label><input type="radio" name="log" value="AND" <?php if($data_form["log"] === "AND") { ?> checked <?php } ?> >
		<label>ИЛИ</label><input type="radio" name="log" value="OR" <?php if($data_form["log"] === "OR") { ?> checked <?php } ?> >
	</div>
	<input type="submit" name="admin_statistics" value="ОТПРАВИТЬ ЗАПРОС" >
</form>

<div class="wrapper">
	<div class="adminTable">
		<div class="adminTable_row">
			<div class="adminTable_cell adminTable_cell-stat">
				Общее<br>количество заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Число<br>обработанных заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Число<br>оплаченных заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Число<br>анулированных заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумм<br>заявок<br>(руб.)
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма<br>обработанных заявок <br>(руб.)
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма<br>оплаченных заявок <br>(руб.)
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма<br>анулированных заявок <br>(руб.)
			</div>
		</div>
		
		<div class="adminTable_row">
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$total_orders?>		
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$confirm_orders?>		
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$paid_orders?>		
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$cancel_orders?>		
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$total_summ?>
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$confirm_sum?>
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$paid_sum?>
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				<?=$cancel_sum?>
			</div>
		</div>
	</div>
</div>
