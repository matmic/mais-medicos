<?php

/**
 * This is the model class for table "Artigo".
 *
 * The followings are the available columns in table 'Artigo':
 * @property integer $CodArtigo
 * @property string $IndicadorRevistaConferencia
 * @property string $Resumo
 * @property string $Multicentrico
 * @property string $DataInicioEstudo
 * @property string $DataFimEstudo
 * @property integer $CodUsuarioInsercao
 * @property string $DataInsercao
 * @property integer $CodUsuarioUltimaAtu
 * @property string $DataUltimaAtu
 * @property integer $CodAbrangencia
 * @property integer $CodRevista
 * @property integer $CodObjetoPesquisa
 * @property string $NomeArtigo
 * @property string $NomeArtigoIngles
 * @property string $Volume
 * @property string $Numero
 * @property string $Paginas
 * @property string $Ano
 *
 * The followings are the available model relations:
 * @property Objetopesquisa $codObjetoPesquisa
 * @property Abrangencia $codAbrangencia
 * @property Autor[] $autors
 * @property Instituicao[] $instituicaos
 * @property Tipoanalise[] $tipoanalises
 * @property Tipoobjetivo[] $tipoobjetivos
 * @property Tipoprocedimento[] $tipoprocedimentos
 * @property Coordenador[] $coordenadors
 * @property Palavra[] $palavras
 */
class Artigo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Artigo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Resumo, IndicadorMulticentrico, CodAbrangencia, CodObjetoPesquisa, NomeArtigo, IndicadorRevistaConferencia, AnoPublicacao', 'required'),
			array('CodArtigo, CodUsuarioInsercao, CodUsuarioUltimaAtu, CodAbrangencia, CodObjetoPesquisa', 'numerical', 'integerOnly'=>true),
			array('Resumo', 'length', 'max'=>5000),
			array('IndicadorMulticentrico, IndicadorRevistaConferencia', 'length', 'max'=>1),
			array('NomeArtigo, NomeArtigoIngles', 'length', 'max'=>300),
			array('UrlArtigo', 'length', 'max'=>500),
			array('Volume', 'length', 'max'=>45),
			array('Numero', 'length', 'max'=>10),
			array('Paginas', 'length', 'max'=>15),
			array('AnoPublicacao', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodArtigo, Resumo, IndicadorMulticentrico, DataInicioEstudo, DataFimEstudo, CodUsuarioInsercao, DataInsercao, CodUsuarioUltimaAtu, DataUltimaAtu, CodAbrangencia, CodObjetoPesquisa, NomeArtigo, IndicadorRevistaConferencia, Volume, Paginas, AnoPublicacao', 'safe', 'on'=>'search'),
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
			'ObjetoPesquisa' => array(self::BELONGS_TO, 'ObjetoPesquisa', 'CodObjetoPesquisa', 'joinType'=>'INNER JOIN'),
			'Abrangencia' => array(self::BELONGS_TO, 'Abrangencia', 'CodAbrangencia', 'joinType'=>'INNER JOIN'),
			'Revista' => array(self::BELONGS_TO, 'Revista', 'CodRevista', 'joinType'=>'INNER JOIN'),
			'Instituicao'=> array(self::BELONGS_TO, 'ArtigoInstituicao', 'CodArtigo', 'joinType'=>'INNER JOIN'),
			'Analise'=> array(self::BELONGS_TO, 'ArtigoTipoAnalise', 'CodArtigo', 'joinType'=>'INNER JOIN'),
			'Objetivo'=> array(self::BELONGS_TO, 'ArtigoTipoObjetivo', 'CodArtigo', 'joinType'=>'INNER JOIN'),
			'Procedimento'=> array(self::BELONGS_TO, 'ArtigoTipoProcedimento', 'CodArtigo', 'joinType'=>'INNER JOIN'),
			'Palavra'=> array(self::BELONGS_TO, 'ArtigoPalavra', 'CodArtigo', 'joinType'=>'INNER JOIN'),
			'Autor'=> array(self::BELONGS_TO, 'ArtigoAutor', 'CodArtigo', 'joinType'=>'INNER JOIN'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CodArtigo' => 'Cod Artigo',
			'Resumo' => 'Resumo',
			'IndicadorMulticentrico' => 'Multicentrico',
			'DataInicioEstudo' => 'Data Inicio Estudo',
			'DataFimEstudo' => 'Data Fim Estudo',
			'CodUsuarioInsercao' => 'Cod Pessoa Insercao',
			'DataInsercao' => 'Data Insercao',
			'CodUsuarioUltimaAtu' => 'Cod Pessoa Ultima Atu',
			'DataUltimaAtu' => 'Data Ultima Atu',
			'CodAbrangencia' => 'Cod Abrangencia',
			'CodObjetoPesquisa' => 'Cod Objeto Pesquisa',
			'NomeArtigo' => 'Nome Artigo',
			'Volume' => 'Volume',
			'AnoPublicacao' => 'Ano',
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
		$criteria->compare('Resumo',$this->Resumo,true);
		$criteria->compare('Multicentrico',$this->Multicentrico,true);
		$criteria->compare('DataInicioEstudo',$this->DataInicioEstudo,true);
		$criteria->compare('DataFimEstudo',$this->DataFimEstudo,true);
		$criteria->compare('CodUsuarioInsercao',$this->CodUsuarioInsercao);
		$criteria->compare('DataInsercao',$this->DataInsercao,true);
		$criteria->compare('CodUsuarioUltimaAtu',$this->CodUsuarioUltimaAtu);
		$criteria->compare('DataUltimaAtu',$this->DataUltimaAtu,true);
		$criteria->compare('CodAbrangencia',$this->CodAbrangencia);
		$criteria->compare('CodObjetoPesquisa',$this->CodObjetoPesquisa);
		$criteria->compare('NomeArtigo',$this->NomeArtigo,true);
		$criteria->compare('Volume',$this->Volume,true);
		$criteria->compare('Paginas',$this->Paginas,true);
		$criteria->compare('AnoPublicacao',$this->AnoPublicacao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artigo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function afterFind()
	{
		if (!empty($this->DataInicioEstudo))
		{
			$dataInicioEstudo = DateTime::createFromFormat('Y-m-d', $this->DataInicioEstudo);
			$this->DataInicioEstudo = $dataInicioEstudo->format('d/m/Y');
		}
		
		if (!empty($this->DataFimEstudo))
		{
			$dataFimEstudo = DateTime::createFromFormat('Y-m-d', $this->DataFimEstudo);
			$this->DataFimEstudo = $dataFimEstudo->format('d/m/Y');
		}
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->setCodArtigo();
			$this->CodUsuarioInsercao = Yii::app()->user->CodUsuario;
			$this->DataInsercao = new CDbExpression('NOW()');
		}
		
		$this->CodUsuarioUltimaAtu =  Yii::app()->user->CodUsuario;
		$this->DataUltimaAtu = new CDbExpression('NOW()');
	
		return parent::beforeSave();
	}
	
	private function setCodArtigo()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodArtigo), 0)+1 AS CodArtigo FROM Artigo');
		$result = $command->queryRow();
		$this->CodArtigo = $result['CodArtigo'];
	}
}
