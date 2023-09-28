<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiSolutionMaster;
use common\models\ModelMaster;

/**
 * This is the model class for table "kfi_solution".
 *
 * @property integer $kfiSolutionId
 * @property integer $kfiIssueId
 * @property string $solution
 * @property integer $parentId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KfiSolution extends \backend\models\hrvc\master\KfiSolutionMaster
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
    public static function solutionList($kfiIssueId)
    {
        $data = [];
        $kfiSolution = KfiSolution::find()
            ->select('solution,kfiSolutionId,employeeId,file,createDateTime')
            ->where(["kfiIssueId" => $kfiIssueId])
            ->asArray()
            ->orderBy('kfiSolutionId')
            ->all();
        if (isset($kfiSolution) && count($kfiSolution) > 0) {
            foreach ($kfiSolution as $solution) :
                $employee = Employee::EmployeeDetail($solution["employeeId"]);
                $data[$solution["kfiSolutionId"]] = [
                    "name" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
                    "image" => Employee::EmployeeDetail($solution["employeeId"])["picture"],
                    "createDateTime" => ModelMaster::engDate($solution["createDateTime"], 2),
                    "solution" => $solution["solution"],
                    "file" => $solution["file"],
                ];
            endforeach;
        }
        return $data;
    }
}
