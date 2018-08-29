<?php

class BaseController extends Controller
{
	public $menu;
	
	public function beforeAction($action)
	{
		$this->menu = array(
			array(
				'label'=>'Gerenciar Instituições',
				'url'=>Yii::app()->createUrl('instituicao/formulario', array()),
				'icone'=>'c-blue-500 ti-agenda',
				'tipo'=>'dropdown',
				'pertenceDropdown'=>true,
			),
			array(
				'label'=>'Nova Instituição',
				'url'=>Yii::app()->createUrl('instituicao/formulario', array()),
				'icone'=>'c-brown-500 ti-agenda',
				'tipo'=>'entrada',
				'pertenceDropdown'=>true,
			),
			array(
				'label'=>'Listar Instituições',
				'url'=>Yii::app()->createUrl('instituicao/listar', array()),
				'icone'=>'c-brown-500 ti-agenda',
				'tipo'=>'entrada',
				'pertenceDropdown'=>true,
			),
			array(
				'tipo'=>'dropdown',
				'pertenceDropdown'=>false,
			),
			array(
				'label'=>'Unidades da Federação',
				'url'=>Yii::app()->createUrl("unidadeFederacao/listar"),
				'icone'=>'c-green-500 ti-blackboard',
				'tipo'=>'entrada',
				'pertenceDropdown'=>false,
			),
		);
	
		return parent::beforeAction($action);
	}
}

