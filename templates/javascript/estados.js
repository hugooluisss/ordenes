$(document).ready(function(){
	$('#txtColor').colorpicker();
	$("#panelTabs li a[href=#add]").hide();
	
	getLista();
	
	$("#btnReset").click(function(){
		$('#panelTabs a[href="#listas"]').tab('show');
	});
	
	$("#frmAdd").validate({
		debug: true,
		rules: {
			txtNombre: "required",
			txtColor: "required",
			txtOrden: "digits"
		},
		wrapper: 'span', 
		messages: {
			txtNombre: "Este campo es necesario",
			txtColor: "Este campo es necesario",
		},
		submitHandler: function(form){
			var obj = new TEstado;
			obj.add(
				$("#id").val(), 
				$("#txtNombre").val(),
				$("#txtColor").val(),
				$("#txtOrden").val(),
				{
					after: function(datos){
						if (datos.band){
							getLista();
							$("#frmAdd").get(0).reset();
							$('#panelTabs a[href="#listas"]').tab('show');
							$("#panelTabs a[href=#add]").hide();
						}else{
							alert("Upps... " + datos.mensaje);
						}
					}
				}
			);
        }

    });
		
	function getLista(){
		$.get("?mod=listadoEstados", function( data ) {
			$("#dvLista").html(data);
			
			$("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TEstado;
					obj.del($(this).attr("item"), {
						after: function(data){
							getLista();
						}
					});
				}
			});
			
			$("[action=permisos]").click(function(){
				$("#winPerfiles").attr("identificador", $(this).attr("identificador"));
			});
			
			$("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$("#id").val(el.idEstado);
				$("#txtNombre").val(el.nombre);
				$("#txtColor").val(el.color);
				$("#txtOrden").val(el.orden);
				$("#panelTabs a[href=#add]").show();
				$('#panelTabs a[href="#add"]').tab('show');
			});
			
			$("#tblEstados").DataTable({
				"responsive": true,
				"language": espaniol,
				"paging": false,
				"lengthChange": false,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});
	};
	
	$("#winPerfiles").on("shown.bs.modal", function(){
		$(".perfil").prop("disabled", true).prop("checked", false);
		
		$.post("cestados", {
			"id": $("#winPerfiles").attr("identificador"),
			"action": "getPermisos"
		}, function(data){
			$(".perfil").prop("disabled", false);
			
			$.each(data.permisos, function(i, tipo){
				$(".perfil[value=" + tipo.idTipo + "]").prop("checked", true);
			});
		}, "json");
	});
	
	$(".perfil").click(function(){
		var el = $(this);
		var estado = new TEstado;
		
		if(el.is(":checked"))
			estado.addTipoUsuario({
				id: $("#winPerfiles").attr("identificador"),
				tipo: el.val(),
				fn: {
					before: function(){
						el.prop("disabled", true);
					},
					after: function(resp){
						el.prop("disabled", false);
						if (!resp.band){
							alert("No se pudo agregar el permiso");
							el.prop("checked", false);
						}
					}
				}
			});
		else
			estado.delTipoUsuario({
				id: $("#winPerfiles").attr("identificador"),
				tipo: el.val(),
				fn: {
					before: function(){
						el.prop("disabled", true);
					},
					after: function(resp){
						el.prop("disabled", false);
						if (!resp.band){
							alert("No se pudo quitar el permiso");
							el.prop("checked", true);
						}
					}
				}
			});
	});
});