<h4 class="c-grey-900 mB-20">Dados do Artigo</h4>
<div class="mT-30">
<?php
	// DADOS DO ARTIGO
	echo '<div class="form-group row">';
		echo CHtml::label('Objeto da Pesquisa: ', 'lblObjetoPesquisa', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $artigo->ObjetoPesquisa->NomeObjetoPesquisa . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Nome do Artigo: ', 'lblNomeArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $artigo->NomeArtigo . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Autores: ', 'lblAutores', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
				echo '<span class="form-control-plaintext">' . $autores . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Resumo: ', 'lblResumoArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $artigo->Resumo . '</span>';echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Revista / Conferência: ', 'lblConfRevista', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $artigo->NomeRevistaConferencia . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Volume: ', 'lblVolume', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo '<span class="form-control-plaintext">' . (!empty($artigo->Volume) ? $artigo->Volume : "-") . '</span>';
		echo '</div>';
		
		echo CHtml::label('Ano da Publicação: ', 'lblAnoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo '<span class="form-control-plaintext">' . $artigo->AnoPublicacao . '</span>';
		echo '</div>';		
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Publicado em*: ', 'lblIndicadorRevConf', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div style="margin-top: 9px;" class="col-sm-4">';
			echo CHtml::radioButtonList('Artigo[IndicadorRevistaConferencia]', $artigo->IndicadorRevistaConferencia, array('R'=>'Revista', 'C'=>'Conferência'), array("disabled" => "disabled", 'style'=>'margin-left: 5px;', 'separator'=>'',));
		echo '</div>';
		
		echo CHtml::label('Páginas: ', 'lblPaginas', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo '<span class="form-control-plaintext">' . $artigo->Paginas . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Palavras-chave: ', 'lblPalavrasChaves', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $palavras . '</span>';
		echo '</div>';
	echo '</div>';
	// FIM DADOS DO ARTIGO
	
	// TIPOS DE PESQUISA
	echo '<div class="form-group row">';
		echo CHtml::label('Análise: ', 'lblAnalise', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
		echo '<div class="col-sm-2">';
			echo CHtml::checkBoxList('Artigo[Analise]', $analises, TipoAnalise::getTiposAnalises(), array("disabled" => "disabled"));
		echo '</div>';
		
		echo CHtml::label('Objetivo: ', 'lblObjetivo', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
		echo '<div class="col-sm-2">';
			echo CHtml::checkBoxList('Artigo[Objetivo]', $objetivos, TipoObjetivo::getTiposObjetivos(), array("disabled" => "disabled"));
		echo '</div>';
		
		echo CHtml::label('Procedimento: ', 'lblProcedimento', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
		echo '<div class="col-sm-2">';
			echo CHtml::checkBoxList('Artigo[Procedimento]', $procedimentos, TipoProcedimento::getTiposProcedimentos(), array("disabled" => "disabled"));
		echo '</div>';
	echo '</div>';
	// FIM TIPOS DE PESQUISA
	
	// MAPEAMENTO DAS PESQUISAS
	echo '<div class="form-group row">';
		echo CHtml::label('Instituições: ', 'lblInstituicao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $instituicoes . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Coordenador(es): ', 'lblCoordenador', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-10">';
			echo '<span class="form-control-plaintext">' . $coordenadores . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Multicêntrico: ', 'lblMulticentrico', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo CHtml::checkBox('Artigo[Multicentrico]', $artigo->IndicadorMulticentrico == 'S' ? true : false, array("disabled" => "disabled", 'style'=>'margin-top: 13px;'));
		echo '</div>';
		
		echo CHtml::label('Abrangência: ', 'lblAbrangencia', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo '<span class="form-control-plaintext">' . $artigo->Abrangencia->NomeAbrangencia . '</span>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Data Inicial do Estudo: ', 'lblDataInicioEstudo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
				echo '<span class="form-control-plaintext">' . $artigo->DataInicioEstudo . '</span>';
		echo '</div>';
		
		echo CHtml::label('Data Final do Estudo: ', 'lblDataFimEstudo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
		echo '<div class="col-sm-4">';
			echo '<span class="form-control-plaintext">' . $artigo->DataFimEstudo . '</span>';
		echo '</div>';
	echo '</div>';
	// FIM MAPEAMENTO PESQUISAS
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
	});
</script>