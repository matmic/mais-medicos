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
				Yii::app()->user->setFlash('danger', 'Não foi encontrada um Artigo válido!');
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
				Yii::app()->user->setFlash('danger', 'Não foi encontrada um Artigo válido!');
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
							Yii::app()->user->setFlash('danger', 'Não foi encontrada um Artigo válido!');
							$this->redirect(array('artigo/listar'));
						}
					}
					else
						$artigo = new Artigo();
					
					if (empty($_POST['Artigo']['CodObjetoPesquisa']))
						$msg .= " - Escolha um Objeto de Pesquisa;\n";
					
					if (empty($_POST['Artigo']['Nome']))
						$msg .= " - Preencha o nome do artigo;\n";
					else
					{
						if ($artigo->isNewRecord)
						{
							$artigoComMesmoNome = Artigo::model()->findByAttributes(array('NomeArtigo'=>$_POST['Artigo']['Nome']));
							
							if (!empty($artigoComMesmoNome))
								$msg .= " - Já existe um artigo com este nome na base de dados;\n";
						}
					}
					
					if (empty($_POST['Artigo']['IndicadorRevistaConferencia']))
						$msg .= " - Selecione onde o artigo foi publicado;\n";
					
					if (empty($_POST['Artigo']['AnoPublicacao']))
						$msg .= " - Preencha o ano da publicação do artigo;\n";
					
					if (empty($_POST['Artigo']['Autor']))
						$msg .= " - Preencha o(s) autor(es) do artigo;\n";
					
					if (empty($_POST['Artigo']['Resumo']))
						$msg .= " - Preencha o resumo do artigo;\n";
					
					if (empty($_POST['Artigo']['Palavra']))
						$msg .= " - Preencha a(s) palavra(s)-chave do artigo;\n";
					
					if (empty($_POST['Artigo']['Instituicao']))
						$msg .= " - Preencha a(s) instituição(ões) do artigo;\n";
					
					if (empty($_POST['Artigo']['CodAbrangencia']))
						$msg .= " - Escolha uma Abrangência;\n";
					
					$dataInicioEstudo = NULL;
					$dataFimEstudo = NULL;
					
					if (!empty($_POST['Artigo']['DataInicioEstudo']))
					{
						$dataInicioEstudo = DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataInicioEstudo']);
						$dataInicioEstudo = $dataInicioEstudo->format('Y-m-d');
					}
					
					if (!empty($_POST['Artigo']['DataFimEstudo']))
					{
						$dataFimEstudo = DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataFimEstudo']);
						$dataFimEstudo = $dataFimEstudo->format('Y-m-d');
					}
					
					if (!empty($dataInicioEstudo) && !empty($dataFimEstudo))
					{
						if ($dataInicioEstudo > $dataFimEstudo)
							$msg .= " - A data inicial do estudo deve ser igual ou anterior a data final do estudo;\n";
					}

					if (!empty($msg))
						throw new CException($msg);
					
					$artigo->CodObjetoPesquisa = $_POST['Artigo']['CodObjetoPesquisa'];
					$artigo->NomeArtigo = $_POST['Artigo']['Nome'];
					$artigo->CodRevista = (!empty($_POST['Artigo']['RevistaConferencia']) ? $_POST['Artigo']['RevistaConferencia'] : NULL);
					$artigo->AnoPublicacao = $_POST['Artigo']['AnoPublicacao'];
					$artigo->CodAbrangencia = $_POST['Artigo']['CodAbrangencia'];
					$artigo->Resumo = $_POST['Artigo']['Resumo'];
					$artigo->IndicadorRevistaConferencia = $_POST['Artigo']['IndicadorRevistaConferencia'];
					$artigo->DataInicioEstudo = $dataInicioEstudo;
					$artigo->DataFimEstudo = $dataFimEstudo;
					$artigo->UrlArtigo = (!empty($_POST['Artigo']['UrlArtigo']) ? $_POST['Artigo']['UrlArtigo'] : NULL);
					
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
					
					if (empty($_POST['Artigo']['Numero']))
						$artigo->Numero = NULL;
					else
						$artigo->Numero = $_POST['Artigo']['Numero'];
					
					if (empty($_POST['Artigo']['NomeIngles']))
						$artigo->NomeArtigoIngles = NULL;
					else
						$artigo->NomeArtigoIngles = $_POST['Artigo']['NomeIngles'];
					
					if ($artigo->save())
					{
						ArtigoTipoAnalise::deletarRelacoes($artigo->CodArtigo);
						if (isset($_POST['Artigo']['Analise']) && !empty($_POST['Artigo']['Analise']))
						{
							foreach ($_POST['Artigo']['Analise'] as $key => $value)
							{
								$artigoTipoAnalise = new ArtigoTipoAnalise();
								$artigoTipoAnalise->CodArtigo = $artigo->CodArtigo;
								$artigoTipoAnalise->CodTipoAnalise = $value;
								$artigoTipoAnalise->save();
							}
						}
						
						ArtigoTipoObjetivo::deletarRelacoes($artigo->CodArtigo);
						if (isset($_POST['Artigo']['Objetivo']) && !empty($_POST['Artigo']['Objetivo']))
						{
							foreach ($_POST['Artigo']['Objetivo'] as $key => $value)
							{
								$artigoTipoObjetivo = new ArtigoTipoObjetivo();
								$artigoTipoObjetivo->CodArtigo = $artigo->CodArtigo;
								$artigoTipoObjetivo->CodTipoObjetivo = $value;
								$artigoTipoObjetivo->save();
							}
						}
						
						ArtigoTipoProcedimento::deletarRelacoes($artigo->CodArtigo);
						if (isset($_POST['Artigo']['Procedimento']) && !empty($_POST['Artigo']['Procedimento']))
						{
							foreach ($_POST['Artigo']['Procedimento'] as $key => $value)
							{
								$artigoTipoProcedimento = new ArtigoTipoProcedimento();
								$artigoTipoProcedimento->CodArtigo = $artigo->CodArtigo;
								$artigoTipoProcedimento->CodTipoProcedimento = $value;
								$artigoTipoProcedimento->save();
							}
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
						if (isset($_POST['Artigo']['Coordenador']) && !empty($_POST['Artigo']['Coordenador']))
						{
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
						}
										
						$transaction->commit();
					}
					else
						throw new CException('Não foi possível salvar o Artigo');

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

	public function actionListar()
	{
		$arrFiltros = array(
			'NomeArtigo'=>'',
			'CodInstituicao'=>'',
			'NomeInstituicao'=>'',
			'AnoPublicacao'=>'',
			'CodAbrangencia'=>'',
			'CodObjetoPesquisa'=>'',
			'IndicadorRevistaConferencia'=>'',
			'CodTipoAnalise'=>'',
			'CodTipoObjetivo'=>'',
			'CodTipoProcedimento'=>'',
			'CodAutor'=>'',
			'NomeAutor'=>'',
			'CodPalavra'=>'',
			'NomePalavra'=>'',
			'CodRevista'=>'',
		);
			
		if (isset($_GET['Filtro']))
			foreach ($_GET['Filtro'] as $key=>$value)
				$arrFiltros[$key] = $value;
			
		$imgFiltro = Yii::app()->baseUrl . '/images/expandir.gif';
		$filtroUsado = false;
		$with = array('ObjetoPesquisa', 'Abrangencia');
		
		$criteria = new CDbCriteria();
		$criteria->order = 't.AnoPublicacao DESC';

		if (isset($_GET['Filtro']['NomeArtigo']) && !empty($_GET['Filtro']['NomeArtigo']))
		{
			$criteria->addSearchCondition('t.NomeArtigo', $_GET['Filtro']['NomeArtigo']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodInstituicao']) && !empty($_GET['Filtro']['CodInstituicao']))
		{
			$with[] = 'Instituicao';
			$criteria->addCondition('Instituicao.CodInstituicao = ' . $_GET['Filtro']['CodInstituicao']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodPalavra']) && !empty($_GET['Filtro']['CodPalavra']))
		{
			$with[] = 'Palavra';
			$criteria->addCondition('Palavra.CodPalavra = ' . $_GET['Filtro']['CodPalavra']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodAutor']) && !empty($_GET['Filtro']['CodAutor']))
		{
			$with[] = 'Autor';
			$criteria->addCondition('Autor.CodAutor = ' . $_GET['Filtro']['CodAutor']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['AnoPublicacao']) && !empty($_GET['Filtro']['AnoPublicacao']))
		{
			$criteria->addCondition('t.AnoPublicacao = ' . $_GET['Filtro']['AnoPublicacao']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodAbrangencia']) && !empty($_GET['Filtro']['CodAbrangencia']))
		{
			$criteria->addCondition('t.CodAbrangencia = ' . $_GET['Filtro']['CodAbrangencia']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodRevista']) && !empty($_GET['Filtro']['CodRevista']))
		{
			$with[] = 'Revista';
			$criteria->addCondition('t.CodRevista = ' . $_GET['Filtro']['CodRevista']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodObjetoPesquisa']) && !empty($_GET['Filtro']['CodObjetoPesquisa']))
		{
			$criteria->addCondition('t.CodObjetoPesquisa = ' . $_GET['Filtro']['CodObjetoPesquisa']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}

		if (isset($_GET['Filtro']['IndicadorRevistaConferencia']) && !empty($_GET['Filtro']['IndicadorRevistaConferencia']))
		{
			if ($_GET['Filtro']['IndicadorRevistaConferencia'] == 1)
				$criteria->addCondition('t.IndicadorRevistaConferencia = "C"');
			else
				$criteria->addCondition('t.IndicadorRevistaConferencia = "R"');
			
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodTipoAnalise']) && !empty($_GET['Filtro']['CodTipoAnalise']))
		{
			$with[] = 'Analise';
			$criteria->addCondition('Analise.CodTipoAnalise = ' . $_GET['Filtro']['CodTipoAnalise']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodTipoObjetivo']) && !empty($_GET['Filtro']['CodTipoObjetivo']))
		{
			$with[] = 'Objetivo';
			$criteria->addCondition('Objetivo.CodTipoObjetivo = ' . $_GET['Filtro']['CodTipoObjetivo']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}
		
		if (isset($_GET['Filtro']['CodTipoProcedimento']) && !empty($_GET['Filtro']['CodTipoProcedimento']))
		{
			$with[] = 'Procedimento';
			$criteria->addCondition('Procedimento.CodTipoProcedimento = ' . $_GET['Filtro']['CodTipoProcedimento']);
			$filtroUsado = true;
			$imgFiltro = Yii::app()->baseUrl . '/images/contrair.gif';
		}

		$artigos = Artigo::model()->with($with)->findAll($criteria);
		$dataProvider = new CArrayDataProvider($artigos, array(
			'keyField'=>'CodArtigo',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array(
			'dataProvider'=>$dataProvider,
			'arrFiltros'=>$arrFiltros,
			'filtroUsado'=>$filtroUsado,
			'imgFiltro'=>$imgFiltro,
		));
	}
	
	public function actionRemover()
	{
		if (isset($_GET['CodArtigo']) && !empty($_GET['CodArtigo']))
		{
			$CodArtigo = $_GET['CodArtigo'];
			$artigo = Artigo::model()->findByPk($CodArtigo);
			
			if (empty($artigo))
			{
				Yii::app()->user->setFlash('danger', 'Artigo não encontrado!');
				$this->redirect('listar');
			}
			
			try
			{
				
				ArtigoAutor::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				ArtigoCoordenador::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				ArtigoInstituicao::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				ArtigoPalavra::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				ArtigoTipoAnalise::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				ArtigoTipoObjetivo::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				ArtigoTipoProcedimento::model()->deleteAllByAttributes(array('CodArtigo'=>$CodArtigo));
				$artigo->delete();
				
				echo 'Artigo excluído com sucesso!';
			}
			catch (Exception $e)
			{
				echo 'Não foi possível excluir o artigo!';
			}
		}
		else
		{
			Yii::app()->user->setFlash('danger', 'Artigo não encontrado!');
			$this->redirect('listar');
		}
	}
}