TOrden = function(){
	var self = this;
	
	this.importar = function(items, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"items": items,
				"action": "importar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
};