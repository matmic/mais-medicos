<?php

/**
 * This is the model class for table "abrangencia".
 *
 * The followings are the available columns in table 'abrangencia':
 * @property integer $CodAbrangencia
 * @property string $NomeAbrangencia
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 */
class Abrangencia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'abrangencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeAbrangencia', 'required'),
			array('CodAbrangencia', 'numerical', 'integerOnly'=>true),
			array('NomeAbrangencia', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodAbrangencia, NomeAbrangencia', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::HAS_MANY, 'Artigo', 'CodAbrangencia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodAbrangencia' => 'Cod Abrangencia',
			'NomeAbrangencia' => 'Nome Abrangencia',
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

		$criteria->compare('CodAbrangencia',$this->CodAbrangencia);
		$criteria->compare('NomeAbrangencia',$this->NomeAbrangencia,true);

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
			$this->setCodAbrangencia();
				
		return parent::beforeSave();
	}
	
	private function setCodAbrangencia()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodAbrangencia), 0)+1 AS CodAbrangencia FROM abrangencia');
		$result = $command->queryRow();
		$this->CodAbrangencia = $result['CodAbrangencia'];
	}
	
	public static function getAbrangencias()
	{
		$abrangencias = self::model()->findAll(array('order'=>'NomeAbrangencia ASC'));
		return CHtml::listData($abrangencias, 'CodAbrangencia', 'NomeAbrangencia');
	}
}
