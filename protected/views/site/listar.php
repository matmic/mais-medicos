﻿<h4 class="c-grey-900 mB-20">Lista de Usuários</h4>
<?php
	echo CHtml::button('Novo Usuário', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("site/formulario") . '"'));
	
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'#',
			'value'=>'$data->CodUsuario',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeUsuario',
		),
		array(
			'header'=>'Email',
			'value'=>'$data->EmailUsuario',
		),
		array(
			'header'=>'Ativo?',
			'value'=>'($data->IndicadorExclusao == "S") ? "Não" : "Sim"',
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
					'url'=>'Yii::app()->createUrl("site/formulario", array("CodUsuario"=>"$data->CodUsuario"))',
				),
			)
        ),
    ),
));
?>