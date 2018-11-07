<?php

class RevistaController extends BaseController 
{
	public function actionListar()
	{
		$revistas = Revista::model()->findAll(array('order'=>'NomeRevista ASC'));
		$dataProvider = new CArrayDataProvider($revistas, array(
			'keyField'=>'CodRevista',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
	
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodRevista']) && !empty($_GET['CodRevista']))
		{
			$revista = Revista::model()->findByPk($_GET['CodRevista']);
			
			if (empty($revista))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada uma revista válida!');
				$this->redirect(array('revista/listar'));
			}
			else
				$this->render('formulario', array('revista'=>$revista));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['Revista']))
			{
				if (!empty($_POST['Revista']['CodRevista']))
				{
					$revista = Revista::model()->findByPk($_POST['Revista']['CodRevista']);
					if (empty($revista))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada uma revista válida!');
						$this->redirect(array('revista/listar'));
					}
				}
				else
					$revista = new revista();
				
				$revista->attributes = $_POST['Revista'];

				if (!$revista->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar a revista!');
				else
					
					Yii::app()->user->setFlash('success', 'Revista salva com sucesso!');

				$this->redirect(array('revista/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$revista = new Revista();
				$this->render('formulario', array('revista'=>$revista));
			}
		}
	}
		
	// public function actionRemover()
	// {
		// if (isset($_GET['CodPalavra']) && !empty($_GET['CodPalavra']))
		// {
			// $palavra = Palavra::model()->findByPk($_GET['CodPalavra']);
			
			// if (empty($palavra))
			// {
				// Yii::app()->user->setFlash('danger', 'Palavra-chave não encontrada!');
				// $this->redirect('listar');
			// }
			
			// try
			// {
				// $palavra->delete();
				// echo 'Palavra-chave excluída com sucesso!';
			// }
			// catch (Exception $e)
			// {
				// echo 'Existem artigos vinculados a essa palavra-chave, não é possível excluí-la!';
			// }
		// }
		// else
		// {
			// Yii::app()->user->setFlash('danger', 'Palavra-chave não encontrada!');
			// $this->redirect('listar');
		// }
	// }
}