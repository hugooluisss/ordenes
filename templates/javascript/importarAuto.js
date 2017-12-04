$(document).ready(function(){
	$("#btnEnviar").click(function(){
		listaImportarAuto();
	});
	$("[campo=ultimaOrden]").html($("#selRazon").find("option:selected").attr("consecutivo"));
	
	$("#selRazon").change(function(){
		$("[campo=ultimaOrden]").html($(this).find("option:selected").attr("consecutivo"));
	});
	
	function listaImportarAuto(){
		$("#dvLista").html("Espera un momento en lo que obtenemos los datos del sistema...");
		var option = $("#selRazon").find("option:selected")
		
		$.get("http://lyegdl.ddns.net:8080/enlace.php?inicio="+ option.attr("consecutivo") + "&empresa=" + option.attr("empresa"), function(resp){
			console.log(resp);
			
			$.post("listaOrdenesImportAuto", {
				razonsocial: $("#selRazon").val(),
				"json_datos": resp
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
								$("#datos").html("");
								location.reload(true);
								//listaImportarAuto();
							}else
								alert("Ocurrio un error al importar");
						}
					});
				});
			});
		});
	}
});