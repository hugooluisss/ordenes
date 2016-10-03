$(document).ready(function(){
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	getLista();
	
	$("#frmBuscar").submit(function(){
		getLista();
	});
	
	function getLista(){
		$("#frmBuscar").find("[type=submit]").prop("disabled", true);
		drawChart();
	}
	
	function drawChart() {
		$.post("creportes", {
			"sucursal": $("#selSucursal").val(),
			"action": "getResumen"
		}, function( datos ){
			var array = new Array();
			
			array.push(["Nombre", "Total"]);
			$.each(datos.estados, function(i, estado){
				var el = new Array();
				
				el.push(estado.nombre);
				el.push(parseInt(estado.total));
				
				array.push(el);
 			});
 			try{
				data = google.visualization.arrayToDataTable(array);
			}catch(e){
				alert("Sin datos en esta sucursal");
			}
			
			var options = {
				title: "Estado de ODT's"
			};
			
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			
			$("#frmBuscar").find("[type=submit]").prop("disabled", false);
			chart.draw(data, options);
		}, "json");
	}
});