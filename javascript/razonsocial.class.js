TRazonSocial = function(){
	var self = this;
	
	this.updateRemote = function(datos){
		if (datos.fn.before !== undefined) fn.before();
		
		$.post('crazonsocial', {
				"id": datos.id,
				"isChecked": datos.isChecked,
				"action": "setUpdate"
			}, function(data){
				if (data.band == false)
					console.log(data.mensaje);
					
				if (datos.fn.after !== undefined)
					datos.fn.after(data);
			}, "json");
	};
};