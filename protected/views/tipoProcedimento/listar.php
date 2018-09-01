<h4 class="c-grey-900 mB-20">Lista de Procedimentos</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodTipoProcedimento',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeTipoProcedimento',
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
					'url'=>'Yii::app()->createUrl("tipoProcedimento/formulario", array("CodTipoProcedimento"=>"$data->CodTipoProcedimento"))',
				),
				'update' => array
				(
					'label'=>'Editar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("tipoProcedimento/formulario", array("CodTipoProcedimento"=>"$data->CodTipoProcedimento"))',
				),
			)
        ),
    ),
));
?>