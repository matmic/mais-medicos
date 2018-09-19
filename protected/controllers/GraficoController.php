<?php

class GraficoController extends BaseController 
{
	public function actionObjetoPesquisa()
	{
		$sql = '
			SELECT NomeObjetoPesquisa, COUNT(ART.CodObjetoPesquisa) AS Count
			FROM objetopesquisa OP
			LEFT JOIN artigo ART 
				ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
			GROUP BY NomeObjetoPesquisa
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$dados = array();
		$dados[] = array('Objetos de Pesquisa', 'Número de Artigos');
		
		foreach($result as $p)
			$dados[] = array($p['NomeObjetoPesquisa'], (int)$p['Count']);

		$this->render('visualizarGrafico', array(
			'dados'=>$dados,
			'title'=>'Número de Artigos por Objeto de Pesquisa',
		));
	}
	
	public function actionAnoPublicacao()
	{
		$sql = '
			SELECT AnoPublicacao, COUNT(*) AS Count 
			FROM artigo 
			GROUP BY AnoPublicacao
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$dados = array();
		$dados[] = array('Ano de Publicação', 'Número de Artigos');
		
		foreach($result as $p)
			$dados[] = array($p['AnoPublicacao'], (int)$p['Count']);

		$this->render('visualizarGrafico', array(
			'dados'=>$dados, 
			'title'=>'Número de Artigos por Ano de Publicação',
		));
	}
}