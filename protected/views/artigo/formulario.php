<h4 class="c-grey-900 mB-20">Formulário Artigo</h4>
<div class="mT-30">
<?php
	echo CHtml::beginForm(Yii::app()->createUrl('artigo/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
	// DADOS DO ARTIGO
	echo '<div class="form-group row">';
		echo CHtml::label('Objeto da Pesquisa*: ', 'lblObjetoPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropDownList('Artigo[CodObjetoPesquisa]', $artigo->CodObjetoPesquisa, ObjetoPesquisa::getObjetosPesquisas(), array('empty'=>'Selecione...', 'encode'=>false, 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o nome do artigo.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Nome do Artigo*: ', 'lblNomeArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::textField('Artigo[Nome]', $artigo->NomeArtigo, array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o nome do artigo.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Revista / Conferência*: ', 'lblConfRevista', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::textField('Artigo[RevistaConferencia]', $artigo->NomeRevistaConferencia, array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o nome da conferência ou revista em que o artigo foi publicado.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Volume: ', 'lblVolume', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::textField('Artigo[Volume]', $artigo->Volume, array('class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o volume da revista em que o artigo foi publicado.</div>';
		echo '</div>';
		
		echo CHtml::label('Ano da Publicação*: ', 'lblAnoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::numberField('Artigo[AnoPublicacao]', $artigo->AnoPublicacao, array('placeholder'=>'aaaa', 'class'=>'form-control', 'min'=>2000, 'max'=>2100));
			echo '<div class="invalid-feedback">Por favor, insira ano da publicação.</div>';
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
		echo CHtml::label('Coordenador(es)*: ', 'lblCoordenador', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo CHtml::dropdownList('Artigo[Coordenador]', $coordenadores, Coordenador::getCoordenadores(), array('encode'=>false, 'multiple'=>true, 'required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira pelo menos um coordenador.</div>';
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
			echo '<div class="invalid-feedback">Por favor, escolha uma abrangência.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Data Inicial do Estudo*: ', 'lblDataInicioEstudo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
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
					'htmlOptions'=>array('required'=>true, 'placeholder'=>'dd/mm/aaaa', 'class'=>'date form-control'),
				));
				echo '<div class="invalid-feedback">Por favor, insira a data de início do estudo.</div>';
		echo '</div>';
		
		echo CHtml::label('Data Final do Estudo*: ', 'lblDataFimEstudo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
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
					'htmlOptions'=>array('required'=>true, 'placeholder'=>'dd/mm/aaaa', 'class'=>'date form-control'),
				));
				echo '<div class="invalid-feedback">Por favor, insira a data final do estudo.</div>';
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
    !function() {
        "use strict";
        window.addEventListener("load", function() {
            var e = document.getElementById("needs-validation");
            e.addEventListener("submit", function(t) {
                !1 === e.checkValidity() && (t.preventDefault(), t.stopPropagation()), e.classList.add("was-validated")
            }, !1)
        }, !1)
    }()

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
	});
	
	function salvarArtigo()
	{
		var data = $("#needs-validation").serialize();
		
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->createAbsoluteUrl("artigo/formulario"); ?>',
			data:data,
			success:function(retorno)
			{
				var obj = JSON.parse(retorno);

				if (obj.erro == 0)
				{
					alert(obj.msg);
					window.location.href = "<?php echo Yii::app()->createUrl('artigo/listar'); ?>";
				}
				else
					alert('Por favor, corrija o(s) seguinte(s) erro(s):\n' + obj.msg);
				
				// if (obj.erro == 0) {
					// alert('ok');
				// }
			},
			dataType:'html',
		});
	}
</script>