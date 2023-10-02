<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KpiDepartmentMaster;

/**
* This is the model class for table "kpi_department".
*
* @property integer $kpiDepartmentId
* @property integer $kpiId
* @property integer $departmentId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KpiDepartment extends \common\models\hrvc\master\KpiDepartmentMaster{
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
