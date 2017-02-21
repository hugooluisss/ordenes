$(document).ready(function(){
	$("#btnEnviar").click(function(){
		$("#dvLista").html("Espera un momento en lo que obtenemos los datos del sistema...");
		$.post("listaOrdenesImportAuto", {
			razonsocial: $("#selRazon").val()
		}, function(data){
			$("#dvLista").html(data);
			
			$("#btnTodas").click(function(){
				$(".orden").prop("checked", true);
			});
			
			$("#btnNinguna").click(function(){
				$(".orden").prop("checked", false);
			});
			
			$("[action=importar]").click(function(){
				var ordenes = [];
				$(".orden:checked").each(function(){
					var el = $(this).attr("json");
					
					ordenes.push(el);
				});
				
				console.info(ordenes);
				
				obj = new TOrden;
				obj.importarAuto(ordenes, $("#selRazon").val(), {
					before: function(){
						$("#dvLista").html("Espera mientras importamos la información...");
					},
					after: function(resp){
						
						if (resp.band){
							alert("Ordenes importadas...");
							//location.reload();
							$("#datos").html("");
						}else
							alert("Ocurrio un error al importar");
					}
				});
			});
		});
	});
});