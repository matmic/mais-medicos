<h4 class="c-grey-900 mB-20">Lista de Instituições</h4>
<?php
	echo '<fieldset><legend>Filtro</legend>';
		echo CHtml::beginForm(Yii::app()->createUrl('instituicao/listar'), 'POST', array('class'=>'container'));
		echo '<div class="form-group row">';
			echo CHtml::label('Nome ou Sigla da Instituição: ', 'lblNomeSiglaInst', array('class'=>'col-sm-3 col-form-label alinharDireita'));
			echo '<div class="col-sm-8">';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'sourceUrl'=>array('auxiliar/autoCompleteInstituicao'),
					'name'=>'Instituicao[NomeInstituicao]',
					'value' => $NomeInstituicao,
					'options'=>array(
						'minLength'=>'3',
						'select'=>"js: function(event, ui) {
							$('#iptCodInstituicao').val(ui.item['CodInstituicao']);                   
						}"
					),
					'htmlOptions'=>array(
						'class'=>'form-control',
						'placeholder'=>'Digite o nome ou sigla da instituição',
						'encode'=>false,
					),
				));
				echo CHtml::hiddenField('Instituicao[CodInstituicao]', $CodInstituicao, array('id'=>'iptCodInstituicao'));
			echo '</div>';
			
			echo '<div class="col-sm-1">';
				echo CHtml::submitButton('Filtrar', array('class'=>"btn btn-primary"));
			echo '</div>';
		echo '</div>';
	echo '</fieldset>';

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