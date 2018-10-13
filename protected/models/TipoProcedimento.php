<?php

/**
 * This is the model class for table "TipoProcedimento".
 *
 * The followings are the available columns in table 'TipoProcedimento':
 * @property integer $CodTipoProcedimento
 * @property string $NomeTipoProcedimento
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 */
class TipoProcedimento extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TipoProcedimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeTipoProcedimento', 'required'),
			array('CodTipoProcedimento', 'numerical', 'integerOnly'=>true),
			array('NomeTipoProcedimento', 'length', 'max'=>100),
			array('IndicadorExclusao', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodTipoProcedimento, NomeTipoProcedimento', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::MANY_MANY, 'Artigo', 'ArtigoTipoProcedimento(CodTipoProcedimento, CodArtigo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodTipoProcedimento' => 'Cod Tipo Procedimento',
			'NomeTipoProcedimento' => 'Nome Tipo Procedimento',
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

		$criteria->compare('CodTipoProcedimento',$this->CodTipoProcedimento);
		$criteria->compare('NomeTipoProcedimento',$this->NomeTipoProcedimento,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoProcedimento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodTipoProcedimento();
				
		return parent::beforeSave();
	}
	
	private function setCodTipoProcedimento()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodTipoProcedimento), 0)+1 AS CodTipoProcedimento FROM TipoProcedimento');
		$result = $command->queryRow();
		$this->CodTipoProcedimento = $result['CodTipoProcedimento'];
	}
	
	public static function getTiposProcedimentos()
	{
		$tiposProcedimentos = self::model()->findAll(array('order'=>'NomeTipoProcedimento ASC', 'condition'=>'IndicadorExclusao IS NULL'));
		return CHtml::listData($tiposProcedimentos, 'CodTipoProcedimento', 'NomeTipoProcedimento');
	}
}
