TEstado = function(){
	var self = this;
	
	this.add = function(id,	nombre, color, orden, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('?mod=cestados&action=add', {
				"id": id,
				"nombre": nombre,
				"color": color,
				"orden": orden
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.del = function(id, fn){
		$.post('?mod=cestados&action=del', {
			"id": id,
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				alert("Ocurrió un error al eliminar el estado");
			}
		}, "json");
	};
	
	this.addTipoUsuario = function(datos){
		if (datos.fn.before != undefined)
			datos.fn.before();
			
		$.post('cestados', {
			"id": datos.id,
			"tipo": datos.tipo,
			"action": "addTipo"
		}, function(data){
			if (datos.fn.after != undefined)
				datos.fn.after(data);
				
			if (data.band == false){
				console.log("Ocurrió un error al agregar");
			}
		}, "json");
	};
	
	this.delTipoUsuario = function(datos){
		if (datos.fn.before != undefined)
			datos.fn.before();
			
		$.post('cestados', {
			"id": datos.id,
			"tipo": datos.tipo,
			"action": "delTipo"
		}, function(data){
			if (datos.fn.after != undefined)
				datos.fn.after(data);
				
			if (data.band == false){
				console.log("Ocurrió un error al quitar");
			}
		}, "json");
	};
};