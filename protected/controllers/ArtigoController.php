<?php

class ArtigoController extends BaseController 
{
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
					$artigo->AnoPublicacao = $_POST['Artigo']['AnoPublicacao'];
					$artigo->CodAbrangencia = $_POST['Artigo']['CodAbrangencia'];
					$artigo->Resumo = $_POST['Artigo']['Resumo'];
					$artigo->DataInicioEstudo = (DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataInicioEstudo']))->format('Y-m-d');
					$artigo->DataFimEstudo = (DateTime::createFromFormat('d/m/Y', $_POST['Artigo']['DataFimEstudo']))->format('Y-m-d');
					
					if (isset($_POST['Artigo']['Multicentrico']))
						$artigo->Multicentrico = 'S';
					else
						$artigo->Multicentrico = 'N';
					
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
						throw new CException('Não foi possível salvar o Artigo');//Yii::app()->user->setFlash('danger', 'Não foi possível salvar o Artigo!');

					
					Yii::app()->user->setFlash('success', 'Artigo salvo com sucesso!');
					$this->redirect(array('artigo/listar'));
				}
				catch (CException $e)
				{
					Yii::app()->user->setFlash('danger', $e->getMessage());
					$this->render('formulario');
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
		$artigos = Artigo::model()->with(array('ObjetoPesquisa', 'Abrangencia'))->findAll(array('order'=>'CodArtigo ASC'));
		$dataProvider = new CArrayDataProvider($artigos, array(
			'keyField'=>'CodArtigo',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}