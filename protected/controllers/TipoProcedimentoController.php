<?php

class TipoProcedimentoController extends BaseController 
{
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodTipoProcedimento']) && !empty($_GET['CodTipoProcedimento']))
		{
			$tipoProcedimento = TipoProcedimento::model()->findByPk($_GET['CodTipoProcedimento']);
			
			if (empty($tipoProcedimento))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada um Procedimento válido!!');
				$this->redirect(array('tipoProcedimento/listar'));
			}
			else
				$this->render('formulario', array('tipoProcedimento'=>$tipoProcedimento));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['TipoProcedimento']))
			{
				if (!empty($_POST['TipoProcedimento']['CodTipoProcedimento']))
				{
					$tipoProcedimento = TipoProcedimento::model()->findByPk($_POST['TipoProcedimento']['CodTipoProcedimento']);
					if (empty($tipoProcedimento))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada um Procedimento válido!');
						$this->redirect(array('tipoProcedimento/listar'));
					}
				}
				else
					$tipoProcedimento = new TipoProcedimento();
				
				$tipoProcedimento->attributes = $_POST['TipoProcedimento'];

				if (!$tipoProcedimento->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar o Procedimento!');
				else
					
					Yii::app()->user->setFlash('success', 'Procedimento salvo com sucesso!');

				$this->redirect(array('tipoProcedimento/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$tipoProcedimento = new TipoProcedimento();
				$this->render('formulario', array('tipoProcedimento'=>$tipoProcedimento));
			}
		}
	}
	
	public function actionListar()
	{
		$tipoProcedimento = TipoProcedimento::model()->findAll(array('order'=>'NomeTipoProcedimento ASC'));
		$dataProvider = new CArrayDataProvider($tipoProcedimento, array(
			'keyField'=>'CodTipoProcedimento',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}