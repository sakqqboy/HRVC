<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiTeamMaster;
use common\models\ModelMaster;
use Exception;

/**
 * This is the model class for table "kgi_team".
 *
 * @property integer $kgiTeamId
 * @property integer $kgiId
 * @property integer $teamId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KgiTeam extends \backend\models\hrvc\master\KgiTeamMaster
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
    public static function kgiTeam($kgiId, $month, $year)
    {
        /*$kgiTeam = KgiTeam::find()
            ->select('t.teamName,kgi_team.teamId')
            ->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
            ->where(["t.status" => 1, "kgi_team.status" => [1, 2, 4], "kgi_team.kgiId" => $kgiId])
            ->asArray()
            ->all();*/

        $kgiTeams = KgiTeam::find()
            ->where(["kgiId" => $kgiId, "month" => $month, "year" => $year])
            ->andWhere("status!=99")
            ->asArray()
            ->all();
        return count($kgiTeams);
    }
    public static function employeeTeam($kgiId)
    {
        $kgiTeam = KgiTeam::find()->select('teamId')->where(["kgiId" => $kgiId])->asArray()->all();
        $data = [];
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            foreach ($kgiTeam as $team) :
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
    public static function kgiTeamEmployee($kgiId, $teamId)
    {
        $kgiTeam = KgiTeam::find()->select('teamId')
            ->where(["kgiId" => $kgiId, "teamId" => $teamId])
            ->asArray()
            ->all();
        $data = [];
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            foreach ($kgiTeam as $team) :
                $employee = KgiEmployee::find()
                    ->select('e.picture,e.employeeId,e.gender,employeeFirstname')
                    ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
                    ->where(["e.teamId" => $team["teamId"]])
                    ->orderBy('e.employeeFirstname')
                    ->asArray()
                    ->all();
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
    public static function lastestCheckDate($kgiTeamId)
    {
        $kgiTeamHistory = KgiTeamHistory::find()
            ->select('kgiTeamId,nextCheckDate,kgiTeamHistoryId')
            ->where(["kgiTeamId" => $kgiTeamId])
            ->orderBy("kgiTeamHistoryId DESC")
            ->asArray()
            ->one();
        if (isset($kgiTeamHistory) && !empty($kgiTeamHistory) && $kgiTeamHistory["nextCheckDate"] != '') {
            //throw new Exception(print_r($kgiTeamHistory, true));
            $lastCheckDate = KgiTeamHistory::find()
                ->select('nextCheckDate,kgiTeamHistoryId')
                ->where(["kgiTeamId" => $kgiTeamId, "status" => [1, 2]])
                ->andWhere("kgiTeamHistoryId<" . $kgiTeamHistory["kgiTeamHistoryId"] . " and nextCheckDate!='" . $kgiTeamHistory["nextCheckDate"] . "'")
                ->orderBy("kgiTeamHistoryId DESC")
                ->asArray()
                ->one();
            if (isset($lastCheckDate) && !empty($lastCheckDate)) {
                return $lastCheckDate["nextCheckDate"];
            }
        } else {
            return '';
        }
    }
    public static function nextCheckDate($kgiTeamId)
    {
        $date = '';
        $kgiHistory = KgiTeamHistory::find()
            ->select('nextCheckDate')
            ->where(["kgiTeamId" => $kgiTeamId, "status" => [1, 2, 4]])
            ->orderBy('kgiTeamHistoryId DESC')
            ->asArray()
            ->one();
        if (isset($kgiHistory) && !empty($kgiHistory) && $kgiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kgiHistory["nextCheckDate"], 2);
        }
        return $date;
    }
}
