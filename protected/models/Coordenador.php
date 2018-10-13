<?php

/**
 * This is the model class for table "Coordenador".
 *
 * The followings are the available columns in table 'Coordenador':
 * @property integer $CodCoordenador
 * @property string $NomeCoordenador
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 */
class Coordenador extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Coordenador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeCoordenador', 'required'),
			array('CodCoordenador', 'numerical', 'integerOnly'=>true),
			array('NomeCoordenador', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodCoordenador, NomeCoordenador', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::MANY_MANY, 'Artigo', 'ArtigoCoordenador(CodCoordenador, CodArtigo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodCoordenador' => 'Cod Coordenador',
			'NomeCoordenador' => 'Nome Coordenador',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('CodCoordenador',$this->CodCoordenador);
		$criteria->compare('NomeCoordenador',$this->NomeCoordenador,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Coordenador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodCoordenador();
				
		return parent::beforeSave();
	}
	
	private function setCodCoordenador()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodCoordenador), 0)+1 AS CodCoordenador FROM Coordenador');
		$result = $command->queryRow();
		$this->CodCoordenador = $result['CodCoordenador'];
	}
	
	public static function getCoordenadores()
	{
		$coordenadores = Coordenador::model()->findAll(array('order'=>'NomeCoordenador ASC'));
		return CHTml::listData($coordenadores, 'CodCoordenador', 'NomeCoordenador');
	}
}
