<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\MasterKpiEvaluationMaster;

/**
* This is the model class for table "master_kpi_evaluation".
*
* @property integer $mKpiId
* @property integer $pimWeight
* @property integer $kpiId
* @property integer $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class MasterKpiEvaluation extends \common\models\hrvc\master\MasterKpiEvaluationMaster{
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
