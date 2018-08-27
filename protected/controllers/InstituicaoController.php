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
}