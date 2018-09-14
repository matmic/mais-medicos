<?php

class InstituicaoController extends BaseController 
{
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodInstituicao']) && !empty($_GET['CodInstituicao']))
		{
			$instituicao = Instituicao::model()->findByPk($_GET['CodInstituicao']);
			
			if (empty($instituicao))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Instituição válida!');
			}
			else
				$this->render('formulario', array('instituicao'=>$instituicao));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['Instituicao']))
			{
				if (!empty($_POST['Instituicao']['CodInstituicao']))
				{
					$instituicao = Instituicao::model()->findByPk($_POST['Instituicao']['CodInstituicao']);
					if (empty($instituicao))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Instituição válida!');
						$this->redirect(array('instituicao/listar'));
					}
				}
				else
					$instituicao = new Instituicao();
				
				$instituicao->attributes = $_POST['Instituicao'];
				
				if (empty($_POST['Instituicao']['SiglaInstituicao']))
					$instituicao->SiglaInstituicao = NULL;

				if (!$instituicao->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar a Instituição!');
				else
					
					Yii::app()->user->setFlash('success', 'Instituição salva com sucesso!');

				$this->redirect(array('instituicao/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$instituicao = new Instituicao();
				$this->render('formulario', array('instituicao'=>$instituicao));
			}
		}
	}
	
	public function actionListar()
	{
		$instituicoes = Instituicao::model()->findAll(array('order'=>'NomeInstituicao ASC'));
		$dataProvider = new CArrayDataProvider($instituicoes, array(
			'keyField'=>'CodInstituicao',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}