<?php

class PalavraController extends BaseController 
{
	public function actionListar()
	{
		$palavras = Palavra::model()->findAll(array('order'=>'NomePalavra ASC'));
		$dataProvider = new CArrayDataProvider($palavras, array(
			'keyField'=>'CodPalavra',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}