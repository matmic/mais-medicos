<h4 class="c-grey-900 mB-20">Lista de Palavras-chave</h4>
<?php
	echo '<p>Para visualizar as palavras-chave mais utilizadas, clique <a href="' . Yii::app()->createUrl('grafico/palavra', array('Numero'=>10)) . '">aqui</a>!</p>';

	echo '<div class="table-responsive">';
		if (!Yii::app()->user->isGuest)
		{
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'gridPalavras',
				'dataProvider'=>$dataProvider,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed',
				'columns'=>array(
					array(
						'header'=>'Palavra',
						'value'=>'$data->NomePalavra',
					),
					array(
						'htmlOptions'=>array('style'=>"width: 30px; text-align: center;"),
						'header'=>'Visualizar',
						'class'=>'CButtonColumn',
						'template'=>'{update} {deletar}',
						'buttons'=>array(
							'update' => array
							(
								'label'=>'Editar',
								'imageUrl'=>Yii::app()->request->baseUrl.'/images/editar.png',
								'url'=>'Yii::app()->createUrl("palavra/formulario", array("CodPalavra"=>"$data->CodPalavra"))',
							),
							'deletar' => array
							(
								'label'=>'Deletar',
								'imageUrl'=>Yii::app()->request->baseUrl.'/images/remover.png',
								'url'=>'Yii::app()->createUrl("palavra/remover", array("CodPalavra"=>"$data->CodPalavra"))',
								'click'=>"function(){
									if(confirm('Você tem certeza que deseja excluir essa palavra-chave?'))
									{
										$.ajax({
											type:'POST',
											url:$(this).attr('href'),
											success : function(retorno){ 
												alert(retorno);
												$.fn.yiiGridView.update('gridPalavras');
											},
										});
									}
								return false;
								}",
							),
						),
					),
				),
			));
		}
		else
		{
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'gridPalavras',
				'dataProvider'=>$dataProvider,
				'itemsCssClass'=>'table table-striped table-bordered table-condensed',
				'columns'=>array(
					array(
						'header'=>'Palavra',
						'value'=>'$data->NomePalavra',
					),
				),
			));
		}
	echo '</div>';
?>