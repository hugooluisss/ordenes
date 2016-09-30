TMovimiento = function(){
	var self = this;
	this.guardar = function(orden, clave, notas, fechaImpresion, envio, fechaHora, notasSucursales, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cmovimientos', {
				"orden": orden,
				"clave": clave,
				"notas": notas,
				"fechaImpresion": fechaImpresion,
				"envio": envio,
				"fechaHora": fechaHora,
				"notasSucursales": notasSucursales,
				"action": "guardar"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
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
};