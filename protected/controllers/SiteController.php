<?php

class SiteController extends BaseController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
		//$this->redirect(Yii::app()->createAbsoluteUrl("site/login"));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('erro', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest)
		{
			if (isset($_POST['Usuario']))
			{
				$email = $_POST['Usuario']['EmailUsuario'];
				$password = $_POST['Usuario']['SenhaUsuario'];
					
				$identity = new UserIdentity($email, $password);

				if ($identity->authenticate())
				{
					Yii::app()->user->login($identity);
					Yii::app()->user->setFlash('success', "Você está logado!");
					$this->redirect(array('site/index'));
				}
				else
				{
					Yii::app()->user->setFlash('danger', "Não foi possível logar! Verifique as informações preenchidas!");
					$this->redirect('login');
				}
			}
			else
			{
				$usuario = new Usuario;
				$this->render('login', array('usuario'=>$usuario));
			}
		}
		else
			$this->render('index');
		
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionFormulario()
	{
		if (isset($_GET['CodUsuario']))
		{
			$usuario = Usuario::model()->findByPk($_GET['CodUsuario']);
			if (empty($usuario))
			{
				Yii::app()->user->setFlash('danger', 'Não foi encontrada um Usuário válido!');
				$this->redirect(array('site/listar'));
			}
			else
			{
				$this->render('formulario', array('usuario'=>$usuario));
			}
		}
		else
		{
			if (isset($_POST['Usuario']))
			{
				if (!empty($_POST['Usuario']['CodUsuario']))
				{
					$usuario = Usuario::model()->findByPk($_POST['Usuario']['CodUsuario']);
					if (empty($usuario))
					{
						Yii::app()->user->setFlash('danger', 'Não foi encontrada um Usuário válido!');
						$this->redirect(array('site/listar'));
					}
				}
				else
					$usuario = new Usuario();
				
				$usuario->EmailUsuario = $_POST['Usuario']['EmailUsuario'];
				
				if (!empty($_POST['Usuario']['SenhaUsuario']))
					$usuario->SenhaUsuario = password_hash($_POST['Usuario']['SenhaUsuario'], PASSWORD_DEFAULT);
				
				$usuario->NomeUsuario = $_POST['Usuario']['NomeUsuario'];
				$usuario->IndicadorExclusao = isset($_POST['Usuario']['IndicadorExclusao']) ? NULL : 'S';
				
				if ($usuario->save())
				{
					Yii::app()->user->setFlash('success', 'Usuário salvo com sucesso!');
					$this->redirect(array('site/listar'));
				}
				else
				{
					Yii::app()->user->setFlash('danger', 'Erro ao salvar Usuário!');
					$this->redirect(array('site/formulario'));
				}
			}
			else
			{
				$usuario = new Usuario();
				$this->render('formulario', array('usuario'=>$usuario));
			}
		}
	}
	
	public function actionListar()
	{
		$usuarios = Usuario::model()->findAll();
		
		$dataProvider = new CArrayDataProvider($usuarios, array(
			'keyField'=>'CodUsuario',
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('listar', array('dataProvider'=>$dataProvider));
	}
}