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
				
				$.post("detalleOrden", {
					"orden": el.idOrden
				}, function( data ) {
					$("#winOrden").find(".modal-body").html(data);
					
					$("#winOrden").find("#tblDatos").find("tbody tr").click(function(){
						var el = $(this);
						$("input[campo=area]").val(el.attr("area"));
						$("input[campo=clave]").val(el.attr("clave"));
						$("input[campo=elaboracion]").val(el.attr("elaboracion"));
						$("input[campo=cantidad]").val(el.attr("cantidad"));
						$("input[campo=descripcion]").val(el.attr("descripcion"));
						$("#winOrden").find("input[campo=observaciones]").val(el.attr("observaciones"));
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