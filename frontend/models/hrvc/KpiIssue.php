<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiIssueMaster;

/**
* This is the model class for table "kpi_issue".
*
* @property integer $kpiIssueId
* @property string $issue
* @property integer $kpiId
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KpiIssue extends \frontend\models\hrvc\master\KpiIssueMaster{
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
