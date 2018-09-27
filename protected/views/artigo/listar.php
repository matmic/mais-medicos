<h4 class="c-grey-900 mB-20">Lista de Artigos</h4>
<?php
	if (!Yii::app()->user->isGuest)
	{
		echo CHtml::button('Novo Artigo', array('class'=>'btn cur-p btn-primary', 'onClick'=>'window.location.href = "'. Yii::app()->createUrl("artigo/formulario") . '"'));
		echo '<br /><br />';
	}
	
	echo '<fieldset style="background-color: #F7F7F7;"><legend><img class="clicavel toggleField" src="'. Yii::app()->baseUrl . '/images/'. $imgUrl . '">Filtro</legend>';
		echo '<div id="divFieldset" class="' . ($filtroUsado ? 'collapse show' : 'collapse') .'">';
			echo CHtml::beginForm(Yii::app()->createUrl('artigo/listar'), 'GET', array('class'=>'container'));
			echo '<div class="form-group row">';
				echo CHtml::label('Nome do Artigo: ', 'lblNomeArtigo', array('class'=>'col-sm-3 col-form-label alinharDireita'));
				echo '<div class="col-sm-9">';
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'sourceUrl'=>array('auxiliar/autoCompleteArtigo'),
						'name'=>'NomeArtigo',
						'value' => $NomeArtigo,
						'options'=>array(
							'minLength'=>'3',
							'select'=>"js: function(event, ui) {
								$('#iptCodArtigo').val(ui.item['CodArtigo']);                   
							}"
						),
						'htmlOptions'=>array(
							'class'=>'form-control',
							'placeholder'=>'Digite o nome do artigo',
							'encode'=>false,
						),
					));
					echo CHtml::hiddenField('CodArtigo', $CodArtigo, array('id'=>'iptCodArtigo'));
				echo '</div>';
			echo '</div>';
			
			echo '<div class="form-group row">';
				echo CHtml::label('Ano de Publicação: ', 'lblAnoPublicacao', array('class'=>'col-sm-3 col-form-label alinharDireita'));
				echo '<div class="col-sm-9">';
					echo CHtml::numberField('AnoPublicacao', $AnoPublicacao, array('placeholder'=>'aaaa', 'class'=>'form-control', 'min'=>2000, 'max'=>2100));
				echo '</div>';
			echo '</div>';
			
			echo '<div class="form-group row">';
				echo CHtml::label('Objeto de Pesquisa: ', 'lblObjetoPesquisa', array('class'=>'col-sm-3 col-form-label alinharDireita'));
				echo '<div class="col-sm-9">';
					echo CHtml::dropDownList('CodObjetoPesquisa', $CodObjetoPesquisa, ObjetoPesquisa::getObjetosPesquisas(), array('empty'=>'Selecione...', 'class'=>'form-control'));
				echo '</div>';
			echo '</div>';
			
			echo '<div class="form-group row">';
				echo CHtml::label('Abrangência*: ', 'lblAbrangencia', array('class'=>'col-sm-3 col-form-label alinharDireita'));
				echo '<div class="col-sm-9">';
					echo CHtml::dropdownList('CodAbrangencia', $CodAbrangencia, Abrangencia::getAbrangencias(), array('empty'=>'Selecione...', 'class'=>'form-control'));
				echo '</div>';
			echo '</div>';
			
			echo '<div class="text-center form-group row">';
				echo '<div class="col-sm-12">';
					echo CHtml::submitButton('Filtrar', array('class'=>"btn btn-primary"));
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</fieldset>';
	
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
				'value'=>'$data->NomeRevistaConferencia',
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
				'htmlOptions'=>array('style'=>"width: 30px; text-align: center;"),
				'header'=>'Operações',
				'class'=>'CButtonColumn',
				'template'=>'{view} {update}',
				'buttons'=>array(
					'view'=>array
					(
						'label'=>'Visualizar',
						'imageUrl'=>Yii::app()->request->baseUrl.'/images/view-menor.png',
						'url'=>'Yii::app()->createUrl("artigo/visualizar", array("CodArtigo"=>"$data->CodArtigo"))',
					),
					'update' => array
					(
						'label'=>'Editar',
						'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit-menor.png',
						'url'=>'Yii::app()->createUrl("artigo/formulario", array("CodArtigo"=>"$data->CodArtigo"))',
						'visible'=>'Yii::app()->user->isGuest ? false : true',
					),
				)
			),
		),
	));
?>
<script>
	$(document).ready(function() {
		$('.toggleField').unbind('click');
	    $('.toggleField').click(function() {
	        if($(this).attr('src')=='<?php echo Yii::app()->baseUrl; ?>/images/contrair.gif') {
	            $(this).attr('src','<?php echo Yii::app()->baseUrl; ?>/images/expandir.gif');
	        } else {
	            $(this).attr('src','<?php echo Yii::app()->baseUrl; ?>/images/contrair.gif');
	        }
	        $('#divFieldset').slideToggle();
	    });
	    
	});
</script>