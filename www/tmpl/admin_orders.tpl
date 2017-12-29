<div class="adminH1">
	<h1 class="adminH1_titel"><?=$title?></h1>
</div>

<div class="wrapper">
	<form class="admin-form-orders" name="admin_orders">
		<div class='admin-form-orders_btn'>
			<input class="admin-form-orders_btn-remove" type="submit" name="delete" value="Удалить">
			<input class="admin-form-orders_btn-add" type="submit" name="add" value="Добавить">
			<input class="admin-form-orders_btn-save" type="submit" name="admin_orders" value="Сохранить">
		</div>
	
		<div class="adminTable">
			<div class="adminTable_row">
				<div class="adminTable_cell adminTable_cell-checkbox">
				</div>
				<div class="adminTable_cell adminTable_cell-id">
					ID
				</div>
				<div class="adminTable_cell adminTable_cell-name">
					Имя
				</div>
				<div class="adminTable_cell adminTable_cell-price">
					Цена
				</div>
				<div class="adminTable_cell adminTable_cell-phone">
					Телефон
				</div>
				<div class="adminTable_cell adminTable_cell-email">
					Мэйл
				</div>
				<div class="adminTable_cell adminTable_cell-date">
					Дата
				</div>
				<div class="adminTable_cell adminTable_cell-date">
					Дата<br>подтв
				</div>
				<div class="adminTable_cell adminTable_cell-date">
					Дата<br>оплаты
				</div>
				<div class="adminTable_cell adminTable_cell-date">
					Дата<br>анулиров
				</div>
			</div>
			<?php foreach( $orders as $order) { ?>
				<div class="adminTable_row">
					<div class="adminTable_cell adminTable_cell-checkbox">
						<input  type="checkbox" name="checkbox">
					</div>
					<div class="adminTable_cell adminTable_cell-id">
						<input  type="number" name="id" value="<?=$order->id?>" disabled>
					</div>
					<div class="adminTable_cell adminTable_cell-name">
						<input  type="text" name="name" value="<?=$order->name?>" pattern="^[0-9a-zA-Zа-яА-ЯёЁ_ ]+$" title="Допустимы буквы и цифры" maxlength="100"  required disabled />
					</div>
					<div class="adminTable_cell adminTable_cell-price">
						<input  type="number" name="price" value="<?=$order->price?>" title="Десять цифр без пробелов" disabled />
					</div>
					<div class="adminTable_cell adminTable_cell-phone">
						<input  type="tel" name="phone" value="<?=$order->phone?>" title="Десять цифр без пробелов" pattern='[0-9]{10}' required disabled />
					</div>
					<div class="adminTable_cell adminTable_cell-email">
						<input  type="email" name="email"  value="<?=$order->email?>" pattern='^[a-z0-9_][a-z0-9\._-]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+$' disabled>
					</div>
					<div class="adminTable_cell adminTable_cell-date">
						<input  type="date" name="date_order" value="<?=$order->date_order?>" title="Введите дату в формате дд.мм.гггг время в формате чч:мм:сс" pattern='\d{2}\.\d{2}\.\d{4}(\s\d{2}:\d{2}:\d{2}){0,1}' required disabled />
					</div>
					<div class="adminTable_cell adminTable_cell-date">
						<input  type="date" name="date_confirm" value="<?=$order->date_confirm?>" disabled >
					</div>
					<div class="adminTable_cell adminTable_cell-date">
						<input  type="date" name="date_pay" value="<?=$order->date_pay?>" disabled >
					</div>
					<div class="adminTable_cell adminTable_cell-date">
						<input  type="date" name="date_cancel" value="<?=$order->date_cancel?>" disabled >
					</div>
				</div>
			<?php } ?>
		</div>
	</form>
</div>

<div class="popup">
	<div class="popup_message_window">
		<p class="popup_message_window-content"></p>
		<div class="popup_message_window-btn_ok">OK</div>
	</div>
</div>

<script type="text/javascript" src="js/helper.js"></script>
<script type="text/javascript" src="js/model_table.js"></script>
<script type="text/javascript" src="js/view_table.js"></script>
<script type="text/javascript" src="js/controller_admin.js"></script>
<script type="text/javascript" src="js/index_admin.js"></script>
		