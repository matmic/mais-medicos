<?php

/**
 * This is the model class for table "Usuario".
 *
 * The followings are the available columns in table 'Usuario':
 * @property integer $CodUsuario
 * @property string $NomeUsuario
 * @property string $EmailUsuario
 * @property string $SenhaUsuario
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 * @property Artigo[] $artigos1
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeUsuario, EmailUsuario, SenhaUsuario', 'required'),
			array('CodUsuario', 'numerical', 'integerOnly'=>true),
			array('NomeUsuario', 'length', 'max'=>100),
			array('EmailUsuario', 'length', 'max'=>45),
			array('SenhaUsuario', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodUsuario, NomeUsuario, EmailUsuario, SenhaUsuario', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'artigos' => array(self::HAS_MANY, 'Artigo', 'CodUsuario'),
			'artigos1' => array(self::HAS_MANY, 'Artigo', 'CodUsuarioUltimaAtu'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodUsuario' => 'Cod Usuario',
			'NomeUsuario' => 'Nome Usuario',
			'EmailUsuario' => 'Email Usuario',
			'SenhaUsuario' => 'Senha Usuario',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodUsuario();
				
		return parent::beforeSave();
	}
	
	private function setCodUsuario()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodUsuario), 0)+1 AS CodUsuario FROM Usuario');
		$result = $command->queryRow();
		$this->CodUsuario = $result['CodUsuario'];
	}
}
