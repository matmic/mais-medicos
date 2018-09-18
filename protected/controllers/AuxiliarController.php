<?php

class AuxiliarController extends BaseController
{
	public function actionAutoCompleteInstituicao($term) 
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'UPPER(NomeInstituicao) LIKE UPPER(:termo) OR UPPER(SiglaInstituicao) LIKE UPPER(:termo)';
		$criteria->params = array(':termo' => '%'.$term.'%');
		$criteria->limit = 10;
		$results = array();
		foreach(Instituicao::model()->findAll($criteria) as $inst)
		{
		  $results[] = array(
			  'label' => (!empty($inst->SiglaInstituicao) ? $inst->SiglaInstituicao . ' - ' . $inst->NomeInstituicao : $inst->NomeInstituicao),
			  'CodInstituicao' => $inst->CodInstituicao,
		  );
		}
		echo CJSON::encode($results);
		Yii::app()->end();
	}
}