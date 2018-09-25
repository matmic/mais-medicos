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
		
		$dataPoints = array();
		foreach($result as $p) {
			$dataPoints[] = array(
				"label"=>$p['NomeObjetoPesquisa'], 
				"y"=>(int)$p['Count'],
				"link"=>Yii::app()->createUrl('artigo/listar', array('CodObjetoPesquisa'=>$p['CodObjetoPesquisa'])),
			);
		}

		$this->render('_objetoPesquisa', array(
			'dataPoints'=>$dataPoints,
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
			ORDER BY AnoPublicacao ASC
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
		
		$dataPoints = array();
		foreach ($arrCodObjetosPesquisas as $CodObjetoPesquisa)
			$dataPoints[] = ${"dados$CodObjetoPesquisa"};
		
		$this->render('_anoPublicacao', array(
			'dataPoints'=>$dataPoints,
		));
	}
	
	public function actionTeste()
	{
		// BUSCA A QUANTIDADE DE ARTIGOS POR OBJETO DE PESQUISA, E AGRUPA-OS PELO NOME
		$sql = '
			SELECT OP.CodObjetoPesquisa, OP.NomeObjetoPesquisa, COUNT(ART.CodObjetoPesquisa) AS Count
			FROM objetopesquisa OP
			LEFT JOIN artigo ART 
				ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
			GROUP BY NomeObjetoPesquisa
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		
		foreach($result as $objetoPesquisa) {
			$data[] = array(
				"name"=>$objetoPesquisa['NomeObjetoPesquisa'], 
				"y"=>(int)$objetoPesquisa['Count'],
				"url"=>Yii::app()->createUrl('artigo/listar', array('CodObjetoPesquisa'=>$objetoPesquisa['CodObjetoPesquisa'])),
			);
		}

		$this->render('teste', array(
			'data'=>$data,
		));
	}
	
	public function actionTeste2()
	{
		// BUSCA OS ANOS DISTINTOS NA TABELA DE ARTIGO E ORDENA DO MENOR PARA O MAIOR
		$sqlAnos = '
			SELECT DISTINCT AnoPublicacao
			FROM artigo 
			ORDER BY AnoPublicacao ASC
		';
		$commandAnos = Yii::app()->db->createCommand($sqlAnos);
		$resultAnos = $commandAnos->queryAll();
		
		// BUSCA OS OBJETOS DE PESQUISA CADASTRADOS NO BANCO E ORDENA PELO COD (MENOR PARA MAIOR)
		$sqlObjetoPesquisa = '
			SELECT CodObjetoPesquisa, NomeObjetoPesquisa
			FROM objetopesquisa
			order by CodObjetoPesquisa ASC
		';
		$commandObjetoPesquisa = Yii::app()->db->createCommand($sqlObjetoPesquisa);
		$resultObjetoPesquisa = $commandObjetoPesquisa->queryAll();
		
		$anos = array();
		$arrCodObjetosPesquisas = array();
		
		//CRIA OS ARRAYS DE CADA OBJETO DE PESQUISA QUE SERÃO MOSTRADOS NO GRÁFICO
		foreach ($resultObjetoPesquisa as $objetoPesquisa)
		{
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"} = array();
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"}['name'] = $objetoPesquisa['NomeObjetoPesquisa'];
			$arrCodObjetosPesquisas[] = $objetoPesquisa['CodObjetoPesquisa'];
		}
		
		// PARA CADA ANO ENCONTRADO NO BANCO, INICIALIZA COM 0 O NÚMERO DE ARTIGOS DO OBJETO DE PESQUISA
		foreach($resultAnos as $ano) 
		{
			$anos[] = $ano['AnoPublicacao'];
			
			foreach ($arrCodObjetosPesquisas as $CodObjetoPesquisa)
				${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'][] = 0;
		}
		
		$series = array();
		
		// PARA CADA OBJETO DE PESQUISA E PARA CADA ANO ENCONTRADO NO BANCO, VERIFICA SE EXISTE ALGUM ARTIGO
		foreach ($arrCodObjetosPesquisas as $CodObjetoPesquisa)
		{
			$i = 0;
			foreach ($anos as $ano)
			{
				$sql = "
					SELECT COUNT(*) as Count 
					FROM artigo
					WHERE CodObjetoPesquisa = $CodObjetoPesquisa
					AND AnoPublicacao = $ano
				";
			
				$command = Yii::app()->db->createCommand($sql);
				$result = $command->queryRow();
				
				${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'][$i] = (int)$result['Count'];
				$i++;
			}
			// ARMAZENA NO ARRAY DE SERIES
			$series[] = ${"arrCodObjetoPesquisa$CodObjetoPesquisa"};
		}

		$this->render('teste2', array(
			'anos'=>$anos,
			'series'=>$series,
		));
	}
	
	// MESMA ACTION QUE A ANTERIOR, MAS COM MENOS CONSULTAS SQL
	public function actionTeste3()
	{
		// BUSCA OS ANOS DISTINTOS NA TABELA DE ARTIGO E ORDENA DO MENOR PARA O MAIOR
		$sqlAnos = '
			SELECT DISTINCT AnoPublicacao
			FROM artigo 
			ORDER BY AnoPublicacao ASC
		';
		$commandAnos = Yii::app()->db->createCommand($sqlAnos);
		$resultAnos = $commandAnos->queryAll();
		
		// BUSCA OS OBJETOS DE PESQUISA CADASTRADOS NO BANCO E ORDENA PELO COD (MENOR PARA MAIOR)
		$sqlObjetoPesquisa = '
			SELECT CodObjetoPesquisa, NomeObjetoPesquisa
			FROM objetopesquisa
			order by CodObjetoPesquisa ASC
		';
		$commandObjetoPesquisa = Yii::app()->db->createCommand($sqlObjetoPesquisa);
		$resultObjetoPesquisa = $commandObjetoPesquisa->queryAll();
		
		//CRIA OS ARRAYS DE CADA OBJETO DE PESQUISA QUE SERÃO MOSTRADOS NO GRÁFICO
		$arrCodObjetosPesquisas = array();
		foreach ($resultObjetoPesquisa as $objetoPesquisa)
		{
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"} = array();
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"}['name'] = $objetoPesquisa['NomeObjetoPesquisa'];
			$arrCodObjetosPesquisas[] = $objetoPesquisa['CodObjetoPesquisa'];
		}
		
		// PARA CADA ANO ENCONTRADO NO BANCO, INICIALIZA COM 0 O NÚMERO DE ARTIGOS DO OBJETO DE PESQUISA E CRIA ARRAY DE ANOS
		$anos = array();
		foreach($resultAnos as $ano) 
		{
			$anos[] = $ano['AnoPublicacao'];
			
			foreach ($arrCodObjetosPesquisas as $CodObjetoPesquisa)
				${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'][$ano['AnoPublicacao']] = 0;
		}
		
		// PARA CADA OBJETO DE PESQUISA E PARA CADA ANO ENCONTRADO NO BANCO, VERIFICA SE EXISTE ALGUM ARTIGO
		$series = array();
		foreach ($arrCodObjetosPesquisas as $CodObjetoPesquisa)
		{
			$sql = "
				SELECT OP.CodObjetoPesquisa, OP.NomeObjetoPesquisa, ART.AnoPublicacao, COUNT(*) AS Count 
				FROM artigo ART
				INNER JOIN objetopesquisa OP
					ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
				WHERE ART.CodObjetoPesquisa = $CodObjetoPesquisa
				GROUP BY AnoPublicacao, CodObjetoPesquisa
				ORDER BY AnoPublicacao ASC
			";

			$command = Yii::app()->db->createCommand($sql);
			$result = $command->queryAll();
			
			foreach ($result as $result)
				${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'][$result['AnoPublicacao']] = (int)$result['Count'];
			
			// TRANSFORMA AS CHAVES DO ARRAY. ERAM ANO E PASSAM PRA INDEXAÇÃO NORMAL
			${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'] = array_values(${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data']);
			$series[] = ${"arrCodObjetoPesquisa$CodObjetoPesquisa"};
		}

		$this->render('teste2', array(
			'anos'=>$anos,
			'series'=>$series,
		));
	}
}