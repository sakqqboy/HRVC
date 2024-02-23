<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiIssueMaster;

/**
 * This is the model class for table "kpi_issue".
 *
 * @property integer $kpiIssueId
 * @property string $issue
 * @property integer $kpiId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiIssue extends \backend\models\hrvc\master\KpiIssueMaster
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
    public static function lastestIssue($kpiId)
    {
        $data = [
            "issue" => "",
            "solution" => ""
        ];
        $issue = KpiIssue::find()->where(["kpiId" => $kpiId])->asArray()->orderBy('updateDateTime DESC')->one();
        if (isset($issue) && !empty($issue)) {
            $issueLength = strlen($issue["issue"]);
            if ($issueLength > 140) {
                $issueText = substr($issue["issue"], 0, 140) . " . . .";
            } else {
                $issueText = $issue["issue"];
            }
            $data = [
                "issue" => $issueText,
                "solution" => "There is no solution yet ! ! !"
            ];
            $solution = KpiSolution::find()->where(["kpiIssueId" => $issue["kpiIssueId"]])
                ->asArray()
                ->orderBy('kpiSolutionId DESC')
                ->one();
            if (isset($solution) && !empty($solution)) {
                $solutionLength = strlen($solution["solution"]);
                if ($solutionLength > 140) {
                    $solutionText = substr($solution["solution"], 0, 140) . " . . .";
                } else {
                    $solutionText = $solution["solution"];
                }
                $data = [
                    "issue" => $issueText,
                    "solution" => $solutionText
                ];
            }
        }
        return $data;
    }
}
