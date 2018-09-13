<?php

/**
 * This is the model class for table "artigo".
 *
 * The followings are the available columns in table 'artigo':
 * @property integer $CodArtigo
 * @property string $Resumo
 * @property string $Multicentrico
 * @property string $DataInicioEstudo
 * @property string $DataFimEstudo
 * @property integer $CodPessoaInsercao
 * @property string $DataInsercao
 * @property integer $CodPessoaUltimaAtu
 * @property string $DataUltimaAtu
 * @property integer $CodAbrangencia
 * @property integer $CodObjetoPesquisa
 * @property string $NomeArtigo
 * @property string $RevistaConferencia
 * @property string $Volume
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
		return 'artigo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Resumo, Multicentrico, DataInicioEstudo, DataFimEstudo, CodPessoaInsercao, DataInsercao, CodPessoaUltimaAtu, DataUltimaAtu, CodAbrangencia, CodObjetoPesquisa, NomeArtigo, RevistaConferencia, Ano', 'required'),
			array('CodArtigo, CodPessoaInsercao, CodPessoaUltimaAtu, CodAbrangencia, CodObjetoPesquisa', 'numerical', 'integerOnly'=>true),
			array('Resumo', 'length', 'max'=>2000),
			array('Multicentrico', 'length', 'max'=>1),
			array('NomeArtigo, RevistaConferencia', 'length', 'max'=>300),
			array('Volume', 'length', 'max'=>45),
			array('Ano', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CodArtigo, Resumo, Multicentrico, DataInicioEstudo, DataFimEstudo, CodPessoaInsercao, DataInsercao, CodPessoaUltimaAtu, DataUltimaAtu, CodAbrangencia, CodObjetoPesquisa, NomeArtigo, RevistaConferencia, Volume, Ano', 'safe', 'on'=>'search'),
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
			'codObjetoPesquisa' => array(self::BELONGS_TO, 'Objetopesquisa', 'CodObjetoPesquisa'),
			'codAbrangencia' => array(self::BELONGS_TO, 'Abrangencia', 'CodAbrangencia'),
			'autors' => array(self::MANY_MANY, 'Autor', 'artigoautor(CodArtigo, CodAutor)'),
			'instituicaos' => array(self::MANY_MANY, 'Instituicao', 'artigoinstituicao(CodArtigo, CodInstituicao)'),
			'tipoanalises' => array(self::MANY_MANY, 'Tipoanalise', 'artigotipoanalise(CodArtigo, CodTipoAnalise)'),
			'tipoobjetivos' => array(self::MANY_MANY, 'Tipoobjetivo', 'artigotipoobjetivo(CodArtigo, CodTipoObjetivo)'),
			'tipoprocedimentos' => array(self::MANY_MANY, 'Tipoprocedimento', 'artigotipoprocedimento(CodArtigo, CodTipoProcedimento)'),
			'coordenadors' => array(self::HAS_MANY, 'Coordenador', 'CodArtigo'),
			'palavras' => array(self::HAS_MANY, 'Palavra', 'CodArtigo'),
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
			'Multicentrico' => 'Multicentrico',
			'DataInicioEstudo' => 'Data Inicio Estudo',
			'DataFimEstudo' => 'Data Fim Estudo',
			'CodPessoaInsercao' => 'Cod Pessoa Insercao',
			'DataInsercao' => 'Data Insercao',
			'CodPessoaUltimaAtu' => 'Cod Pessoa Ultima Atu',
			'DataUltimaAtu' => 'Data Ultima Atu',
			'CodAbrangencia' => 'Cod Abrangencia',
			'CodObjetoPesquisa' => 'Cod Objeto Pesquisa',
			'NomeArtigo' => 'Nome Artigo',
			'RevistaConferencia' => 'Revista Conferencia',
			'Volume' => 'Volume',
			'Ano' => 'Ano',
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
		$criteria->compare('CodPessoaInsercao',$this->CodPessoaInsercao);
		$criteria->compare('DataInsercao',$this->DataInsercao,true);
		$criteria->compare('CodPessoaUltimaAtu',$this->CodPessoaUltimaAtu);
		$criteria->compare('DataUltimaAtu',$this->DataUltimaAtu,true);
		$criteria->compare('CodAbrangencia',$this->CodAbrangencia);
		$criteria->compare('CodObjetoPesquisa',$this->CodObjetoPesquisa);
		$criteria->compare('NomeArtigo',$this->NomeArtigo,true);
		$criteria->compare('RevistaConferencia',$this->RevistaConferencia,true);
		$criteria->compare('Volume',$this->Volume,true);
		$criteria->compare('Ano',$this->Ano,true);

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
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->setCodArtigo();
			$this->CodUsuarioInsercao = Yii::app()->user->CodUsuario;
			$this->DataInsercao = new CDbExpression('GETDATE()');
		}
		
		$this->CodUsuarioUltimaAtu =  Yii::app()->user->CodUsuario;
		$this->DataUltimaAtu = new CDbExpression('GETDATE()');
	
		return parent::beforeSave();
	}
	
	private function setCodArtigo()
	{
		$command = Yii::app()->db->createCommand('SELECT IFNULL(MAX(CodArtigo), 0)+1 AS CodArtigo FROM artigo');
		$result = $command->queryRow();
		$this->CodArtigo = $result['CodArtigo'];
	}
}
