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
    
    $("#winAreas").find("input[type=checkbox]").change(function(){
    	var obj = new TUsuario;
    	var el = $(this);
    	
    	if ($(this).is(":checked"))
	    	obj.setArea($("#winAreas").find("#usuario").val(), el.val(), {
	    		before: function(){
		    		el.prop("disabled", true);
	    		}, after: function(resp){
		    		el.prop("disabled", false);
		    		
		    		if (!resp.band){
		    			alert("No se asignó el área");
		    			el.prop("checked", false);
		    		}
	    		}
	    	});
    	else
	    	obj.delArea($("#winAreas").find("#usuario").val(), el.val(), {
	    		before: function(){
		    		el.prop("disabled", true);
	    		}, after: function(resp){
		    		el.prop("disabled", false);
		    		
		    		if (!resp.band){
		    			alert("No se desasignó el área");
		    			el.prop("checked", true);
		    		}
	    		}
	    	});
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
				$("#txtPuesto").val(el.puesto);
				$("#selTipo").val(el.idTipo);
				$("#selSucursal").val("");
				
				$.each(el.sucursales, function(i, e){
					
					$("#selSucursal option[value='" + e.idSucursal + "']").prop("selected", true);
				});

				$('#panelTabs a[href="#add"]').tab('show');
			});
			
			$("[action=areas]").click(function(){
				var el = jQuery.parseJSON($(this).attr("datos"));
				$("#winAreas").find("#usuario").val(el.idUsuario);
				
				$.each(el.areas, function(i, area){
					$("#winAreas").find("[value=" + area.idArea + "]").prop("checked", true);
				});
				
				$("#winAreas").modal();
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
	
	$("#winAreas").on('hide.bs.modal', function(event){
		getLista();
		
		$("#winAreas").find("[type=checkbox]").prop("checked", false);
	});
});