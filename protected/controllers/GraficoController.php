﻿<?php

class GraficoController extends BaseController 
{	
	public function actionObjetoPesquisa()
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
		
		foreach($result as $objetoPesquisa) 
		{
			$data[] = array(
				"name"=>$objetoPesquisa['NomeObjetoPesquisa'], 
				"y"=>(int)$objetoPesquisa['Count'],
				"url"=>Yii::app()->createUrl('artigo/listar', array('CodObjetoPesquisa'=>$objetoPesquisa['CodObjetoPesquisa'])),
			);
		}

		$this->render('_objetoPesquisa', array('data'=>$data));
	}

	public function actionAnoPublicacaoObjetoPesquisa()
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
				FROM artigo ART
				INNER JOIN objetopesquisa OP
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
		$sql = '
			SELECT INST.NomeInstituicao, ARTINST.CodInstituicao, COUNT(*) AS Count
			FROM artigoinstituicao ARTINST
			INNER JOIN instituicao INST
				ON INST.CodInstituicao = ARTINST.CodInstituicao
			GROUP BY ARTINST.CodInstituicao
			ORDER BY Count DESC
			LIMIT 10
		';
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		
		$data = array();
		foreach ($result as $row)
		{
			$data[] = array(
				'name' => $row['NomeInstituicao'], 
				'y' => (int)$row['Count'],
				'url' => Yii::app()->createUrl('artigo/listar', array('CodInstituicao'=>$row['CodInstituicao'], 'NomeInstituicao'=>$row['NomeInstituicao'])),
			);
		}
		
		$this->render('_instituicao', array('data'=>$data));
	}
	
	public function actionTipoAnalise()
	{
		$sql = '
			SELECT TA.NomeTipoAnalise, ATA.CodTipoAnalise, COUNT(*) AS Count
			FROM artigotipoanalise ATA
			INNER JOIN tipoanalise TA
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
				'url' => Yii::app()->createUrl('artigo/listar', array('CodTipoAnalise'=>$row['CodTipoAnalise'])),
			);
		}
		
		$this->render('_tipoAnalise', array('data'=>$data));
	}
	
	public function actionTipoObjetivo()
	{
		$sql = '
			SELECT TOB.NomeTipoObjetivo, ATO.CodTipoObjetivo, COUNT(*) AS Count
			FROM artigotipoobjetivo ATO
			INNER JOIN tipoobjetivo TOB
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
				'url' => Yii::app()->createUrl('artigo/listar', array('CodTipoObjetivo'=>$row['CodTipoObjetivo'])),
			);
		}
		
		$this->render('_tipoObjetivo', array('data'=>$data));
	}
	
	public function actionTipoProcedimento()
	{
		$sql = '
			SELECT TP.NomeTipoProcedimento, ATP.CodTipoProcedimento, COUNT(*) AS Count
			FROM artigotipoprocedimento ATP
			INNER JOIN tipoprocedimento TP
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
				'url' => Yii::app()->createUrl('artigo/listar', array('CodTipoProcedimento'=>$row['CodTipoProcedimento'])),
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
			FROM artigo
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
				'url' => Yii::app()->createUrl('artigo/listar', array('IndicadorRevistaConferencia'=>$row['IndicadorRevistaConferencia'])),
			);
		}
		
		$this->render('_tipoProcedimento', array('data'=>$data));
	}
}