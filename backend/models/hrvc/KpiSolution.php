<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiSolutionMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kpi_solution".
 *
 * @property integer $kpiSolutionId
 * @property integer $kpiIssueId
 * @property string $solution
 * @property integer $parentId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiSolution extends \backend\models\hrvc\master\KpiSolutionMaster
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
    public static function solutionList($kpiIssueId)
    {
        $data = [];
        $kpiSolution = KpiSolution::find()
            ->select('solution,kpiSolutionId,employeeId,file,createDateTime')
            ->where(["kpiIssueId" => $kpiIssueId])
            ->asArray()
            ->orderBy('kpiSolutionId')
            ->all();
        if (isset($kpiSolution) && count($kpiSolution) > 0) {
            foreach ($kpiSolution as $solution) :
                $employee = Employee::EmployeeDetail($solution["employeeId"]);
                $data[$solution["kpiSolutionId"]] = [
                    "name" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
                    "image" => Employee::EmployeeDetail($solution["employeeId"])["picture"],
                    "gender" => Employee::EmployeeDetail($solution["employeeId"])["gender"],
                    "createDateTime" => ModelMaster::engDate($solution["createDateTime"], 2),
                    "solution" => $solution["solution"],
                    "file" => $solution["file"],
                ];
            endforeach;
        }

        return $data;
    }
}
