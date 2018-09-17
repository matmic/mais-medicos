<h4 class="c-grey-900 mB-20">Lista de Instituições</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodInstituicao',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeInstituicao',
		),
		array(
			'header'=>'Sigla',
			'value'=>'$data->SiglaInstituicao',
		),
		array(
			'htmlOptions'=>array('style'=>"width: 30px;"),
			'header'=>'Operações',
            'class'=>'CButtonColumn',
			'template'=>'{update}',
			'buttons'=>array(
				'update' => array
				(
					'label'=>'Editar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("instituicao/formulario", array("CodInstituicao"=>"$data->CodInstituicao"))',
				),
			)
        ),
    ),
));
?>