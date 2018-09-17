<?php

class TipoAnaliseController extends BaseController 
{
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodTipoAnalise']) && !empty($_GET['CodTipoAnalise']))
		{
			$tipoAnalise = TipoAnalise::model()->findByPk($_GET['CodTipoAnalise']);
			
			if (empty($tipoAnalise))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Abordagem válida!');
				$this->redirect(array('tipoAnalise/listar'));
			}
			else
				$this->render('formulario', array('tipoAnalise'=>$tipoAnalise));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['TipoAnalise']))
			{
				if (!empty($_POST['TipoAnalise']['CodTipoAnalise']))
				{
					$tipoAnalise = TipoAnalise::model()->findByPk($_POST['TipoAnalise']['CodTipoAnalise']);
					if (empty($tipoAnalise))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Abordagem válida!');
						$this->redirect(array('tipoAnalise/listar'));
					}
				}
				else
					$tipoAnalise = new TipoAnalise();
				
				$tipoAnalise->attributes = $_POST['TipoAnalise'];
				
				if (isset($_POST['TipoAnalise']['IndicadorExclusao']))
					$tipoAnalise->IndicadorExclusao = NULL;
				else
					$tipoAnalise->IndicadorExclusao = 'S';

				if (!$tipoAnalise->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar a Abordagem!');
				else
					
					Yii::app()->user->setFlash('success', 'Abordagem salva com sucesso!');

				$this->redirect(array('tipoAnalise/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$tipoAnalise = new TipoAnalise();
				$this->render('formulario', array('tipoAnalise'=>$tipoAnalise));
			}
		}
	}
	
	public function actionListar()
	{
		$tipoAnalise = TipoAnalise::model()->findAll(array('order'=>'NomeTipoAnalise ASC'));
		$dataProvider = new CArrayDataProvider($tipoAnalise, array(
			'keyField'=>'CodTipoAnalise',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}