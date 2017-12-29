function Stack(){
	this.stack_data = {};
}

Stack.prototype = {
	put: function ( name,  data){
		if( Array.isArray( data ) ){
			if( typeof this.stack_data[name] === "undefined" ){
				this.stack_data[name] = [];
			}
			for(  var i=0; i<data.length; i++ ){
				this.stack_data[name].push(data[i]);
			}
		}
		else{	
			this.stack_data[name] = data;
		}
	},
	get: function( name ){
		if( typeof this.stack_data[name] === "undefined" )
			return "undefined"; 
		else return this.stack_data[name];
	},
	del: function( name ){
		delete this.stack_data[name];
	}
}