$(document).ready(function(){
	$(".btnUpload").click(function(){
		$("#winUpload").attr("razonSocial", $(this).attr("razonSocial"));
		
		$("#winUpload").modal();
	});
	
	$("#winUpload").find("#upload").fileupload({
		dataType: 'json',
		add: function (e, data){
			var jqXHR = data.submit();
		},
		done: function (e, data) {
			//$("#winUpload").modal("hide");
			listaOrdenes(data.files[0].name);
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
	
	
	function listaOrdenes(archivo){
		$.post("listaImportar", {
			"archivo": archivo,
			"razonSocial": $("#winUpload").attr("razonSocial")
		}, function( data ) {
			$("#datos").html(data);
			
			$("[action=importar]").click(function(){
				if(confirm("Estas apunto de enviar " + $("input[type=checkbox]:checked").length + " ¿Seguro?")){
					var elementos = {};
					var i = 0;
					var boton = $("[action=importar]");
					$("input[type=checkbox]:checked").each(function(){
					var el = jQuery.parseJSON($(this).attr("datos"));
						//objeto = el;
						elementos[i++] = el;
					});
					
					elementos = JSON.stringify(elementos);
					
					var obj = new TOrden;
					obj.importar(elementos, {
						before: function(){
							boton.prop("disabled", true);
						},
						after: function(resp){
							boton.prop("disabled", false);
							
							if (resp.band){
								alert("Ordenes importadas");
								$("#datos").html("");
							}else
								alert("Ocurrio un error al importar");
						}
					});
				}
			});
			
			$("#tblDatos").DataTable({
				"responsive": true,
				"language": espaniol,
				"paging": false,
				"lengthChange": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"ordering":  false
			});
		});
	}
	
});