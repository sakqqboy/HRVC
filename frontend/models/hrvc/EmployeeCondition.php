<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeConditionMaster;

/**
 * This is the model class for table "employee_condition".
 *
 * @property integer $employeeConditionId
 * @property string $employeeConditionName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class EmployeeCondition extends \frontend\models\hrvc\master\EmployeeConditionMaster
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
    public static function conditionName($conditionId)
    {
        $employeeCondition = EmployeeCondition::find()
            ->select('employeeConditionName')
            ->where(["employeeConditionId" => $conditionId])
            ->asArray()
            ->one();
        if (isset($employeeCondition) && !empty($employeeCondition)) {
            return  $employeeCondition["employeeConditionName"];
        } else {
            return '';
        }
    }
    public static function employeeConditionId($employeeConditionName)
    {
        if ($employeeConditionName != '') {
            $employeeCondition = EmployeeCondition::find()
                ->where(["employeeConditionName" => $employeeConditionName, "status" => 1])
                ->asArray()
                ->one();
            if (isset($employeeCondition) && !empty($employeeCondition)) {
                return $employeeCondition["employeeConditionId"];
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
}
