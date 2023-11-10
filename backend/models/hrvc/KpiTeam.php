<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiTeamMaster;

/**
 * This is the model class for table "kpi_team".
 *
 * @property integer $kpiTeamId
 * @property integer $kpiId
 * @property integer $teamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KpiTeam extends \backend\models\hrvc\master\KpiTeamMaster
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
    public static function kpiTeam($kpiId)
    {
        $kpiTeam = KpiTeam::find()
            ->select('t.teamName,kpi_team.teamId')
            ->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
            ->where(["t.status" => 1, "kpi_team.status" => 1, "kpi_team.kpiId" => $kpiId])
            ->asArray()
            ->all();
        return count($kpiTeam);
    }
    public static function employeeTeam($kpiId)
    {
        $kpiTeam = KpiTeam::find()->select('teamId')->where(["kpiId" => $kpiId])->asArray()->all();
        $data = [];
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $team) :
                $employee = Employee::find()->select('picture,employeeId,gender')
                    ->where(["teamId" => $team["teamId"]])
                    ->asArray()->all();
                if (isset($employee) && count($employee) > 0) {
                    foreach ($employee as $emp) :
                        if ($emp['picture'] == "") {
                            if ($emp['gender'] == 1) {
                                $picture = 'image/user.png';
                            } else {
                                $picture = 'image/lady.jpg';
                            }
                        } else {
                            $picture = $emp['picture'];
                        }
                        $data[$emp["employeeId"]] = $picture;
                    endforeach;
                }
            endforeach;
        }
        return $data;
    }
}
