<h4 class="c-grey-900 mB-20">Lista de Instituições</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodArtigo',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeArtigo',
		),
		array(
			'header'=>'Objeto de Pesquisa',
			'value'=>'$data->ObjetoPesquisa->NomeObjetoPesquisa',
		),
		array(
			'header'=>'Revista / Conferência',
			'value'=>'$data->RevistaConferencia',
		),
		array(
			'header'=>'Volume',
			'value'=>'empty($data->Volume) ? "-" : $data->Volume',
		),
		array(
			'header'=>'Ano de Publicação',
			'value'=>'$data->AnoPublicacao',
		),
		array(
			'header'=>'Abrangência',
			'value'=>'$data->Abrangencia->NomeAbrangencia',
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
					'url'=>'Yii::app()->createUrl("artigo/formulario", array("CodArtigo"=>"$data->CodArtigo"))',
				),
				'update' => array
				(
					'label'=>'Editar',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
					'url'=>'Yii::app()->createUrl("artigo/formulario", array("CodArtigo"=>"$data->CodArtigo"))',
				),
			)
        ),
    ),
));
?>