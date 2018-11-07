<?php

/**
 * This is the model class for table "Revista".
 *
 * The followings are the available columns in table 'Revista':
 * @property integer $CodAbrangencia
 * @property string $NomeAbrangencia
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 */
class Revista extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Revista';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeRevista', 'required'),
			array('CodRevista', 'numerical', 'integerOnly'=>true),
			array('NomeRevista', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodRevista, Revista', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::HAS_MANY, 'Artigo', 'CodRevista'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodRevista' => 'Cod Revista',
			'NomeRevista' => 'Nome Revista',
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

		$criteria->compare('CodRevista',$this->CodRevista);
		$criteria->compare('NomeRevista',$this->NomeRevista,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Abrangencia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodRevista();
				
		return parent::beforeSave();
	}
	
	private function setCodRevista()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodRevista), 0)+1 AS CodRevista FROM Revista');
		$result = $command->queryRow();
		$this->CodRevista = $result['CodRevista'];
	}
	
	public static function getRevistas()
	{
		$revistas = self::model()->findAll(array('order'=>'NomeRevista ASC'));
		return CHtml::listData($revistas, 'CodRevista', 'NomeRevista');
	}
}
