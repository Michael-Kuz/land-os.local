/* этот класс - модель таблицы                                       */
/* модель представляет собой массив, который хранит состаяние модели */
	class ModelTable extends EventEmitter{
		constructor( state = [] ){	
			super();
			this.state = state;
			//this.load(); //load data from local storage if exist
		}
		
		/* этот метод возврыщает обьект состаяниия по id, в противном случае "undefind" */
		getItem(id){
			return this.state.find( item => item.id == id );
		}
		/* Этот метод добавляет новое состояние в массив состояни обьекта */
		addItem( item ){
			this.state.push( item );
		}
		/* Этот метод обновляет свойства состояния обьекта                             */
		/* где: id - номер обьекта свойство которого нужно обновить                    */
		/* data - массив новых свойств, которые нужно сохранить в свойствах обьекта    */ 
		updateItem( id, data ){
			const item = this.getItem( id );
			Object.keys(data).forEach( key => item[key] = data[key] );
		}
		/* Этот метод удаляет состояние обьекта по его id из массива состояний */
		removeItem( id ){
			let index; 
			this.state.forEach( function(item, i){ if(item.id == id) index = i; });
			if( index > -1 ){
				this.state.splice( index, index+1 );
				//this.state.splice( index, 1 );
			}
		}
		/*  Этод метод сохраняет данные в локальное хранилище */
		save(data){
			console.log(data);
			const string = JSON.stringify(data);
			//localStorage.setItem(data.id, string);
			/*  Этод метод отправляет и получает данные с сервера */
			
			fetch('http://land-os.ru/adminmain/adminorders', {  
				method: 'post',  
				headers: {  
				  "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"  
				},  
				body: 'func=update'  
			})
			.then(function (response) {
				return  response.json();
			})
			.then(function (data) {
				console.log('data', data);
			})
			.catch(function (error) {
				console.log('error', error);
			})
			
			/* var status = function (response) {
			  if (response.status !== 200) {
				return Promise.reject(new Error(response.statusText))
			  }
			  console.log(Promise.resolve(response));
			  return Promise.resolve(response)
			}
			var json = function (response) {
				 console.log(response.json());
				// alert(response.json());
			  return response.json()
			} */
			
			  /* .then(status)
			  .then(json)
			  .then(function (data) {
				alert(data);
				//console.log('data', data)
			  })
			  .catch(function (error) {
				console.log('error', error)
			  }) */
		}
		/*  Этод метод корректирует данные уже существующие в хранилице */
		update(data){
			const string = JSON.stringify(data);
			const exist = localStorage.getItem(data.id);
			if( exist )
				localStorage.setItem(data.id, string);
		}
		
		/*  Этод метод удаляет данные с диска */
		remove(data){
			const string = JSON.stringify(data);
			localStorage.removeItem(data.id, string);
		}
		/*  Этод метод загружает данные с диска */
		load(id = 0){
			if( !id ){
				if( !localStorage.length )
					return;
				for( let i=0; i<localStorage.length; i++ ){
					let key = localStorage.key(i);
					this.state.push( localStorage.getItem( key ) );
				}
			}else{
				const string = localStorage.getItem(id);
				const data = JSON.parse(string);
				return data;
			}
		}
		
	}
//export default Sector;