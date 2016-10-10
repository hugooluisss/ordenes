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
				getOrden(jQuery.parseJSON($(this).attr("datos")));
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
		
		
		function getOrden(el){
			var idOrden =  el.idOrden;
			$("#winOrden").find(".modal-body").html("Por favor espera mientras obtenemos los datos...");
			$.post("detalleOrden", {
				"orden": el.idOrden
			}, function( data ) {
				var plantilla = $("#winOrden");
				plantilla.find(".modal-body").html(data);
				$("#txtFechaRecepcion").inputmask("9999-99-99 99:99");
				$("#txtFechaRecepcion").click(function(){
					if ($(this).val() == ''){
						var d = new Date();
						 mes = (d.getMonth() < 10?"0":"") + d.getMonth();
						 dia = (d.getDate() < 10?"0":"") + d.getDate();
						$(this).val(d.getFullYear() + "-" + mes + "-" + dia + " 00:00");
					}
				});
				
				$("#txtFechaEntregaCliente").inputmask("9999-99-99 99:99");
				$("#txtFechaEntregaCliente").click(function(){
					if ($(this).val() == ''){
						var d = new Date();
						 mes = (d.getMonth() < 10?"0":"") + d.getMonth();
						 dia = (d.getDate() < 10?"0":"") + d.getDate();
						$(this).val(d.getFullYear() + "-" + mes + "-" + dia + " 00:00");
					}
				});
				
				//$("#txtFechaImpresion").inputmask("9999-99-99");
				
				plantilla.find("#txtFechaImpresion").datepicker("option", "dateFormat", "yyyy-mm-dd");
				plantilla.find("#txtFechaImpresion").datepicker({"dateFormat": "yyyy-mm-dd", "autoclose": true});
				plantilla.find("#txtFechaEnvio").datepicker({"dateFormat": "yyyy-mm-dd", "autoclose": true});
				//plantilla.find("#txtFechaRecepcion").datepicker({"dateFormat": "yyyy-mm-dd", "autoclose": true});
				//plantilla.find("#txtFechaEntregaCliente").datepicker({"dateFormat": "yyyy-mm-dd", "autoclose": true});
				
				plantilla.find("#txtHoraEnvio").inputmask("99:99");
				
				plantilla.find("#tblDatos").find("tbody tr").click(function(){
					var el = $(this);
					$("input[campo=area]").val(el.attr("area"));
					$("input[campo=clave]").val(el.attr("clave"));
					$("input[campo=elaboracion]").val(el.attr("elaboracion"));
					$("input[campo=cantidad]").val(el.attr("cantidad"));
					$("input[campo=descripcion]").val(el.attr("descripcion"));
					$("#winOrden").find("input[campo=observaciones]").val(el.attr("observaciones"));
					
					//notasSucursales, impresionDigital, disenador, fechaImpresion, notasProduccion, claveImpresion, fechaEnvio, horaEnvio, fechaRecepcion, entregaCliente, notas
					plantilla.find("#txtNotasSucursales").val(el.attr("notasucursales"));
					plantilla.find("#txtImpresionDigital").val(el.attr("impresionDigital"));
					plantilla.find("#txtDisenador").val(el.attr("disenador"));
					plantilla.find("#txtFechaImpresion").val(el.attr("fechaImpresion"));
					plantilla.find("#txtNotasProduccion").val(el.attr("notasProduccion"));
					plantilla.find("#txtClaveImpresior").val(el.attr("claveImpresior"));
					plantilla.find("#txtFechaEnvio").val(el.attr("fechaenvio"));
					plantilla.find("#selHoraEnvio").val(el.attr("horaenvio"));
					
					//Vista de diseñador
					plantilla.find("#chkImpresionDigital").prop("checked", el.attr("impresiondigital") == 'S');
					plantilla.find("#txtDisenador").val(el.attr("disenador"));
					
					plantilla.find("#txtDisenador").val(el.attr("disenador"));
					plantilla.find("#txtClaveImpresor").val(el.attr("claveimpresor"));
					plantilla.find("#txtNombreImpresor").val(el.attr("nombreimpresor"));
					
					if (plantilla.find("#txtFechaEnvio").val() != '')
						plantilla.find("#chkEnvio").prop("checked", true);
					else
						plantilla.find("#chkEnvio").prop("checked", false);
					
					plantilla.find("#txtFechaRecepcion").val(el.attr("fecharecepcion"));
					plantilla.find("#txtFechaEntregaCliente").val(el.attr("entregacliente"));
					plantilla.find("#txtNotas").val(el.attr("notas"));
				});
				
				plantilla.find("#chkEnvio").change(function(){
					if ($(this).is(":checked")){
						var f = new Date();
						mes = (f.getMonth()+1 < 10)?("0" + (f.getMonth() +1)):(f.getMonth() +1);
						dia = (f.getDate() < 10)?("0" + f.getDate()):f.getDate();
						
						minutos = (f.getMinutes() < 10)?("0" + f.getMinutes()):f.getMinutes();
						horas = (f.getHours() < 10)?("0" + f.getHours()):f.getHours();
						
						plantilla.find("#txtFechaEnvio").val(f.getFullYear() + "-" + mes + "-" + dia);
						plantilla.find("#txtHoraEnvio").val(horas + ":" + minutos);
					}
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
						var elementos = ['txtNotas', "txtFechaImpresion", "envio", "txtFechaHora", "txtNotasSucursales", "btnGuardar"];
						
						//notasSucursales, impresionDigital, disenador, fechaImpresion, notasProduccion, claveImpresion, fechaEnvio, horaEnvio, fechaRecepcion, entregaCliente, notas, fn){
						
						movimiento.guardar(idOrden, 
							$("input[campo=clave]").val(), 
							$("#txtNotasSucursales").val(),
							$("#chkImpresionDigital").is(":checked")?'S':'N', //impresionDigital, 
							$("#txtDisenador").val(), //disenador 
							$("#txtFechaImpresion").val(), 
							$("#txtNotasProduccion").val(), 
							$("#txtClaveImpresor").val(), //claveImpresion, 
							$("#txtNombreImpresor").val(), //nombreimpresor, 
							$("#txtFechaEnvio").val(), 
							$("#selHoraEnvio").val(), 
							$("#txtFechaRecepcion").val(), //fechaRecepcion, 
							$("#txtFechaEntregaCliente").val(), //entregaCliente, 
							$("#txtNotas").val(), {
								before: function(){
									$.each(elementos, function(i, el){
										$(el).prop("disabled", true);
									});
								}, after: function(resp){
									$.each(elementos, function(i, el){
										$(el).prop("disabled", false);
									});
									
									if (resp.band){
										getOrden(el);
										getLista();
										alert("Orden guardada");
									}else
										alert("No se pudo guardar el cambio");
								}
							}
						);
					}
				});
			});
		}
	}
});