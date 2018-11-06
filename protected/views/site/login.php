<div class="peers ai-s fxw-nw h-100vh">
	<div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(<?php echo Yii::app()->baseUrl; ?>/images/bg.jpg)">
		<div class="pos-a centerXY">
			<div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img class="pos-a centerXY" src="<?php echo Yii::app()->baseUrl; ?>/images/logo.png" alt=""></div>
		</div>
	</div>
	<div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r ps" style="min-width:320px">
		<h4 class="fw-300 c-grey-900">Login</h4>
		<span style="color: red;">Login restrito para administradores do sistema</span>
		<?php
			echo CHtml::beginForm(Yii::app()->createUrl('site/login'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
			echo '<div class="form-group row">';
				echo CHtml::label('E-mail: ', 'lblEmail', array('class'=>'text-normal text-dark'));
				echo '<div class="col-sm-10">';
					echo CHtml::activeTextField($usuario, 'EmailUsuario', array('required'=>true, 'class'=>'form-control'));
					echo '<div class="invalid-feedback">Por favor, insira o email.</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class="form-group row">';
				echo CHtml::label('Senha: ', 'lblEmail', array('class'=>'text-normal text-dark'));
				echo '<div class="col-sm-10">';
					echo CHtml::activePasswordField($usuario, 'SenhaUsuario', array('required'=>true, 'class'=>'form-control'));
					echo '<div class="invalid-feedback">Por favor, insira a senha.</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div class="form-group row">';
				echo '<div class="col-sm-12">';
					echo CHtml::submitButton('Login', array('class'=>"btn btn-primary"));
				echo '</div>';
			echo '</div>';
	
			echo CHtml::endForm();
		?>
		<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
			<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
		</div>
		<div class="ps__rail-y" style="top: 0px; right: 0px;">
			<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
		</div>
	</div>
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