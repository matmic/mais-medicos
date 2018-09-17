<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	 private $_id;
	 private $_nome;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$usuario = Usuario::model()->findByAttributes(array('EmailUsuario'=>$this->username, 'IndicadorExclusao'=>NULL));
		
		if ($usuario === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else 
			if (!password_verify($this->password, $usuario->SenhaUsuario))
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id = $usuario->CodUsuario;
			$this->_nome = $usuario->NomeUsuario;
			
			$this->setState('CodUsuario', $usuario->CodUsuario);
			$this->setState('NomeUsuario', $usuario->NomeUsuario);

			$this->errorCode=self::ERROR_NONE;
		}
		
		return !$this->errorCode;
	}
	
	public function getId()
    {
        return $this->_id;
    }

    public function getNome(){
    	return $this->_nome;
    }
}