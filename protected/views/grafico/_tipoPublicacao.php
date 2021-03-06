<h4 class="c-grey-900 mB-20">Artigos por Tipo de Publica��o</h4>
<div class="mT-30">
	<div id="container" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
</div>
<script>
	setTimeout(function() {
		Highcharts.chart('container', {
			chart: {
				type: 'column'
			},
			title: {
				text: ''
			},
			subtitle: {
				text: 'Clique nas colunas para acessar os artigos'
			},
			xAxis: {
				type: 'category',
				title: {
					text: 'Publicado em'
				}
			},
			yAxis: {
				title: {
					text: 'N�mero de Artigos'
				}
			},
			tooltip: {
				pointFormat: 'N�mero de Artigos: <b>{point.y}</b>'
			},
			plotOptions: {
				series: {
					cursor: 'pointer',
					point: {
						events: {
							click: function () {
								window.open(this.options.url, '_blank');
							},
							legendItemClick: function () {
								return false; 
							},
						}
					}
				}
			},
			series: [{
				showInLegend: false,
				colorByPoint: true,
				data: <?php echo json_encode($data); ?>
			}]
		});
	}, 1000);
</script>