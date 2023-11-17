<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiEmployeeMaster;

/**
 * This is the model class for table "kgi_employee".
 *
 * @property integer $kgiEmployeeId
 * @property integer $employeeId
 * @property integer $kgiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiEmployee extends \frontend\models\hrvc\master\KgiEmployeeMaster
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
    public static function isHasEmployee($employeeId, $kgiId)
    {
        $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId, "employeeId" => $employeeId, "status" => 1])->one();
        if (isset($kgiEmployee) && !empty($kgiEmployee)) {
            return 1;
        } else {
            return 0;
        }
    }
}
