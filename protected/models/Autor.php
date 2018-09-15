<?php

/**
 * This is the model class for table "autor".
 *
 * The followings are the available columns in table 'autor':
 * @property integer $CodAutor
 * @property string $NomeAutor
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 */
class Autor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'autor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeAutor', 'required'),
			array('CodAutor', 'numerical', 'integerOnly'=>true),
			array('NomeAutor', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodAutor, NomeAutor', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::MANY_MANY, 'Artigo', 'artigoautor(CodAutor, CodArtigo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodAutor' => 'Cod Autor',
			'NomeAutor' => 'Nome Autor',
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

		$criteria->compare('CodAutor',$this->CodAutor);
		$criteria->compare('NomeAutor',$this->NomeAutor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Autor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodAutor();
				
		return parent::beforeSave();
	}
	
	private function setCodAutor()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodAutor), 0)+1 AS CodAutor FROM Autor');
		$result = $command->queryRow();
		$this->CodAutor = $result['CodAutor'];
	}
	
	public static function getAutores()
	{
		$autores = Autor::model()->findAll(array('order'=>'NomeAutor ASC'));
		return CHTml::listData($autores, 'CodAutor', 'NomeAutor');
	}
}
