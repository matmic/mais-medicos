<h4 class="c-grey-900 mB-20">Lista de Instituições</h4>
<?php
	echo CHtml::button('Nova Instituição', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("instituicao/formulario") . '"'));
	echo '<br /><br />';

	echo '<fieldset style="background-color: #F7F7F7;"><legend>Filtro</legend>';
		echo CHtml::beginForm(Yii::app()->createUrl('instituicao/listar'), 'GET', array('class'=>'container'));
		echo '<div class="form-group row">';
			echo CHtml::label('Nome ou Sigla da Instituição: ', 'lblNomeSiglaInst', array('class'=>'col-sm-3 col-form-label alinharDireita'));
			echo '<div class="col-sm-9">';
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
		echo '</div>';
			
		echo '<div class="text-center form-group row">';
			echo '<div class="col-sm-12">';
				echo CHtml::submitButton('Buscar', array('class'=>"btn btn-primary"));
			echo '</div>';
		echo '</div>';
	echo '</fieldset>';

	echo '<div class="table-responsive">';
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'gridInstituicoes',
			'dataProvider'=>$dataProvider,
			'itemsCssClass'=>'table table-striped table-bordered table-condensed',
			'columns'=>array(
				array(
					'header'=>'Nome',
					'value'=>'$data->NomeInstituicao',
				),
				array(
					'header'=>'Sigla',
					'value'=>'$data->SiglaInstituicao',
				),
				array(
					'htmlOptions'=>array('style'=>"width: 30px; text-align: center;"),
					'header'=>'Operações',
					'class'=>'CButtonColumn',
					'template'=>'{update}{deletar}',
					'buttons'=>array(
						'update' => array
						(
							'label'=>'Editar',
							'imageUrl'=>Yii::app()->request->baseUrl.'/images/editar.png',
							'url'=>'Yii::app()->createUrl("instituicao/formulario", array("CodInstituicao"=>"$data->CodInstituicao"))',
						),
						'deletar' => array
						(
							'label'=>'Deletar',
							'imageUrl'=>Yii::app()->request->baseUrl.'/images/remover.png',
							'url'=>'Yii::app()->createUrl("instituicao/remover", array("CodInstituicao"=>"$data->CodInstituicao"))',
							'click'=>"function(){
								if(confirm('Você tem certeza que deseja excluir essa Instituição?'))
								{
									$.ajax({
										type:'POST',
										url:$(this).attr('href'),
										success : function(retorno){ 
											alert(retorno);
											$.fn.yiiGridView.update('gridInstituicoes');
										},
									});
								}
							return false;
							}",
						),
					)
				),
			),
		));
	echo '</div>';
?>