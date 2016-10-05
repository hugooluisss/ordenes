$(document).ready(function(){
	$(".alert-danger").hide();
	$("#btnCerrarVentana").click(function(){
		if (confirm("¿Seguro?"))
			window.close();
	});
	lista();
	
	$('#upload2').fileupload({
		// This function is called when a file is added to the queue
		dataType: 'json',
		progressall: function (e, data) {
			//console.log(data);
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$(".progress .progress-bar").css('width', progress + '%');
			
			if (progress < 100)
				$(".alert-danger").show();
			else
				$(".alert-danger").hide();
		},
		add: function (e, data) {
			console.log(data);
			var archivos = '';
			
			data.context = $('<p/>', {"class": "text-warning"}).html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Subiendo <b>' + data.files[0].name + '</b> al servidor... <i class="fa fa-upload" aria-hidden="true"></i>').appendTo($("#historial"));
			
			data.submit();
        },
		fail: function(){
			alert("Ocurrió un problema en el servidor, contacta al administrador del sistema");
			
			console.log("Error en el servidor al subir el archivo, checa permisos de la carpeta repositorio");
		},
		done: function (e, data) {
            $.each(data.files, function (index, file) {
            	data.context.html('<i class="fa fa-2x fa-check-circle" aria-hidden="true"></i> ' + file.name + ' 100% arriba');
            	data.context.removeClass("text-warning");
            	data.context.addClass("text-success");
            });
            
            lista();
        },
        complete: function(result, textStatus, jqXHR) {
        	//console.log(result);
        	result = jQuery.parseJSON(result.responseText);
        	
        	//result.status == 'success')
        }
	});
	
	function lista(){
		$.post("listaArchivos", {
			"orden": $("#orden").val(),
			"movimiento": $("#movimiento").val()
		}, function(data){
			$("#listaArchivos").html(data);
			
			$("[action=borrar]").click(function(){
				if (confirm("Seguro?")){
					var el = jQuery.parseJSON($(this).attr("datos"));
					
					$.post("cmovimientos", {
						"action": "eliminar",
						"archivo": el.ruta
					}, function(resp){
						if (resp.band)
							lista()
						else
							alert("No se pudo eliminar el archivo");
					}, "json");
				}
			});
			
			$("#tblDatos").DataTable({
				"responsive": true,
				"language": espaniol,
				"paging": false,
				"lengthChange": false,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});
	}
});