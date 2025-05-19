<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiTeamMaster;
use common\models\ModelMaster;

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
    public static function kpiTeam($kpiId, $month, $year)
    {
        $kpiTeam = KpiTeam::find()
            ->where(["kpiId" => $kpiId, "month" => $month, "year" => $year])
            ->andWhere("status!=99")
            ->asArray()
            ->all();
        return count($kpiTeam);
    }
    public static function kpiTeam2($kpiId, $month, $year)
    {
        $kpiTeamHistory = KpiTeamHistory::find()
            ->select('kpi_team_history.month,kpi_team_history.year,kpi_team_history.kpiTeamId')
            ->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kpi_team_history.kpiTeamId")
            ->where(["kt.kpiId" => $kpiId, "kpi_team_history.month" => $month, "kpi_team_history.year" => $year])
            ->andWhere("kpi_team_history.status!=99")
            ->asArray()
            ->all();
        if (!isset($kpiTeamHistory) || count($kpiTeamHistory) == 0) {
            $kpiTeamHistory = KpiTeam::find()
                ->where(["kpiId" => $kpiId, "month" => $month, "year" => $year])
                ->andWhere("status!=99")
                ->asArray()
                ->all();
        }
        $team = [];
        if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) {
            foreach ($kpiTeamHistory as $kgh):
                if (!isset($team[$kgh["kpiTeamId"]])) {
                    $team[$kgh["kpiTeamId"]] = 1;
                }
            endforeach;
        }
        return count($team);
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
    public static function kpiTeamEmployee($kpiId, $teamId)
    {
        $kpiTeam = KpiTeam::find()->select('teamId')
            ->where(["kpiId" => $kpiId, "teamId" => $teamId])
            ->asArray()
            ->all();
        $data = [];
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $team) :
                $employee = KpiEmployee::find()
                    ->select('e.picture,e.employeeId,e.gender,employeeFirstname')
                    ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
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
    public static function lastestCheckDate($kpiTeamId)
    {
        $kpiTeamHistory = KpiTeamHistory::find()
            ->select('kpiTeamId,nextCheckDate,kpiTeamHistoryId')
            ->where(["kpiTeamId" => $kpiTeamId])
            ->orderBy("kpiTeamHistoryId DESC")
            ->asArray()
            ->one();
        if (isset($kpiTeamHistory) && !empty($kpiTeamHistory) && $kpiTeamHistory["nextCheckDate"] != '') {
            //throw new Exception(print_r($kpiTeamHistory, true));
            $lastCheckDate = KpiTeamHistory::find()
                ->select('nextCheckDate,kpiTeamHistoryId')
                ->where(["kpiTeamId" => $kpiTeamId, "status" => [1, 2]])
                ->andWhere("kpiTeamHistoryId<" . $kpiTeamHistory["kpiTeamHistoryId"] . " and nextCheckDate!='" . $kpiTeamHistory["nextCheckDate"] . "'")
                ->orderBy("kpiTeamHistoryId DESC")
                ->asArray()
                ->one();
            if (isset($lastCheckDate) && !empty($lastCheckDate)) {
                return $lastCheckDate["nextCheckDate"];
            }
        } else {
            return '';
        }
    }
    public static function nextCheckDate($kpiTeamId)
    {
        $date = '';
        $kpiHistory = KpiTeamHistory::find()
            ->select('nextCheckDate')
            ->where(["kpiTeamId" => $kpiTeamId, "status" => [1, 2, 4]])
            ->orderBy('kpiTeamHistoryId DESC')
            ->asArray()
            ->one();
        if (isset($kpiHistory) && !empty($kpiHistory) && $kpiHistory["nextCheckDate"] != '') {
            $date = ModelMaster::engDate($kpiHistory["nextCheckDate"], 2);
        }
        return $date;
    }

    public static function autoSummalys($kpiId, $month, $year)
    {
        // คำนวณผลรวมของ result ในตาราง kpi_team
        $sumResult = KpiTeam::find()
            ->where([
                'kpiId' => $kpiId,
                'month' => $month,
                'year' => $year,
                'status' => [1, 2, 4]
            ])
            ->sum('result');

        return $sumResult ?? 0; // คืนค่า 0 หากไม่มีผลลัพธ์
    }
    public static function checkComplete($kpiTeamId, $month, $year, $currentYear)
    {
        if ($month != '' && $year != '') {
            $kpiTeamHistory = KpiTeamHistory::find()
                ->where([
                    "kpiTeamId" => $kpiTeamId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $year
                ])
                ->one();
        }
        if ($month == '' && $year != '') {
            if ($year != $currentYear) {
                return 1;
            } else {

                return 0;
            }
        }
        if ($month != '' && $year == '') {
            $kpiTeamHistory = KpiTeamHistory::find()
                ->where([
                    "kpiTeamId" => $kpiTeamId,
                    "status" => 2,
                    "month" => $month,
                    "year" => $currentYear
                ])
                ->one();
        }
        if ($month == '' && $year == '') {
            return 0;
        }

        if (isset($kpiTeamHistory) && !empty($kpiTeamHistory)) {
            return 1;
        } else {
            return 0;
        }
    }
}
