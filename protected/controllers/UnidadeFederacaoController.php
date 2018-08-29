<?php

class UnidadeFederacaoController extends BaseController 
{	
	public function actionListar()
	{
		$estados = UnidadeFederacao::model()->findAll(array('order'=>'NomeUF ASC'));
		$dataProvider = new CArrayDataProvider($estados, array(
			'keyField'=>'CodUF',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}