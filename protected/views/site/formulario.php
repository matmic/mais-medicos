<h4 class="c-grey-900 mB-20">Cadastrar Usuário</h4>
<div class="mT-30">
<?php
	echo CHtml::beginForm(Yii::app()->createUrl('site/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
	echo '<div class="form-group row">';
		echo CHtml::label('Nome*: ', 'lblNome', array('class'=>'col-sm-2 col-form-label'));
		echo '<div class="col-sm-10">';
			echo CHtml::activeTextField($usuario, 'NomeUsuario', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o nome do usuário.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('E-mail*: ', 'lblEmail', array('class'=>'col-sm-2 col-form-label'));
		echo '<div class="col-sm-10">';
			echo CHtml::activeTextField($usuario, 'EmailUsuario', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira o email.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo CHtml::label('Senha*: ', 'lblEmail', array('class'=>'col-sm-2 col-form-label'));
		echo '<div class="col-sm-10">';
			echo CHtml::activeTextField($usuario, 'SenhaUsuario', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira a senha.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="form-group row">';
		echo '<div class="col-sm-12">';
			echo CHtml::submitButton('Salvar', array('class'=>"btn btn-primary"));
		echo '</div>';
	echo '</div>';
	
	echo CHtml::endForm();
	
?>
</div>