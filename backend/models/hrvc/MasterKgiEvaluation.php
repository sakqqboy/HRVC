<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\MasterKgiEvaluationMaster;

/**
* This is the model class for table "master_kgi_evaluation".
*
* @property integer $mKgiId
* @property integer $pimWeightId
* @property integer $kgiId
* @property integer $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class MasterKgiEvaluation extends \backend\models\hrvc\master\MasterKgiEvaluationMaster{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
