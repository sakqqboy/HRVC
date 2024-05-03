<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\PimWeightMaster;

/**
 * This is the model class for table "pim_weight".
 *
 * @property integer $pimWeightId
 * @property integer $kfiWeight
 * @property integer $kgiWeight
 * @property integer $kpiWeight
 * @property integer $termId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class PimWeight extends \backend\models\hrvc\master\PimWeightMaster
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
    public static function hasEmployee($employeeId, $pimWeightId)
    {
        $employeeEva = EmployeeEvaluation::find()->where(["employeeId" => $employeeId, "pimWeightId" => $pimWeightId])->one();
        if (isset($employeeEva) && !empty($employeeEva)) {
            return 1;
        } else {
            return 0;
        }
    }
}
