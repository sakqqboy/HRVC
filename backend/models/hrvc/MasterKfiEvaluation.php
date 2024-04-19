<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\MasterKfiEvaluationMaster;

/**
* This is the model class for table "master_kfi_evaluation".
*
* @property integer $mKfiId
* @property integer $pimWeightId
* @property integer $kfiId
* @property integer $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class MasterKfiEvaluation extends \backend\models\hrvc\master\MasterKfiEvaluationMaster{
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
