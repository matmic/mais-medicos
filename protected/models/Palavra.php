<?php

/**
 * This is the model class for table "palavra".
 *
 * The followings are the available columns in table 'palavra':
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
		return 'palavra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CodPalavra, NomePalavra, CodArtigo', 'required'),
			array('CodPalavra, CodArtigo', 'numerical', 'integerOnly'=>true),
			array('NomePalavra', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodPalavra, NomePalavra, CodArtigo', 'safe', 'on'=>'search'),
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
			'codArtigo' => array(self::BELONGS_TO, 'Artigo', 'CodArtigo'),
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
			'CodArtigo' => 'Cod Artigo',
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
		$criteria->compare('CodArtigo',$this->CodArtigo);

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
}
