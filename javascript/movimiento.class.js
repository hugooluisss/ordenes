TMovimiento = function(){
	var self = this;

	this.guardar = function(orden, clave, notasSucursales, impresionDigital, disenador, fechaImpresion, notasProduccion, claveImpresor, nombreImpresor, fechaEnvio, horaEnvio, fechaRecepcion, entregaCliente, notas, notasAdministrativas, area, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cmovimientos', {
				"orden": orden,
				"clave": clave,
				"notasSucursales": notasSucursales,
				"impresionDigital": impresionDigital, 
				"disenador": disenador, 
				"fechaImpresion": fechaImpresion, 
				"notasProduccion": notasProduccion, 
				"claveImpresor": claveImpresor, 
				"fechaEnvio": fechaEnvio, 
				"horaEnvio": horaEnvio, 
				"fechaRecepcion": fechaRecepcion, 
				"entregaCliente": entregaCliente, 
				"notas": notas,
				"notasAdministrativas": notasAdministrativas,
				"area": area,
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