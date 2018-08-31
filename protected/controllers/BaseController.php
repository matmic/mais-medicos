<?php

class BaseController extends Controller
{
	public $menu;
	
	public function beforeAction($action)
	{
		$this->menu = array(
			// INSTITUIÇÕES
			array(
				'label'=>'Gerenciar Instituições',
				'icone'=>'c-blue-500 ti-agenda',
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
			// UNIDADES DA FEDERAÇÃO
			array(
				'label'=>'Unidades da Federação',
				'url'=>Yii::app()->createUrl("unidadeFederacao/listar"),
				'icone'=>'c-green-500 ti-blackboard',
				'tipo'=>'entrada',
				'pertenceDropdown'=>false,
			),
			// OBJETOS DE PESQUISA
			array(
				'label'=>'Gerenciar Objetos da Pesquisa',
				'icone'=>'c-blue-500 ti-agenda',
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
		);
	
		return parent::beforeAction($action);
	}
}

