<h4 class="c-grey-900 mB-20">Formulário Abrangência</h4>
<div class="mT-30">
<?php
	echo CHtml::beginForm(Yii::app()->createUrl('abrangencia/formulario'), 'POST', array('id'=>'needs-validation', 'class'=>'container', 'noValidate'=>""));
	
	echo '<div class="form-group row">';
		echo CHtml::label('Abrangência*: ', 'lblAbrangencia', array('class'=>'alinharDireita col-sm-2 col-form-label'));
		echo '<div class="col-sm-10">';
			echo CHtml::activeTextField($abrangencia, 'NomeAbrangencia', array('required'=>true, 'class'=>'form-control'));
			echo '<div class="invalid-feedback">Por favor, insira a abrangência.</div>';
		echo '</div>';
	echo '</div>';
	
	echo '<div class="text-center form-group row">';
		echo '<div class="col-sm-12">';
			echo CHtml::submitButton('Salvar', array('class'=>"btn btn-primary"));
		echo '</div>';
	echo '</div>';
	
	echo CHtml::activeHiddenField($abrangencia, 'CodAbrangencia', array());
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