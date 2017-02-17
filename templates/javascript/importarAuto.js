$(document).ready(function(){
	$("#btnEnviar").click(function(){
		$.post("listaOrdenesImportAuto", {
			sucursal: $("#selSucursal").val()
		}, function(data){
			$("#dvLista").html(data);
		});
	});
});