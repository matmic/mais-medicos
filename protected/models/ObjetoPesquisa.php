<?php

/**
 * This is the model class for table "ObjetoPesquisa".
 *
 * The followings are the available columns in table 'ObjetoPesquisa':
 * @property integer $CodObjetoPesquisa
 * @property string $NomeObjetoPesquisa
 * @property integer $CodObjetoPesquisaPai
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 * @property ObjetoPesquisa $codObjetoPesquisaPai
 * @property ObjetoPesquisa[] $objetopesquisas
 */
class ObjetoPesquisa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ObjetoPesquisa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeObjetoPesquisa', 'required'),
			array('CodObjetoPesquisa', 'numerical', 'integerOnly'=>true),
			array('NomeObjetoPesquisa', 'length', 'max'=>100),
			array('IndicadorExclusao', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodObjetoPesquisa, NomeObjetoPesquisa, CodObjetoPesquisaPai', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::HAS_MANY, 'Artigo', 'CodObjetoPesquisa'),
			'codObjetoPesquisaPai' => array(self::BELONGS_TO, 'ObjetoPesquisa', 'CodObjetoPesquisaPai'),
			'objetopesquisas' => array(self::HAS_MANY, 'ObjetoPesquisa', 'CodObjetoPesquisaPai'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodObjetoPesquisa' => 'Cod Objeto Pesquisa',
			'NomeObjetoPesquisa' => 'Nome Objeto Pesquisa',
			'CodObjetoPesquisaPai' => 'Cod Objeto Pesquisa Pai',
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

		$criteria->compare('CodObjetoPesquisa',$this->CodObjetoPesquisa);
		$criteria->compare('NomeObjetoPesquisa',$this->NomeObjetoPesquisa,true);
		$criteria->compare('CodObjetoPesquisaPai',$this->CodObjetoPesquisaPai);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ObjetoPesquisa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodObjetoPesquisa();
				
		return parent::beforeSave();
	}
	
	private function setCodObjetoPesquisa()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodObjetoPesquisa), 0)+1 AS CodObjetoPesquisa FROM ObjetoPesquisa');
		$result = $command->queryRow();
		$this->CodObjetoPesquisa = $result['CodObjetoPesquisa'];
	}
	
	public static function getObjetosPesquisasPais()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = "CodObjetoPesquisaPai IS NULL";
		$criteria->addCondition("IndicadorExclusao IS NULL");
		$criteria->order = 'CodObjetoPesquisa ASC';
		$objetoPesquisas = self::model()->findAll($criteria);
		
		return CHtml::listData($objetoPesquisas, 'CodObjetoPesquisa', 'NomeObjetoPesquisa');
	}
	
	public static function getObjetosPesquisas()
	{
		$objetoPesquisas = self::model()->findAll(array('order'=>'CodObjetoPesquisa ASC', 'condition'=>'IndicadorExclusao IS NULL'));
		
		return CHtml::listData($objetoPesquisas, 'CodObjetoPesquisa', 'NomeObjetoPesquisa');
	}
}
