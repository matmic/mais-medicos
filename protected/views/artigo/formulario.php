<h4 class="c-grey-900 mB-20">Formulário Artigo</h4>
<div class="mT-30">

<!-- DIV QUE APARECE QUANDO FAZ UMA CHAMADA AJAX -->
<div id="overlayDiv" class="overlayDiv" style="display: none;">
	<div class="loadingImg"><img src="<?php echo Yii::app()->baseUrl?>/images/loading-big.gif" /></div>
</div>
<?php
	echo CHtml::beginForm(Yii::app()->createUrl('artigo/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
	// DADOS DO ARTIGO
	echo '<div class="form-group row">';
		echo CHtml::label('Tema de Pesquisa*: ', 'lblTemaPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropDownList('Artigo[CodObjetoPesquisa]', $artigo->CodObjetoPesquisa, ObjetoPesquisa::getObjetosPesquisas(), array('empty'=>'Selecione...', 'encode'=>false, 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, selecione o tema de pesquisa.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Título*: ', 'lblNomeArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			//echo CHtml::textField('Artigo[Nome]', $artigo->NomeArtigo, array('required'=>true, 'class'=>'form-control'));
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'sourceUrl'=>array('auxiliar/autoCompleteArtigo'),
				'name'=>'Artigo[Nome]',
				'value' => $artigo->NomeArtigo,
				'options'=>array(
					'minLength'=>'3',
				),
				'htmlOptions'=>array(
					'class'=>'form-control',
					'placeholder'=>'Digite o nome do artigo',
					'required'=>true,
				),
			));
			echo '<div class="invalid-feedback">Por favor, insira o nome do artigo.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Título em inglês: ', 'lblNomeArtigoIngles', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::textField('Artigo[NomeIngles]', $artigo->NomeArtigoIngles, array('class'=>'form-control'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Autores*: ', 'lblAutores', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropdownList('Artigo[Autor]', $autores, Autor::getAutores(), array('encode'=>false, 'multiple'=>true, 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira pelo menos um autor.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Resumo*: ', 'lblResumoArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::textArea('Artigo[Resumo]', $artigo->Resumo, array('required'=>true, 'class'=>'form-control', 'rows'=>6));
			echo '<div class="invalid-feedback">Por favor, insira o resumo do artigo.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Tipo de Publicação*: ', 'lblIndicadorRevConf', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div style="margin-top: 9px;" class="col-sm-4">';
			echo CHtml::radioButtonList('Artigo[IndicadorRevistaConferencia]', $artigo->IndicadorRevistaConferencia, array('R'=>'Revista', 'C'=>'Conferência'), array('style'=>'margin-left: 5px;', 'separator'=>'',));
			echo '<div class="invalid-feedback">Por favor, selecione onde foi publicado o artigo.</div>';
		echo '</div>';
		
		// echo CHtml::label('Revista / Conferência: ', 'lblConfRevista', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		// echo '<div class="col-sm-4">';
			// echo CHtml::textField('Artigo[RevistaConferencia]', $artigo->NomeRevistaConferencia, array('class'=>'form-control'));
		// echo '</div>';
		echo CHtml::label('Revista / Conferência: ', 'lblConfRevista', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::dropDownList('Artigo[RevistaConferencia]', $artigo->CodRevista, Revista::getRevistas(), array('empty'=>'Selecione...', 'class'=>'form-control'));
		echo '</div>';
		
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Volume: ', 'lblVolume', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::textField('Artigo[Volume]', $artigo->Volume, array('class'=>'form-control'));
		echo '</div>';
		
		echo CHtml::label('Número: ', 'lblNumero', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::textField('Artigo[Numero]', $artigo->Numero, array('maxLength'=>4, 'class'=>'form-control'));
		echo '</div>';		
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Ano da Publicação*: ', 'lblAnoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::textField('Artigo[AnoPublicacao]', $artigo->AnoPublicacao, array('maxLength'=>4, 'placeholder'=>'aaaa', 'class'=>'form-control', 'required'=>true));
			echo '<div class="invalid-feedback">Por favor, insira ano da publicação.</div>';
		echo '</div>';	
		
		echo CHtml::label('Páginas: ', 'lblPaginas', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::textField('Artigo[Paginas]', $artigo->Paginas, array('class'=>'form-control'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Palavras-chave*: ', 'lblPalavrasChaves', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropdownList('Artigo[Palavra]', $palavras, Palavra::getPalavras(), array('encode'=>false, 'multiple'=>true, 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira pelo menos uma palavra-chave.</div>';
		echo '</div>';
	echo '</div>';
	// FIM DADOS DO ARTIGO
	
	// TIPOS DE PESQUISA
	echo '<div class="form-group row">';
		echo CHtml::label('Análise: ', 'lblAnalise', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
		echo '<div class="col-sm-2">';
			echo CHtml::checkBoxList('Artigo[Analise]', $analises, TipoAnalise::getTiposAnalises(), array());
		echo '</div>';
		
		echo CHtml::label('Objetivo: ', 'lblObjetivo', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
		echo '<div class="col-sm-2">';
			echo CHtml::checkBoxList('Artigo[Objetivo]', $objetivos, TipoObjetivo::getTiposObjetivos(), array());
		echo '</div>';
		
		echo CHtml::label('Procedimento: ', 'lblProcedimento', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
		echo '<div class="col-sm-2">';
			echo CHtml::checkBoxList('Artigo[Procedimento]', $procedimentos, TipoProcedimento::getTiposProcedimentos(), array());
		echo '</div>';
	echo '</div>';
	// FIM TIPOS DE PESQUISA
	
	// MAPEAMENTO DAS PESQUISAS
	echo '<div class="form-group row">';
		echo CHtml::label('Instituições*: ', 'lblInstituicao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropdownList('Artigo[Instituicao]', $instituicoes, Instituicao::getInstituicoes(), array('encode'=>false, 'multiple'=>true, 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira pelo menos uma instituição.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Coordenador(es): ', 'lblCoordenador', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropdownList('Artigo[Coordenador]', $coordenadores, Coordenador::getCoordenadores(), array('encode'=>false, 'multiple'=>true, 'class'=>'form-control'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Url: ', 'lblUrl', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::textField('Artigo[UrlArtigo]', $artigo->UrlArtigo, array('class'=>'form-control'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Multicêntrico: ', 'lblMulticentrico', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
				echo CHtml::checkBox('Artigo[Multicentrico]', $artigo->IndicadorMulticentrico == 'S' ? true : false, array('style'=>'margin-top: 13px;'));
		echo '</div>';
		
		echo CHtml::label('Abrangência*: ', 'lblAbrangencia', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::dropdownList('Artigo[CodAbrangencia]', $artigo->CodAbrangencia, Abrangencia::getAbrangencias(), array('empty'=>'Selecione...', 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, selecione uma abrangência.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Data Inicial do Estudo: ', 'lblDataInicioEstudo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name' =>'Artigo[DataInicioEstudo]',
					'value'=>$artigo->DataInicioEstudo,
					'options' => array(
						'showAnim' => 'slideDown',
						'dateFormat'=>'dd/mm/yy',
						'dayNamesMin'=>'DSTQQSS',
					),
					'language' => 'pt',
					'htmlOptions'=>array('placeholder'=>'dd/mm/aaaa', 'class'=>'date form-control'),
				));
		echo '</div>';
		
		echo CHtml::label('Data Final do Estudo: ', 'lblDataFimEstudo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name' =>'Artigo[DataFimEstudo]',
					'value'=>$artigo->DataFimEstudo,
					'options' => array(
						'showAnim' => 'slideDown',
						'dateFormat'=>'dd/mm/yy',
						'dayNamesMin'=>'DSTQQSS',
					),
					'language' => 'pt',
					'htmlOptions'=>array('placeholder'=>'dd/mm/aaaa', 'class'=>'date form-control'),
				));
		echo '</div>';
	echo '</div>';
	// FIM MAPEAMENTO PESQUISAS
	
	echo '<div class="text-center form-group row">';
		echo '<div class="col-sm-12">';
			echo CHtml::button('Salvar', array('onClick'=>'salvarArtigo()', 'class'=>"btn btn-primary"));
		echo '</div>';
	echo '</div>';
	
	echo CHtml::hiddenField('Artigo[CodArtigo]', $artigo->CodArtigo, array());
	echo CHtml::endForm();
?>
</div>

<script>
	$(document).ready(function(){
		$('#Artigo_Autor').tokenize2({
			dataSource: 'select',
			tokensAllowCustom: true,
		});
	
		$('#Artigo_Palavra').tokenize2({
			dataSource: 'select',
			tokensAllowCustom: true,
		});
		
		$('#Artigo_Instituicao').tokenize2({
			dataSource: 'select',
			tokensAllowCustom: false,
			searchFromStart: false,
			searchMinLength: 3,
			dropdownMaxItems: 4,
		});
		
		$('#Artigo_Coordenador').tokenize2({
			dataSource: 'select',
			tokensAllowCustom: true,
		});
		
		$('#Artigo_AnoPublicacao').mask('0000');
		$('#Artigo_Numero').mask('0000');
		$('#Artigo_DataInicioEstudo').mask('00/00/0000');
		$('#Artigo_DataFimEstudo').mask('00/00/0000');
	});
	
	function salvarArtigo() 
	{
		var hasError = false;
		var msg = 'Por favor, corrija o(s) seguinte(s) erro(s): \n';
		
		var e = document.getElementById("needs-validation");
		if (!1 === e.checkValidity())
		{
			hasError = true;
			e.classList.add("was-validated");
			return false;
		}
		
		if (!hasError)
		{
			if ($('#Artigo_AnoPublicacao').val().length < 4)
			{
				msg += ' - Ano de Publicação deve estar no formato aaaa;\n';
				hasError = true;
			}
			
			if ($('#Artigo_DataInicioEstudo').val().length > 0 && $('#Artigo_DataInicioEstudo').val().length < 10)
			{
				msg += ' - Data Inicial do Estudo deve estar no formato dd/mm/aaaa;\n';
				hasError = true;
			}
			
			if ($('#Artigo_DataFimEstudo').val().length > 0 && $('#Artigo_DataFimEstudo').val().length < 10)
			{
				msg += ' - Data Final do Estudo deve estar no formato dd/mm/aaaa;\n';
				hasError = true;
			}
			
			if (!hasError)
			{
				var data = $("#needs-validation").serialize();
				
				$.ajax({
					type: 'POST',
					url: '<?php echo Yii::app()->createAbsoluteUrl("artigo/formulario"); ?>',
					data:data,
					beforeSend:function(){
						$('#overlayDiv').show();    
					},
					success:function(retorno)
					{
						$('#overlayDiv').hide(); 
						var obj = JSON.parse(retorno);

						if (obj.erro == 0)
						{
							alert(obj.msg);
							window.location.href = "<?php echo Yii::app()->createUrl('artigo/listar'); ?>";
						}
						else
							alert('Por favor, corrija o(s) seguinte(s) erro(s):\n' + obj.msg);
					},
					dataType:'html',
				});
			}
			else
			{
				alert(msg);
				return false;
			}
		}
	}	
</script>