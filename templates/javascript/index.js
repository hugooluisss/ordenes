$(document).ready(function(){
	$(".user-body").find("a[perfil]").click(function(){
		var el = $(this);
		
		$.post('cusuarios', {
				"perfil": el.attr("perfil"),
				"action": "changePerfil"
			}, function(data){
				if (data.band == 'false'){
					console.log(data.mensaje);
					alert("No se pudo realizar el cambio de perfil");
				}else
					location.reload();
					
			}, "json");
	});
});