<?php

namespace frontend\modules\kfi\controllers;

use common\models\hrvc\KfiBranch;
use Exception;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\KfiDepartment;
use frontend\models\hrvc\KfiEmployee;
use frontend\models\hrvc\KfiHasKgi;
use frontend\models\hrvc\KfiHistory;
use frontend\models\hrvc\KfiIssue;
use frontend\models\hrvc\KfiSolution;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiDepartment;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\KgiGroup;
use frontend\models\hrvc\KgiHasKpi;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\KgiIssue;
use frontend\models\hrvc\KgiSolution;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;

use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\KpiDepartment;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\KpiIssue;
use frontend\models\hrvc\KpiSolution;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use frontend\modules\kfi\kfi as KfiKfi;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kfi` module
 */
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
    public function actionClearAll()
    {
        Kfi::deleteAll(1);
        KfiBranch::deleteAll(1);
        KfiDepartment::deleteAll(1);
        KfiEmployee::deleteAll(1);
        KfiHasKgi::deleteAll(1);
        KfiHistory::deleteAll(1);
        KfiIssue::deleteAll(1);
        KfiSolution::deleteAll(1);

        Kgi::deleteAll(1);
        KgiBranch::deleteAll(1);
        KgiHistory::deleteAll(1);
        KgiDepartment::deleteAll(1);
        KgiEmployee::deleteAll(1);
        KgiEmployeeHistory::deleteAll(1);
        KgiGroup::deleteAll(1);
        KgiHasKpi::deleteAll(1);
        KgiIssue::deleteAll(1);
        KgiSolution::deleteAll(1);
        KgiTeam::deleteAll(1);
        KgiTeamHistory::deleteAll(1);

        Kpi::deleteAll(1);
        KpiBranch::deleteAll(1);
        KpiHistory::deleteAll(1);
        KpiDepartment::deleteAll(1);
        KpiEmployee::deleteAll(1);
        KpiEmployeeHistory::deleteAll(1);
        KpiIssue::deleteAll(1);
        KpiSolution::deleteAll(1);
        KpiTeam::deleteAll(1);
        KpiTeamHistory::deleteAll(1);
    }
    public function actionDeleteOldPim()
    {
        KgiTeam::deleteAll("status=99 or year=2024");
        KgiHistory::deleteAll("status=99 or year=2024");
        KgiTeamHistory::deleteAll("status=99 or year=2024");
        KgiEmployee::deleteAll("status=99 or year=2024");
        KgiEmployeeHistory::deleteAll("status=99 or year=2024");
        KpiTeam::deleteAll("status=99 or year=2024");
        KpiHistory::deleteAll("status=99 or year=2024");
        KpiTeamHistory::deleteAll("status=99 or year=2024");
        KpiEmployee::deleteAll("status=99 or year=2024");
        KpiEmployeeHistory::deleteAll("status=99 or year=2024");

        Kfi::deleteAll("status=99");
        KfiHistory::deleteAll("status=99");
        KfiBranch::deleteAll("status=99");
        KfiDepartment::deleteAll("status=99");
        KfiEmployee::deleteAll("status=99");
        KfiHasKgi::deleteAll("status=99");
        KfiIssue::deleteAll("status=99");
        KfiSolution::deleteAll("status=99");




        Kgi::deleteAll("status=99");
        KgiHistory::deleteAll("status=99");
        KgiBranch::deleteAll("status=99");
        KgiDepartment::deleteAll("status=99");
        KgiEmployee::deleteAll("status=99");
        KgiEmployeeHistory::deleteAll("status=99");
        KgiGroup::deleteAll("status=99");
        KgiHasKpi::deleteAll("status=99");
        KgiIssue::deleteAll("status=99");
        KgiSolution::deleteAll("status=99");
        KgiTeam::deleteAll("status=99");
        KgiTeamHistory::deleteAll("status=99");


        Kpi::deleteAll("status=99");
        KpiHistory::deleteAll("status=99");
        KpiBranch::deleteAll("status=99");
        KpiDepartment::deleteAll("status=99");
        KpiEmployee::deleteAll("status=99");
        KpiEmployeeHistory::deleteAll("status=99");
        KpiIssue::deleteAll("status=99");
        KpiSolution::deleteAll("status=99");
        KpiTeam::deleteAll("status=99");
        KgiTeamHistory::deleteAll("status=99");


        KgiTeam::deleteAll("status=88");
        KgiTeamHistory::deleteAll("status=88");
        KgiEmployee::deleteAll("status=88");
        KgiEmployeeHistory::deleteAll("status=88");
        KpiTeam::deleteAll("status=88");
        KpiTeamHistory::deleteAll("status=88");
        KpiEmployee::deleteAll("status=88");
        KpiEmployeeHistory::deleteAll("status=88");
    }
    public function actionUpdateToCurrent()
    {
        $kgi = Kgi::find()->where(1)->all();
        if (isset($kgi) && count($kgi) > 0) {
            foreach ($kgi as $k):
                $year = '2025';
                $kgiId = $k->kgiId;
                if ($k->unitId == 1) {
                    $month = '01';
                }
                if ($k->unitId == 2) {
                    $month = '03';
                }
                if ($k->unitId == 3) {
                    $month = '06';
                }
                if ($k->unitId == 4) {
                    $month = '12';
                }
                $k->month = $month;
                $k->year = $year;
                $k->save(false);


                $kgiHistory = KgiHistory::find()->where(["kgiId" => $kgiId])->all();
                if (isset($kgiHistory) && count($kgiHistory) > 0) {
                    foreach ($kgiHistory as $kg):
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->save(false);
                    endforeach;
                }
                $kgiTeam = KgiTeam::find()->where(["kgiId" => $kgiId])->all();
                if (isset($kgiTeam) && count($kgiTeam) > 0) {
                    foreach ($kgiTeam as $kg):
                        $kgiTeamHistory = KgiTeamHistory::find()->where(["kgiTeamId" => $kg->kgiTeamId])->all();
                        if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) {
                            foreach ($kgiTeamHistory as $kgh):
                                $kgh->month = $month;
                                $kgh->year = $year;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->save(false);
                    endforeach;
                }
                $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId])->all();
                if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
                    foreach ($kgiEmployee as $kg):
                        $kgiEmployeeHistory = KgiEmployeeHistory::find()->where(["kgiEmployeeId" => $kg->kgiEmployeeId])->all();
                        if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                            foreach ($kgiEmployeeHistory as $kgh):
                                $kgh->month = $month;
                                $kgh->year = $year;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->save(false);
                    endforeach;
                }
            endforeach;
        }
        $kpi = Kpi::find()->where(1)->all();
        if (isset($kpi) && count($kpi) > 0) {
            foreach ($kpi as $k):
                $year = '2025';
                $kpiId = $k->kpiId;
                if ($k->unitId == 1) {
                    $month = '01';
                }
                if ($k->unitId == 2) {
                    $month = '03';
                }
                if ($k->unitId == 3) {
                    $month = '06';
                }
                if ($k->unitId == 4) {
                    $month = '12';
                }
                $k->month = $month;
                $k->year = $year;
                $k->save(false);
                $kpiHistory = KpiHistory::find()->where(["kpiId" => $kpiId])->all();
                if (isset($kpiHistory) && count($kpiHistory) > 0) {
                    foreach ($kpiHistory as $kg):
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->save(false);
                    endforeach;
                }
                $kpiTeam = KpiTeam::find()->where(["kpiId" => $kpiId])->all();
                if (isset($kpiTeam) && count($kpiTeam) > 0) {
                    foreach ($kpiTeam as $kg):
                        $kpiTeamHistory = KpiTeamHistory::find()->where(["kpiTeamId" => $kg->kpiTeamId])->all();
                        if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) {
                            foreach ($kpiTeamHistory as $kgh):
                                $kgh->month = $month;
                                $kgh->year = $year;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->save(false);
                    endforeach;
                }
                $kpiEmployee = KpiEmployee::find()->where(["kpiId" => $kpiId])->all();
                if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
                    foreach ($kpiEmployee as $kg):
                        $kpiEmployeeHistory = KpiEmployeeHistory::find()->where(["kpiEmployeeId" => $kg->kpiEmployeeId])->all();
                        if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                            foreach ($kpiEmployeeHistory as $kgh):
                                $kgh->month = $month;
                                $kgh->year = $year;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->save(false);
                    endforeach;
                }
            endforeach;
        }
        $kgiHis = KgiHistory::find()->where(1)->all();
        if (isset($kgiHis) && count($kgiHis) > 0) {
            foreach ($kgiHis as $kh):
                $kgi = Kgi::find()->where(["kgiId" => $kh->kgiId])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $kh->delete(false);
                }
            endforeach;
        }
        $kgiTeam = KgiTeam::find()->where(1)->all();
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            foreach ($kgiTeam as $kt):
                $kgi = Kgi::find()->where(["kgiId" => $kt->kgiId])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $kt->delete(false);
                }
            endforeach;
        }
        $kgiTeamHistory = KgiTeamHistory::find()->where(1)->all();
        if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) {
            foreach ($kgiTeamHistory as $kth):
                $kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kth->kgiTeamId])->one();
                if (!isset($kgiTeam) || empty($kgiTeam)) {
                    $kth->delete(false);
                }
            endforeach;
        }
        $kgiEmployee = KgiEmployee::find()->where(1)->all();
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke):
                $kgi = Kgi::find()->where(["kgiId" => $ke->kgiId])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $ke->delete(false);
                }
            endforeach;
        }
        $kgiEmployeeHistory = KgiEmployeeHistory::find()->where(1)->all();
        if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
            foreach ($kgiEmployeeHistory as $kte):
                $kgiEmployee = KgiEmployee::find()->where(["kgiEmployeeId" => $kte->kgiEmployeeId])->one();
                if (!isset($kgiEmployee) || empty($kgiEmployee)) {
                    $kte->delete(false);
                }
            endforeach;
        }


        $kpiHis = KpiHistory::find()->where(1)->all();
        if (isset($kpiHis) && count($kpiHis) > 0) {
            foreach ($kpiHis as $kh):
                $kpi = Kpi::find()->where(["kpiId" => $kh->kpiId])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $kh->delete(false);
                }
            endforeach;
        }
        $kpiTeam = KpiTeam::find()->where(1)->all();
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $kt):
                $kpi = Kpi::find()->where(["kpiId" => $kt->kpiId])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $kt->delete(false);
                }
            endforeach;
        }
        $kpiTeamHistory = KpiTeamHistory::find()->where(1)->all();
        if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) {
            foreach ($kpiTeamHistory as $kth):
                $kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $kth->kpiTeamId])->one();
                if (!isset($kpiTeam) || empty($kpiTeam)) {
                    $kth->delete(false);
                }
            endforeach;
        }
        $kpiEmployee = KpiEmployee::find()->where(1)->all();
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke):
                $kpi = Kpi::find()->where(["kpiId" => $ke->kpiId])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $ke->delete(false);
                }
            endforeach;
        }
        $kpiEmployeeHistory = KpiEmployeeHistory::find()->where(1)->all();
        if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
            foreach ($kpiEmployeeHistory as $kte):
                $kpiEmployee = KpiEmployee::find()->where(["kpiEmployeeId" => $kte->kpiEmployeeId])->one();
                if (!isset($kpiEmployee) || empty($kpiEmployee)) {
                    $kte->delete(false);
                }
            endforeach;
        }
    }
    public function actionClearNotRelate()
    {
        $kgiTeam = KgiTeam::find()->where(1)->all();
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            foreach ($kgiTeam as $kt):
                $kgi = Kgi::find()->where(["kgiId" => $kt->kgiId, "status" => [1, 2, 4, 88]])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $kt->delete(false);
                }
            endforeach;
        }
        $kgiEmployee = KgiEmployee::find()->where(1)->all();
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke):
                $team = Employee::employeeTeam($ke->employeeId);
                $teamId = $team["teamId"];
                $kgiTeam = KgiTeam::find()->where(["kgiId" => $ke->kgiId, "teamId" => $teamId, "status" => [1, 2, 4, 88]])->one();
                if (!isset($kgiTeam) || empty($kgiTeam)) {
                    $ke->delete(false);
                }
            endforeach;
        }
        $kpiTeam = KpiTeam::find()->where(1)->all();
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $kt):
                $kpi = Kpi::find()->where(["kpiId" => $kt->kpiId, "status" => [1, 2, 4, 88]])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $kt->delete(false);
                }
            endforeach;
        }
        $kpiEmployee = KpiEmployee::find()->where(1)->all();
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke):
                $team = Employee::employeeTeam($ke->employeeId);
                $teamId = $team["teamId"];
                $kpiTeam = KpiTeam::find()->where(["kpiId" => $ke->kpiId, "teamId" => $teamId, "status" => [1, 2, 4, 88]])->one();
                if (!isset($kpiTeam) || empty($kpiTeam)) {
                    $ke->delete(false);
                }
            endforeach;
        }
        $fg = KfiHasKgi::find()->where(["status" => [1, 2, 4, 88]])->all();
        if (isset($fg) && count($fg) > 0) {
            foreach ($fg as $ff):
                $kfi = Kfi::find()->where(["kfiId" => $ff->kfiId])->one();
                $kgi = Kgi::find()->where(["kgiId" => $ff->kgiId])->one();
                if (!isset($kfi) || empty($kfi) || !isset($kgi) || empty($kgi)) {
                    $ff->delete(false);
                }
            endforeach;
        }
        $gp = KgiHasKpi::find()->where(["status" => [1, 2, 4, 88]])->all();
        if (isset($gp) && count($gp) > 0) {
            foreach ($gp as $gg):
                $kpi = Kpi::find()->where(["kpiId" => $gg->kpiId])->one();
                $kgi = Kgi::find()->where(["kgiId" => $gg->kgiId])->one();
                if (!isset($kpi) || empty($kpi) || !isset($kgi) || empty($kgi)) {
                    $gg->delete(false);
                }
            endforeach;
        }
    }
    public function actionAddKfi()
    {
        // $kfiEmployee = KfiEmployee::find()->where(["month" => null, "year" => null])->all();
        // if (isset($kfiEmployee) && count($kfiEmployee) > 0) {
        //     $year = '2024';
        //     foreach ($kfiEmployee as $ke):
        //         $month = 1;
        //         while ($month <= 12) {
        //             if ($month < 10) {
        //                 $textMonth = '0' . $month;
        //             } else {
        //                 $textMonth = $month;
        //             }
        //             $new = new KfiEmployee();
        //             $new->employeeId = $ke->employeeId;
        //             $new->kfiId = $ke->kfiId;
        //             $new->target = $ke->target;
        //             $new->year = $year;
        //             $new->month = $textMonth;
        //             $new->status = 1;
        //             $new->createDateTime = $ke->createDateTime;
        //             $new->save(false);
        //             $month++;
        //         }
        //         $ke->delete(false);
        //     endforeach;
        // } else {
        //     throw new Exception('111');
        // }
        $employee = KfiEmployee::find()
            ->select('employeeId')
            ->where(["kfiId" => [54, 56, 57, 59]])->groupBy("employeeId")->asArray()->all();
        if (isset($employee) && count($employee) > 0) {
            foreach ($employee as $e):
                $kfi = Kfi::find()->where(["status" => [1, 2, 4]])->asArray()->all();
                if (isset($kfi) && count($kfi) > 0) {
                    foreach ($kfi as $kf):
                        $year = '2024';
                        $month = 1;
                        while ($month <= 12) {
                            if ($month < 10) {
                                $textMonth = '0' . $month;
                            } else {
                                $textMonth = $month;
                            }
                            $kfiHistory = KfiHistory::find()->where(["month" => $month, "year" => $year, "kfiId" => $kf["kfiId"]])->one();
                            if (isset($kfiHistory) && !empty($kfiHistory)) {
                                $kfiEmployee = KfiEmployee::find()
                                    ->where(["month" => $month, "year" => $year, "kfiId" => $kf["kfiId"], "employeeId" => $e["employeeId"]])
                                    ->one();
                                if (!isset($kfiEmployee) || empty($kfiEmployee)) {
                                    $new = new KfiEmployee();
                                    $new->employeeId = $e["employeeId"];
                                    $new->kfiId = $kf["kfiId"];
                                    $new->target = $kf["targetAmount"];
                                    $new->year = $year;
                                    $new->month = $textMonth;
                                    $new->status = 1;
                                    $new->createDateTime = new Expression('NOW()');
                                    $new->save(false);
                                }
                            }
                            $month++;
                        }
                    endforeach;
                }
            endforeach;
        }
        //    throw new exception(print_r($kfiEmployee, true));
    }
    public function actionUpdateToCurrentAssign()
    {
        $kgi = Kgi::find()->where(1)->all();
        if (isset($kgi) && count($kgi) > 0) {
            foreach ($kgi as $k):
                $month = $k->month;
                $year = $k->year;
                $currentStatus = $k->status;
                $kgiId = $k->kgiId;
                $currentKgiHistory = KgiHistory::find()
                    ->where(["kgiId" => $kgiId, "month" => $month, "year" => $year, "status" => $currentStatus])
                    ->orderBy("createDateTime DESC")
                    ->one();
                if (isset($currentKgiHistory)) {
                    $currentKgiHistoryId = $currentKgiHistory->kgiHistoryId;
                } else {
                    $kgiHistory = new KgiHistory();
                    $kgiHistory->kgiId = $kgiId;
                    $kgiHistory->unitId = $k->unitId;
                    $kgiHistory->targetAmount = $k->targetAmount;
                    $kgiHistory->description = $k->kgiDetail;
                    $kgiHistory->quantRatio = $k->quantRatio;
                    $kgiHistory->priority = $k->priority;
                    $kgiHistory->amountType = $k->amountType;
                    $kgiHistory->code = $k->code;
                    $kgiHistory->status = $currentStatus;
                    $kgiHistory->year = $k->year;
                    $kgiHistory->month = $k->month;
                    $kgiHistory->createrId = Yii::$app->user->id;
                    $kgiHistory->createDateTime = new Expression('NOW()');
                    $kgiHistory->updateDateTime = new Expression('NOW()');
                    $kgiHistory->fromDate = $k->fromDate;
                    $kgiHistory->toDate = $k->toDate;
                    $kgiHistory->save(false);
                    $currentKgiHistoryId = Yii::$app->db->lastInsertID;
                }
                $kgiHistory = KgiHistory::find()
                    ->where("kgiId=$kgiId and kgiHistoryId!=$currentKgiHistoryId and status!=99")
                    ->all();
                if (isset($kgiHistory) && count($kgiHistory) > 0) {
                    foreach ($kgiHistory as $kg):
                        $kg->status = 2;
                        $kg->save(false);
                    endforeach;
                }

                $kgiTeam = KgiTeam::find()->where(["kgiId" => $kgiId])->all();
                if (isset($kgiTeam) && count($kgiTeam) > 0) {
                    foreach ($kgiTeam as $kg):
                        $currentKgiTeamHistory = KgiTeamHistory::find()
                            ->where(["kgiTeamId" => $kg->kgiTeamId, "month" => $month, "year" => $year, "status" => $currentStatus])
                            ->orderBy("createDateTime DESC")
                            ->one();
                        if (isset($currentKgiTeamHistory)) {
                            $currentKgiTeamHistoryId = $currentKgiTeamHistory->kgiTeamHistoryId;
                        } else {
                            $KgiTeamHistory = new KgiTeamHistory();
                            $KgiTeamHistory->kgiTeamId = $kg->kgiTeamId;
                            $KgiTeamHistory->target = null;
                            $KgiTeamHistory->month = $month;
                            $KgiTeamHistory->year = $year;
                            $KgiTeamHistory->result = 0;
                            $KgiTeamHistory->status = $currentStatus;
                            $KgiTeamHistory->fromDate = $k->fromDate;
                            $KgiTeamHistory->toDate = $k->toDate;
                            $KgiTeamHistory->createDateTime = new Expression('NOW()');
                            $KgiTeamHistory->updateDateTime = new Expression('NOW()');
                            $KgiTeamHistory->save(false);
                            $currentKgiTeamHistoryId = Yii::$app->db->lastInsertID;
                        }
                        $kgiTeamHistory = KgiTeamHistory::find()->where("kgiTeamId=$kg->kgiTeamId and kgiTeamHistoryId!=$currentKgiTeamHistoryId and status!=99")->all();
                        if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) {
                            foreach ($kgiTeamHistory as $kgh):
                                $kgh->status = 2;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->fromDate = $k->fromDate;
                        $kg->toDate = $k->toDate;
                        $kg->status = $currentStatus;
                        $kg->save(false);
                    endforeach;
                }
                $kgiEmployee = KgiEmployee::find()->where(["kgiId" => $kgiId])->all();
                if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
                    foreach ($kgiEmployee as $kg):
                        $currentKgiEmployeeHistory = KgiEmployeeHistory::find()
                            ->where(["kgiEmployeeId" => $kg->kgiEmployeeId, "month" => $month, "year" => $year, "status" => $currentStatus])
                            ->orderBy("createDateTime DESC")
                            ->one();
                        if (isset($currentKgiEmployeeHistory)) {
                            $currentKgiEmployeeHistoryId = $currentKgiEmployeeHistory->kgiEmployeeHistoryId;
                        } else {
                            $KgiEmployeeHistory = new KgiEmployeeHistory();
                            $KgiEmployeeHistory->kgiEmployeeId = $kg->kgiEmployeeId;
                            $KgiEmployeeHistory->target = null;
                            $KgiEmployeeHistory->month = $month;
                            $KgiEmployeeHistory->year = $year;
                            $KgiEmployeeHistory->result = 0;
                            $KgiEmployeeHistory->status = $currentStatus;
                            $KgiEmployeeHistory->fromDate = $k->fromDate;
                            $KgiEmployeeHistory->toDate = $k->toDate;
                            $KgiEmployeeHistory->createDateTime = new Expression('NOW()');
                            $KgiEmployeeHistory->updateDateTime = new Expression('NOW()');
                            $KgiEmployeeHistory->save(false);
                            $currentKgiEmployeeHistoryId = Yii::$app->db->lastInsertID;
                        }
                        $kgiEmployeeHistory = KgiEmployeeHistory::find()->where("kgiEmployeeId=$kg->kgiEmployeeId and kgiEmployeeHistoryId!=$currentKgiEmployeeHistoryId and status!=99")->all();
                        if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                            foreach ($kgiEmployeeHistory as $kgh):
                                $kgh->status = 2;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->fromDate = $k->fromDate;
                        $kg->toDate = $k->toDate;
                        $kg->status = $currentStatus;
                        $kg->save(false);
                        $employeeId = $kg->employeeId;
                        $teamId = Employee::employeeTeam($employeeId)["teamId"];
                        if ($teamId) {
                            $kgiTeamD = KgiTeam::find()->where(["kgiId" => $kgiId, "teamId" => $teamId])
                                ->andWhere("status!=99")
                                ->one();
                            if (!isset($kgiTeamD) || empty($kgiTeamD)) {
                                KgiEmployee::deleteAll(["kgiId" => $kgiId, "employeeId" => $employeeId]);
                                KgiEmployeeHistory::deleteAll(["kgiEmployeeId" => $kg->kgiEmployeeId]);
                            }
                        }
                    endforeach;
                }
            endforeach;
        }


        $kpi = Kpi::find()->where(1)->all();
        if (isset($kpi) && count($kpi) > 0) {
            foreach ($kpi as $k):
                $month = $k->month;
                $year = $k->year;
                $currentStatus = $k->status;
                $kpiId = $k->kpiId;
                $currentKpiHistory = KpiHistory::find()
                    ->where(["kpiId" => $kpiId, "month" => $month, "year" => $year, "status" => $currentStatus])
                    ->orderBy("createDateTime DESC")
                    ->one();
                if (isset($currentKpiHistory)) {
                    $currentKpiHistoryId = $currentKpiHistory->kpiHistoryId;
                } else {
                    $kpiHistory = new KpiHistory();
                    $kpiHistory->kpiId = $kpiId;
                    $kpiHistory->unitId = $k->unitId;
                    $kpiHistory->targetAmount = $k->targetAmount;
                    $kpiHistory->description = $k->kpiDetail;
                    $kpiHistory->quantRatio = $k->quantRatio;
                    $kpiHistory->priority = $k->priority;
                    $kpiHistory->amountType = $k->amountType;
                    $kpiHistory->code = $k->code;
                    $kpiHistory->status = $currentStatus;
                    $kpiHistory->year = $k->year;
                    $kpiHistory->month = $k->month;
                    $kpiHistory->createrId = Yii::$app->user->id;
                    $kpiHistory->createDateTime = new Expression('NOW()');
                    $kpiHistory->updateDateTime = new Expression('NOW()');
                    $kpiHistory->fromDate = $k->fromDate;
                    $kpiHistory->toDate = $k->toDate;
                    $kpiHistory->save(false);
                    $currentKpiHistoryId = Yii::$app->db->lastInsertID;
                }
                $kpiHistory = KpiHistory::find()
                    ->where("kpiId=$kpiId and kpiHistoryId!=$currentKpiHistoryId and status!=99")
                    ->all();
                if (isset($kpiHistory) && count($kpiHistory) > 0) {
                    foreach ($kpiHistory as $kg):
                        $kg->status = 2;
                        $kg->save(false);
                    endforeach;
                }

                $kpiTeam = KpiTeam::find()->where(["kpiId" => $kpiId])->all();
                if (isset($kpiTeam) && count($kpiTeam) > 0) {
                    foreach ($kpiTeam as $kg):
                        $currentKpiTeamHistory = KpiTeamHistory::find()
                            ->where(["kpiTeamId" => $kg->kpiTeamId, "month" => $month, "year" => $year, "status" => $currentStatus])
                            ->orderBy("createDateTime DESC")
                            ->one();
                        if (isset($currentKpiTeamHistory)) {
                            $currentKpiTeamHistoryId = $currentKpiTeamHistory->kpiTeamHistoryId;
                        } else {
                            $KpiTeamHistory = new KpiTeamHistory();
                            $KpiTeamHistory->kpiTeamId = $kg->kpiTeamId;
                            $KpiTeamHistory->target = null;
                            $KpiTeamHistory->month = $month;
                            $KpiTeamHistory->year = $year;
                            $KpiTeamHistory->result = 0;
                            $KpiTeamHistory->status = $currentStatus;
                            $KpiTeamHistory->fromDate = $k->fromDate;
                            $KpiTeamHistory->toDate = $k->toDate;
                            $KpiTeamHistory->createDateTime = new Expression('NOW()');
                            $KpiTeamHistory->updateDateTime = new Expression('NOW()');
                            $KpiTeamHistory->save(false);
                            $currentKpiTeamHistoryId = Yii::$app->db->lastInsertID;
                        }
                        $kpiTeamHistory = KpiTeamHistory::find()->where("kpiTeamId=$kg->kpiTeamId and kpiTeamHistoryId!=$currentKpiTeamHistoryId and status!=99")->all();
                        if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) {
                            foreach ($kpiTeamHistory as $kgh):
                                $kgh->status = 2;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->fromDate = $k->fromDate;
                        $kg->toDate = $k->toDate;
                        $kg->status = $currentStatus;
                        $kg->save(false);
                    endforeach;
                }
                $kpiEmployee = KpiEmployee::find()->where(["kpiId" => $kpiId])->all();
                if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
                    foreach ($kpiEmployee as $kg):
                        $currentKpiEmployeeHistory = KpiEmployeeHistory::find()
                            ->where(["kpiEmployeeId" => $kg->kpiEmployeeId, "month" => $month, "year" => $year, "status" => $currentStatus])
                            ->orderBy("createDateTime DESC")
                            ->one();
                        if (isset($currentKpiEmployeeHistory)) {
                            $currentKpiEmployeeHistoryId = $currentKpiEmployeeHistory->kpiEmployeeHistoryId;
                        } else {
                            $KpiEmployeeHistory = new KpiEmployeeHistory();
                            $KpiEmployeeHistory->kpiEmployeeId = $kg->kpiEmployeeId;
                            $KpiEmployeeHistory->target = null;
                            $KpiEmployeeHistory->month = $month;
                            $KpiEmployeeHistory->year = $year;
                            $KpiEmployeeHistory->result = 0;
                            $KpiEmployeeHistory->status = $currentStatus;
                            $KpiEmployeeHistory->fromDate = $k->fromDate;
                            $KpiEmployeeHistory->toDate = $k->toDate;
                            $KpiEmployeeHistory->createDateTime = new Expression('NOW()');
                            $KpiEmployeeHistory->updateDateTime = new Expression('NOW()');
                            $KpiEmployeeHistory->save(false);
                            $currentKpiEmployeeHistoryId = Yii::$app->db->lastInsertID;
                        }
                        $kpiEmployeeHistory = KpiEmployeeHistory::find()->where("kpiEmployeeId=$kg->kpiEmployeeId and kpiEmployeeHistoryId!=$currentKpiEmployeeHistoryId and status!=99")->all();
                        if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                            foreach ($kpiEmployeeHistory as $kgh):
                                $kgh->status = 2;
                                $kgh->save(false);
                            endforeach;
                        }
                        $kg->month = $month;
                        $kg->year = $year;
                        $kg->fromDate = $k->fromDate;
                        $kg->toDate = $k->toDate;
                        $kg->status = $currentStatus;
                        $kg->save(false);
                        $employeeId = $kg->employeeId;
                        $teamId = Employee::employeeTeam($employeeId)["teamId"];
                        if ($teamId) {
                            $kpiTeamD = KpiTeam::find()->where(["kpiId" => $kpiId, "teamId" => $teamId])
                                ->andWhere("status!=99")
                                ->one();
                            if (!isset($kpiTeamD) || empty($kpiTeamD)) {
                                KpiEmployee::deleteAll(["kpiId" => $kpiId, "employeeId" => $employeeId]);
                                KpiEmployeeHistory::deleteAll(["kpiEmployeeId" => $kg->kpiEmployeeId]);
                            }
                        }
                    endforeach;
                }
            endforeach;
        }
        $kgiHis = KgiHistory::find()->where(1)->all();
        if (isset($kgiHis) && count($kgiHis) > 0) {
            foreach ($kgiHis as $kh):
                $kgi = Kgi::find()->where(["kgiId" => $kh->kgiId])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $kh->delete(false);
                }
            endforeach;
        }
        $kgiTeam = KgiTeam::find()->where(1)->all();
        if (isset($kgiTeam) && count($kgiTeam) > 0) {
            foreach ($kgiTeam as $kt):
                $kgi = Kgi::find()->where(["kgiId" => $kt->kgiId])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $kt->delete(false);
                }
            endforeach;
        }
        $kgiTeamHistory = KgiTeamHistory::find()->where(1)->all();
        if (isset($kgiTeamHistory) && count($kgiTeamHistory) > 0) {
            foreach ($kgiTeamHistory as $kth):
                $kgiTeam = KgiTeam::find()->where(["kgiTeamId" => $kth->kgiTeamId])->one();
                if (!isset($kgiTeam) || empty($kgiTeam)) {
                    $kth->delete(false);
                }
            endforeach;
        }
        $kgiEmployee = KgiEmployee::find()->where(1)->all();
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $ke):
                $kgi = Kgi::find()->where(["kgiId" => $ke->kgiId])->one();
                if (!isset($kgi) || empty($kgi)) {
                    $ke->delete(false);
                }
            endforeach;
        }
        $kgiEmployeeHistory = KgiEmployeeHistory::find()->where(1)->all();
        if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
            foreach ($kgiEmployeeHistory as $kte):
                $kgiEmployee = KgiEmployee::find()->where(["kgiEmployeeId" => $kte->kgiEmployeeId])->one();
                if (!isset($kgiEmployee) || empty($kgiEmployee)) {
                    $kte->delete(false);
                }
            endforeach;
        }

        $kpiHis = KpiHistory::find()->where(1)->all();
        if (isset($kpiHis) && count($kpiHis) > 0) {
            foreach ($kpiHis as $kh):
                $kpi = Kpi::find()->where(["kpiId" => $kh->kpiId])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $kh->delete(false);
                }
            endforeach;
        }
        $kpiTeam = KpiTeam::find()->where(1)->all();
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $kt):
                $kpi = Kpi::find()->where(["kpiId" => $kt->kpiId])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $kt->delete(false);
                }
            endforeach;
        }
        $kpiTeamHistory = KpiTeamHistory::find()->where(1)->all();
        if (isset($kpiTeamHistory) && count($kpiTeamHistory) > 0) {
            foreach ($kpiTeamHistory as $kth):
                $kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $kth->kpiTeamId])->one();
                if (!isset($kpiTeam) || empty($kpiTeam)) {
                    $kth->delete(false);
                }
            endforeach;
        }
        $kpiEmployee = KpiEmployee::find()->where(1)->all();
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $ke):
                $kpi = Kpi::find()->where(["kpiId" => $ke->kpiId])->one();
                if (!isset($kpi) || empty($kpi)) {
                    $ke->delete(false);
                }
            endforeach;
        }
        $kpiEmployeeHistory = KpiEmployeeHistory::find()->where(1)->all();
        if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
            foreach ($kpiEmployeeHistory as $kte):
                $kpiEmployee = KpiEmployee::find()->where(["kpiEmployeeId" => $kte->kpiEmployeeId])->one();
                if (!isset($kpiEmployee) || empty($kpiEmployee)) {
                    $kte->delete(false);
                }
            endforeach;
        }
    }
}
