<style>
	.alinharDireita {
		text-align: right;
	}
	
	fieldset 
	{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		/*padding: 10px; */
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		/*padding-left:10px!important;*/
	}
	
	fieldset fieldset
	{
		background-color: white;
	}
	
	legend
	{
		font-size:14px;
		font-weight:bold;
		margin-bottom: 0px; 
		width: auto; 
		border: 1px solid #ddd;
		border-radius: 4px; 
		padding: 5px 5px 5px 10px; 
		background-color: #ffffff;
	}
</style>

<!--<h4 class="c-grey-900 mB-20">Formulário Artigo</h4>-->
<fieldset>
	<legend style="font-size: 150%;">Formulário Artigo</legend>
	<div class="mT-30">
		<?php
			echo CHtml::beginForm(Yii::app()->createUrl('tipoObjetivo/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
			echo '<fieldset><legend>Dados do Artigo</legend>';
				echo '<div class="form-group row">';
					echo CHtml::label('Nome do Artigo*: ', 'lblNomeArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						echo CHtml::textField('Artigo[Nome]', '', array('required'=>true, 'class'=>'form-control'));
						echo '<div class="invalid-feedback">Por favor, insira o nome do artigo.</div>';
					echo '</div>';
				echo '</div>';
				
				echo '<div class="form-group row">';
					echo CHtml::label('Conferência / Revista*: ', 'lblConfRevista', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						echo CHtml::textField('Artigo[ConferenciaRevista]', '', array('required'=>true, 'class'=>'form-control'));
						echo '<div class="invalid-feedback">Por favor, insira o nome da conferência ou revista em que o artigo foi publicado.</div>';
					echo '</div>';
				echo '</div>';
				
				echo '<div class="form-group row">';
					echo CHtml::label('Volume: ', 'lblVolume', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::textField('Artigo[Volume]', '', array('class'=>'form-control'));
						echo '<div class="invalid-feedback">Por favor, insira o volume da revista em que o artigo foi publicado.</div>';
					echo '</div>';
					
					echo CHtml::label('Ano da Publicação: ', 'lblAnoPublicacao', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
						echo CHtml::numberField('Artigo[AnoPublicacao]', '', array('placeholder'=>'aaaa', 'class'=>'form-control'));
						echo '<div class="invalid-feedback">Por favor, insira ano da publicação.</div>';
					echo '</div>';		
				echo '</div>';
				
				echo '<div class="form-group row">';
					echo CHtml::label('Autores*: ', 'lblAutores', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						echo CHtml::dropdownList('Artigo[Autor]', '', TipoObjetivo::getTiposObjetivos(), array('encode'=>false, 'multiple'=>true, 'required'=>true, 'class'=>'form-control'));
						echo '<div class="invalid-feedback">Por favor, insira pelo menos um autor.</div>';
					echo '</div>';
				echo '</div>';
				
				echo '<div class="form-group row">';
					echo CHtml::label('Resumo*: ', 'lblResumoArtigo', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						echo CHtml::textArea('Artigo[Resumo]', '', array('required'=>true, 'class'=>'form-control', 'rows'=>6));
						echo '<div class="invalid-feedback">Por favor, insira o resumo do artigo.</div>';
					echo '</div>';
				echo '</div>';
				
				echo '<div class="form-group row">';
					echo CHtml::label('Palavras-chave*: ', 'lblPalavrasChaves', array('class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-10">';
						echo CHtml::dropdownList('Artigo[Palavras]', '', array(), array('encode'=>false, 'multiple'=>true, 'required'=>true, 'class'=>'form-control'));
						echo '<div class="invalid-feedback">Por favor, insira pelo menos uma palavra-chave.</div>';
					echo '</div>';
				echo '</div>';
			echo '</fieldset>';
			
			echo '<fieldset><legend>Tipo de Pesquisa</legend>';
				echo '<div class="form-group row">';
					echo CHtml::label('Análise: ', 'lblAnalise', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
					echo '<div class="col-sm-2">';
						echo CHtml::checkBoxList('Artigo[Analise]', '', array('1'=>'Quali', '2'=>'Quant'), array('class'=>'form-check-input'));
						echo '<div class="invalid-feedback">Por favor, insira o volume da revista em que o artigo foi publicado.</div>';
					echo '</div>';
					
					echo CHtml::label('Procedimento: ', 'lblProcedimento', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
					echo '<div class="col-sm-2">';
						echo CHtml::checkBoxList('Artigo[Procedimento]', '', array('1'=>'Quali', '2'=>'Quant'), array());
						echo '<div class="invalid-feedback">Por favor, insira o volume da revista em que o artigo foi publicado.</div>';
					echo '</div>';
					
					echo CHtml::label('Objetivo: ', 'lblObjetivo', array('class'=>'col-sm-2 col-form-label alinharDireita', 'style'=>'margin-top: -10px;'));
					echo '<div class="col-sm-2">';
						echo CHtml::checkBoxList('Artigo[Objetivo]', '', array('1'=>'Quali', '2'=>'Quant'), array());
						echo '<div class="invalid-feedback">Por favor, insira o volume da revista em que o artigo foi publicado.</div>';
					echo '</div>';
				echo '</div>';
			echo '</fieldset>';
			
			echo '<fieldset><legend>Mapeamento das Pesquisas</legend>';
				echo '<div class="form-group row">';
					echo CHtml::label('Data Inicial do Estudo*: ', 'lblDataInicioEstudo', array('required'=>true, 'class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name' =>'PessoaFamilia[DataNascimento]',
								'value'=>'',
								'options' => array(
									'showAnim' => 'slideDown',
									'dateFormat'=>'dd/mm/yy',
									'dayNamesMin'=>'DSTQQSS',
								),
								'language' => 'pt',
								'htmlOptions'=>array('placeholder'=>'dd/mm/aaaa', 'class'=>'date form-control'),
							));
							echo '<div class="invalid-feedback">Por favor, insira a data de início do estudo.</div>';
					echo '</div>';
					
					echo CHtml::label('Data Fim do Estudo*: ', 'lblDataFimEstudo', array('required'=>true, 'class'=>'col-sm-2 col-form-label alinharDireita'));
					echo '<div class="col-sm-4">';
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name' =>'PessoaFamilia[DataNascimento]',
								'value'=>'',
								'options' => array(
									'showAnim' => 'slideDown',
									'dateFormat'=>'dd/mm/yy',
									'dayNamesMin'=>'DSTQQSS',
								),
								'language' => 'pt',
								'htmlOptions'=>array('placeholder'=>'dd/mm/aaaa', 'class'=>'date form-control'),
							));
							echo '<div class="invalid-feedback">Por favor, insira o tipo de objetivo.</div>';
					echo '</div>';
				echo '</div>';
			echo '</fieldset>';
			
			echo '<div class="form-group row">';
				echo '<div class="col-sm-12">';
					echo CHtml::submitButton('Salvar', array('class'=>"btn btn-primary"));
				echo '</div>';
			echo '</div>';
	
			echo CHtml::hiddenField('Artigo[CodArtigo]', '', array());
			echo CHtml::endForm();
		?>
	</div>
</fieldset>

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
	
		$('#Artigo_Palavras').tokenize2({
			dataSource: 'select',
			tokensAllowCustom: true,
		});
	});
	
	
</script>