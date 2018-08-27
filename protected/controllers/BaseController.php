<?php

class BaseController extends Controller
{
	public $menu;
	
	public function beforeAction($action)
	{
		$this->menu = array(
			array(
				'label'=>'Teste',
				'url'=>Yii::app()->createUrl("news/view",array("id"=>1)),
				'icone'=>'c-brown-500 ti-email',
			),
			array(
				'label'=>'Gerenciar Instituições',
				'url'=>Yii::app()->createUrl('instituicao/formulario', array()),
				'icone'=>'c-brown-500 ti-email',
			),
		);
	
		return parent::beforeAction($action);
	}
}

