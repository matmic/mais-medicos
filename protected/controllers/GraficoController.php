<?php

class GraficoController extends BaseController 
{
	public function actionObjetoPesquisa()
	{
		$sql = '
			SELECT OP.CodObjetoPesquisa, NomeObjetoPesquisa, COUNT(ART.CodObjetoPesquisa) AS Count
			FROM objetopesquisa OP
			LEFT JOIN artigo ART 
				ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
			GROUP BY NomeObjetoPesquisa
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$dados = array();
		$dados2 = array();
		$dados[] = array('Objetos de Pesquisa', 'Número de Artigos');
		
		foreach($result as $p) {
			$dados[] = array($p['NomeObjetoPesquisa'], (int)$p['Count']);
			$dados2[] = array(
				"label"=>$p['NomeObjetoPesquisa'], 
				"y"=>(int)$p['Count'],
				"link"=>Yii::app()->createUrl('artigo/listar', array('CodObjetoPesquisa'=>$p['CodObjetoPesquisa'])),
			);
		}
		//CVarDumper::dump(json_encode($dados2), 10, true);die;
		$this->render('_objetoPesquisa', array(
			'dados'=>$dados,
			'dados2'=>$dados2,
			'title'=>'Número de Artigos por Objeto de Pesquisa',
		));
	}
	
	public function actionAnoPublicacao()
	{
		$arrCodObjetosPesquisas = array();
		$sql = '
			SELECT OP.CodObjetoPesquisa, OP.NomeObjetoPesquisa, ART.AnoPublicacao, COUNT(*) AS Count 
			FROM artigo ART
			INNER JOIN objetopesquisa OP
				ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
			GROUP BY AnoPublicacao, CodObjetoPesquisa
		';
		
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		foreach($result as $reg)
		{
			// SE NÃO EXISTE VARIÁVEL TEMPORÁRIA QUE ARMAZENA OS DADOS DO OBJETO DE PESQUISA, CRIA
			if (!isset(${"dados$reg[CodObjetoPesquisa]"}))
			{
				${"dados$reg[CodObjetoPesquisa]"} = array();
				// ARMAZENA O COD OBJETO PESQUISA PARA CRIAR O ARRAY DE DADOS
				$arrCodObjetosPesquisas[] = $reg['CodObjetoPesquisa'];
			}
			
			${"dados$reg[CodObjetoPesquisa]"}[] = array(
				'x'=>(int)$reg['AnoPublicacao'], 
				'y'=>(int)$reg['Count'],
				'nome'=>$reg['NomeObjetoPesquisa'],
				'link'=>Yii::app()->createUrl('artigo/listar', array('CodObjetoPesquisa'=>$reg['CodObjetoPesquisa'], 'AnoPublicacao'=>$reg['AnoPublicacao'])),
			);
		}
		
		foreach ($arrCodObjetosPesquisas as $CodObjetoPesquisa)
			$dados[] = ${"dados$CodObjetoPesquisa"};
		
		$this->render('_anoPublicacao', array(
			'dados'=>$dados,
		));
	}
}