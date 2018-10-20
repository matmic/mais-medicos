<?php

class BaseController extends Controller
{
	public $menu;
	
	public function beforeAction($action)
	{
		if (!Yii::app()->user->isGuest)
		{
			$this->menu = array(
				// LOGOUT
				array(
					'label'=>'Logout',
					'icone'=>'c-red-500 ti-back-left',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('site/logout', array()),
				),
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
					'label'=>'Objeto de Pesquisa',
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
					'label'=>'Tipo de Abordagem',
					'url'=>Yii::app()->createUrl('grafico/tipoAnalise', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipo de Objetivo',
					'url'=>Yii::app()->createUrl('grafico/tipoObjetivo', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipo de Procedimento',
					'url'=>Yii::app()->createUrl('grafico/tipoProcedimento', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipo de Publicação',
					'url'=>Yii::app()->createUrl('grafico/tipoPublicacao', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
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
					'label'=>'Objetos de Pesquisa',
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
				array(
					'label'=>'Procedimentos',
					'icone'=>'c-blue-500 ti-stats-up',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('tipoProcedimento/listar', array()),
				),
				// USUÁRIOS
				array(
					'label'=>'Usuários',
					'icone'=>'c-black-500 ti-user',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('site/listar', array()),
				),
			);
		}
		else
			$this->menu = array(
				// LOGIN
				array(
					'label'=>'Login',
					'icone'=>'c-red-500 ti-back-right',
					'tipo'=>'entrada',
					'pertenceDropdown'=>false,
					'url'=>Yii::app()->createUrl('site/login', array()),
				),
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
					'label'=>'Objeto de Pesquisa',
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
					'label'=>'Tipo de Abordagem',
					'url'=>Yii::app()->createUrl('grafico/tipoAnalise', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipo de Objetivo',
					'url'=>Yii::app()->createUrl('grafico/tipoObjetivo', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipo de Procedimento',
					'url'=>Yii::app()->createUrl('grafico/tipoProcedimento', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Tipo de Publicação',
					'url'=>Yii::app()->createUrl('grafico/tipoPublicacao', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
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
				'controllers' => array('grafico', 'auxiliar', 'abrangencia', 'artigo', 'instituicao', 'objetoPesquisa', 'site', 'tipoAnalise', 'tipoObjetivo', 'tipoProcedimento', 'unidadeFederacao'),
			),
			array(
				'allow',
				'users' => array('*'),
				'controllers' => array('site'),
				'actions'=>array('login', 'index'),
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
				'controllers' => array('auxiliar', 'grafico'),
			),
			array(
				'deny',
                'users' => array('*'),
            ),
			// array(
				// 'allow',
				// 'controllers' => array('documentacao'),
				// 'users' => array('@'),
			// ),
			// array(
				// 'allow',
				// 'controllers' => array('membroFamilia'),
				// 'users' => array('@'),
			// ),
			// array(
				// 'allow',
				// 'controllers' => array('declaracoes'),
				// 'users' => array('@'),
			// ),
		);
	}
}

