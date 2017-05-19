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
});