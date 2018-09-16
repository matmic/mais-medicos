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
				$this->render('error', $error);
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
					Yii::app()->user->setFlash('danger', "Não foi possível logar-se! Verifique as informações preenchidas!");
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
		if (isset($_POST['Usuario']))
		{
			$usuario = new Usuario();
			$usuario->EmailUsuario = $_POST['Usuario']['EmailUsuario'];
			$usuario->SenhaUsuario = password_hash($_POST['Usuario']['SenhaUsuario'], PASSWORD_DEFAULT);
			$usuario->NomeUsuario = $_POST['Usuario']['NomeUsuario'];
			
			if ($usuario->save())
			{
				Yii::app()->user->setFlash('success', 'Usuário criado com sucesso!');
				$this->redirect(array('site/login'));
			}
			else
			{
				Yii::app()->user->setFlash('danger', 'Erro ao criar usuário!');
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