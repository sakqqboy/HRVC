<?php

namespace backend\modules\home\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Employee;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployeeHistory;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiTeamHistory;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiEmployeeHistory;
use backend\models\hrvc\KpiTeamHistory;
use backend\models\hrvc\User;
use common\models\ModelMaster;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `home` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionPendingApproval($role, $employeeId)
    {
        $employeeDetail = Employee::EmployeeDetail($employeeId);
        //throw new Exception($employeeId);
        $kgiEmployee = [];
        if ($role < 3) { //normal staff
            $kgiEmployee = KgiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kgiEmployeeId,keh.updateDateTime,keh.createrId,ke.kgiId,keh.kgiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=keh.kgiEmployeeId")
                ->where(["keh.status" => 88, "ke.employeeId" => $employeeId])
                ->asArray()
                ->all();
            $kpiEmployee = KpiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kpiEmployeeId,keh.updateDateTime,keh.createrId,ke.kgiId,keh.kpiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=keh.kpiEmployeeId")
                ->where(["keh.status" => 88, "ke.employeeId" => $employeeId])
                ->asArray()
                ->all();
        }
        if ($role == 3) { //team leader see just in their team
            $kgiEmployee = KgiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kgiEmployeeId,keh.updateDateTime,keh.createrId,ke.kgiId,keh.kgiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=keh.kgiEmployeeId")
                ->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
                ->where(["keh.status" => 88, "e.teamId" => $employeeDetail["teamId"]])
                ->asArray()
                ->all();
            $kgiTeam = KgiTeamHistory::find()
                ->alias('kth')
                ->select('kt.kgiTeamId,kth.updateDateTime,kth.createrId,kt.kgiId,kth.kgiTeamHistoryId')
                ->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kth.kgiTeamId")
                ->where(["kth.status" => 88, "kt.teamId" => $employeeDetail["teamId"]])
                ->asArray()
                ->all();

            $kpiEmployee = KpiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kpiEmployeeId,keh.updateDateTime,keh.createrId,ke.kpiId,keh.kpiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=keh.kpiEmployeeId")
                ->JOIN("LEFT JOIN", "employee e", "e.employeeId=ke.employeeId")
                ->where(["keh.status" => 88, "e.employeeId" => $employeeDetail["teamId"]])
                ->asArray()
                ->all();
            $kpiTeam = KpiTeamHistory::find()
                ->alias('kth')
                ->select('kt.kpiTeamId,kth.updateDateTime,kth.createrId,kt.kpiId,kth.kpiTeamHistoryId')
                ->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kth.kpiTeamId")
                ->where(["kth.status" => 88, "kt.teamId" => $employeeDetail["teamId"]])
                ->asArray()
                ->all();
        }

        if ($role > 3 && $role < 6) { //supervisor manager gm can see just in their branch
            $kgiEmployee = KgiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kgiEmployeeId,keh.updateDateTime,keh.createrId,ke.kgiId,keh.kgiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=keh.kgiEmployeeId")
                ->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=ke.kgiId")
                ->where([
                    "keh.status" => 88,
                    "kb.branchId" => $employeeDetail["branchId"],
                    "kb.status" => 1
                ])
                ->asArray()
                ->all();
            $kgiTeam = KgiTeamHistory::find()
                ->alias('kth')
                ->select('kt.kgiTeamId,kth.updateDateTime,kth.createrId,kt.kgiId,kth.kgiTeamHistoryId')
                ->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kth.kgiTeamId")
                ->JOIN("LEFT JOIN", "kgi_branch kb", "kb.kgiId=kt.kgiId")
                ->where([
                    "kth.status" => 88,
                    "kb.branchId" => $employeeDetail["branchId"],
                    "kb.status" => 1,
                    "kt.status" => 1
                ])
                ->asArray()
                ->all();

            $kpiEmployee = KpiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kpiEmployeeId,keh.updateDateTime,keh.createrId,ke.kpiId,keh.kgiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=keh.kpiEmployeeId")
                ->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=ke.kpiId")
                ->where([
                    "keh.status" => 88,
                    "kb.branchId" => $employeeDetail["branchId"],
                    "kb.status" => 1
                ])
                ->asArray()
                ->all();
            $kpiTeam = KpiTeamHistory::find()
                ->alias('kth')
                ->select('kt.kpiTeamId,kth.updateDateTime,kth.createrId,kt.kpiId,kth.kpiTeamHistoryId')
                ->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kth.kpiTeamId")
                ->JOIN("LEFT JOIN", "kpi_branch kb", "kb.kpiId=kt.kpiId")
                ->where([
                    "kth.status" => 88,
                    "kb.branchId" => $employeeDetail["branchId"],
                    "kb.status" => 1,
                    "kt.status" => 1

                ])
                ->asArray()
                ->all();
        }
        if ($role > 6) { //admin
            $kgiEmployee = KgiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kgiEmployeeId,keh.updateDateTime,keh.createrId,ke.kgiId,keh.kgiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kgi_employee ke", "ke.kgiEmployeeId=keh.kgiEmployeeId")
                ->where(["keh.status" => 88])
                ->asArray()
                ->all();
            $kgiTeam = KgiTeamHistory::find()
                ->alias('kth')
                ->select('kt.kgiTeamId,kth.updateDateTime,kth.createrId,kt.kgiId,kth.kgiTeamHistoryId')
                ->JOIN("LEFT JOIN", "kgi_team kt", "kt.kgiTeamId=kth.kgiTeamId")
                ->where(["kth.status" => 88])
                ->asArray()
                ->all();
            $kpiEmployee = KpiEmployeeHistory::find()
                ->alias('keh')
                ->select('ke.kpiEmployeeId,keh.updateDateTime,keh.createrId,ke.kpiId,keh.kpiEmployeeHistoryId')
                ->JOIN("LEFT JOIN", "kpi_employee ke", "ke.kpiEmployeeId=keh.kpiEmployeeId")
                ->where(["keh.status" => 88])
                ->asArray()
                ->all();
            $kpiTeam = KpiTeamHistory::find()
                ->alias('kth')
                ->select('kt.kpiTeamId,kth.updateDateTime,kth.createrId,kt.kpiId,kth.kpiTeamHistoryId')
                ->JOIN("LEFT JOIN", "kpi_team kt", "kt.kpiTeamId=kth.kpiTeamId")
                ->where(["kth.status" => 88])
                ->asArray()
                ->all();
        }
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            $i = 0;
            foreach ($kgiEmployee as $ke):
                $data["kgiEmployee"][$i] = [
                    "kgiEmployeeId" => $ke["kgiEmployeeId"],
                    "kgiEmployeeHistoryId" => $ke["kgiEmployeeHistoryId"],
                    "kgiId" => $ke["kgiId"],
                    "name" => "Target Changing",
                    "kgiName" => Kgi::kgiName($ke["kgiId"]),
                    "updateDateTime" => ModelMaster::timeDateNumber($ke["updateDateTime"]),
                    "employee" => User::employeeNameByuserId($ke["createrId"]),
                    "createrId" => $ke["createrId"]
                ];
                $i++;
            endforeach;
        }
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            $i = 0;
            foreach ($kgiTeam as $kt):
                $data["kgiTeam"][$i] = [
                    "kgiTeamId" => $kt["kgiTeamId"],
                    "kgiTeamHistoryId" => $kt["kgiTeamHistoryId"],
                    "kgiId" => $kt["kgiId"],
                    "name" => "Target Changing",
                    "kgiName" => Kgi::kgiName($kt["kgiId"]),
                    "updateDateTime" => ModelMaster::timeDateNumber($kt["updateDateTime"]),
                    "employee" => User::employeeNameByuserId($kt["createrId"]),
                    "createrId" => $kt["createrId"]
                ];
                $i++;
            endforeach;
        }
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            $i = 0;
            foreach ($kpiEmployee as $ke):
                $data["kpiEmployee"][$i] = [
                    "kpiEmployeeId" => $ke["kpiEmployeeId"],
                    "kpiEmployeeHistoryId" => $ke["kpiEmployeeHistoryId"],
                    "kpiId" => $ke["kpiId"],
                    "name" => "Target Changing",
                    "kpiName" => Kpi::kpiName($ke["kpiId"]),
                    "updateDateTime" =>  ModelMaster::timeDateNumber($ke["updateDateTime"]),
                    "employee" => User::employeeNameByuserId($ke["createrId"]),
                    "createrId" => $ke["createrId"]
                ];
                $i++;
            endforeach;
        }
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            $i = 0;
            foreach ($kpiTeam as $kt):
                $data["kpiTeam"][$i] = [
                    "kpiTeamId" => $kt["kpiTeamId"],
                    "kpiTeamHistoryId" => $kt["kpiTeamHistoryId"],
                    "kpiId" => $kt["kpiId"],
                    "kpiName" => "Target changed",
                    "kpiName" => Kpi::kpiName($kt["kpiId"]),
                    "updateDateTime" => ModelMaster::timeMonthDateYear($kt["updateDateTime"]),
                    "employee" => User::employeeNameByuserId($kt["createrId"]),
                    "createrId" => $kt["createrId"]
                ];
                $i++;
            endforeach;
        }
        return json_encode($data);
    }
}
