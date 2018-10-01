<?php

class ArtigoController extends BaseController 
{
	public function actionVisualizar()
	{
		if (isset($_GET['CodArtigo']))
		{
			$artigo = Artigo::model()->with(array('ObjetoPesquisa', 'Abrangencia'))->findByPk($_GET['CodArtigo']);
			if (empty($artigo))
			{
				Yii::app()->user->setFlash('danger', 'N�o foi encontrada um Artigo v�lido!');
				$this->redirect(array('artigo/listar'));
			}
			else
			{
				$this->render('visualizar', array(
					'artigo'=>$artigo, 
					'autores'=>ArtigoAutor::getNomeAutores($artigo->CodArtigo),
					'coordenadores'=>ArtigoCoordenador::getNomeCoordenadores($artigo->CodArtigo),
					'palavras'=>ArtigoPalavra::getNomePalavras($artigo->CodArtigo),
					'analises'=>ArtigoTipoAnalise::getArtigoAnalises($artigo->CodArtigo),
					'objetivos'=>ArtigoTipoObjetivo::getArtigoObjetivos($artigo->CodArtigo),
					'procedimentos'=>ArtigoTipoProcedimento::getArtigoProcedimentos($artigo->CodArtigo),
					'instituicoes'=>ArtigoInstituicao::getNomeInstituicoes($artigo->CodArtigo),
				));
			}
		}
	}
	
