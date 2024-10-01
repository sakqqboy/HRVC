<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiSolutionMaster;
use common\models\ModelMaster;
use Exception;

/**
 * This is the model class for table "kgi_solution".
 *
 * @property integer $kgiSolutionId
 * @property integer $kgiIssueId
 * @property string $solution
 * @property integer $parentId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiSolution extends \backend\models\hrvc\master\KgiSolutionMaster
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
    public static function solutionList($kgiIssueId)
    {
        $data = [];
        $kgiSolution = KgiSolution::find()
            ->select('solution,kgiSolutionId,employeeId,file,createDateTime')
            ->where(["kgiIssueId" => $kgiIssueId])
            ->asArray()
            ->orderBy('kgiSolutionId')
            ->all();
        if (isset($kgiSolution) && count($kgiSolution) > 0) {
            foreach ($kgiSolution as $solution) :
                $employee = Employee::EmployeeDetail($solution["employeeId"]);
                $data[$solution["kgiSolutionId"]] = [
                    "name" => $employee["employeeFirstname"] . ' ' . $employee["employeeSurename"],
                    "image" => Employee::EmployeeDetail($solution["employeeId"])["picture"],
                    "createDateTime" => ModelMaster::timeMonthDateYear($solution["createDateTime"]),
                    "solution" => $solution["solution"],
                    "file" => $solution["file"],
                ];
            endforeach;
        }

        return $data;
    }
}
