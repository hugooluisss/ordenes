TSucursal = function(){
	var self = this;
	
	this.add = function(id,	nombre, color, razonsocial, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('csucursales', {
				"id": id,
				"nombre": nombre,
				"color": color,
				"razonsocial": razonsocial,
				"action": "add"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('csucursales', {
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