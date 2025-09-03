<?php

namespace frontend\modules\home\controllers;

use common\helpers\Path;
use common\helpers\Session;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeePimWeight;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\FrameTerm;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\web\Controller;

class DashboardController extends Controller
{
    public function beforeAction($action)
    {
        Session::deleteSession();
        if (!Yii::$app->user->id) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        return true; //go to origin request
    }
    public function actionIndex()
    {
        $employeeId = User::employeeIdFromUserId();
        $employee = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $termId = FrameTerm::currentTermId($employee["companyId"], $employee["branchId"]);
        $evaluator = Api::connectApi(Path::Api() . 'evaluation/environment/employee-evaluator?employeeId=' . $employeeId . '&&termId=' . $termId);
        $terms = Api::connectApi(Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
        $employeePim = Api::connectApi(Path::Api() . 'evaluation/eva/employee-pim?employeeId=' . $employeeId . '&&termId=' . $termId);
        $allCurrentTerm = Api::connectApi(Path::Api() . 'evaluation/eva/all-current-term?employeeId=' . $employeeId . '&&companyId=' . $employee["companyId"] . '&&branchId=' . $employee["branchId"]);
        $subordinateTerm = Api::connectApi(Path::Api() . 'evaluation/eva/subordinate-current-term?evaluatorId=' .  $employeeId);
        $frameId = $terms["frameId"];
        $frameName = Frame::frameName($frameId);
        return $this->render('index', [
            "employee" => $employee,
            "evaluator" => $evaluator,
            "terms" => $terms,
            "frameName" => $frameName,
            "employeePim" => $employeePim,
            "allCurrentTerm" => $allCurrentTerm,
            "termId" => $termId,
            "subordinateTerm" => $subordinateTerm
        ]);
    }

    public function actionKfiId()
    {
        $kfiId = $_POST["id"];
        $res["kfiId"] = ModelMaster::encodeParams(["kfiId" => $kfiId, 'kfiHistoryId' => 0]);
        return json_encode($res);
    }

    public function actionKgiEmployeeId()
    {
        $kgiEmployeeId = $_POST["id"];
        $res["kgiEmployeeId"] = ModelMaster::encodeParams(["kgiEmployeeId" => $kgiEmployeeId, 'kgiHistoryId' => 0]);
        return json_encode($res);
    }


    public function actionKgiTeamId()
    {
        $kgiTeamId = $_POST["id"];
        $res["kgiTeamId"] = ModelMaster::encodeParams(["kgiTeamId" => $kgiTeamId, 'kgiHistoryId' => 0]);
        return json_encode($res);
    }


    public function actionKgiId()
    {
        $kgiId = $_POST["id"];
        $res["kgiId"] = ModelMaster::encodeParams(["kgiId" => $kgiId, 'kgiHistoryId' => 0]);
        return json_encode($res);
    }

    public function actionKpiEmployeeId()
    {
        $kpiEmployeeId = $_POST["id"];
        $res["kpiEmployeeId"] = ModelMaster::encodeParams(["kpiEmployeeId" => $kpiEmployeeId, 'kpiHistoryId' => 0]);
        return json_encode($res);
    }

    public function actionKpiTeamId()
    {
        $kpiTeamId = $_POST["id"];
        $res["kpiTeamId"] = ModelMaster::encodeParams(["kpiTeamId" => $kpiTeamId, 'kpiHistoryId' => 0]);
        return json_encode($res);
    }

    public function actionKpiId()
    {
        $kpiId = $_POST["id"];
        $res["kpiId"] = ModelMaster::encodeParams(["kpiId" => $kpiId, 'kpiHistoryId' => 0]);
        return json_encode($res);
    }

    //
    public function actionKfiTabId()
    {
        $kfiId = $_POST["id"];
        $res["kfiId"] = ModelMaster::encodeParams(["kfiId" => $kfiId, 'openTab' => 1]);
        return json_encode($res);
    }

    public function actionKgiTabEmployeeId()
    {
        $kgiEmployeeId = $_POST["id"];
        $kgiId = KgiEmployee::find()
            ->select('kgiId')
            ->where(['kgiEmployeeId' => $kgiEmployeeId])
            ->scalar();
        $res["kgiEmployeeId"] = ModelMaster::encodeParams(['kgiEmployeeId' => $kgiEmployeeId, 'kgiEmployeeHistoryId' => 0, 'kgiId' => $kgiId, 'openTab' => 1]);
        return json_encode($res);
    }


    public function actionKgiTabTeamId()
    {
        $kgiTeamId = $_POST["id"];
        $kgiId = KgiTeam::find()
            ->select('kgiId')
            ->where(['kgiTeamId' => $kgiTeamId])
            ->scalar();
        $res["kgiTeamId"] = ModelMaster::encodeParams(['kgiTeamId' => $kgiTeamId, 'kgiTeamHistoryId' => 0, 'kgiId' => $kgiId, 'openTab' => 1]);
        return json_encode($res);
    }


    public function actionKgiTabId()
    {
        $kgiId = $_POST["id"];
        $res["kgiId"] = ModelMaster::encodeParams(["kgiId" => $kgiId, 'openTab' => 0]);
        return json_encode($res);
    }

    public function actionKpiTabEmployeeId()
    {
        $kpiEmployeeId = $_POST["id"];
        $kpiId = KpiEmployee::find()
            ->select('kpiId')
            ->where(['kpiEmployeeId' => $kpiEmployeeId])
            ->scalar();
        $res["kpiEmployeeId"] = ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiEmployeeHistoryId' => 0, 'kpiEmployeeId' => $kpiEmployeeId]);
        return json_encode($res);
    }

    public function actionKpiTabTeamId()
    {
        $kpiTeamId = $_POST["id"];
        $kpiId = KpiTeam::find()
            ->select('kpiId')
            ->where(['kpiTeamId' => $kpiTeamId])
            ->scalar();
        $res["kpiTeamId"] = ModelMaster::encodeParams(['kpiId' => $kpiId, 'kpiTeamHistoryId' => 0, 'kpiTeamId' => $kpiTeamId]);
        return json_encode($res);
    }

    public function actionKpiTabId()
    {
        $kpiId = $_POST["id"];
        $res["kpiId"] = ModelMaster::encodeParams(["kpiId" => $kpiId, 'kpiHistoryId' => 0]);
        return json_encode($res);
    }

    public function actionEndcodeUpcomming()
    {
        $id = Yii::$app->request->post("id", null);
        $historyId = Yii::$app->request->post("historyId", null);
        $typeId = Yii::$app->request->post("typeId", null);
        $type = Yii::$app->request->post("type", null);
        $page = Yii::$app->request->post("page", null);

        $res = [
            "part" => "",
            "param" => ""
        ];

        if ($page == 'kfi') {
            $res["part"] = "kfi/view/kfi-history/";
            $res["param"] = ModelMaster::encodeParams([
                "kfiId" => $id,
                "kfiHistoryId" => $historyId,
                "openTab" => 1
            ]);
        } elseif ($page === 'kpi') {
            if ($type === 'company') {
                $res["part"] = "kpi/view/kpi-history/";
                $res["param"] = ModelMaster::encodeParams([
                    "kpiId" => $id,
                    "kpiHistoryId" => $historyId,
                    "openTab" => 1
                ]);
            } elseif ($type === 'team') {
                $res["part"] = "kpi/kpi-team/kpi-team-history/";
                $res["param"] = ModelMaster::encodeParams([
                    "kpiId" => $id,
                    "kpiTeamHistoryId" => $historyId,
                    "kpiTeamId" => $typeId
                ]);
            } elseif ($type === 'employee') {
                $res["part"] = "kpi/kpi-personal/kpi-individual-history/";
                $res["param"] = ModelMaster::encodeParams([
                    "kpiId" => $id,
                    "kpiEmployeeHistoryId" => $historyId,
                    "kpiEmployeeId" => $typeId
                ]);
            }
        } elseif ($page === 'kgi') {
            if ($type === 'company') {
                $res["part"] = "kgi/view/kgi-history/";
                $res["param"] = ModelMaster::encodeParams([
                    "kgiId" => $id,
                    "kgiHistoryId" => $historyId,
                    "openTab" => 1
                ]);
            } elseif ($type === 'team') {
                $res["part"] = "kgi/kgi-team/kgi-team-history/";
                $res["param"] = ModelMaster::encodeParams([
                    "kgiId" => $id,
                    "kgiTeamHistoryId" => $historyId,
                    "kgiTeamId" => $typeId,
                    "openTab" => 1
                ]);
            } elseif ($type === 'employee') {
                $res["part"] = "kgi/kgi-personal/kgi-employee-history/";
                $res["param"] = ModelMaster::encodeParams([
                    "kgiId" => $id,
                    "kgiEmployeeHistoryId" => $historyId,
                    "kgiEmployeeId" => $typeId,
                    "openTab" => 1
                ]);
            }
        }

        return json_encode($res);
    }

    public function actionChartDashbord()
    {
        $currentCategory = $_POST['currentCategory'] ?? '';
        $type = $_POST['type'] ?? '';
        $userId = Yii::$app->user->id;
        $Id = User::employeeIdFromUserId($userId);
        $employeeProfile = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $Id);
        $companyId = $employeeProfile['companyId'];
        $teamId = $employeeProfile['teamId'];
        $employeeId = $employeeProfile['employeeId'];
        $res = [];
        if ($currentCategory && $type) {
            $res['category'] = $currentCategory;
            $res['type'] = $type;
            if ($type == 'KFI') {
                $chartKFI = Api::connectApi(Path::Api() . 'home/dashbord/chart-kfi?currentCategory=' . $currentCategory . '&&companyId=' . $companyId . '&&teamId=' . $teamId . '&&employeeId=' . $employeeId);
                $performanceData = $chartKFI['performance'] ?? [];
                $finalPerformanceData = [];
                for ($i = 1; $i <= 12; $i++) {
                    $finalPerformanceData[] = $performanceData[$i] ?? 0;
                }
                while (!empty($finalPerformanceData) && end($finalPerformanceData) === 0) {
                    array_pop($finalPerformanceData);
                }
                $res['data'] = [
                    [
                        'title' => "KFI Performance",
                        'series' => [
                            [
                                'type' => 'areaspline',
                                'name' => 'Performance',
                                'data' => $finalPerformanceData,
                                'color' => '#748EE9',
                                'fillOpacity' => 0.5,
                                'lineWidth' => 2,
                                'marker' => ['enabled' => true],
                                'visible' => true,
                                'showInLegend' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Result',
                                'data' => $finalPerformanceData,
                                'color' => 'transparent',
                                'lineWidth' => 0,
                                'marker' => ['enabled' => false],
                                'showInLegend' => false,
                                'enableMouseTracking' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_map(fn($v) => $v - 100, $finalPerformanceData),
                                'color' => 'transparent',
                                'lineWidth' => 0,
                                'marker' => ['enabled' => false],
                                'showInLegend' => false,
                                'enableMouseTracking' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Max',
                                'data' => array_fill(0, 12, 100.0),
                                'color' => '#748EE9',
                                'lineWidth' => 2,
                                'marker' => ['enabled' => false],
                                'halo' => null,
                                'visible' => true,
                                'enableMouseTracking' => false,
                                'showInLegend' => false
                            ]
                        ]
                    ]
                ];
            } elseif ($type == 'KGI') {
                $chartKGI = Api::connectApi(Path::Api() . 'home/dashbord/chart-kgi?currentCategory=' . $currentCategory . '&companyId=' . $companyId . '&teamId=' . $teamId . '&employeeId=' . $employeeId);
                $performanceData = $chartKGI['performance'] ?? [];
                $finalPerformanceData = [];
                for ($i = 1; $i <= 12; $i++) {
                    $finalPerformanceData[] = $performanceData[$i] ?? 0;
                }
                while (!empty($finalPerformanceData) && end($finalPerformanceData) === 0) {
                    array_pop($finalPerformanceData);
                }
                $res['data'] = [
                    [
                        'title' => "KGI Performance",
                        'series' => [
                            [
                                'type' => 'areaspline',
                                'name' => 'Performance',
                                'data' => $finalPerformanceData,
                                'color' => '#FFBA00',
                                'fillOpacity' => 0.4,
                                'lineWidth' => 2,
                                'marker' => ['enabled' => true],
                                'visible' => true,
                                'showInLegend' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Result',
                                'data' => $finalPerformanceData,
                                'color' => 'transparent',
                                'lineWidth' => 0,
                                'marker' => ['enabled' => false],
                                'showInLegend' => false,
                                'enableMouseTracking' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_map(fn($v) => $v - 100, $finalPerformanceData),
                                'color' => 'transparent',
                                'lineWidth' => 0,
                                'marker' => ['enabled' => false],
                                'showInLegend' => false,
                                'enableMouseTracking' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Max',
                                'data' => array_fill(0, 12, 100.0),
                                'color' => '#FFD000',
                                'lineWidth' => 4,
                                'marker' => ['enabled' => false],
                                'visible' => true,
                                'enableMouseTracking' => false,
                                'showInLegend' => false
                            ]
                        ]
                    ]
                ];
            } elseif ($type == 'KPI') {
                $chartKPI = Api::connectApi(Path::Api() . 'home/dashbord/chart-kpi?currentCategory=' . $currentCategory . '&companyId=' . $companyId . '&teamId=' . $teamId . '&employeeId=' . $employeeId);
                $performanceData = $chartKPI['performance'] ?? [];
                $finalPerformanceData = [];
                for ($i = 1; $i <= 12; $i++) {
                    $finalPerformanceData[] = $performanceData[$i] ?? 0;
                }
                while (!empty($finalPerformanceData) && end($finalPerformanceData) === 0) {
                    array_pop($finalPerformanceData);
                }
                $res['data'] = [
                    [
                        'title' => "KPI Performance",
                        'series' => [
                            [
                                'type' => 'areaspline',
                                'name' => 'Performance',
                                'data' => $finalPerformanceData,
                                'color' => '#F20',
                                'fillOpacity' => 0.4,
                                'lineWidth' => 2,
                                'marker' => ['enabled' => true],
                                'visible' => true,
                                'showInLegend' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Result',
                                'data' => $finalPerformanceData,
                                'color' => 'transparent',
                                'lineWidth' => 0,
                                'marker' => ['enabled' => false],
                                'showInLegend' => false,
                                'enableMouseTracking' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_map(fn($v) => $v - 100, $finalPerformanceData),
                                'color' => 'transparent',
                                'lineWidth' => 0,
                                'marker' => ['enabled' => false],
                                'showInLegend' => false,
                                'enableMouseTracking' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_fill(0, 12, 100.0),
                                'color' => '#FF715B',
                                'lineWidth' => 4,
                                'marker' => ['enabled' => false],
                                'visible' => true,
                                'enableMouseTracking' => false,
                                'showInLegend' => false
                            ]
                        ]
                    ]
                ];
            }
        }
        return json_encode($res);
    }

    public function actionUpcomingSchedule()
    {
        $data = [];
        $userId = Yii::$app->user->id;
        $Id = User::employeeIdFromUserId($userId);
        $role = UserRole::userRight();
        $employeeProfile = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $Id);
        $companyId = $employeeProfile['companyId'];
        $teamId = $employeeProfile['teamId'];
        $employeeId = $employeeProfile['employeeId'];
        $upcoming = Api::connectApi(Path::Api() . 'home/dashbord/upcoming-schedule?id=' . $Id . '&role=' . $role . '&companyId=' . $companyId . '&teamId=' . $teamId . '&employeeId=' . $employeeId);
        return json_encode($upcoming);
    }
}
