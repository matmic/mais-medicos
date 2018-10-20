<?php

class AuxiliarController extends BaseController
{
	public function actionAutoCompleteInstituicao($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomeInstituicao) LIKE UPPER(:termo) OR UPPER(SiglaInstituicao) LIKE UPPER(:termo)';
		$criteria->params = array(':termo' => '%'.$term.'%');
		$criteria->limit = 10;
		$results = array();
		foreach(Instituicao::model()->findAll($criteria) as $inst)
		{
		  $results[] = array(
			  'label' => (!empty($inst->SiglaInstituicao) ? $inst->SiglaInstituicao . ' - ' . $inst->NomeInstituicao : $inst->NomeInstituicao),
			  'CodInstituicao' => $inst->CodInstituicao,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
	}
	
	public function actionAutoCompleteArtigo($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomeArtigo) LIKE UPPER(:termo)';
		$criteria->params = array(':termo' => '%'.$term.'%');
		$criteria->limit = 10;
		$results = array();
		foreach(Artigo::model()->findAll($criteria) as $artigo)
		{
		  $results[] = array(
			  'label' => $artigo->NomeArtigo,
			  'CodArtigo' => $artigo->CodArtigo,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
	}
	
	public function actionAutoCompletePalavra($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomePalavra) LIKE UPPER(:termo)';
		$criteria->params = array(':termo' => '%'.$term.'%');
		$criteria->limit = 10;
		$results = array();
		foreach(Palavra::model()->findAll($criteria) as $palavra)
		{
		  $results[] = array(
			  'label' => $palavra->NomePalavra,
			  'CodPalavra' => $palavra->CodPalavra,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
	}
	
	public function actionAutoCompleteAutor($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomeAutor) LIKE UPPER(:termo)';
		$criteria->params = array(':termo' => '%'.$term.'%');
		$criteria->limit = 10;
		$results = array();
		foreach(Autor::model()->findAll($criteria) as $autor)
		{
		  $results[] = array(
			  'label' => $autor->NomeAutor,
			  'CodAutor' => $autor->CodAutor,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
	}
}