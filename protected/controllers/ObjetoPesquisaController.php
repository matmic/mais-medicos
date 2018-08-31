<?php

class ObjetoPesquisaController extends BaseController 
{
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodObjetoPesquisa']) && !empty($_GET['CodObjetoPesquisa']))
		{
			$objetoPesquisa = $objetoPesquisa = ObjetoPesquisa::model()->findByPk($_GET['CodObjetoPesquisa']);
			
			if (empty($objetoPesquisa))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada um Objeto de Pesquisa válido!');
			}
			else
				$this->render('formulario', array('objetoPesquisa'=>$objetoPesquisa));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['ObjetoPesquisa']))
			{
				if (!empty($_POST['ObjetoPesquisa']['CodObjetoPesquisa']))
				{
					$objetoPesquisa = ObjetoPesquisa::model()->findByPk($_POST['ObjetoPesquisa']['CodObjetoPesquisa']);
					if (empty($objetoPesquisa))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Abrangência válida!');
						$this->redirect(array('objetoPesquisa/listar'));
					}
				}
				else
					$objetoPesquisa = new ObjetoPesquisa();
				
				$objetoPesquisa->attributes = $_POST['ObjetoPesquisa'];
				
				if (isset($_POST['ObjetoPesquisa']['CodObjetoPesquisaPai']) && !empty($_POST['ObjetoPesquisa']['CodObjetoPesquisaPai']))
					$objetoPesquisa->CodObjetoPesquisaPai = $_POST['ObjetoPesquisa']['CodObjetoPesquisaPai'];
				else
					$objetoPesquisa->CodObjetoPesquisaPai = NULL;
				
				if (!$objetoPesquisa->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar o Objeto de Pesquisa');
				else
					Yii::app()->user->setFlash('success', 'Objeto de Pesquisa salvo com sucesso!');

				$this->redirect(array('objetoPesquisa/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$objetoPesquisa = new ObjetoPesquisa();
				$this->render('formulario', array('objetoPesquisa'=>$objetoPesquisa));
			}
		}
	}
	
	public function actionListar()
	{
		$criteria = new CDbCriteria();
		$criteria->with = 'codObjetoPesquisaPai';
		$criteria->order = 't.NomeObjetoPesquisa ASC';
		$criteria->alias = 't';
		$objetoPesquisa = ObjetoPesquisa::model()->findAll($criteria);
		$dataProvider = new CArrayDataProvider($objetoPesquisa, array(
			'keyField'=>'CodObjetoPesquisa',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}