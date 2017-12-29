$(document).ready(function(){
	
				/*--- отслеживаем координаты положения фоновой картинки в header ---*/
				const H_UP = 0.18135; //длинна в процентах от верха картинки до начала поля заголовка
				const H1_HEIGHT_PER = 0.170099; //отношение высоты заголовка к высоте картинки
				const H1_WIDTH_PER = 0.98844;   //отношение длинны заголовка к длинне картинки
				const IMG_PROPORTIONS = 0.83671; //пропорции картинки height/width
				var img = document.querySelector('.pic-header-1');
				var h1 = document.querySelector("#h1");
				locationH1();
				window.addEventListener("resize", locationH1 );
				function locationH1(){
					if( img == null ) return;
					var width_img = img.getBoundingClientRect().right-img.getBoundingClientRect().left;
					var height_img = IMG_PROPORTIONS * width_img;
					let x = img.getBoundingClientRect().left.toString();
					let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
					let y = img.getBoundingClientRect().top + scrollTop + height_img * H_UP;
					h1.style.left = x+"px";
					h1.style.top = y+"px";
					h1.style.height = height_img * H1_HEIGHT_PER+"px";
					h1.style.width = width_img * H1_WIDTH_PER+"px";
				}
				
				/*--- добавляем id для всех .item-hover ---*/
				$('.item-hover').each(function(i,elem) {
					if( $(this).attr("id") == undefined )
						$(this).attr("id", "hover-"+i );
				});

				/*--- обработка событий принаведении курсора на пиктограммы ---*/
				var item_blocks=[".item-advnt",".item-steps",".item-effic"];
				var hover;
				$(".circle-icon").on("mouseover", function(){
					hover = $(this).parent();
					for( var i=0; i<item_blocks.length; i++){
						if( $(this).closest( item_blocks[i] ).length == 1 && i==1 ){
							$( "#"+ $(hover).attr("id") ).css("background", "rgba(107,185,180,1)" );
							$( "#"+ $(hover).attr("id") ).css("box-shadow", "rgba(0,0,0,.5) 3px 3px 8px, rgba(43,214,231,.9) -3px -3px 8px");
						}else if( $(this).closest( item_blocks[i] ).length == 1 && i==2 ){
							$( "#"+ $(hover).attr("id") ).css("background", "rgba(205,175,36,1)" );
							$( "#"+ $(hover).attr("id") ).css("box-shadow", "rgba(0,0,0,.5) 3px 3px 8px, rgba(241,206,42,.9) -3px -3px 8px");
						}
					}
					$( "#"+$(hover).attr("id") ).animate({opacity: "1.0"},100);
				});
				$(".item-hover").on("mouseleave", function(){
					$( "#"+$(hover).attr("id") ).animate({opacity: "0.0"},100);
				});
							
				/*--- слайдер с работами ---*/
				var gep = 300;
				var el_width = 220;
				var l_betwin = 80;
				var frames = getFrames();
				var count = $(".slider-win ul>li").length;
				var i_left = 0;
				var offset = 0;
				var steps = count - frames;
				var i_right = steps;
				$(window).resize( function(){
					setTimeout('window.location.reload()', 0);
				});
				function getFrames(){
					var mult = 0;
					var slider_width = $("body").css("width");
					var str = slider_width.substr( 0,slider_width.length-2 );
					if( str > 870)
						return 3;
					else if( str <= 870 && str > 550 )
						return 2;
					else if( str <= 570 )
						return 1;
				}
				$(".arrow-left").bind("click", function slaider(){
					if( i_left < steps ){
						var slide = $(".slider-win").children("ul");
						offset -= gep; 
						$(slide).animate({left: offset+"px"},100);
						i_left++; i_right--;
						if( i_right < steps ){
							$(".arrow-right").css({"cursor":"pointer", "opacity":"1.0"});
						}
						if( i_left >= steps ){
							$(".arrow-left").css({"cursor":"auto", "opacity":"0.3"});
						}
					}
				});
				$(".arrow-right").bind("click", function slaider(){
					if( i_right < steps ){
						var slide = $(".slider-win").children("ul");
						offset += gep;
						$(slide).animate({left: offset+"px"},100);
						i_left--; i_right++;
						if( i_left < steps ){
							$(".arrow-left").css({"cursor":"pointer", "opacity":"1.0"});
						}
						if( i_right >= steps ){
							$(".arrow-right").css({"cursor":"auto", "opacity":"0.3"});
						}
					}
				});
				/*--- включение окна popup с заявкой ---*/
				$("#popup, .button-1").bind("click", function popup(){
					$(".parent-popup").fadeIn(200);
					$(".parent-popup").css("display", "flex");
					$("#popup").addClass("active");
					return false;
				});
				/*--- выключение окна popup с заявкой ---*/
				$(".close-popup").bind("click", function popout(){
					$(".parent-popup").fadeOut(200);
					$("#popup").removeClass("active");
				});
				/*--- плавная прокрутка страницы до заданного якоря ---*/
				$('a[href^="#"]').click(function(){
					var target = $(this).attr('href'); //Сохраняем значение атрибута href в переменной:
					$('html, body').animate({scrollTop: $(target).offset().top}, 0);
					return false;
				});
				/*=== смена изображения в каптче ===*/
				$(".captcha img:first-child").bind("click", function chengeCaptcha(event) {
					var captcha = $(".captcha img:last-child");
					var src = $(captcha).attr("src");
					if ((i = src.indexOf("?")) == -1) src += "?" + Math.random();
					else src = src.substring(0, i) + "?" + Math.random();
					$(captcha).attr("src", src);
				});
				/*=== загрузка увеличенной картинки из раздела работы и цены ===*/
				$(".icon-work img").click( function(){
					var src = $(this).attr("data-img");
					$(".fancy-box-background img:nth-child(2)").attr("src",src);
					$(".fancy-box-parent").fadeIn(200);
				});
				/*--- выключение окна  fancy-box-parent ---*/
				$(".fancy-box-background .close-popup").bind("click", function(){
					$(".fancy-box-parent").fadeOut(200);
				});
				/*--- выключение окна с сообщением ---*/
				$(".ok-button").on("click", function(){
					$(".parent-message").fadeOut(200);
				});
				/*--- Проверка видимости элементв в окне браузера и их анимация ---*/
				//ini_animation(); запускается в index.tpl
				$(document.body).on('appear', '.animate', function(e, $affected) {
					console.log(e, '//', $affected);
					$(this).addClass("appeared");
				});
				$('.animate').appear({force_process: true});
});
/*--- инициализация для элементов для анимации ---*/
function ini_animation(){
	$(".wow").each(function(i,elem){
		$(this).addClass("animate");
	});
}
