<h4 class="c-grey-900 mB-20">Número de Artigos por Objeto de Pesquisa</h4>
<div class="mT-30">
	<div id="container" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
</div>
<script>
	Highcharts.chart('container', {
		chart: {
			type: 'column'
		},
		title: {
			text: ''
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			categories: <?php echo json_encode($anos); ?>,
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Número de Artigos'
			},
			tickInterval: 1,
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0,
				cursor: 'pointer',
				point: {
					events: {
						click: function () {
							window.open('<?php echo Yii::app()->createUrl('artigo/listar'); ?>' + '?CodObjetoPesquisa='+this.series.userOptions.key+'&AnoPublicacao='+this.category, '_blank'); 
						}
					}
				}
			}
		},
		series: <?php echo json_encode($series); ?>
	});
</script>