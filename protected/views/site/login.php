<h4 class="c-grey-900">Login</h4>
	<div class="mB-40">
		<span style="color: red;">O Login é restrito aos administradores do sistema</span>
	</div>
	<?php
		echo CHtml::beginForm(Yii::app()->createUrl('site/login'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
		echo '<div class="form-group row">';
			echo CHtml::label('E-mail: ', 'lblEmail', array('class'=>'col-sm-2 col-form-label alinharDireita'));
			echo '<div class="col-sm-10">';
				echo CHtml::activeTextField($usuario, 'EmailUsuario', array('required'=>true, 'class'=>'form-control'));
				echo '<div class="invalid-feedback">Por favor, insira o email.</div>';
			echo '</div>';
		echo '</div>';
		
		echo '<div class="form-group row">';
			echo CHtml::label('Senha: ', 'lblEmail', array('class'=>'col-sm-2 col-form-label alinharDireita'));
			echo '<div class="col-sm-10">';
				echo CHtml::activePasswordField($usuario, 'SenhaUsuario', array('required'=>true, 'class'=>'form-control'));
				echo '<div class="invalid-feedback">Por favor, insira a senha.</div>';
			echo '</div>';
		echo '</div>';
		
		echo '<div class="text-center form-group row">';
			echo '<div class="col-sm-12">';
				echo CHtml::submitButton('Login', array('class'=>"btn btn-primary"));
			echo '</div>';
		echo '</div>';

		echo CHtml::endForm();
	?>

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