TUsuario = function(){
	var self = this;
	
	this.add = function(id,	sucursal, nombre, clave, pass, email, perfiles, puesto, area, codigo, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cusuarios', {
				"id": id,
				"sucursal": sucursal,
				"nombre": nombre,
				"clave": clave,
				"codigo": codigo,
				"email": email, 
				"pass": pass,
				"perfiles": perfiles,
				"puesto": puesto,
				"area": area,
				"action": "add"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	};
	
	this.savePersonales = function(nombre, apellidos, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('?mod=cusuarios&action=saveDatosPersonales', {
				"nombre": nombre,
				"app": apellidos
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
	
	this.savePass = function(pass, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('?mod=cusuarios&action=savePassword', {
				"pass": pass
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
	
	this.del = function(usuario, fn){
		$.post('cusuarios', {
			"usuario": usuario,
			"action": "del"
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
			if (data.band == 'false'){
				alert("Ocurrió un error al eliminar al usuario");
			}
		}, "json");
	};
	
	this.login = function(usuario, pass, fn){
		if (fn.before !== undefined)
			fn.before();
			
		$.post('?mod=clogin&action=login', {
			"usuario": usuario,
			"pass": pass
		}, function(data){
			if (fn.after != undefined)
				fn.after(data);
				
			if (data.band == 'false'){
				console.log("Los datos del usuario no son válidos");
			}
		}, "json");
	}
	
	this.setArea = function(usuario, area, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cusuarios', {
				"usuario": usuario,
				"area": area,
				"action": "addArea"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
	
	this.delArea = function(usuario, area, fn){
		if (fn.before !== undefined) fn.before();
		
		$.post('cusuarios', {
				"usuario": usuario,
				"area": area,
				"action": "delArea"
			}, function(data){
				if (data.band == 'false')
					console.log(data.mensaje);
					
				if (fn.after !== undefined)
					fn.after(data);
			}, "json");
	}
};