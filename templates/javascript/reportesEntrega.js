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
			"entrega": $("#selEntrega").val(),
			"action": "getResumenEntrega",
			"antiguas": $("#chkAntiguas").is(":checked")
		}, function( datos ){
			var array = new Array();
			
			array.push(["Estado", "Ordenes", {role: "style"}, {role: "annotation"}]);
			$.each(datos.estados, function(i, estado){
				var el = new Array();
				
				el.push(estado.nombre);
				el.push(parseInt(estado.total));
				el.push("color: " + estado.color);
				el.push(parseInt(estado.total));
				//el.push(parseInt(estado.idEstado));
				array.push(el);
 			});
 			try{
				data = google.visualization.arrayToDataTable(array);
			}catch(e){
				console.log(array);
			}
			
			var options = {
				title: "Estado de ODT's",
			};
			
			function selectHandler() {
				var selectedItem = chart.getSelection()[0];
				if (selectedItem) {
					var topping = data.getValue(selectedItem.row, 1);
					listaOrdenes(datos.estados[selectedItem.row].idEstado);
				}
			}
			
			var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
	        google.visualization.events.addListener(chart, 'select', selectHandler);    


			$("#frmBuscar").find("[type=submit]").prop("disabled", false);
			chart.draw(data, options);
		}, "json");
	}
	
	function listaOrdenes(estado){
		$("#listaOrdenes").html('<i class="fa fa-cog fa-spin fa-3x fa-fw"></i> Estamos actualizando la lista');
		$.post("listaOrdenesReportes", {
			"sucursal": $("#selSucursal").val(),
			"estado": estado,
			"entrega": $("#selEntrega").val(),
			"antiguas": $("#chkAntiguas").is(":checked")
		}, function( datos ){
			$("#listaOrdenes").html(datos);
		});
	}
});