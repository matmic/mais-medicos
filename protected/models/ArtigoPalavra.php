<?php

/**
 * This is the model class for table "artigopalavra".
 *
 * The followings are the available columns in table 'artigopalavra':
 * @property integer $CodArtigo
 * @property integer $CodPalavra
 */
class ArtigoPalavra extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'artigopalavra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CodArtigo, CodPalavra', 'required'),
			array('CodArtigo, CodPalavra', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodArtigo, CodPalavra', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodArtigo' => 'Cod Artigo',
			'CodPalavra' => 'Cod Palavra',
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

		$criteria->compare('CodArtigo',$this->CodArtigo);
		$criteria->compare('CodPalavra',$this->CodPalavra);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artigopalavra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function deletarRelacoes($CodArtigo) 
	{
		$command = Yii::app()->db->createCommand('DELETE FROM artigopalavra WHERE CodArtigo = :CodArtigo');
		$command->bindParam(":CodArtigo", $CodArtigo, PDO::PARAM_INT);
		$result = $command->query();
	}
	
	public static function getArtigoPalavras($CodArtigo)
	{
		$artigoPalavras = self::model()->findAll(array('condition'=>'CodArtigo = ' . $CodArtigo));
		$array = array();
		
		foreach ($artigoPalavras as $artigoPalavra)
		{
			$array[] = $artigoPalavra->CodPalavra;
		}
		
		return $array;
	}
}
