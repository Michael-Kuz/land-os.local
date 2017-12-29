window.onload = function(e){
	ESC_CONST = 27;
	INSERT = 45;
	var st = new Stack();
	var disp = new Dispatcher();
	
	//создаем класс, который будет работать с обьектом "таблица"
	//редактировать, сохранять и добавлять данные в таблицу
	function TableEditClass( obj_table ){
		this.table = obj_table;
		this.row;    //выбранная строка через кнопку radio
		this.row_tmpl; //строка - шаблон для вставки 
		this.inputs; //список редактируемых полей
		this.instruction; //save - сохранить строку, add - добавить(вставить) строку, delete - удалить строку
		this.class_row;
		this.class_cell;
		this.class_edit; //класс задающий стили для редактируемого элемента input
	}
	
	//этод метод выбирает строку через radio кнопку
	TableEditClass.prototype.setRow = function(event){
		if( !event ) return false;
		this.row = event.target.parentNode.parentNode;
		this.inputs = this.row.querySelectorAll("input");
		return this.row;
	}
	
	//этод метод удаляет выбранную строку с данными
	TableEditClass.prototype.del = function(){
		if( !this.row ) return false;
		this.row.parentNode.removeChild(this.row);
		this.row = null;
	}
	
	//этот метод инициализации имен классов стилей для строки, ячейки и элемента который редактируется
	TableEditClass.prototype.initClass = function( name_row_class, name_cell_class="", name_edit_class="" ){
		this.class_row = name_row_class;
		this.class_cell = name_cell_class;
		this.class_edit = name_edit_class;
		//инициализируем строку шаблон для вставки
		this.row_tmpl = this.table.querySelectorAll( this.class_row)[1];
		this.row_tmpl = this.row_tmpl.cloneNode(true);
		this.row_tmpl.setAttribute("data-save", "false");
		let radio = this.row_tmpl.querySelector("input[type='radio']");
		radio.addEventListener("change", changeEvent);
		let input = this.row_tmpl.querySelectorAll("input");
		for( let i=0; i< input.length; i++ ){
			if( input[i].name === "id")
				input[i].setAttribute("value", "");
		}
	}
	
	//этод метод подключает обработчик события на radio кнопку в новой вставленной строке
	TableEditClass.prototype.addChangeOnRadio = function(){
		this.row.querySelector("input[type='radio']").addEventListener("change", changeEvent);
	}
	
	//этот метод втавляет пустую строку в верхнюю часть таблицы
	TableEditClass.prototype.insert = function(){
		if( !this.row ){ //вставляем в начало таблицы если нет отмеченных строк
			this.row = this.row_tmpl.cloneNode(true);
			this.addChangeOnRadio();
			let input = this.row.querySelectorAll("input");
			for( let i=0; i< input.length; i++ ){
				if( input[i].name === "id")
					input[i].setAttribute("value", "");
			}
			this.table.insertBefore( this.row, this.table.children[1] );
		}else{
			this.save(function(){
				//сдесь надо доделать, когда строка не сохраняется
				let row_ins = et.row_tmpl.cloneNode(true);
				et.table.insertBefore(row_ins, et.row);
				et.noEdit.call(et);
				et.row = row_ins;
				et.edit.call(et);
				et.addChangeOnRadio.call(et);
			});
		}
	}
	
	//этот метод разрешает редактирование выбранной строки
	TableEditClass.prototype.edit = function(){
		if( !this.row ) return false;
		this.inputs = this.row.querySelectorAll("input");
		for( let i=0; i<this.inputs.length; i++ ){
			if( this.inputs[i].name === "radio"){
				this.inputs[i].checked = true;
			}else if( this.inputs[i].name !== "id" && this.inputs[i].name !== "radio" ){
				this.inputs[i].removeAttribute("disabled");
			}
			this.inputs[i].classList.add( this.class_edit.replace( /^\./,"" ) );
		}
	}
	
	//этод метод запрещает редактировать строку
	TableEditClass.prototype.noEdit = function(){
		if( !this.row ) return false;
		for( let i=0; i<this.inputs.length; i++ ){
			if( this.inputs[i].name == "radio" ){
				this.inputs[i].checked = false;
			}else{	
				this.inputs[i].setAttribute("disabled", "disabled");
			}
			this.inputs[i].classList.remove( this.class_edit.replace( /^\./,"" ) );
		}
		this.row = null;
		this.inputs = null;
	}
	
	//этот метод отменяет выделение строки для редактирования или вставку(добавление) новой строки
	TableEditClass.prototype.esc = function(){
		if( !this.row ) return false;
		if( this.row.getAttribute("data-save") === "false" ){
			this.del(); 
			this.row = null;
			this.inputs = null;
		}else if( this.row.getAttribute("data-save") === "true" ){
			let radio = this.row.querySelector("input[type='radio']");
			radio.checked = false;
		}
	}
	
	//этод метод устанавливает флаг сохранения строки data-save
	TableEditClass.prototype.setSave = function(){
		if( !this.row ) return false;
		this.row.setAttribute("data-save", "true");
	}
			
	/* вспомогательные функции ajax запроса */
	function funcB(){
		
	}
	function funcS(data,d){
		data = JSON.parse(data);
		$(".message p").text(data["text"]);
		$(".parent-message").css("display","flex");
	}
	
	//этод метод сохраняет активную активную строку
	TableEditClass.prototype.save = function( callBack = null ){
		if( !this.row ) return false;
		var form_data = {};
		for( let i=0; i<this.inputs.length; i++){
			form_data[this.inputs[i].name] = this.inputs[i].value;
		}	
		form_data["func"] = this.instruction;
		myAjax( form_data );
		
	/*вспомогательная функция выполняется после завершения запроса ajax*/
		function funcComplete(jqXHR, textStatus) {
			if (textStatus == 'success') {
				data = JSON.parse(jqXHR.responseText);
				if( data.func === "save" || data.func === "add" ){
					et.setSave.call(et);
					let id = et.row.querySelector("input[name='id']");
					if( id.value == "" )
						id.setAttribute("value", data.id);
					if( callBack ) 
						callBack();	
				}else if( data.func === "delete" ){
					et.del.call(et);
				}
			}
			if (textStatus == 'error') {
				
			}
		}
		
		//этод метод отправляет запрос Ajax на сервер
		function myAjax( form_data ){
			let qu = {"save":"Сохранить выделенную строку?", "add":"Сохранить выделенную строку?", "delete":"Удалить выделенную строку?" };
			if( confirm(qu[form_data.func]) ){
				$.ajax({
					url: "/adminmain/adminorders",
					data: (form_data),
					dataType: "html",
					type: "GET",
					beforSend: funcB(),
					success: funcS,
					complete: funcComplete
				});
			}
		}
	}
	
	//===============================================================================
	var table = document.querySelector(".admin-orders-table");
	if( table ){
		var et = new TableEditClass( table );
		et.initClass(".admin-orders-table-row", "", ".admin-order-edit" );
				
		//слушаем события от нажатия клавиш
		var keys = document.querySelector("body");
		keys.addEventListener("keydown", function(event){
			if( event.keyCode === INSERT){
				et.instruction = "save";
				et.insert.call(et);
				et.edit.call(et);
			}
			else if( event.keyCode === ESC_CONST ){
				et.esc.call(et);
				et.noEdit();
			}
		});	
		
		//слушаем событие  "submit"
		var save_order = document.querySelector(".admin-form-orders");
		save_order.addEventListener("submit", function(event){
			if( et.instruction === "save" ){
				et.save.call(et);
			}else if( et.instruction === "add" ){
				et.instruction = "save";
				et.insert.call(et);
				et.edit.call(et);
			}else if( et.instruction === "delete" ){
				et.save.call(et,function(){
					et.del.call(et);
				});
			}
		});
		
		//слушаем событие от нажатия кнопки submit
		let button = document.querySelectorAll("input[type='submit']");
		for( let i=0; i<button.length; i++ ){
			button[i].addEventListener("click", function(event){
				et.instruction = event.target.className;
			});
		}
		
		//слушаем события от изменения radio - кнопок
		let radio = table.querySelectorAll("input[type='radio']");
		for( let i=0; i<radio.length; i++ ){
			radio[i].addEventListener("change", changeEvent);
		}
		
		//функция обработки change на radio кнопке
		function changeEvent(event){
			et.esc.call(et);
			et.noEdit.call(et);
			et.setRow.call(et,event);
			et.edit.call(et);
		}
	}
}
