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
	
	public function actionFormulario()
	{
		// Carrega formulário com os dados
		if (isset($_GET['CodPalavra']) && !empty($_GET['CodPalavra']))
		{
			$palavra = Palavra::model()->findByPk($_GET['CodPalavra']);
			
			if (empty($palavra))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada uma palavra-chave válida!');
				$this->redirect(array('palavra/listar'));
			}
			else
				$this->render('formulario', array('palavra'=>$palavra));
		}
		else
		{
			// Atualização ou Novo
			if (isset($_POST['Palavra']))
			{
				if (!empty($_POST['Palavra']['CodPalavra']))
				{
					$palavra = Palavra::model()->findByPk($_POST['Palavra']['CodPalavra']);
					if (empty($palavra))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada uma palavra-chave válida!');
						$this->redirect(array('palavra/listar'));
					}
				}
				else
					$palavra = new Palavra();
				
				$palavra->attributes = $_POST['Palavra'];

				if (!$palavra->save())
					Yii::app()->user->setFlash('danger', 'Não foi possível salvar a palavra-chave!');
				else
					
					Yii::app()->user->setFlash('success', 'Palavra-chave salva com sucesso!');

				$this->redirect(array('palavra/listar'));
			}
			// Carrega formulário em branco
			else
			{
				$palavra = new Palavra();
				$this->render('formulario', array('palavra'=>$palavra));
			}
		}
	}
		
	public function actionRemover()
	{
		if (isset($_GET['CodPalavra']) && !empty($_GET['CodPalavra']))
		{
			$palavra = Palavra::model()->findByPk($_GET['CodPalavra']);
			
			if (empty($palavra))
			{
				Yii::app()->user->setFlash('danger', 'Palavra-chave não encontrada!');
				$this->redirect('listar');
			}
			
			try
			{
				$palavra->delete();
				echo 'Palavra-chave excluída com sucesso!';
			}
			catch (Exception $e)
			{
				echo 'Existem artigos vinculados a essa palavra-chave, não é possível excluí-la!';
			}
		}
		else
		{
			Yii::app()->user->setFlash('danger', 'Palavra-chave não encontrada!');
			$this->redirect('listar');
		}
	}
}