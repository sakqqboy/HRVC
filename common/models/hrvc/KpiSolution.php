<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KpiSolutionMaster;

/**
* This is the model class for table "kpi_solution".
*
* @property integer $kpiSolutionId
* @property integer $kpiIssueId
* @property string $solution
* @property integer $parentId
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KpiSolution extends \common\models\hrvc\master\KpiSolutionMaster{
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
