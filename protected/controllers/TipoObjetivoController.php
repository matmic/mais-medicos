<?php

class TipoObjetivoController extends BaseController 
{
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodTipoObjetivo']) && !empty($_GET['CodTipoObjetivo']))
		{
			$tipoObjetivo = TipoObjetivo::model()->findByPk($_GET['CodTipoObjetivo']);
			
			if (empty($tipoObjetivo))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrado um Objetivo válido!');
				$this->redirect(array('tipoObjetivo/listar'));
			}
			else
				$this->render('formulario', array('tipoObjetivo'=>$tipoObjetivo));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['TipoObjetivo']))
			{
				if (!empty($_POST['TipoObjetivo']['CodTipoObjetivo']))
				{
					$tipoObjetivo = TipoObjetivo::model()->findByPk($_POST['TipoObjetivo']['CodTipoObjetivo']);
					if (empty($tipoObjetivo))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrado um Objetivo válido!');
						$this->redirect(array('tipoObjetivo/listar'));
					}
				}
				else
					$tipoObjetivo = new TipoObjetivo();
				
				$tipoObjetivo->attributes = $_POST['TipoObjetivo'];
				
				if (isset($_POST['TipoObjetivo']['IndicadorExclusao']))
					$tipoObjetivo->IndicadorExclusao = NULL;
				else
					$tipoObjetivo->IndicadorExclusao = 'S';

				if (!$tipoObjetivo->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar o Objetivo!');
				else
					
					Yii::app()->user->setFlash('success', 'Objetivo salvo com sucesso!');

				$this->redirect(array('tipoObjetivo/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$tipoObjetivo = new TipoObjetivo();
				$this->render('formulario', array('tipoObjetivo'=>$tipoObjetivo));
			}
		}
	}
	
	public function actionListar()
	{
		$tipoObjetivo = TipoObjetivo::model()->findAll(array('order'=>'NomeTipoObjetivo ASC'));
		$dataProvider = new CArrayDataProvider($tipoObjetivo, array(
			'keyField'=>'CodTipoObjetivo',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}