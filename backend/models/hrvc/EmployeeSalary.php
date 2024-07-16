<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\EmployeeSalaryMaster;

/**
 * This is the model class for table "employee_salary".
 *
 * @property integer $employeeSalaryId
 * @property integer $employeeId
 * @property integer $structureId
 * @property integer $value
 * @property integer $currencyId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class EmployeeSalary extends \backend\models\hrvc\master\EmployeeSalaryMaster
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
    public static function isSetSalary($employeeId)
    {
        $salary = EmployeeSalary::find()->where(["employeeId" => $employeeId])->asArray()->one();
        if (isset($salary) && !empty($salary)) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function employeeAllowance($employeeId, $departmentId, $titleId)
    {
        $salary = Salary::find()
            ->where(["departmentId" => $departmentId, "titleId" => $titleId, "status" => 1])
            ->asArray()
            ->one();
        $data = [];
        if (isset($salary) && !empty($salary)) {
            $salaryStructure = SalaryStructure::find()
                ->where(["salaryId" => $salary["salaryId"], "status" => 1])
                ->orderBy('structureId')
                ->all();
            if (isset($salaryStructure) && count($salaryStructure) > 0) {
                foreach ($salaryStructure as $ss) :
                    $employeeSalary = EmployeeSalary::find()
                        ->where(["employeeId" => $employeeId, "structureId" => $ss["structureId"], "status" => 1])
                        ->asArray()
                        ->one();
                    if (isset($employeeSalary) && !empty($employeeSalary)) {
                        $data[$ss["structureId"]] = $employeeSalary["value"];
                    } else {
                        $data[$ss["structureId"]] = '-';
                    }

                endforeach;
            }
        }
        return $data;
    }
    public static function EmployeeCurrentSalary($employeeId)
    {
        $salary = EmployeeSalary::find()->where(["employeeId" => $employeeId, "structureId" => 1, "status" => 1])->one();
        if (isset($salary) && !empty($salary)) {
            return $salary["value"];
        } else {
            return '-';
        }
    }
    public static function evaluationSalary($employeeId, $termId)
    {
        $bonusRecord = BonusRecord::find()->where(["employeeId" => $employeeId, "termId" => $termId])->asArray()->one();
        $data = [];
        if (isset($bonusRecord) && !empty($bonusRecord)) {
            $data["rankId"] = $bonusRecord["rankId"];
            $data["rankName"] = $bonusRecord["rankName"];
            $data["salary"] = $bonusRecord["salary"];
            $data["bomusRate"] = $bonusRecord["bonusRate"];
            $data["bonus"] = $bonusRecord["bonusRate"] * $bonusRecord["salary"];
            $data["finalAdjustment"] = $bonusRecord["finalAdjustment"];
        }
        return $data;
    }
}
