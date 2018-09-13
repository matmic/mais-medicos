<?php

class ArtigoController extends BaseController 
{
	// public function actionFormulario()
	// {
		//Carrega formulário com os dados
		// if (isset($_GET['CodArtigo']) && !empty($_GET['CodArtigo']))
		// {
			// $abrangencia = Abrangencia::model()->findByPk($_GET['CodAbrangencia']);
			
			// if (empty($abrangencia))
			// {
				// Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Abrangência válida!');
				// $this->redirect(array('abrangencia/listar'));
			// }
			// else
				// $this->render('formulario', array('abrangencia'=>$abrangencia));
		// }
		// else
		// {
			//Atualização ou Novo
			// if (isset($_POST['Artigo']))
			// {
				// if (!empty($_POST['Abrangencia']['CodAbrangencia']))
				// {
					// $abrangencia = Abrangencia::model()->findByPk($_POST['Abrangencia']['CodAbrangencia']);
					// if (empty($abrangencia))
					// {
						// Yii::app()->user->setFlash('danger', 'Não foi encontrada uma Abrangência válida!');
						// $this->redirect(array('abrangencia/listar'));
					// }
				// }
				// else
					// $abrangencia = new Abrangencia();
				
				// $abrangencia->attributes = $_POST['Abrangencia'];

				// if (!$abrangencia->save())
					// Yii::app()->user->setFlash('danger', 'Não foi possível salvar a Abrangência!');
				// else
					
					// Yii::app()->user->setFlash('success', 'Abrangência salva com sucesso!');

				// $this->redirect(array('abrangencia/listar'));
			// }
			//Carrega formulário em branco
			// else
			// {
				// $abrangencia = new Abrangencia();
				// $this->render('formulario', array('abrangencia'=>$abrangencia));
			// }
		// }
	// }
	
	public function actionFormulario()
	{
		$this->render('formulario');
	}
	
	public function actionListar()
	{
		$abrangencia = Abrangencia::model()->findAll(array('order'=>'NomeAbrangencia ASC'));
		$dataProvider = new CArrayDataProvider($abrangencia, array(
			'keyField'=>'CodAbrangencia',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}