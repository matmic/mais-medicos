<h4 class="c-grey-900 mB-20">Lista de Abrangências</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'htmlOptions' => array(
		'class'=>'table table-striped table-bordered dataTable',
	),
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodAbrangencia',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeAbrangencia',
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
					'url'=>'Yii::app()->createUrl("abrangencia/formulario", array("CodAbrangencia"=>"$data->CodAbrangencia"))',
				),
				'update' => array
				(
					'label'=>'Editar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("abrangencia/formulario", array("CodAbrangencia"=>"$data->CodAbrangencia"))',
				),
			)
        ),
    ),
));
?>