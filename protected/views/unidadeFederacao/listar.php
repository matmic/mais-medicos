<h4 class="c-grey-900 mB-20">Lista de Estados Brasileiros</h4>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
    'columns'=>array(
        array(
			'header'=>'Código IBGE',
			'value'=>'$data->CodUF',
		),
		array(
			'header'=>'Nome',
			'value'=>'$data->NomeUF',
		),
		array(
			'header'=>'Sigla',
			'value'=>'$data->SiglaUF',
		),
    ),
));
?>