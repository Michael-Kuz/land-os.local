$(document).ready(function(){
	/*--- Проверка видимости элементв в окне браузера и их анимация ---*/
	$(document.body).on('appear', '.animate', function(e, $affected) {
		$(this).addClass("appeared");
	});
	$('.animate').appear({force_process: true});
});