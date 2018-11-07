<h4 class="c-grey-900 mB-20">Lista de Revistas</h4>
<?php
	echo CHtml::button('Nova Revista', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("revista/formulario") . '"'));

	echo '<div class="table-responsive">';
		if (!Yii::app()->user->isGuest)
		{
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'gridRevistas',
				'dataProvider'=>$dataProvider,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed',
				'columns'=>array(
					array(
						'header'=>'Revista',
						'value'=>'$data->NomeRevista',
					),
					array(
						'htmlOptions'=>array('style'=>"width: 30px; text-align: center;"),
						'header'=>'Visualizar',
						'class'=>'CButtonColumn',
						'template'=>'{update}',
						'buttons'=>array(
							'update' => array
							(
								'label'=>'Editar',
								'imageUrl'=>Yii::app()->request->baseUrl.'/images/editar.png',
								'url'=>'Yii::app()->createUrl("revista/formulario", array("CodRevista"=>"$data->CodRevista"))',
							),
						),
					),
				),
			));
		}
		else
		{
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'gridRevistas',
				'dataProvider'=>$dataProvider,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed',
				'columns'=>array(
					array(
						'header'=>'Revista',
						'value'=>'$data->NomeRevista',
					),
				),
			));
		}
	echo '</div>';
?>