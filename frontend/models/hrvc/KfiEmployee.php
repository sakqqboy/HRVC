<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiEmployeeMaster;

/**
 * This is the model class for table "kfi_employee".
 *
 * @property integer $kfiEmployeeId
 * @property integer $employeeId
 * @property integer $kfiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KfiEmployee extends \frontend\models\hrvc\master\KfiEmployeeMaster
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
    public static function isHasEmployee($employeeId, $kfiId)
    {
        $kfiEmployee = KfiEmployee::find()->where(["kfiId" => $kfiId, "employeeId" => $employeeId, "status" => 1])->one();
        if (isset($kfiEmployee) && !empty($kfiEmployee)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function totalEmployee($kfiId)
    {
        $kfiEmployee = KfiEmployee::find()->where(["kfiId" => $kfiId, "status" => 1])->asArray()->all();
        if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
            return count($kfiEmployee);
        } else {
            return 0;
        }
    }
}