	public function actionFormulario()
	{
		if (isset($_GET['CodArtigo']))
		{
			$artigo = Artigo::model()->findByPk($_GET['CodArtigo']);
			if (empty($artigo))
			{
				Yii::app()->user->setFlash('danger', 'N�o foi encontrada um Artigo v�lido!');
				$this->redirect(array('artigo/listar'));
			}
			else
			{
				$this->render('formulario', array(
					'artigo'=>$artigo, 
					'autores'=>ArtigoAutor::getArtigoAutores($artigo->CodArtigo),
					'coordenadores'=>ArtigoCoordenador::getArtigoCoordenadores($artigo->CodArtigo),
					'palavras'=>ArtigoPalavra::getArtigoPalavras($artigo->CodArtigo),
					'analises'=>ArtigoTipoAnalise::getArtigoAnalises($artigo->CodArtigo),
					'objetivos'=>ArtigoTipoObjetivo::getArtigoObjetivos($artigo->CodArtigo),
					'procedimentos'=>ArtigoTipoProcedimento::getArtigoProcedimentos($artigo->CodArtigo),
					'instituicoes'=>ArtigoInstituicao::getArtigoInstituicoes($artigo->CodArtigo),
				));
			}
		}
		else
		{
			if (isset($_POST['Artigo']))
			{
				$transaction = Yii::app()->db->beginTransaction();
				try
				{
					$msg = '';
					
					if (!empty($_POST['Artigo']['CodArtigo']))
					{
						$artigo = Artigo::model()->findByPk($_POST['Artigo']['CodArtigo']);
						if (empty($artigo))
						{
							Yii::app()->user->setFlash('danger', 'N�o foi encontrada um Artigo v�lido!');
							$this->redirect(array('artigo/listar'));
						}
					}
					else
						$artigo = new Artigo();
					
					if (empty($_POST['Artigo']['CodObjetoPesquisa']))
						$msg .= " - Escolha um Objeto de Pesquisa;\n";
					
					if (empty($_POST['Artigo']['Nome']))
						$msg .= " - Preencha o nome do artigo;\n";
					
					if (empty($_POST['Artigo']['RevistaConferencia']))
						$msg .= " - Preencha a revista/confer�ncia onde o artigo foi publicado;\n";
					
					if (empty($_POST['Artigo']['IndicadorRevistaConferencia']))
						$msg .= " - Selecione onde o artigo foi publicado;\n";
					
					if (empty($_POST['Artigo']['AnoPublicacao']))
						$msg .= " - Preencha o ano da publica��o do artigo;\n";
					
					if (empty($_POST['Artigo']['Autor']))
						$msg .= " - Preencha o(s) autor(es) do artigo;\n";
					
					if (empty($_POST['Artigo']['Resumo']))
						$msg .= " - Preencha o resumo do artigo;\n";
					
					if (empty($_POST['Artigo']['Palavra']))
						$msg .= " - Preencha a(s) palavra(s)-chave do artigo;\n";
					
					if (empty($_POST['Artigo']['Analise']))
						$msg .= " - Marque ao menos um tipo de an�lise;\n";
					
					if (empty($_POST['Artigo']['Objetivo']))
						$msg .= " - Marque ao menos um tipo de objetivo;\n";
					
					if (empty($_POST['Artigo']['Procedimento']))
						$msg .= " - Marque ao menos um tipo de procedimento;\n";
					
					if (empty($_POST['Artigo']['Instituicao']))
						$msg .= " - Preencha a(s) institui��o(�es) do artigo;\n";
					
					if (empty($_POST['Artigo']['Coordenador']))
						$msg .= " - Preencha o(s) coordenador(es) do artigo;\n";
					
					if (empty($_POST['Artigo']['CodAbrangencia']))
						$msg .= " - Escolha uma Abrang�ncia;\n";
					
					$dataInicioEstudo = DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataInicioEstudo']);
					$dataFimEstudo = DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataFimEstudo']);
					
					if ($dataInicioEstudo > $dataFimEstudo)
						$msg .= " - A data inicial do estudo deve ser igual ou anterior a data final do estudo;\n";

					if (!empty($msg))
						throw new CException($msg);
					
					$artigo->CodObjetoPesquisa = $_POST['Artigo']['CodObjetoPesquisa'];
					$artigo->NomeArtigo = $_POST['Artigo']['Nome'];
					$artigo->NomeRevistaConferencia = $_POST['Artigo']['RevistaConferencia'];
					$artigo->AnoPublicacao = $_POST['Artigo']['AnoPublicacao'];
					$artigo->CodAbrangencia = $_POST['Artigo']['CodAbrangencia'];
					$artigo->Resumo = $_POST['Artigo']['Resumo'];
					$artigo->IndicadorRevistaConferencia = $_POST['Artigo']['IndicadorRevistaConferencia'];
					$artigo->DataInicioEstudo = $dataInicioEstudo->format('Y-m-d');
					$artigo->DataFimEstudo = $dataFimEstudo->format('Y-m-d');
					
					if (isset($_POST['Artigo']['Multicentrico']))
						$artigo->IndicadorMulticentrico = 'S';
					else
						$artigo->IndicadorMulticentrico = 'N';
					
					if (empty($_POST['Artigo']['Paginas']))
						$artigo->Paginas = NULL;
					else
						$artigo->Paginas = $_POST['Artigo']['Paginas'];
					
					if (empty($_POST['Artigo']['Volume']))
						$artigo->Volume = NULL;
					else
						$artigo->Volume = $_POST['Artigo']['Volume'];
					
					if ($artigo->save())
					{
						ArtigoTipoAnalise::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Analise'] as $key => $value)
						{
							$artigoTipoAnalise = new ArtigoTipoAnalise();
							$artigoTipoAnalise->CodArtigo = $artigo->CodArtigo;
							$artigoTipoAnalise->CodTipoAnalise = $value;
							$artigoTipoAnalise->save();
						}
						
						ArtigoTipoObjetivo::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Objetivo'] as $key => $value)
						{
							$artigoTipoObjetivo = new ArtigoTipoObjetivo();
							$artigoTipoObjetivo->CodArtigo = $artigo->CodArtigo;
							$artigoTipoObjetivo->CodTipoObjetivo = $value;
							$artigoTipoObjetivo->save();
						}
						
						ArtigoTipoProcedimento::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Procedimento'] as $key => $value)
						{
							$artigoTipoProcedimento = new ArtigoTipoProcedimento();
							$artigoTipoProcedimento->CodArtigo = $artigo->CodArtigo;
							$artigoTipoProcedimento->CodTipoProcedimento = $value;
							$artigoTipoProcedimento->save();
						}
						
						ArtigoInstituicao::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Instituicao'] as $key => $value)
						{
							$artigoInstituicao = new ArtigoInstituicao();
							$artigoInstituicao->CodArtigo = $artigo->CodArtigo;
							$artigoInstituicao->CodInstituicao = $value;
							$artigoInstituicao->save();
						}
						
						ArtigoAutor::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Autor'] as $key => $value)
						{
							if (is_numeric($value))
							{
								$artigoAutor = new ArtigoAutor();
								$artigoAutor->CodArtigo = $artigo->CodArtigo;
								$artigoAutor->CodAutor = $value;
								$artigoAutor->save();
							}
							else
							{
								$autor = new Autor();
								$autor->NomeAutor = $value;
								$autor->save();
								
								$artigoAutor = new ArtigoAutor();
								$artigoAutor->CodArtigo = $artigo->CodArtigo;
								$artigoAutor->CodAutor = $autor->CodAutor;
								$artigoAutor->save();
							}
						}
						
						ArtigoPalavra::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Palavra'] as $key => $value)
						{
							if (is_numeric($value))
							{
								$artigoPalavra = new ArtigoPalavra();
								$artigoPalavra->CodArtigo = $artigo->CodArtigo;
								$artigoPalavra->CodPalavra = $value;
								$artigoPalavra->save();
							}
							else
							{
								$palavra = new Palavra();
								$palavra->NomePalavra = $value;
								$palavra->save();
								
								$artigoPalavra = new ArtigoPalavra();
								$artigoPalavra->CodArtigo = $artigo->CodArtigo;
								$artigoPalavra->CodPalavra = $palavra->CodPalavra;
								$artigoPalavra->save();
							}
						}
						
						ArtigoCoordenador::deletarRelacoes($artigo->CodArtigo);
						foreach ($_POST['Artigo']['Coordenador'] as $key => $value)
						{
							if (is_numeric($value))
							{
								$artigoCoordenador = new ArtigoCoordenador();
								$artigoCoordenador->CodArtigo = $artigo->CodArtigo;
								$artigoCoordenador->CodCoordenador = $value;
								$artigoCoordenador->save();
							}
							else
							{
								$coordenador = new Coordenador();
								$coordenador->NomeCoordenador = $value;
								$coordenador->save();
								
								$artigoCoordenador = new ArtigoCoordenador();
								$artigoCoordenador->CodArtigo = $artigo->CodArtigo;
								$artigoCoordenador->CodCoordenador = $coordenador->CodCoordenador;
								$artigoCoordenador->save();
							}
						}
										
						$transaction->commit();
					}
					else
						throw new CException('N�o foi poss�vel salvar o Artigo');

					Yii::app()->user->setFlash('success', 'Artigo salvo com sucesso!');
					
					echo json_encode(array(
						"msg" => utf8_encode('Artigo salvo com sucesso!'),
						"erro" => 0,
					));
				}
				catch (CException $e)
				{
					echo json_encode(array(
						"msg" => utf8_encode($e->getMessage()),
						"erro" => 1,
					));
				}
			}
			else
				$this->render('formulario', array(
					'artigo'=>new Artigo(), 
					'autores'=>array(),
					'coordenadores'=>array(),
					'palavras'=>array(),
					'analises'=>array(),
					'objetivos'=>array(),
					'procedimentos'=>array(),
					'instituicoes'=>array(),
				));
		}
	}
	
