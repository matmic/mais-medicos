<?php

class BaseController extends Controller
{
	public $menu;
	
	public function beforeAction($action)
	{
		if (!Yii::app()->user->isGuest)
		{
			$this->menu = array(
				// ARTIGO
				array(
					'label'=>'Artigos',
					'icone'=>'c-blue-500 ti-agenda',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('artigo/listar', array()),
				),
				// GRÁFICOS
				array(
					'label'=>'Gráficos',
					'icone'=>'c-brown-500 ti-pie-chart',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tema da Pesquisa',
					'url'=>Yii::app()->createUrl('grafico/objetoPesquisa', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Ano de Publicação',
					'url'=>Yii::app()->createUrl('grafico/anoPublicacaoObjetoPesquisa', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Instituição',
					'url'=>Yii::app()->createUrl('grafico/instituicao', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Palavras-chave',
					'url'=>Yii::app()->createUrl('grafico/palavra', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Revista',
					'url'=>Yii::app()->createUrl('grafico/revista', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipos de Pesquisa',
					'icone'=>'',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Quanto a Abordagem',
					'url'=>Yii::app()->createUrl('grafico/tipoAnalise', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Quanto ao Objetivo',
					'url'=>Yii::app()->createUrl('grafico/tipoObjetivo', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Quanto ao Procedimento',
					'url'=>Yii::app()->createUrl('grafico/tipoProcedimento', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// INSTITUIÇÕES
				array(
					'label'=>'Instituições',
					'icone'=>'c-green-500 ti-blackboard',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('instituicao/listar', array()),
				),
				// OBJETOS DE PESQUISA
				array(
					'label'=>'Temas de Pesquisa',
					'icone'=>'c-brown-500 ti-target',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('objetoPesquisa/listar', array()),
				),
				// ABRANGÊNCIA
				array(
					'label'=>'Abrangências',
					'icone'=>'c-red-500 ti-fullscreen',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('abrangencia/listar', array()),
				),
				// ABORDAGEM - TIPO ANÁLISE
				array(
					'label'=>'Abordagens',
					'icone'=>'c-yellow-500 ti-search',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('tipoAnalise/listar', array()),
				),
				// TIPO OBJETIVO
				array(
					'label'=>'Objetivos',
					'icone'=>'c-orange-500 ti-direction-alt',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('tipoObjetivo/listar', array()),
				),
				// TIPO PROCEDIMENTOS
				array(
					'label'=>'Procedimentos',
					'icone'=>'c-blue-500 ti-stats-up',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('tipoProcedimento/listar', array()),
				),
				// PALAVRAS
				array(
					'label'=>'Palavras-chave',
					'icone'=>'c-green-500 fa fa-font',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('palavra/listar', array()),
				),
				// REVISTAS
				array(
					'label'=>'Revistas',
					'icone'=>'c-red-500 ti-book',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('revista/listar', array()),
				),
				// USUÁRIOS
				array(
					'label'=>'Usuários',
					'icone'=>'c-black-500 ti-user',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('site/listar', array()),
				),
				// SOBRE
				array(
					'label'=>'Sobre',
					'icone'=>'c-black-500 ti-world',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('site/sobre', array()),
				),
			);
		}
		else
			$this->menu = array(
				// ARTIGO
				array(
					'label'=>'Artigos',
					'icone'=>'c-blue-500 ti-agenda',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('artigo/listar', array()),
				),
				// GRÁFICOS
				array(
					'label'=>'Gráficos',
					'icone'=>'c-brown-500 ti-pie-chart',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tema da Pesquisa',
					'url'=>Yii::app()->createUrl('grafico/objetoPesquisa', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Ano de Publicação',
					'url'=>Yii::app()->createUrl('grafico/anoPublicacaoObjetoPesquisa', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Instituição',
					'url'=>Yii::app()->createUrl('grafico/instituicao', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Palavras-chave',
					'url'=>Yii::app()->createUrl('grafico/palavra', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Revista',
					'url'=>Yii::app()->createUrl('grafico/revista', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipos de Pesquisa',
					'icone'=>'',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Quanto a Abordagem',
					'url'=>Yii::app()->createUrl('grafico/tipoAnalise', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Quanto ao Objetivo',
					'url'=>Yii::app()->createUrl('grafico/tipoObjetivo', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Quanto ao Procedimento',
					'url'=>Yii::app()->createUrl('grafico/tipoProcedimento', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// PALAVRAS
				array(
					'label'=>'Palavras-chave',
					'icone'=>'c-green-500 fa fa-font',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('palavra/listar', array()),
				),
				// SOBRE
				array(
					'label'=>'Sobre',
					'icone'=>'c-black-500 ti-world',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('site/sobre', array()),
				),
			);
	
		return parent::beforeAction($action);
	}
	
	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	
	public function accessRules()
    {		
		return array(
			array(
				'allow',
				'users' => array('@'),
				'controllers' => array('revista', 'palavra', 'grafico', 'auxiliar', 'abrangencia', 'artigo', 'instituicao', 'objetoPesquisa', 'site', 'tipoAnalise', 'tipoObjetivo', 'tipoProcedimento', 'unidadeFederacao'),
			),
			array(
				'allow',
				'users' => array('*'),
				'controllers' => array('site'),
				'actions'=>array('login', 'index', 'sobre'),
			),
			array(
				'allow',
				'users' => array('*'),
				'controllers' => array('artigo'),
				'actions'=>array('listar', 'visualizar'),
			),
			array(
				'allow',
				'users' => array('*'),
				'controllers' => array('palavra', 'auxiliar', 'grafico'),
			),
			array(
				'deny',
                'users' => array('*'),
            ),
		);
	}
}

