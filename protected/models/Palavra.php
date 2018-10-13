<?php

/**
 * This is the model class for table "Palavra".
 *
 * The followings are the available columns in table 'Palavra':
 * @property integer $CodPalavra
 * @property string $NomePalavra
 * @property integer $CodArtigo
 *
 * The followings are the available model relations:
 * @property Artigo $codArtigo
 */
class Palavra extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Palavra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomePalavra', 'required'),
			array('CodPalavra', 'numerical', 'integerOnly'=>true),
			array('NomePalavra', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodPalavra, NomePalavra', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodPalavra' => 'Cod Palavra',
			'NomePalavra' => 'Nome Palavra',
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

		$criteria->compare('CodPalavra',$this->CodPalavra);
		$criteria->compare('NomePalavra',$this->NomePalavra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Palavra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodPalavra();
				
		return parent::beforeSave();
	}
	
	private function setCodPalavra()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodPalavra), 0)+1 AS CodPalavra FROM Palavra');
		$result = $command->queryRow();
		$this->CodPalavra = $result['CodPalavra'];
	}
	
	public static function getPalavras()
	{
		$palavras = Palavra::model()->findAll(array('order'=>'NomePalavra ASC'));
		return CHTml::listData($palavras, 'CodPalavra', 'NomePalavra');
	}
}