	public function actionFormulario2()
	{
		$this->render('formulario2');
	}
	
	public function actionListar()
	{
		$CodArtigo = '';
		$NomeArtigo = '';
		$CodObjetoPesquisa = '';
		$AnoPublicacao = '';
		$CodObjetoPesquisa = '';
		$CodAbrangencia = '';
		$filtroUsado = false;
		$imgUrl = 'expandir.gif';
		
		$criteria = new CDbCriteria();
		$criteria->order = 'CodArtigo ASC';
		
		if (isset($_GET['NomeArtigo']) && !empty($_GET['NomeArtigo']))
		{
			if (isset($_GET['CodArtigo']) && !empty($_GET['CodArtigo']))
			{
				$criteria->addCondition('CodArtigo = ' . $_GET['CodArtigo']);
				$CodArtigo = $_GET['CodArtigo'];
				$NomeArtigo = $_GET['NomeArtigo'];
				$filtroUsado = true;
				$imgUrl = 'contrair.gif';
			}
		}
		
		if (isset($_GET['AnoPublicacao']) && !empty($_GET['AnoPublicacao']))
		{
			$criteria->addCondition('t.AnoPublicacao = ' . $_GET['AnoPublicacao']);
			$AnoPublicacao = $_GET['AnoPublicacao'];
			$filtroUsado = true;
			$imgUrl = 'contrair.gif';
		}
		
		if (isset($_GET['CodObjetoPesquisa']) && !empty($_GET['CodObjetoPesquisa']))
		{
			$criteria->addCondition('t.CodObjetoPesquisa = ' . $_GET['CodObjetoPesquisa']);
			$CodObjetoPesquisa = $_GET['CodObjetoPesquisa'];
			$filtroUsado = true;
			$imgUrl = 'contrair.gif';
		}
		
		if (isset($_GET['CodAbrangencia']) && !empty($_GET['CodAbrangencia']))
		{
			$criteria->addCondition('t.CodAbrangencia = ' . $_GET['CodAbrangencia']);
			$CodAbrangencia = $_GET['CodAbrangencia'];
			$filtroUsado = true;
			$imgUrl = 'contrair.gif';
		}
		
		/* SQL 
		SELECT ART.* 
		FROM artigo ART
		INNER JOIN objetopesquisa OP 
			ON OP.CodObjetoPesquisa = ART.CodObjetoPesquisa
		INNER JOIN abrangencia AB 
			ON AB.CodAbrangencia = ART.CodAbrangencia
		INNER JOIN artigoinstituicao AI
			ON AI.CodArtigo = ART.CodArtigo
		*/
		
		$artigos = Artigo::model()->with(array('ObjetoPesquisa', 'Abrangencia'))->findAll($criteria);
		$dataProvider = new CArrayDataProvider($artigos, array(
			'keyField'=>'CodArtigo',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array(
			'dataProvider'=>$dataProvider,
			'CodArtigo'=>$CodArtigo,
			'NomeArtigo'=>$NomeArtigo,
			'CodObjetoPesquisa'=>$CodObjetoPesquisa,
			'AnoPublicacao'=>$AnoPublicacao,
			'CodObjetoPesquisa'=>$CodObjetoPesquisa,
			'CodAbrangencia'=>$CodAbrangencia,
			'filtroUsado'=>$filtroUsado,
			'imgUrl'=>$imgUrl
		));
	}
}