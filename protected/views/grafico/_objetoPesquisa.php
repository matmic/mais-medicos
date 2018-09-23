<h4 class="c-grey-900 mB-20"><?php echo $title; ?></h4>
<div class="mT-30">
	<?php 
		// $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'PieChart',
			// 'data' => $dados,
			// 'options' => array(
				// 'title' => $title,
			// ),
		// ));
	?>
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
				dataPoints: <?php echo json_encode($dados2); ?>
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