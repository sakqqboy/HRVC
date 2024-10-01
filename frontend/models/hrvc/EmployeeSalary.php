<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeSalaryMaster;

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

class EmployeeSalary extends \frontend\models\hrvc\master\EmployeeSalaryMaster
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
    public static function totalEmployeeSalary($departmentId, $titleId)
    {
        $employeeSalary = EmployeeSalary::find()
            ->select('employee_salary.value,employee_salary.employeeId')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=employee_salary.employeeId")
            ->where([
                "employee_salary.status" => 1,
                "e.status" => 1,
                "e.departmentId" => $departmentId,
                "e.titleId" => $titleId
            ])
            ->all();
        $total = 0;
        if (isset($employeeSalary) && count($employeeSalary) > 0) {
            foreach ($employeeSalary as $es) :
                $total += $es["value"];
            endforeach;
        }
        return $total;
    }
    public static function EmployeeCurrentSalary($employeeId)
    {
        $salary = EmployeeSalary::find()->where(["employeeId" => $employeeId, "structureId" => 1, "status" => 1])->one();
        if (isset($salary) && !empty($salary)) {
            return $salary["value"];
        } else {
            return null;
        }
    }
}
