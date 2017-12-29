$(document).ready( function(){
	/*формируем обьект диспетчера*/
	var disp = new Dispatcher();
	
	/*=== передача данных в форме обратного звонка через Ajax ===*/
	function funcB(){
		
	}
	function funcS(data,d){
		data = JSON.parse(data);
		if( data["send"] === true){
			$(".message p").text(data["text"]);
		}else if( data["send"] === false ){
			$(".message p").text(data["text"]);
		}else if( data["send"] === "redirect" ){
			location.href = data["text"];
			return;
		}
		$(".parent-message").css("display","flex");
	}
	/* обработка формы "ОСТАВИТЬ ЗАЯВКУ" через AJAX */
	$(".call-back, .form-popup, .form-bottom").bind("submit", function(event){
		var list = this.getElementsByTagName("input");
		var form_data = {};
		for( var i=0; i<list.length; i++){
			form_data[list[i].name] = $(list[i]).val();
		}
		$.ajax({
			url: "function.php",
			data: (form_data),
			dataType: "html",
			type: "GET",
			beforSend: funcB(),
			success: funcS
		});
		return false;
	});
	
	/*  передача данных в форме админ панели  */
	var admin = document.querySelector(".form-admin-auth");
	if( admin !== null ){
		admin.addEventListener("submit", ajaxAdminAuth);
		function ajaxAdminAuth(event){
			var cl = event.target.classList;
			//console.log(event.target.classList);
			var cl_sum = "";
			for( var i=0; i<cl.length; i++){
				cl_sum +="."+cl[i]+" ";
			}
			var data = [];
			var list = document.querySelectorAll(cl_sum+" input");
			var form_data = {};
			for( var i=0; i<list.length; i++){
				form_data[list[i].name] = $(list[i]).val();
			}
			data = [event.target.attributes.action.value, form_data];
			$.ajax({
				url: data[0],
				data: (data[1]),
				dataType: "html",
				type: "POST",
				beforSend: funcB(),
				success: funcS
			});
		}
	}
});