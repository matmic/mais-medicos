<?php

class InstituicaoController extends BaseController 
{
	public function actionFormulario()
	{
		if (isset($_GET['CodInstituicao']) && !empty($_GET['CodInstituicao']))
		{
		
		}
		else
		{
			if (isset($_POST['Instituicao']) && !empty($_POST['Instituicao']))
			{
			
			}
			else
			{
				$instituicao = new Instituicao();
				$this->render('formulario', array());
			}
		}
	}
	
	public function actionListar()
	{
		$instituicoes = Instituicao::model()->findAll();
		$dataProvider = new CArrayDataProvider($instituicoes, array(
			'keyField'=>'CodInstituicao',
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}