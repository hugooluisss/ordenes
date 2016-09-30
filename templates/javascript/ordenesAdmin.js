$(document).ready(function(){
	getLista();
	
	$("#frmBuscar").submit(function(){
		getLista();
	});
	
	function getLista(){
		$("#frmBuscar").find("[type=submit]").prop("disabled", true);
		
		$.post("listaOrdenes", {
			"sucursal": $("#selSucursal").val()
		}, function( data ) {
			$("#dvLista").html(data);
			
			$("#dvLista").find("[action=detalle]").click(function(){
				$("#winOrden").modal();
				var el = jQuery.parseJSON($(this).attr("datos"));
				var idOrden =  el.idOrden;
				$.post("detalleOrden", {
					"orden": el.idOrden
				}, function( data ) {
					var plantilla = $("#winOrden");
					plantilla.find(".modal-body").html(data);
					
					plantilla.find("#tblDatos").find("tbody tr").click(function(){
						var el = $(this);
						$("input[campo=area]").val(el.attr("area"));
						$("input[campo=clave]").val(el.attr("clave"));
						$("input[campo=elaboracion]").val(el.attr("elaboracion"));
						$("input[campo=cantidad]").val(el.attr("cantidad"));
						$("input[campo=descripcion]").val(el.attr("descripcion"));
						$("#winOrden").find("input[campo=observaciones]").val(el.attr("observaciones"));
					});
					
					plantilla.find("#selEstadoOrden").change(function(){
						var orden = new TOrden;
						
						orden.guardar(idOrden, plantilla.find("#selEstadoOrden").val(), {
							before: function(){
								plantilla.find("#selEstadoOrden").prop("disabled", true);
							},
							after: function(resp){
								plantilla.find("#selEstadoOrden").prop("disabled", false);
								
								if (resp.band)
									getLista();
								else
									alert("El cambio de estado de la orden no pudo ser realizado");
							}
						});
					});
					
					plantilla.find("#btnGuardar").click(function(){
						if ($("input[campo=clave]").val() == '')
							alert("Selecciona un artículo de la lista");
						else{
							var movimiento = new TMovimiento;
							var elementos = ['txtNotas', "txtFechaImpresion", "envio", "txtFechaHora", "txtNotasSucursales"];
							
							movimiento.guardar(idOrden, $("input[campo=clave]").val(), $("#txtNotas").val(), $("#txtFechaImpresion").val(), $("#txtFechaEnvio").val(), $("#txtFechaEnvio").val(), $("#txtNotasSucursales").val(), {
								before: function(){
									$.each(elementos, function(i, el){
										$(el).prop("disabled", true);
									});
								}, after: function(resp){
									$.each(elementos, function(i, el){
										$(el).prop("disabled", false);
									});
									
									if (!resp.band)
										alert("No se pudo guardar el cambio");
								}
							});
						}
					});
				});
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
			
			$("#frmBuscar").find("[type=submit]").prop("disabled", false);
		});
	}
});