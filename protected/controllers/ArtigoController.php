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
		if (isset($_POST['Artigo']))
		{
			if (!empty($_POST['Artigo']['CodArtigo']))
			{
				$artigo = Artigo::model()->findByPk($_POST['Artigo']['CodArtigo']);
				if (empty($artigo))
				{
					Yii::app()->user->setFlash('danger', 'Não foi encontrada um Artigo válido!');
					$this->redirect(array('artigo/listar'));
				}
			}
			else
				$artigo = new Artigo();
			
			$artigo->CodObjetoPesquisa = $_POST['Artigo']['CodObjetoPesquisa'];
			$artigo->NomeArtigo = $_POST['Artigo']['Nome'];
			$artigo->RevistaConferencia = $_POST['Artigo']['RevistaConferencia'];
			$artigo->Ano = $_POST['Artigo']['AnoPublicacao'];
			$artigo->CodAbrangencia = $_POST['Artigo']['CodAbrangencia'];
			$artigo->Resumo = $_POST['Artigo']['Resumo'];
			$artigo->DataInicioEstudo = (DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataInicioEstudo']))->format('Y-m-d');
			$artigo->DataFimEstudo = (DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataFimEstudo']))->format('Y-m-d');
			
			if (isset($_POST['Artigo']['Multicentrico']))
				$artigo->Multicentrico = 'S';
			else
				$artigo->Multicentrico = 'N';
			
			die(CVarDumper::dump($artigo, 10, true));
		}
		else
			$this->render('formulario');
	}
	
	public function actionFormulario2()
	{
		$this->render('formulario2');
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