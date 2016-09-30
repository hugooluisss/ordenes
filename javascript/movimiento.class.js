TMovimiento = function(){
	var self = this;

	this.guardar = function(orden, clave, impresionDigital, disenador, fechaImpresion, notasProduccion, claveImpresion, fechaEnvio, horaEnvio, fechaRecepcion, entregaCliente, notas, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cmovimientos', {
				"orden": orden,
				"clave": clave,
				"impresionDigital": impresionDigital, 
				"disenador": disenador, 
				"fechaImpresion": fechaImpresion, 
				"notasProduccion": notasProduccion, 
				"claveImpresion": claveImpresion, 
				"fechaEnvio": fechaEnvio, 
				"horaEnvio": horaEnvio, 
				"fechaRecepcion": fechaRecepcion, 
				"entregaCliente": entregaCliente, 
				"notas": notas,
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