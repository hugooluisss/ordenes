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
};