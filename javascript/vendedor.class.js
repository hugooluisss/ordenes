TVendedor = function(){
	var self = this;
	
	this.add = function(id,	clave, nombre, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cvendedores', {
				"id": id,
				"nombre": nombre,
				"clave": clave,
				"action": "add"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('cvendedores', {
			"id": id,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				alert("Ocurrió un error al eliminar");
			}
		}, "json");
	};
};