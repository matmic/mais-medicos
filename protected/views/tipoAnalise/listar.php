<h4 class="c-grey-900 mB-20">Lista de Abordagens</h4>
<?php
	echo CHtml::button('Nova Abordagem', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("tipoAnalise/formulario") . '"'));

	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodTipoAnalise',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeTipoAnalise',
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
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("tipoAnalise/formulario", array("CodTipoAnalise"=>"$data->CodTipoAnalise"))',
				),
			)
        ),
    ),
));
?>