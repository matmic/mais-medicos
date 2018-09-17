<h4 class="c-grey-900 mB-20">Lista de Abrangências</h4>
<?php
	echo CHtml::button('Nova Abrangência', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("abrangencia/formulario") . '"'));
	
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
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
			'template'=>'{update}',
			'buttons'=>array(
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