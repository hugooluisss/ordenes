$(document).ready(function(){
	servidor = $("#txtDireccionSAE").val();
	
	$("#btnSAE").click(function(){
		tiempoInicio = new Date;
		var btn = $(this);
		btn.prop("disabled", true);
		$.post(servidor + "check.php", {
			"evento": "sae"
		}, function(resp){
			btn.prop("disabled", false);
			console.log(tiempoInicio, new Date);
			if (resp.band)
				alert("Todo ok");
			else
				alert("Error");
		}, "json");
	});
	
	$("#btnActualizar").click(function(){
		var tiempo = prompt("¿Cuanto minutos?");
		
		alert(tiempo);
	});
	
	$(".razonSocial").click(function(){
		var chk = $(this);
		if (chk.id(":checked"))
			
	});
});