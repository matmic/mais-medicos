<h4 class="c-grey-900 mB-20">Artigos por Tipo de Procedimento</h4>
<div class="mT-30">
	<div id="container" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
</div>
<script>
	setTimeout(function() {
		Highcharts.chart('container', {
			chart: {
				type: 'pie'
			},
			title: {
				text: ''
			},
			subtitle: {
				text: 'Clique sobre os pedaços para acessar os artigos'
			},
			xAxis: {
				type: 'category',
				title: {
					text: 'Tipos de Procedimentos'
				}
			},
			yAxis: {
				title: {
					text: 'Número de Artigos'
				}
			},
			tooltip: {
				pointFormat: 'Número de Artigos: <b>{point.y}</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '{point.percentage:.1f} %',
					},
					showInLegend: true,
					point: {
						events: {
							click: function() {
								window.open(this.options.url,'_blank');
							},
							legendItemClick: function () {
								return false; 
							},
						}
					},
				}
			},
			series: [{
				colorByPoint: true,
				data: <?php echo json_encode($data); ?>
			}]
		});
	}, 1000);
</script>