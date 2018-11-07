<h4 class="c-grey-900 mB-20">Publicações por Instituição</h4>
<div class="mT-30">
	<?php
		echo CHtml::beginForm(Yii::app()->createUrl('grafico/instituicao'), 'GET', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
			echo '<div class="form-group row">';
				echo CHtml::label('Número de instituições*: ', 'lblInstituicao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
				echo '<div class="col-sm-10">';
					$this->widget('CMaskedTextField', array(
						'name' => 'Numero',
						'mask' => '99',
						'value'=> $numero,
						'htmlOptions' => array('maxLength' => 3, 'class'=>'form-control', 'required'=>true)
					));
					echo '<div class="invalid-feedback">Por favor, insira um número.</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class="text-center form-group row">';
				echo '<div class="col-sm-12">';
					echo CHtml::submitButton('Buscar', array('class'=>"btn btn-primary"));
				echo '</div>';
			echo '</div>';
	
		echo CHtml::endForm();
	?>
	
	<div id="container" style="min-width: 310px; height: 400px; max-width: 100%; margin: 0 auto"></div>
</div>
<script>
	!function() {
		"use strict";
		window.addEventListener("load", function() {
			var e = document.getElementById("needs-validation");
			e.addEventListener("submit", function(t) {
				!1 === e.checkValidity() && (t.preventDefault(), t.stopPropagation()), e.classList.add("was-validated")
			}, !1)
		}, !1)
	}()

	if ('<?php echo $criarGrafico; ?>' == '1')
	{
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
						text: 'Instituições'
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
	}
</script>