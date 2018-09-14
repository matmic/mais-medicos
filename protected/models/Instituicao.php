<?php

/**
 * This is the model class for table "instituicao".
 *
 * The followings are the available columns in table 'instituicao':
 * @property integer $CodInstituicao
 * @property string $NomeInstituicao
 * @property string $SiglaInstituicao
 * @property integer $CodUF
 *
 * The followings are the available model relations:
 * @property Artigo[] $artigos
 * @property Unidadefederacao $codUF
 */
class Instituicao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'instituicao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NomeInstituicao, CodUF', 'required'),
			array('CodInstituicao, CodUF', 'numerical', 'integerOnly'=>true),
			array('NomeInstituicao', 'length', 'max'=>200),
			array('SiglaInstituicao', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodInstituicao, NomeInstituicao, SiglaInstituicao, CodUF', 'safe', 'on'=>'search'),
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
			'artigos' => array(self::MANY_MANY, 'Artigo', 'artigoinstituicao(CodInstituicao, CodArtigo)'),
			'codUF' => array(self::BELONGS_TO, 'Unidadefederacao', 'CodUF'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodInstituicao' => 'Cod Instituicao',
			'NomeInstituicao' => 'Nome Instituicao',
			'SiglaInstituicao' => 'Sigla Instituicao',
			'CodUF' => 'Cod Uf',
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

		$criteria->compare('CodInstituicao',$this->CodInstituicao);
		$criteria->compare('NomeInstituicao',$this->NomeInstituicao,true);
		$criteria->compare('SiglaInstituicao',$this->SiglaInstituicao,true);
		$criteria->compare('CodUF',$this->CodUF);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Instituicao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->setCodInstituicao();
				
		return parent::beforeSave();
	}
	
	private function setCodInstituicao()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodInstituicao), 0)+1 AS CodInstituicao FROM instituicao');
		$result = $command->queryRow();
		$this->CodInstituicao = $result['CodInstituicao'];
	}
	
	public static function getInstituicoes()
	{
		$instituicoes = self::model()->findAll(array('order'=>'NomeInstituicao ASC'));
		
		return CHtml::listData($instituicoes, 'CodInstituicao', function($instituicao) {
			return (!empty($instituicao->SiglaInstituicao) ? $instituicao->SiglaInstituicao . ' - ' . $instituicao->NomeInstituicao : $instituicao->NomeInstituicao);
			//return $instituicao->SiglaInstituicao . ' - ' . $instituicao->NomeInstituicao;
		});
	}
}
