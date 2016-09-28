$(document).ready(function(){
	$("#btnUpload").click(function(){
		$("#winUpload").modal();
	});
	
	$("#winUpload").find("#upload").fileupload({
		dataType: 'json',
		add: function (e, data){
			var jqXHR = data.submit();
		},
		done: function (e, data) {
			$("#winUpload").modal("hide");
		},
		progress: function(e, data){
		    var progress = parseInt(data.loaded / data.total * 100, 10);
		
		    if(progress == 100){
		         console.log("Completado...");
		    }
		},
		fail: function(){
			alert("Ocurrió un problema en el servidor, contacta al administrador del sistema");
			console.log("Error en el servidor al subir el archivo, checa permisos de la carpeta repositorio");
		}
	}).error(function (jqXHR, textStatus, errorThrown) {
		alert("error");
	});
});