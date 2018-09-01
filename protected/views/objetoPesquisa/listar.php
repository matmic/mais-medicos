<h4 class="c-grey-900 mB-20">Lista de Objetos de Pesquisa</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodObjetoPesquisa',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeObjetoPesquisa',
		),
		array(
			'header'=>'Objeto de Pesquisa Pai',
			'value'=>'isset($data->codObjetoPesquisaPai->NomeObjetoPesquisa) ? $data->codObjetoPesquisaPai->NomeObjetoPesquisa : "-"',
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
					'url'=>'Yii::app()->createUrl("objetoPesquisa/formulario", array("CodObjetoPesquisa"=>"$data->CodObjetoPesquisa"))',
				),
				'update' => array
				(
					'label'=>'Editar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("objetoPesquisa/formulario", array("CodObjetoPesquisa"=>"$data->CodObjetoPesquisa"))',
				),
			)
        ),
    ),
));
?>