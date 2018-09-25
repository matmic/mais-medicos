<h4 class="c-grey-900 mB-20">Número de Artigos por Objeto de Pesquisa</h4>
<div class="mT-30">
	<div id="container" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
</div>
<script>
	Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
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
            showInLegend: true
        }
    },
    series: [{
        colorByPoint: true,
        data: <?php echo json_encode($data); ?>
    }]
});
</script>