<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiIssueMaster;

/**
 * This is the model class for table "kgi_issue".
 *
 * @property integer $kgiIssueId
 * @property string $issue
 * @property integer $kgiId
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiIssue extends \frontend\models\hrvc\master\KgiIssueMaster
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
    public static function lastestIssue($kgiId)
    {
        $data = [
            "issue" => "",
            "solution" => ""
        ];
        $issue = KgiIssue::find()->where(["kgiId" => $kgiId])->asArray()->orderBy('kgiIssueId DESC')->one();
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
            $solution = KgiSolution::find()->where(["kgiIssueId" => $issue["kgiIssueId"]])
                ->asArray()
                ->orderBy('kgiSolutionId DESC')
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
