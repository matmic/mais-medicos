<?php

/**
 * This is the model class for table "artigoinstituicao".
 *
 * The followings are the available columns in table 'artigoinstituicao':
 * @property integer $CodArtigo
 * @property integer $CodInstituicao
 */
class ArtigoInstituicao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'artigoinstituicao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CodArtigo, CodInstituicao', 'required'),
			array('CodArtigo, CodInstituicao', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodArtigo, CodInstituicao', 'safe', 'on'=>'search'),
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
			'CodInstituicao' => 'Cod Instituicao',
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
		$criteria->compare('CodInstituicao',$this->CodInstituicao);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArtigoInstituicao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function deletarRelacoes($CodArtigo) 
	{
		$command = Yii::app()->db->createCommand('DELETE FROM artigoinstituicao WHERE CodArtigo = :CodArtigo');
		$command->bindParam(":CodArtigo", $CodArtigo, PDO::PARAM_INT);
		$result = $command->query();
	}
	
	public static function getArtigoInstituicoes($CodArtigo)
	{
		$artigoInstituicoes = self::model()->findAll(array('condition'=>'CodArtigo = ' . $CodArtigo));
		$array = array();
		
		foreach ($artigoInstituicoes as $artigoInstituicao)
		{
			$array[] = $artigoInstituicao->CodInstituicao;
		}
		
		return $array;
	}
}
