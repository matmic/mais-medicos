<h4 class="c-grey-900 mB-20">Lista de Palavras-chave</h4>
<?php
	echo '<p>Para visualizar as palavras-chave mais utilizadas, clique <a href="' . Yii::app()->createUrl('grafico/palavra') . '">aqui</a>!</p>';

	echo '<div class="table-responsive">';
		$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'columns'=>array(
				array(
					'header'=>'Palavra',
					'value'=>'$data->NomePalavra',
				),
			),
		));
	echo '</div>';
?>