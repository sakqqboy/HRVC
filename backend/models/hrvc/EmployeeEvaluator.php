<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\EmployeeEvaluatorMaster;

/**
 * This is the model class for table "employee_evaluator".
 *
 * @property integer $employeeEvaluatorId
 * @property integer $termId
 * @property integer $employeeId
 * @property integer $primaryId
 * @property integer $finalId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class EmployeeEvaluator extends \backend\models\hrvc\master\EmployeeEvaluatorMaster
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
    public static function primaryDetail($employeeId, $termId)
    {
        $employeeEvaluator = EmployeeEvaluator::find()
            ->where(["employeeId" => $employeeId, "termId" => $termId])
            ->asArray()
            ->one();
        if (isset($employeeEvaluator) && !empty($employeeEvaluator)) {
            $primary = Employee::find()
                ->select('t.titleName,employee.employeeFirstname,employee.employeeSurename,b.branchName,employee.picture')
                ->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
                ->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
                ->where(["employee.employeeId" => $employeeEvaluator["primaryId"]])
                ->asArray()
                ->one();
            if (isset($primary) && !empty($primary)) {
                $data["primaryName"] = $primary["employeeFirstname"] . ' ' . $primary["employeeSurename"];
                $data["titleName"] = $primary["titleName"];
                $data["branchName"] = $primary["branchName"];
                $data["picture"] = $primary["picture"];
            } else {
                $data["primaryName"] = '';
                $data["titleName"] = '';
                $data["branchName"] = '';
                $data["picture"] = '';
            }
        } else {
            $data["primaryName"] = '';
            $data["titleName"] = '';
            $data["branchName"] = '';
            $data["picture"] = '';
        }
        return $data;
    }
    public static function finalDetail($employeeId, $termId)
    {
        $employeeEvaluator = EmployeeEvaluator::find()
            ->where(["employeeId" => $employeeId, "termId" => $termId])
            ->asArray()
            ->one();
        if (isset($employeeEvaluator) && !empty($employeeEvaluator)) {
            $final = Employee::find()
                ->select('t.titleName,employee.employeeFirstname,employee.employeeSurename,b.branchName,employee.picture')
                ->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
                ->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
                ->where(["employee.employeeId" => $employeeEvaluator["finalId"]])
                ->asArray()
                ->one();
            if (isset($final) && !empty($final)) {
                $data["finalName"] = $final["employeeFirstname"] . ' ' . $final["employeeSurename"];
                $data["titleName"] = $final["titleName"];
                $data["branchName"] = $final["branchName"];
                $data["picture"] = $final["picture"];
            } else {
                $data["finalName"] = '';
                $data["titleName"] = '';
                $data["branchName"] = '';
                $data["picture"] = '';
            }
        } else {
            $data["finalName"] = '';
            $data["titleName"] = '';
            $data["branchName"] = '';
            $data["picture"] = '';
        }
        return $data;
    }
}
