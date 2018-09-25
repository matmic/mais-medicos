<h4 class="c-grey-900 mB-20">Número de Artigos por Objeto de Pesquisa</h4>
<div class="mT-30">
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
<script>
	setTimeout(function(){
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			data: [{
				type: "pie",
				yValueFormatString: "#,##0",
				indexLabel: "{label} - #percent%",
				dataPoints: <?php echo json_encode($dataPoints); ?>
			}]
		});
	
		chart.options.data[0].click = function(e){ 
			var dataSeries = e.dataSeries;
			var dataPoint = e.dataPoint;
			window.open(dataPoint.link,'_blank');      
		};

		chart.render();
	},500);
</script>