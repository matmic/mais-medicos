<h4 class="c-grey-900 mB-20">Artigos por Tema de Pesquisa e Ano de Publicação</h4>
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
					events: {
						legendItemClick: function () {
							return false; 
						},
					},
					point: {
						events: {
							click: function () {
								window.open('<?php echo Yii::app()->createUrl('artigo/listar'); ?>' + '?Filtro[CodObjetoPesquisa]='+this.series.userOptions.key+'&Filtro[AnoPublicacao]='+this.category, '_blank'); 
							},
						}
					}
				}
			},
			series: <?php echo json_encode($series); ?>
		});
	}, 1000);
</script>