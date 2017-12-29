<div class="popup">
	<div class="popup_message_window">
		<p class="popup_message_window-content"></p>
		<div class="popup_message_window-btn_ok">OK</div>
	</div>
</div>
<div class="adminH1">
	<h1 class="adminH1_titel"><?=$title?></h1>
</div>
	
<div class="wrapper">
	<div class="adminTable">
		<div class="adminTable_row">
			<div class="adminTable_cell adminTable_cell-stat">
				Общее количество заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Число обработанных заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Число оплаченных заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Число анулированных заявок
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма заявок<br>(руб.)
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма обработанных заявок <br>(руб.)
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма оплаченных заявок <br>(руб.)
			</div>
			<div class="adminTable_cell adminTable_cell-stat">
				Общая сумма анулированных заявок <br>(руб.)
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

		