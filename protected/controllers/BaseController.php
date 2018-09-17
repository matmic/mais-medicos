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
				// INSTITUIÇÕES
				array(
					'label'=>'Ger. Instituições',
					'icone'=>'c-green-500 ti-blackboard',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Nova Instituição',
					'url'=>Yii::app()->createUrl('instituicao/formulario', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Listar Instituições',
					'url'=>Yii::app()->createUrl('instituicao/listar', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// OBJETOS DE PESQUISA
				array(
					'label'=>'Ger. Objetos de Pesquisa',
					'icone'=>'c-brown-500 ti-target',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Novo Objeto de Pesquisa',
					'url'=>Yii::app()->createUrl('objetoPesquisa/formulario', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Listar Objetos de Pesquisa',
					'url'=>Yii::app()->createUrl('objetoPesquisa/listar', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// ABRANGÊNCIA
				array(
					'label'=>'Ger. Abrangências',
					'icone'=>'c-red-500 ti-fullscreen',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Nova Abrangência',
					'url'=>Yii::app()->createUrl('abrangencia/formulario', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Listar Abrangências',
					'url'=>Yii::app()->createUrl('abrangencia/listar', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// ABORDAGEM - TIPO ANÁLISE
				array(
					'label'=>'Ger. Abordagens',
					'icone'=>'c-yellow-500 ti-search',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Nova Abordagem',
					'url'=>Yii::app()->createUrl('tipoAnalise/formulario', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Listar Abordagens',
					'url'=>Yii::app()->createUrl('tipoAnalise/listar', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// TIPO OBJETIVO
				array(
					'label'=>'Ger. Objetivos',
					'icone'=>'c-orange-500 ti-direction-alt',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Novo Objetivo',
					'url'=>Yii::app()->createUrl('tipoObjetivo/formulario', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Listar Objetivos',
					'url'=>Yii::app()->createUrl('tipoObjetivo/listar', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// TIPO PROCEDIMENTO
				array(
					'label'=>'Ger. Procedimentos',
					'icone'=>'c-blue-500 ti-stats-up',
					'tipo'=>'dropdown',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Novo Procedimento',
					'url'=>Yii::app()->createUrl('tipoProcedimento/formulario', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'label'=>'Listar Procedimentos',
					'url'=>Yii::app()->createUrl('tipoProcedimento/listar', array()),
					'tipo'=>'entrada',
					'pertenceDropdown'=>true,
				),
				array(
					'tipo'=>'dropdown',
					'pertenceDropdown'=>false,
				),
				// ARTIGO
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
				'controllers' => array('abrangencia', 'artigo', 'instituicao', 'objetoPesquisa', 'site', 'tipoAnalise', 'tipoObjetivo', 'tipoProcedimento', 'unidadeFederacao'),
			),
			array(
				'allow',
				'users' => array('*'),
				'controllers' => array('site'),
				'actions'=>array('login', 'index'),
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

