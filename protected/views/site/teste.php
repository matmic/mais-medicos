<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$dataProvider,
        'template'=>"{items}",
        'columns'=>array(
            array('name'=>'id', 'header'=>'#'),
            array('name'=>'firstName', 'header'=>'First name'),
            array('name'=>'lastName', 'header'=>'Last name'),
            array('name'=>'language', 'header'=>'Language'),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
    ));

    $model = new Instituicao();

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'verticalForm',
        'htmlOptions'=>array('class'=>'well'),
    ));
    
    echo CHtml::textField('Teste', 'teste', array('class'=>'span3'));

    echo $form->textFieldRow($model, 'NomeInstituicao', array('class'=>'span3'));
    echo $form->textFieldRow($model, 'SiglaInstituicao', array('class'=>'span3'));
    echo $form->checkboxRow($model, 'CodUF');
    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login'));
    $this->endWidget();

?>