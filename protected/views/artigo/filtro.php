<?php
	echo '<fieldset style="background-color: #F7F7F7;"><legend><img class="clicavel toggleField" src="'. $imgFiltro . '">Filtro</legend>';
		echo '<div id="divFieldset" class="' . ($filtroUsado ? 'collapse show' : 'collapse') .'">';
			echo CHtml::beginForm(Yii::app()->createUrl('artigo/listar'), 'GET', array('class'=>'container', 'id'=>'frmFiltro'));

				echo '<div class="form-group row">';
					echo CHtml::label('Nome do Artigo: ', 'lblNomeArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
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
					echo CHtml::label('Instituição: ', 'lblInstituicao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'sourceUrl'=>array('auxiliar/autoCompleteInstituicao'),
							'name'=>'NomeInstituicao',
							'value' =>$NomeInstituicao,
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
						echo CHtml::hiddenField('CodInstituicao', $CodInstituicao, array('id'=>'iptCodInstituicao'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Ano de Publicação: ', 'lblAnoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::textField('AnoPublicacao', $AnoPublicacao, array('maxLength'=>4, 'placeholder'=>'aaaa', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Abrangência: ', 'lblAbrangencia', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::dropdownList('CodAbrangencia', $CodAbrangencia, Abrangencia::getAbrangencias(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Objeto de Pesquisa: ', 'lblObjetoPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::dropDownList('CodObjetoPesquisa', $CodObjetoPesquisa, ObjetoPesquisa::getObjetosPesquisas(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Publicado em: ', 'lblTipoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::dropDownList('IndicadorRevistaConferencia', $IndicadorRevistaConferencia, array(1=>'Conferência', 2=>'Revista'), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Análise: ', 'lblObjetoPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-2">';
						echo CHtml::dropDownList('CodTipoAnalise', $CodTipoAnalise, TipoAnalise::getTiposAnalises(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Objetivo: ', 'lblTipoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-2">';
						echo CHtml::dropDownList('CodTipoObjetivo', $CodTipoObjetivo, TipoObjetivo::getTiposObjetivos(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Procedimento: ', 'lblTipoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-2">';
						echo CHtml::dropDownList('CodTipoProcedimento', $CodTipoProcedimento, TipoProcedimento::getTiposProcedimentos(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
				echo '</div>';
			
			echo CHtml::endForm();
			
			echo '<div class="text-center form-group row">';
				echo '<div class="col-sm-12">';
					echo CHtml::button('Filtrar', array('class'=>"btn btn-primary", 'onClick'=>'$("#frmFiltro").submit()'));
					echo CHtml::button('Limpar Filtros', array('style'=>'margin-left: 10px;', 'class'=>"btn btn-secondary", 'onClick'=>'limparFiltros()'));
				echo '</div>';
			echo '</div>';
		
		echo '</div>';
	echo '</fieldset>';
?>