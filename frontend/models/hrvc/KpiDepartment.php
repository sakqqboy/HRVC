<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiDepartmentMaster;

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

class KpiDepartment extends \frontend\models\hrvc\master\KpiDepartmentMaster
{
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
    public static function isInThisKpi($departmentId, $kpiId)
    {
        $kpiDepartment = KpiDepartment::find()->where(["departmentId" => $departmentId, "kpiId" => $kpiId, "status" => 1])->asArray()->one();
        $has = 0;
        if (isset($kpiDepartment) && !empty($kpiDepartment)) {
            $has = 1;
        }
        return $has;
    }
}
