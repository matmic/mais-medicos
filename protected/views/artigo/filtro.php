<?php
	echo '<fieldset style="background-color: #F7F7F7;"><legend><img class="clicavel toggleField" src="'. $imgFiltro . '">Busca</legend>';
		echo '<div id="divFieldset" class="' . ($filtroUsado ? 'collapse show' : 'collapse') .'">';
			echo CHtml::beginForm(Yii::app()->createUrl('artigo/listar'), 'GET', array('class'=>'container', 'id'=>'frmFiltro'));

				echo '<div class="form-group row">';
					echo CHtml::label('Nome do Artigo: ', 'lblNomeArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'sourceUrl'=>array('auxiliar/autoCompleteArtigo'),
							'name'=>'Filtro[NomeArtigo]',
							'value' => $arrFiltros['NomeArtigo'],
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
						echo CHtml::hiddenField('Filtro[CodArtigo]', $arrFiltros['CodArtigo'], array('id'=>'iptCodArtigo'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Instituição: ', 'lblInstituicao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'sourceUrl'=>array('auxiliar/autoCompleteInstituicao'),
							'name'=>'Filtro[NomeInstituicao]',
							'value' =>$arrFiltros['NomeInstituicao'],
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
						echo CHtml::hiddenField('Filtro[CodInstituicao]', $arrFiltros['CodInstituicao'], array('id'=>'iptCodInstituicao'));
					echo '</div>';
				echo '</div>';
				
				echo '<div class="form-group row">';
					echo CHtml::label('Autor: ', 'lblAutor', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'sourceUrl'=>array('auxiliar/autoCompleteAutor'),
							'name'=>'Filtro[NomeAutor]',
							'value' =>$arrFiltros['NomeAutor'],
							'options'=>array(
								'minLength'=>'3',
								'select'=>"js: function(event, ui) {
									$('#iptCodAutor').val(ui.item['CodAutor']);
								}"
							),
							'htmlOptions'=>array(
								'class'=>'form-control',
								'placeholder'=>'Digite um autor',
								'encode'=>false,
							),
						));
						echo CHtml::hiddenField('Filtro[CodAutor]', $arrFiltros['CodAutor'], array('id'=>'iptCodAutor'));
					echo '</div>';
					
					echo CHtml::label('Palavra-chave: ', 'lblPalavra', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'sourceUrl'=>array('auxiliar/autoCompletePalavra'),
							'name'=>'Filtro[NomePalavra]',
							'value' =>$arrFiltros['NomePalavra'],
							'options'=>array(
								'minLength'=>'3',
								'select'=>"js: function(event, ui) {
									$('#iptCodPalavra').val(ui.item['CodPalavra']);
								}"
							),
							'htmlOptions'=>array(
								'class'=>'form-control',
								'placeholder'=>'Digite uma palavra',
								'encode'=>false,
							),
						));
						echo CHtml::hiddenField('Filtro[CodPalavra]', $arrFiltros['CodPalavra'], array('id'=>'iptCodPalavra'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Ano de Publicação: ', 'lblAnoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::textField('Filtro[AnoPublicacao]', $arrFiltros['AnoPublicacao'], array('maxLength'=>4, 'placeholder'=>'aaaa', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Abrangência: ', 'lblAbrangencia', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::dropdownList('Filtro[CodAbrangencia]', $arrFiltros['CodAbrangencia'], Abrangencia::getAbrangencias(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Tema da Pesquisa: ', 'lblObjetoPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::dropDownList('Filtro[CodObjetoPesquisa]', $arrFiltros['CodObjetoPesquisa'], ObjetoPesquisa::getObjetosPesquisas(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Publicado em: ', 'lblTipoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::dropDownList('Filtro[IndicadorRevistaConferencia]', $arrFiltros['IndicadorRevistaConferencia'], array(1=>'Conferência', 2=>'Revista'), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
				echo '</div>';
			
				echo '<div class="form-group row">';
					echo CHtml::label('Análise: ', 'lblObjetoPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-2">';
						echo CHtml::dropDownList('Filtro[CodTipoAnalise]', $arrFiltros['CodTipoAnalise'], TipoAnalise::getTiposAnalises(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Objetivo: ', 'lblTipoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-2">';
						echo CHtml::dropDownList('Filtro[CodTipoObjetivo]', $arrFiltros['CodTipoObjetivo'], TipoObjetivo::getTiposObjetivos(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
					echo CHtml::label('Procedimento: ', 'lblTipoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-2">';
						echo CHtml::dropDownList('Filtro[CodTipoProcedimento]', $arrFiltros['CodTipoProcedimento'], TipoProcedimento::getTiposProcedimentos(), array('empty'=>'Selecione...', 'class'=>'form-control'));
					echo '</div>';
				echo '</div>';
			
			echo CHtml::endForm();
			
			echo '<div class="text-center form-group row">';
				echo '<div class="col-sm-12">';
					echo CHtml::button('Buscar', array('class'=>"btn btn-primary", 'onClick'=>'enviarFiltros()'));
					echo CHtml::button('Limpar Filtros', array('style'=>'margin-left: 10px;', 'class'=>"btn btn-secondary", 'onClick'=>'limparFiltros()'));
				echo '</div>';
			echo '</div>';
		
		echo '</div>';
	echo '</fieldset>';
?>