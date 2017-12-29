Поступила заявка на новый заказ с сайта <?=Config::SITENAME?>

Номер заказа: <?=$order->number?> <br/>
Время и дата формирования заказа: <?=$order->date_order?> <br/>
ФИО: <?=$order->name?> <br/>
Телефон: <?=$order->phone?> <br/>
E-mail: <?=$order->email?> <br/>
Доставка: <?=$delivery?> <br/>
Адрес: <?=$order->address?> <br/>
Примечание: <?=$order->note?> <br/>

Состав продуктов в заказе:
<?php for( $i=0; $i<count( $content_cart->cart ) - 2; $i++ ) {?>
	<?=$i+1?>) <?=$content_cart->cart[$i]["title"]?> - кол. <?=$content_cart->cart[$i]["count"]?> шт. - цена за шт. <?=$content_cart->cart[$i]["price"]?> руб. - общая стоимость <?=$content_cart->cart[$i]["summa"]?> руб. <br/> 
<?php } ?>
Стоимость продуктов в заказе: <?=$order->summa?> руб. <br/>
Стоимость доставки: <?=$delivery_price?> руб. <br/>
<?php $in_total = $order->summa+$delivery_price ?>
Общая стоимость заказа: <?=$in_total?> руб. <br/>
Сообщение с сайта, <?=Config::SITENAME?>.