<h4 class="c-grey-900 mB-20">Artigos Publicados por Ano</h4>
<div class="mT-30">
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
</div>
<script>
	setTimeout(function(){
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			legend: {
				horizontalAlign: "right", // left, center ,right 
				verticalAlign: "top",  // top, center, bottom
			},
			axisX: {
				interval: 1,
				valueFormatString: "0000",
				title: "Ano",
			},
			axisY: {
				interval: 1,
				title: 'Nro. Artigos',
			},
			data: [
			<?php
				for ($i=0; $i < count($dados); $i++)
				{
					echo '
						{
							type: "line",
							showInLegend: true, 
							legendText: "{nome}",
							cursor:"pointer",
							indexLabel: "{y}",
							xValueFormatString: "0000",
							dataPoints: ' . json_encode($dados[$i]) . '
						},
					';
				}
			?>
			]
		});	
	
		<?php
			for ($i=0; $i < count($dados); $i++)
			{
				echo '
					chart.options.data['.$i.'].click = function(e){ 
						var dataSeries = e.dataSeries;
						var dataPoint = e.dataPoint;
						window.open(dataPoint.link,"_blank");      
					};
				';
			}
		?>

		chart.render();
	},500);
</script>