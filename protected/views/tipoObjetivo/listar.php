<h4 class="c-grey-900 mB-20">Lista de Objetivos</h4>
<?php	
	echo CHtml::button('Novo Objetivo', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("tipoObjetivo/formulario") . '"'));

	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodTipoObjetivo',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeTipoObjetivo',
		),
		array(
			'htmlOptions'=>array('style'=>"width: 30px;"),
			'header'=>'Operações',
            'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'buttons'=>array(
				'view'=>array
				(
					'label'=>'Visualizar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/view-menor.png',
					'url'=>'Yii::app()->createUrl("tipoObjetivo/formulario", array("CodTipoObjetivo"=>"$data->CodTipoObjetivo"))',
				),
				'update' => array
				(
					'label'=>'Editar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("tipoObjetivo/formulario", array("CodTipoObjetivo"=>"$data->CodTipoObjetivo"))',
				),
			)
        ),
    ),
));
?>