$(document).ready(function(){
	$('#upload2').fileupload({
		// This function is called when a file is added to the queue
		dataType: 'json',
		progressall: function (e, data) {
			console.log(data);
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$(".progress .progress-bar").css('width', progress + '%');
		},
		add: function (e, data) {
            data.context = $('<p/>').text('Subiendo al servidor...').appendTo($("#listaArchivos"));
            data.submit();
        },
		fail: function(){
			alert("Ocurrió un problema en el servidor, contacta al administrador del sistema");
			
			console.log("Error en el servidor al subir el archivo, checa permisos de la carpeta repositorio");
		},
		done: function (e, data) {
            $.each(data.files, function (index, file) {
            	console.log(data);
            	data.context.text("100% arriba");
            });
        },
        complete: function(result, textStatus, jqXHR) {
        	console.log(result);
        	result = jQuery.parseJSON(result.responseText);
        	
        	//result.status == 'success')
        }
	});
	
	function formatFileSize(bytes) {
		if (typeof bytes !== 'number') {
		    return '';
		}
		
		if (bytes >= 1000000000) {
		    return (bytes / 1000000000).toFixed(2) + ' GB';
		}
		
		if (bytes >= 1000000) {
		    return (bytes / 1000000).toFixed(2) + ' MB';
		}
		return (bytes / 1000).toFixed(2) + ' KB';
	}
});