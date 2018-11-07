<?php

class GraficoController extends BaseController 
{	
	public function actionObjetoPesquisa()
	{
		// BUSCA A QUANTIDADE DE ARTIGOS POR OBJETO DE PESQUISA, E AGRUPA-OS PELO NOME
		$sql = '
			SELECT OP.CodObjetoPesquisa, OP.NomeObjetoPesquisa, COUNT(ART.CodObjetoPesquisa) AS Count
			FROM ObjetoPesquisa OP
			LEFT JOIN Artigo ART 
				ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
			GROUP BY NomeObjetoPesquisa
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		
		foreach($result as $objetoPesquisa) 
		{
			$data[] = array(
				"name"=>$objetoPesquisa['NomeObjetoPesquisa'], 
				"y"=>(int)$objetoPesquisa['Count'],
				"url"=>Yii::app()->createUrl('artigo/listar', array('Filtro[CodObjetoPesquisa]'=>$objetoPesquisa['CodObjetoPesquisa'])),
			);
		}

		$this->render('_objetoPesquisa', array('data'=>$data));
	}

	public function actionAnoPublicacaoObjetoPesquisa()
	{
		// BUSCA OS ANOS DISTINTOS NA TABELA DE ARTIGO E ORDENA DO MENOR PARA O MAIOR
		$sqlAnos = '
			SELECT DISTINCT AnoPublicacao
			FROM Artigo 
			ORDER BY AnoPublicacao ASC
		';
		$commandAnos = Yii::app()->db->createCommand($sqlAnos);
		$resultAnos = $commandAnos->queryAll();
		
		// BUSCA OS OBJETOS DE PESQUISA CADASTRADOS NO BANCO E ORDENA PELO COD (MENOR PARA MAIOR)
		$sqlObjetoPesquisa = '
			SELECT CodObjetoPesquisa, NomeObjetoPesquisa
			FROM ObjetoPesquisa
			ORDER BY CodObjetoPesquisa ASC
		';
		$commandObjetoPesquisa = Yii::app()->db->createCommand($sqlObjetoPesquisa);
		$resultObjetoPesquisa = $commandObjetoPesquisa->queryAll();
		
		//CRIA OS ARRAYS DE CADA OBJETO DE PESQUISA QUE SERÃO MOSTRADOS NO GRÁFICO
		$arrCodObjetosPesquisas = array();
		foreach ($resultObjetoPesquisa as $objetoPesquisa)
		{
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"} = array();
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"}['name'] = $objetoPesquisa['NomeObjetoPesquisa'];
			${"arrCodObjetoPesquisa$objetoPesquisa[CodObjetoPesquisa]"}['key'] = $objetoPesquisa['CodObjetoPesquisa'];
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
				FROM Artigo ART
				INNER JOIN ObjetoPesquisa OP
					ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
				WHERE ART.CodObjetoPesquisa = $CodObjetoPesquisa
				GROUP BY AnoPublicacao, CodObjetoPesquisa
				ORDER BY AnoPublicacao ASC
			";

			$command = Yii::app()->db->createCommand($sql);
			$result = $command->queryAll();
			
			foreach ($result as $row)
				${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'][$row['AnoPublicacao']] = (int)$row['Count'];
			
			// TRANSFORMA AS CHAVES DO ARRAY. ERAM ANO E PASSAM PRA INDEXAÇÃO NORMAL
			${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data'] = array_values(${"arrCodObjetoPesquisa$CodObjetoPesquisa"}['data']);

			$series[] = ${"arrCodObjetoPesquisa$CodObjetoPesquisa"};
		}

		$this->render('_anoPublicacaoObjetoPesquisa', array(
			'anos'=>$anos,
			'series'=>$series,
		));
	}
	
	public function actionInstituicao()
	{
		$data = '';
		$numero = '';
		$criarGrafico = '0';
		
		if (isset($_GET['Numero']) && !empty($_GET['Numero']))
		{
			$numero = $_GET['Numero'];
			$criarGrafico = 1;
			
			$sql = "
				SELECT INST.NomeInstituicao, ARTINST.CodInstituicao, COUNT(*) AS Count
				FROM ArtigoInstituicao ARTINST
				INNER JOIN Instituicao INST
					ON INST.CodInstituicao = ARTINST.CodInstituicao
				GROUP BY ARTINST.CodInstituicao
				ORDER BY Count DESC
				LIMIT $numero
			";
			$command = Yii::app()->db->createCommand($sql);
			$result = $command->queryAll();
			
			$data = array();
			foreach ($result as $row)
			{
				$data[] = array(
					'name' => $row['NomeInstituicao'], 
					'y' => (int)$row['Count'],
					'url' => Yii::app()->createUrl('artigo/listar', array('Filtro[CodInstituicao]'=>$row['CodInstituicao'], 'Filtro[NomeInstituicao]'=>$row['NomeInstituicao'])),
				);
			}
		}
		
		$this->render('_instituicao', array('data'=>$data, 'numero'=>$numero, 'criarGrafico'=>$criarGrafico));
	}
	
	public function actionTipoAnalise()
	{
		$sql = '
			SELECT TA.NomeTipoAnalise, ATA.CodTipoAnalise, COUNT(*) AS Count
			FROM ArtigoTipoAnalise ATA
			INNER JOIN TipoAnalise TA
				ON TA.CodTipoAnalise = ATA.CodTipoAnalise
			GROUP BY CodTipoAnalise
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		foreach ($result as $row)
		{
			$data[] = array(
				'name' => $row['NomeTipoAnalise'], 
				'y' => (int)$row['Count'],
				'url' => Yii::app()->createUrl('artigo/listar', array('Filtro[CodTipoAnalise]'=>$row['CodTipoAnalise'])),
			);
		}
		
		$this->render('_tipoAnalise', array('data'=>$data));
	}
	
	public function actionTipoObjetivo()
	{
		$sql = '
			SELECT TOB.NomeTipoObjetivo, ATO.CodTipoObjetivo, COUNT(*) AS Count
			FROM ArtigoTipoObjetivo ATO
			INNER JOIN TipoObjetivo TOB
				ON TOB.CodTipoObjetivo = ATO.CodTipoObjetivo
			GROUP BY CodTipoObjetivo
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		foreach ($result as $row)
		{
			$data[] = array(
				'name' => $row['NomeTipoObjetivo'], 
				'y' => (int)$row['Count'],
				'url' => Yii::app()->createUrl('artigo/listar', array('Filtro[CodTipoObjetivo]'=>$row['CodTipoObjetivo'])),
			);
		}
		
		$this->render('_tipoObjetivo', array('data'=>$data));
	}
	
	public function actionTipoProcedimento()
	{
		$sql = '
			SELECT TP.NomeTipoProcedimento, ATP.CodTipoProcedimento, COUNT(*) AS Count
			FROM ArtigoTipoProcedimento ATP
			INNER JOIN TipoProcedimento TP
				ON TP.CodTipoProcedimento = ATP.CodTipoProcedimento
			GROUP BY CodTipoProcedimento
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		foreach ($result as $row)
		{
			$data[] = array(
				'name' => $row['NomeTipoProcedimento'], 
				'y' => (int)$row['Count'],
				'url' => Yii::app()->createUrl('artigo/listar', array('Filtro[CodTipoProcedimento]'=>$row['CodTipoProcedimento'])),
			);
		}
		
		$this->render('_tipoProcedimento', array('data'=>$data));
	}
	
	public function actionTipoPublicacao()
	{
		$sql = "
			SELECT COUNT(*) AS Count,
			CASE
				WHEN IndicadorRevistaConferencia = 'C' THEN 1
				ELSE 2
			END AS IndicadorRevistaConferencia,
			CASE
				WHEN IndicadorRevistaConferencia = 'R' THEN 'Revista'
				ELSE 'Conferência'
			END AS TipoPublicacao
			FROM Artigo
			GROUP BY IndicadorRevistaConferencia
		";
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		foreach ($result as $row)
		{
			$data[] = array(
				'name' => $row['TipoPublicacao'], 
				'y' => (int)$row['Count'],
				'url' => Yii::app()->createUrl('artigo/listar', array('Filtro[IndicadorRevistaConferencia]'=>$row['IndicadorRevistaConferencia'])),
			);
		}
		
		$this->render('_tipoProcedimento', array('data'=>$data));
	}
	
	public function actionPalavra()
	{
		$data = '';
		$numero = '';
		$criarGrafico = '0';
		
		if (isset($_GET['Numero']) && !empty($_GET['Numero']))
		{
			$numero = $_GET['Numero'];
			$criarGrafico = 1;
			
		
			$sql = "
				SELECT P.NomePalavra, AP.CodPalavra, COUNT(*) AS Count
				FROM ArtigoPalavra AP
				INNER JOIN Palavra P
					ON P.CodPalavra = AP.CodPalavra
				GROUP BY AP.CodPalavra
				ORDER BY Count DESC
				LIMIT $numero
			";
			$command = Yii::app()->db->createCommand($sql);
			$result = $command->queryAll();
			
			$data = array();
			foreach ($result as $row)
			{
				$data[] = array(
					'name' => $row['NomePalavra'], 
					'y' => (int)$row['Count'],
					'url' => Yii::app()->createUrl('artigo/listar', array('Filtro[CodPalavra]'=>$row['CodPalavra'], 'Filtro[NomePalavra]'=>$row['NomePalavra'])),
				);
			}
		}
		
		$this->render('_palavraChave', array('data'=>$data, 'numero'=>$numero, 'criarGrafico'=>$criarGrafico));
	}
}