<h4 class="c-grey-900 mB-20">Formulário Objeto de Pesquisa</h4>
<div class="mT-30">
<?php
	echo CHtml::beginForm(Yii::app()->createUrl('objetoPesquisa/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
	echo '<div class="form-group row">';
		echo CHtml::label('Objeto de Pesquisa (Eixo do Programa Mais Médicos)*: ', 'lblObjetoPesquisa', array('class'=>'alinharDireita col-sm-4 col-form-label'));
		echo '<div class="col-sm-8">';
			echo CHtml::activeTextField($objetoPesquisa, 'NomeObjetoPesquisa', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o objeto de pesquisa.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Subcategoria do Objeto de Pesquisa: ', 'lblCategoria', array('class'=>'alinharDireita col-sm-4 col-form-label'));
		echo '<div class="col-sm-8">';
			echo CHtml::activeDropDownList($objetoPesquisa, 'CodObjetoPesquisaPai', ObjetoPesquisa::getObjetosPesquisasPais(), array('empty'=>'Selecione...', 'class'=>'form-control'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Ativo? ', 'lblAtivo', array('class'=>'alinharDireita col-sm-4 col-form-label'));
		echo '<div class="col-sm-8">';
			echo CHtml::checkBox('ObjetoPesquisa[IndicadorExclusao]', $objetoPesquisa->IndicadorExclusao == NULL ? true : false, array('style'=>'margin-top: 13px;'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="text-center form-group row">';
		echo '<div class="col-sm-10">';
			echo CHtml::submitButton('Salvar', array('class'=>"btn btn-primary"));
		echo '</div>';
	echo '</div>';
	
	echo CHtml::activeHiddenField($objetoPesquisa, 'CodObjetoPesquisa', array());
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
</script>