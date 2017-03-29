$(document).ready(function(){
	getLista();
	
	setInterval(function(){
		$.post("cordenes", {
			"action": "updateSesion"
		}, function(resp){
			$("#dvLista").find("span#hora").html(resp);
		});
	}, 1 * 60 * 1000);
	
	$("#frmBuscar").submit(function(){
		getLista();
	});
	
	function getLista(){
		$("#frmBuscar").find("[type=submit]").prop("disabled", true);
		
		$.post("listaOrdenes", {
			"sucursal": $("#selSucursal").val()
		}, function( data ) {
			$("#dvLista").html(data);
			
			$("#btnGroupActions").find("button").click(function(){
				var btn = $(this);
				
				if ($("input[type=checkbox].setEstado:checked").length < 0)
					alert("Por lo menos selecciona una orden");
				else if(confirm("¿Seguro?")){
					var identificadores = "";
					$("input[type=checkbox].setEstado:checked").each(function(){
						var el = $(this);
						
						identificadores += (identificadores == ""?"":",") + el.val();
					});
					
					var obj = new TOrden;
					obj.setEstadoMasivo({
						"identificadores": identificadores,
						"estado": btn.attr("estado"),
						before: function(){
							btn.prop("disabled", true);
						}, after: function(resp){
							btn.prop("disabled", false);
							getLista();
							
							if(resp.band)
								alert("Cambio de estado realizado");
							else
								alert("Ocurrió un error al realizar el cambio de estado");
						}
					});
				}
			});
			
			$("#btnUpdateSesion").click(function(){
				$.post("cordenes", {
					"action": "updateSesion"
				}, function(resp){
					$("#dvLista").find("span#hora").html(resp);
					
					alert("Sesión actualizada");
				});
			});
			
			$("#dvLista").find("[action=detalle]").click(function(){
				$("#winOrden").modal();
				getOrden(jQuery.parseJSON($(this).attr("datos")));
				//getLista();
			});
			
			$("#dvLista").find("[action=historialEstados]").click(function(){
				$("#winHistorialEstados").modal();
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$.get("index.php?mod=historialEstados&orden=" + el.idOrden, function(resp){
					$("#winHistorialEstados").find(".modal-body").html(resp);
				});
			});
			
			$("#dvLista").find("[action=setEstado]").click(function(){
				if (confirm("¿Seguro?")){
					var el = jQuery.parseJSON($(this).attr("datos"));
					var orden = new TOrden();
					var btn = $(this);
					
					orden.guardar(el.idOrden, btn.attr("estado"), {
						before: function(){
							btn.prop("disabled", true);
						}, after: function(resp){
							btn.prop("disabled", false);
							if (resp.band)
								getLista();
							else
								alert("No se pudo actualizar el estado");
						}
					});
				}
				
				//getLista();
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
				
				$("#btnEliminarOrden").click(function(){
					var orden = new TOrden;
					orden.eliminar(idOrden, {
						before: function(){
							$("#btnEliminarOrden").prop("disabled", true);
						}, after: function(resp){
							$("#btnEliminarOrden").prop("disabled", false);
							if (resp.band){
								getLista();
								$("#winOrden").modal("hide");
							}else
								alert("No pudo ser eliminada");
						}
					})
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
				
				var tr = plantilla.find("#tblDatos").find("tbody tr:first-child");
				
				plantilla.find("#txtFechaEnvio").datepicker({"dateFormat": "yyyy-mm-dd", "autoclose": true});
				
				plantilla.find("#txtHoraEnvio").inputmask("99:99");
				
				plantilla.find("#btnFechaImpresion").click(function(){
					var f = new Date();
					var fecha = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
					plantilla.find("#txtFechaImpresion").val(fecha);
					
					plantilla.find("#txtFechaImpresion").prop("disabled", true);
					
					guardar();
				});
				
				$("#btnFechaImpresion").prop("disabled", !(tr.attr("fechaimpresion") == ''));
				
				plantilla.find("#btnImpresionDigital").click(function(){
					var f = new Date();
					var fecha = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
					plantilla.find("#txtImpresionDigital").val(fecha);
					
					plantilla.find("#btnImpresionDigital").prop("disabled", true);
					
					guardar(function(){
						var orden = new TOrden();
						
						orden.guardar(idOrden, 9, {
							before: function(){
								plantilla.find("#selEstadoOrden").prop("disabled", true);
							},
							after: function(resp){
								plantilla.find("#selEstadoOrden").prop("disabled", false);
								
								if (resp.band){
									var datos = new Array();
									datos.idOrden = idOrden
									getOrden(datos);
									getLista();
									alert("Orden guardada");
								}
								else
									alert("El cambio de estado de la orden no pudo ser realizado");
							}
						});
					});
				});
				
				$("#btnImpresionDigital").prop("disabled", !(tr.attr("impresionDigital") == ''));
				
				
				plantilla.find("#btnFechaEntregaCliente").click(function(){
					var f = new Date();
					var fecha = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
					plantilla.find("#txtFechaEntregaCliente").val(fecha);
					
					plantilla.find("#btnFechaEntregaCliente").prop("disabled", true);
					
					guardar(function(){
						var orden = new TOrden();
						
						orden.guardar(idOrden, 3, {
							before: function(){
								plantilla.find("#selEstadoOrden").prop("disabled", true);
							},
							after: function(resp){
								plantilla.find("#selEstadoOrden").prop("disabled", false);
								
								if (resp.band){
									var datos = new Array();
									datos.idOrden = idOrden
									getOrden(datos);
									getLista();
									alert("Orden guardada");
								}
								else
									alert("El cambio de estado de la orden no pudo ser realizado");
							}
						});
					});
				});
				
				plantilla.find("#btnFechaEntregaCliente").prop("disabled", !(tr.attr("entregacliente") == ''));
				
				plantilla.find("#btnFechaRecepcion").click(function(){
					var f = new Date();
					var fecha = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate() + " " + f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
					plantilla.find("#txtFechaRecepcion").val(fecha);
					
					plantilla.find("#btnFechaRecepcion").prop("disabled", true);
					
					var orden = new TOrden;
					
					orden.guardar(idOrden, 10, {
						before: function(){
							plantilla.find("#selEstadoOrden").prop("disabled", true);
						},
						after: function(resp){
							plantilla.find("#selEstadoOrden").prop("disabled", false);
							
							if (resp.band){
								guardar();
							}else
								alert("El cambio de estado de la orden no pudo ser realizado");
						}
					});
					
					//guardar();
				});
				
				plantilla.find("#btnFechaRecepcion").prop("disabled", !(tr.attr("fecharecepcion") == ''));
				
				//$("input[campo=area]").val(tr.attr("area"));
				$("select[campo=area]").val(tr.attr("idArea"));
				$("input[campo=clave]").val(tr.attr("clave"));
				$("input[campo=elaboracion]").val(tr.attr("elaboracion"));
				$("input[campo=cantidad]").val(tr.attr("cantidad"));
				$("input[campo=descripcion]").val(tr.attr("descripcion"));
				$("#winOrden").find("input[campo=observaciones]").val(tr.attr("observaciones"));
				
				plantilla.find("#txtNotasSucursales").val(tr.attr("notasucursales"));
				plantilla.find("#txtImpresionDigital").val(tr.attr("impresionDigital"));
				plantilla.find("#txtDisenador").val(tr.attr("disenador"));
				plantilla.find("#txtFechaImpresion").val(tr.attr("fechaImpresion"));
				plantilla.find("#txtNotasProduccion").val(tr.attr("notasProduccion"));
				plantilla.find("#txtClaveImpresior").val(tr.attr("claveImpresior"));
				plantilla.find("#txtFechaEnvio").val(tr.attr("fechaenvio"));
				plantilla.find("#selHoraEnvio").val(tr.attr("horaenvio"));
				plantilla.find("#txtNotasAdministrativas").val(tr.attr("notasadministrativas"));
				plantilla.find("#txtAdministrativo").val(tr.attr("administrativo"));
				
				$("#selEstado option[value=8]").prop("select", tr.attr("ultimoArchivo") == '');
				
				//Vista de diseñador
				//plantilla.find("#chkImpresionDigital").prop("checked", el.attr("impresiondigital") == 'S');
				plantilla.find("#txtDisenador").val(tr.attr("disenador"));
				
				plantilla.find("#txtDisenador").val(tr.attr("disenador"));
				plantilla.find("#txtClaveImpresor").val(tr.attr("claveimpresor"));
				plantilla.find("#txtNombreImpresor").val(tr.attr("nombreimpresor"));
				
				if (plantilla.find("#txtFechaEnvio").val() != '')
					plantilla.find("#chkEnvio").prop("checked", true);
				else
					plantilla.find("#chkEnvio").prop("checked", false);
				
				plantilla.find("#txtFechaRecepcion").val(tr.attr("fecharecepcion"));
				plantilla.find("#txtFechaEntregaCliente").val(tr.attr("entregacliente"));
				plantilla.find("#txtNotas").val(tr.attr("notas"));
				plantilla.find("#rbtTipoEntrega[value="+ tr.attr("tipoEntrega") +"]").prop("checked", true);
				
				plantilla.find("#lnkUltimoArchivo").click(function(){
					var orden = new TOrden;
					orden.guardar(idOrden, 2, {
						before: function(){
							plantilla.find("#selEstadoOrden").prop("disabled", true);
						},
						after: function(resp){
							plantilla.find("#selEstadoOrden").prop("disabled", false);
							if (resp.band)
								plantilla.find("#selEstadoOrden").val(2);
							else
								alert("Ocurrió un error al cambiar el estado a En producción, inténtelo manualmente");
						}
					});
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
					guardar();
				});
				
				function guardar(despues){
					if ($("input[campo=clave]").val() == '')
						alert("Selecciona un artículo de la lista");
					else{
						var movimiento = new TMovimiento;
						var elementos = ['txtNotas', "txtFechaImpresion", "envio", "txtFechaHora", "txtNotasSucursales", "btnGuardar"];
						
						//notasSucursales, impresionDigital, disenador, fechaImpresion, notasProduccion, claveImpresion, fechaEnvio, horaEnvio, fechaRecepcion, entregaCliente, notas, fn){
						movimiento.guardar(idOrden, 
							$("input[campo=clave]").val(), 
							$("#txtNotasSucursales").val(),
							$("#txtImpresionDigital").val(), //impresionDigital, 
							$("#txtDisenador").val(), //disenador 
							$("#txtFechaImpresion").val(), 
							$("#txtNotasProduccion").val(), 
							$("#txtClaveImpresor").val(), //claveImpresion, 
							$("#txtNombreImpresor").val(), //nombreimpresor, 
							$("#txtFechaEnvio").val(), 
							$("#selHoraEnvio").val(), 
							$("#txtFechaRecepcion").val(), //fechaRecepcion, 
							$("#txtFechaEntregaCliente").val(), //entregaCliente, 
							$("#txtNotas").val(), 
							$("#txtNotasAdministrativas").val(), 
							$("#selArea").val(), 
							$("[name=rbtTipoEntrega]:checked").val(), {
								before: function(){
									$.each(elementos, function(i, el3){
										$(el3).prop("disabled", true);
									});
								}, after: function(resp){
									$.each(elementos, function(i, el3){
										$(el3).prop("disabled", false);
									});
									
									if (despues !== undefined){
										despues();
									}else{
										if (resp.band){
											getOrden(el);
											//getLista();
											alert("Orden guardada");
										}
									}
									
									if (!resp.band)
										alert("No se pudo guardar el cambio");
								}
							}
						);
					}
				}
			});
		}
	}
});