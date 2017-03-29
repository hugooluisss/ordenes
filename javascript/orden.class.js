TOrden = function(){
	var self = this;
	
	this.guardar = function(id,	estado, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"id": id,
				"estado": estado,
				"action": "guardar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.setEstadoMasivo = function(datos){
		if (datos.before !== undefined) datos.before();
		
		$.post('cordenes', {
				"identificadores": datos.identificadores,
				"estado": datos.estado,
				"action": "setEstadoMasivo"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (datos.after !== undefined)
					datos.after(data);
			}, "json");
	};
	
	this.importar = function(items, inicio, fin, razonsocial, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"items": items,
				"inicio": inicio,
				"fin": fin,
				"razonSocial": razonsocial,
				"action": "importar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
	
	this.importarAuto = function(items, razonsocial, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"items": items,
				"razonSocial": razonsocial,
				"action": "importarAuto"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
	
	this.eliminar = function(id, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cordenes', {
				"id": id,
				"action": "eliminar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
};