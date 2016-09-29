$(document).ready(function(){
	getLista();
	
	$("#panelTabs li a[href=#add]").click(function(){
		$("#frmAdd").get(0).reset();
		$("#id").val("");
		$("form:not(.filter) :input:visible:enabled:first").focus();
	});
	
	$("#btnReset").click(function(){
		$('#panelTabs a[href="#listas"]').tab('show');
	});
	
	$("#frmAdd").validate({
		debug: true,
		rules: {
			txtEmail: "required",
			txtPass: "required",
			txtUsuario: "required",
			txtCodigo: "required",
			selPerfil: "required",
			selSucursal: "required"
		},
		wrapper: 'span', 
		submitHandler: function(form){
			var obj = new TUsuario;
			obj.add(
				$("#id").val(), 
				$("#selSucursal").val(), 
				$("#txtNombre").val(), 
				$("#txtClave").val(), 
				$("#txtPass").val(), 
				$("#txtEmail").val(),
				$("#selTipo").val(),
				$("#txtPuesto").val(), 
				$("#txtArea").val(), 
				$("#txtCodigo").val(), 
				{
					after: function(datos){
						if (datos.band){
							getLista();
							$("#frmAdd").get(0).reset();
							$('#panelTabs a[href="#listas"]').tab('show');
						}else{
							alert("Upps... " + datos.mensaje);
						}
					}
				}
			);
        }

    });
		
	function getLista(){
		$.get("?mod=listaUsuarios", function( data ) {
			$("#dvLista").html(data);
			
			$("[action=eliminar]").click(function(){
				if(confirm("¿Seguro?")){
					var obj = new TUsuario;
					obj.del($(this).attr("usuario"), {
						after: function(data){
							getLista();
						}
					});
				}
			});
			
			$("[action=modificar]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				
				$("#id").val(el.idUsuario);
				$("#txtNombre").val(el.nombre);
				$("#txtEmail").val(el.email);
				$("#txtPass").val(el.pass);
				$("#txtClave").val(el.clave);
				$("#txtCodigo").val(el.codigo);
				$("#txtArea").val(el.area);
				$("#txtPuesto").val(el.puesto);
				$("#selTipo").val(el.idTipo);
				$("#selSucursal").val(el.idSucursal);
				$('#panelTabs a[href="#add"]').tab('show');
			});
			
			$("#tblUsuarios").DataTable({
				"responsive": true,
				"language": espaniol,
				"paging": true,
				"lengthChange": false,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});
	}
});