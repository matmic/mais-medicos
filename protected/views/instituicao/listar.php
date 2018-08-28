<fieldset>
	<h4 class="c-grey-900 mB-20">Lista de Instituições</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'htmlOptions' => array(
		'class'=>'table table-striped table-bordered dataTable',
	),
	'template'=>'{items}{summary}{pager}',
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
		array(            // display a column with "view", "update" and "delete" buttons
			'htmlOptions'=>array('style'=>"width: 30px;"),
			'header'=>'Operações',
            'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'buttons'=>array(
				'view'=>array
				(
					'label'=>'Send an e-mail to this user',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/view-menor.png',
					'url'=>'Yii::app()->createUrl("users/email", array())',
				),
				'update' => array
				(
					'label'=>'Teste',
					'url'=>'"#"',
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){alert("Going down!");}',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
				),
			)
        ),
    ),
));
?>
</fieldset>