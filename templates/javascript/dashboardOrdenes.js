$(document).ready(function(){
	servidor = $("#txtDireccionSAE").val();
	
	
	$("table").each(function(){
		$(this).DataTable({
			"responsive": true,
			"language": espaniol,
			"paging": true,
			"lengthChange": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"order": [[ 1, "desc" ]]
		});
	});
});