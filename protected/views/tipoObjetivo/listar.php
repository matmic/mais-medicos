<h4 class="c-grey-900 mB-20">Lista de Objetivos</h4>
<?php	
	echo CHtml::button('Novo Objetivo', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("tipoObjetivo/formulario") . '"'));

	echo '<div class="table-responsive">';
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'columns'=>array(
				array(
					'header'=>'Nome',
					'value'=>'$data->NomeTipoObjetivo',
				),
				array(
					'header'=>'Ativo?',
					'value'=>'($data->IndicadorExclusao == "S") ? "Não" : "Sim"',
				),
				array(
					'htmlOptions'=>array('style'=>"width: 30px; text-align: center;"),
					'header'=>'Operações',
					'class'=>'CButtonColumn',
					'template'=>'{update}',
					'buttons'=>array(
						'update' => array
						(
							'label'=>'Editar',
							'imageUrl'=>Yii::app()->request->baseUrl.'/images/editar.png',
							'url'=>'Yii::app()->createUrl("tipoObjetivo/formulario", array("CodTipoObjetivo"=>"$data->CodTipoObjetivo"))',
						),
					)
				),
			),
		));
	echo '</div>';
?>