<?php

/**
 * This is the model class for table "tipoanalise".
 *
 * The followings are the available columns in table 'tipoanalise':
 * @property integer $CodTipoAnalise
 * @property string $NomeTipoAnalise
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 */
class TipoAnalise extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipoanalise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeTipoAnalise', 'required'),
			array('CodTipoAnalise', 'numerical', 'integerOnly'=>true),
			array('NomeTipoAnalise', 'length', 'max'=>100),
			array('IndicadorExclusao', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodTipoAnalise, NomeTipoAnalise', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::MANY_MANY, 'Artigo', 'artigotipoanalise(CodTipoAnalise, CodArtigo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodTipoAnalise' => 'Cod Tipo Analise',
			'NomeTipoAnalise' => 'Nome Tipo Analise',
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

		$criteria->compare('CodTipoAnalise',$this->CodTipoAnalise);
		$criteria->compare('NomeTipoAnalise',$this->NomeTipoAnalise,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoAnalise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodTipoAnalise();
				
		return parent::beforeSave();
	}
	
	private function setCodTipoAnalise()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodTipoAnalise), 0)+1 AS CodTipoAnalise FROM tipoanalise');
		$result = $command->queryRow();
		$this->CodTipoAnalise = $result['CodTipoAnalise'];
	}
	
	public static function getTiposAnalises()
	{
		$tiposAnalises = self::model()->findAll(array('order'=>'NomeTipoAnalise ASC', 'condition'=>'IndicadorExclusao IS NULL'));
		return CHtml::listData($tiposAnalises, 'CodTipoAnalise', 'NomeTipoAnalise');
	}
}
