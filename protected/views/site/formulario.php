<h4 class="c-grey-900 mB-20">Cadastrar Usuário</h4>
<div class="mT-30">
<?php
	echo CHtml::beginForm(Yii::app()->createUrl('site/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
	echo '<div class="form-group row">';
		echo CHtml::label('Nome*: ', 'lblNome', array('class'=>'alinharDireita col-sm-3 col-form-label'));
		echo '<div class="col-sm-9">';
			echo CHtml::activeTextField($usuario, 'NomeUsuario', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o nome do usuário.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('E-mail*: ', 'lblEmail', array('class'=>'alinharDireita col-sm-3 col-form-label'));
		echo '<div class="col-sm-9">';
			echo CHtml::activeTextField($usuario, 'EmailUsuario', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o email.</div>';
		echo '</div>';
	echo '</div>';
	
	if ($usuario->isNewRecord)
	{
		echo '<div class="form-group row">';
			echo CHtml::label('Senha*: ', 'lblSenha', array('class'=>'alinharDireita col-sm-3 col-form-label'));
			echo '<div class="col-sm-9">';
				echo CHtml::passwordField('Usuario[SenhaUsuario]', '', array('required'=>true, 'class'=>'form-control'));
				echo '<div class="invalid-feedback">Por favor, insira a senha.</div>';
			echo '</div>';
		echo '</div>';
	}
	else
	{
		echo '<div class="form-group row">';
			echo CHtml::label('Senha (Preencha se quiser alterar)*: ', 'lblSenha', array('class'=>'alinharDireita col-sm-3 col-form-label'));
			echo '<div class="col-sm-9">';
				echo CHtml::passwordField('Usuario[SenhaUsuario]', '', array('class'=>'form-control'));
			echo '</div>';
		echo '</div>';
	}
	
	echo '<div class="form-group row">';
		echo CHtml::label('Ativo? ', 'lblAtivo', array('class'=>'alinharDireita col-sm-3 col-form-label'));
		echo '<div class="col-sm-9">';
			echo CHtml::checkbox('Usuario[IndicadorExclusao]', $usuario->IndicadorExclusao == NULL ? true : false, array('style'=>'margin-top: 13px;'));
		echo '</div>';
	echo '</div>';
	
	echo '<div class="text-center form-group row">';
		echo '<div class="col-sm-12">';
			echo CHtml::submitButton('Salvar', array('class'=>"btn btn-primary"));
		echo '</div>';
	echo '</div>';
	
	echo CHtml::activeHiddenField($usuario, 'CodUsuario', array());
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