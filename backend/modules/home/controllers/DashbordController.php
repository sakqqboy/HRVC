<?php

namespace backend\modules\home\controllers;

use backend\models\hrvc\Employee;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiHistory;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiEmployeeHistory;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiTeamHistory;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiEmployeeHistory;
use backend\models\hrvc\KpiHistory;
use backend\models\hrvc\KpiTeam;
use backend\models\hrvc\KpiTeamHistory;
use backend\models\hrvc\User;
use backend\modules\fs\fs;
use backend\modules\kfi\kfi as KfiKfi;
use common\models\ModelMaster;
use DateTime;
use Exception;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\web\Controller;

/**
 * Default controller for the `home` module
 */

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class DashbordController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionProfile($employeeId)
    {
        // ดึงข้อมูลพนักงานจากฐานข้อมูล
        $employeeDetails = Employee::find()
            ->select([
                'e.employeeId',
                'e.titleId',
                'e.employeeConditionId',
                'e.companyId',
                'e.picture',
                'CONCAT(e.employeeFirstname, " ", e.employeeSurename) AS fullName',
                'e.companyEmail',
                'e.joinDate',
                't.titleName',
                't.shortTag',
                'ec.employeeConditionName',
                'c.companyName',
                'c.countryId',
            ])
            ->alias('e') // ตั้ง alias ให้กับตารางหลัก
            ->join('LEFT JOIN', 'title t', 't.titleId = e.titleId')
            ->join('LEFT JOIN', 'employee_condition ec', 'ec.employeeConditionId = e.employeeConditionId')
            ->join('LEFT JOIN', 'company c', 'c.companyId = e.companyId')
            ->where(['e.employeeId' => $employeeId])
            ->asArray()
            ->one(); // ใช้ one() แทน all() เนื่องจากต้องการผลลัพธ์เดียว
    
        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if ($employeeDetails) {
            $data = $employeeDetails;
        } else {
            $data = ['error' => 'Employee not found.'];
        }
    
        // ส่งผลลัพธ์เป็น JSON
        return json_encode($data);
    }
    
    public function actionDashbordCompany($companyId)
    {
        $kpiData = [];
        $kgiData = [];
        $kfiData = [];
        $totlePercentKPI = 0;
        $totlePercentKGI = 0;
        $totlePercentKFI = 0;
        
        // $mount = 01;
        // $year = 2025;

        $mount = date('m');
        $year = date('Y');

        $kfis = KfiHistory::find()
        ->alias('b')
        ->select([
            'a.kfiId', 
            'a.active', 
            'a.kfiName', 
            'a.companyId', 
            'a.status', 
            'b.month', 
            'b.year', 
            'b.target', 
            'b.result', 
            'b.kfiHistoryId', 
            'b.unitId', 
            'b.quantRatio', 
            'b.amountType', 
            'b.code'
        ])
        ->leftJoin('kfi a', 'a.kfiId = b.kfiId')
        ->where([
            'a.status' => [1, 2, 4],
            'b.status' => [1, 2, 4],
            'a.companyId' => $companyId,  // ป้องกันเลขฐาน 8
            'b.month' => $mount, // ใช้ตัวแปรจาก PHP
            'b.year' => $year
        ])
        ->andWhere([
            'b.kfiHistoryId' => new \yii\db\Expression(
                "(SELECT MAX(kfiHistoryId) 
                FROM kfi_history 
                WHERE kfiId = b.kfiId 
                AND month = :month)"
            )
        ])
        ->addParams([':month' => $mount]) // ป้องกัน SQL Injection
        ->orderBy(['b.kfiHistoryId' => SORT_DESC])
        ->asArray()
        ->all();

        $kgis = kgiHistory::find()
        ->alias('b')
        ->select([
            'a.kgiId',
            'a.active', 
            'a.kgiName', 
            'a.companyId', 
            'a.status', 
            'b.month', 
            'b.year', 
            'b.targetAmount', 
            'b.result', 
            'b.kgiHistoryId', 
            'b.unitId', 
            'b.quantRatio', 
            'b.amountType', 
            'b.code'
        ])
        ->leftJoin('kgi a', 'a.kgiId = b.kgiId')
        ->where([
            'a.status' => [1, 2, 4],
            'b.status' => [1, 2, 4],
            'a.companyId' => $companyId,  // ป้องกันเลขฐาน 8
            'b.month' => $mount, // ใช้ตัวแปรจาก PHP
            'b.year' => $year
        ])
        ->andWhere([
            'b.kgiHistoryId' => new \yii\db\Expression(
                "(SELECT MAX(kgiHistoryId) 
                FROM kgi_history 
                WHERE kgiId = b.kgiId 
                AND month = :month)"
            )
        ])
        ->addParams([':month' => $mount]) // ป้องกัน SQL Injection
        ->orderBy(['b.kgiHistoryId' => SORT_DESC])
        ->asArray()
        ->all();


        $kpis = kpiHistory::find()
        ->alias('b')
        ->select([
            'a.kpiId',
            'a.active', 
            'a.kpiName', 
            'a.companyId', 
            'a.status', 
            'b.month', 
            'b.year', 
            'b.targetAmount', 
            'b.result', 
            'b.kpiHistoryId', 
            'b.unitId', 
            'b.quantRatio', 
            'b.amountType', 
            'b.code'
        ])
        ->leftJoin('kpi a', 'a.kpiId = b.kpiId')
        ->where([
            'a.status' => [1, 2, 4],
            'b.status' => [1, 2, 4],
            'a.companyId' => $companyId,  // ป้องกันเลขฐาน 8
            'b.month' => $mount, // ใช้ตัวแปรจาก PHP
            'b.year' => $year
        ])
        ->andWhere([
            'b.kpiHistoryId' => new \yii\db\Expression(
                "(SELECT MAX(kpiHistoryId) 
                FROM kpi_history 
                WHERE kpiId = b.kpiId 
                AND month = :month)"
            )
        ])
        ->addParams([':month' => $mount]) // ป้องกัน SQL Injection
        ->orderBy(['b.kpiHistoryId' => SORT_DESC])
        ->asArray()
        ->all();

        // return json_encode($kgis);
    
        // นับจำนวนของแต่ละคิวรี้
        $kfiCount = count($kfis);
        $kgiCount = count($kgis);
        $kpiCount = count($kpis);
        $have = ''; // สร้างตัวแปรเปล่าสำหรับเก็บค่าที่วนลูป

        if (isset($kfis) && count($kfis) > 0) {
            $totlePercent = 0;
			foreach ($kfis as $kfi) :

                if (strlen($kfi["kfiName"]) > 18) {
					$kfiname = substr($kfi["kfiName"], 0, 18) . '. . .';
				} else {
					$kfiname = $kfi["kfiName"];
				}

             
                // $kfID = $kfi["kfiId"];
                    $kfiHistory = KfiHistory::find()
                        ->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2], "month" => $mount, "year" => $year])
                        ->orderBy('year DESC,kfiHistoryId DESC')
                        ->asArray()
                        ->one();

                    if (isset($kfiHistory) && !empty($kfiHistory)) {
                        if ($kfi["target"] == null || $kfi["target"] == '' || $kfi["target"] == 0) {
                            $ratio = 0;
                        } else {
                            if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
                                $ratio = ((int)$kfiHistory['result'] / (int)$kfi["target"]) * 100;
                            } else {
                                //$ratio = ((int)$kfi['targetAmount'] / (int)$kfiHistory["result"]) * 100;
                                if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
                                    $ratio = ((int)$kfi["target"] / (int)$kfiHistory["result"]) * 100;
                                } else {
                                    $ratio = 0;
                                }
                            }
                        }	
                        $showPercent = 0;
                        $percent = explode('.', $ratio);
                        if (isset($percent[0]) && $percent[0] == '0') {
                            if (isset($percent[1])) {
                                if ($percent[1] == '00') {
                                    $showPercent = 0;
                                } else {
                                    $showPercent = round($ratio, 1);
                                }
                            }
                        } else {
                            $showPercent = round($ratio);
                        }		

                        $kfiData[$kfi["kfiId"]] = [
                            "name" => $kfiname,
                            "companyId" => $kfi['companyId'],
                            "target" => $kfi['target'],
                            "status" => $kfiHistory['status'],
                            "quantRatio" => $kfiHistory["quantRatio"],
                            "code" =>  $kfiHistory["code"],
                            "result" => $kfiHistory["result"],
                            "percentage" => $showPercent,
                            "amountType" => $kfiHistory["amountType"],						
                            "active" => $kfi["active"],
                            "id" => $kfiHistory['kfiHistoryId'],
                            'kfiId'=> $kfi['kfiId'],
                            "due" => ModelMaster::engDate($kfiHistory["nextCheckDate"], 2),
						    // "last" => ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2),
                            "last" => ModelMaster::engDate($kfiHistory["nextCheckDate"], 2)

                        ];
                                  
                        $totlePercent = $totlePercent + $showPercent;
				    }
                 // ส่งผลลัพธ์เป็น JSON
            endforeach;

            $totlePercentKFI = ceil($totlePercent / $kfiCount);
		}


        if (isset($kgis) && count($kgis) > 0) {
            $totlePercent = 0;
			foreach ($kgis as $kgi) :

                if (strlen($kgi["kgiName"]) > 18) {
					$kginame = substr($kgi["kgiName"], 0, 18) . '. . .';
				} else {
					$kginame = $kgi["kgiName"];
				}
             
                    $kgiHistory = KgiHistory::find()
                        ->where(["kgiId" => $kgi["kgiId"], "status" => [1, 2], "month" => $mount, "year" => $year])
                        ->orderBy('year DESC,kgiHistoryId DESC')
                        ->asArray()
                        ->one();

                    if (isset($kgiHistory) && !empty($kgiHistory)) {
                        if ($kgi["targetAmount"] == null || $kgi["targetAmount"] == '' || $kgi["targetAmount"] == 0) {
                            $ratio = 0;
                        } else {
                            if ($kgiHistory["code"] == '<' || $kgiHistory["code"] == '=') {
                                $ratio = ((int)$kgiHistory['result'] / (int)$kgi["targetAmount"]) * 100;
                            } else {
                                if ($kgiHistory["result"] != '' && $kgiHistory["result"] != 0) {
                                    $ratio = ((int)$kgi["targetAmount"] / (int)$kgiHistory["result"]) * 100;
                                } else {
                                    $ratio = 0;
                                }
                            }
                        }	
                        $showPercent = 0;
                        $percent = explode('.', $ratio);
                        if (isset($percent[0]) && $percent[0] == '0') {
                            if (isset($percent[1])) {
                                if ($percent[1] == '00') {
                                    $showPercent = 0;
                                } else {
                                    $showPercent = round($ratio, 1);
                                }
                            }
                        } else {
                            $showPercent = round($ratio);
                        }		

                        $kgiData[$kgi["kgiId"]] = [
                            "name" => $kginame,
                            "companyId" => $kgi['companyId'],
                            "target" => $kgi['targetAmount'],
                            "status" => $kgiHistory['status'],
                            "quantRatio" => $kgiHistory["quantRatio"],
                            "code" =>  $kgiHistory["code"],
                            "result" => $kgiHistory["result"],
                            "percentage" => $showPercent,
                            "amountType" => $kgiHistory["amountType"],						
                            "active" => $kgi["active"],
                            "id" => $kgiHistory['kgiHistoryId'],
                            'kgiId'=> $kgi['kgiId'],
                            "due" => ModelMaster::engDate($kgiHistory["nextCheckDate"], 2),
						    // "last" => ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2)
                            "last" => ModelMaster::engDate($kgiHistory["nextCheckDate"], 2),

                        ];
                                  
                        $totlePercent = $totlePercent + $showPercent;
				    }
                 // ส่งผลลัพธ์เป็น JSON
            endforeach;

            $totlePercentKGI = ceil($totlePercent / $kgiCount);
		}

        if (isset($kpis) && count($kpis) > 0) {
            $totlePercent = 0;
			foreach ($kpis as $kpi) :

                if (strlen($kpi["kpiName"]) > 18) {
					$kpiname = substr($kpi["kpiName"], 0, 18) . '. . .';
				} else {
					$kpiname = $kpi["kpiName"];
				}
             
                    $kpiHistory = KpiHistory::find()
                        ->where(["kpiId" => $kpi["kpiId"], "status" => [1, 2], "month" => $mount, "year" => $year])
                        ->orderBy('kpiHistoryId DESC')
                        ->asArray()
                        ->one();

                    if (isset($kpiHistory) && !empty($kpiHistory)) {
                        if ($kpi["targetAmount"] == null || $kpi["targetAmount"] == '' || $kpi["targetAmount"] == 0) {
                            $ratio = 0;
                        } else {
                            if ($kpiHistory["code"] == '<' || $kpiHistory["code"] == '=') {
                                $ratio = ((int)$kpiHistory['result'] / (int)$kpi["targetAmount"]) * 100;
                            } else {
                                if ($kpiHistory["result"] != '' && $kpiHistory["result"] != 0) {
                                    $ratio = ((int)$kpi["targetAmount"] / (int)$kpiHistory["result"]) * 100;
                                } else {
                                    $ratio = 0;
                                }
                            }
                        }	
                        $showPercent = 0;
                        $percent = explode('.', $ratio);
                        if (isset($percent[0]) && $percent[0] == '0') {
                            if (isset($percent[1])) {
                                if ($percent[1] == '00') {
                                    $showPercent = 0;
                                } else {
                                    $showPercent = round($ratio, 1);
                                }
                            }
                        } else {
                            $showPercent = round($ratio);
                        }		

                        $kpiData[$kpi["kpiId"]] = [
                            "name" => $kpiname,
                            "companyId" => $kpi['companyId'],
                            "target" => $kpi['targetAmount'],
                            "status" => $kpiHistory['status'],
                            "quantRatio" => $kpiHistory["quantRatio"],
                            "code" =>  $kpiHistory["code"],
                            "result" => $kpiHistory["result"],
                            "percentage" => $showPercent,
                            "amountType" => $kpiHistory["amountType"],						
                            "active" => $kpi["active"],
                            "id" => $kpiHistory['kpiHistoryId'],
                            'kpiId'=> $kpi['kpiId'],
                            "due" => ModelMaster::engDate($kpiHistory["nextCheckDate"], 2),
						    // "last" => ModelMaster::engDate($kfiHistory["checkPeriodDate"], 2),
                            "last" => ModelMaster::engDate($kpiHistory["nextCheckDate"], 2),
                        ];

                        $totlePercent = $totlePercent + $showPercent;
                        // $have .= $totlePercent . ' '; 

				    }
                 // ส่งผลลัพธ์เป็น JSON
            endforeach;

            $totlePercentKPI = ceil($totlePercent / $kpiCount);
		}

        $data = [
            'KFI' => ['kfiCount' => $kfiCount,'KFIData' => $kfiData,'showPercent' => $totlePercentKFI],
            'KGI'=>  ['kgiCount' => $kgiCount,'KGIData' => $kgiData,'showPercent' => $totlePercentKGI],
            'KPI'=>  ['kpiCount' => $kpiCount,'KPIData' => $kpiData,'showPercent' => $totlePercentKPI]
        ];
       
        return json_encode($data);
    }
    
    public function actionDashbordTeam($teamId, $userId, $role)
    {
        $kpiData = [];
        $kgiData = [];
        $kfiData = [];
        $totlePercentKPI = 0;
        $totlePercentKGI = 0;
        $totlePercentKFI = 0;

        // $mount = 03;
        // $year = 2025;

        $mount = date('m');
        $year = date('Y');
        
        $employeeId = Employee::employeeId($userId);
		$employee = Employee::EmployeeDetail($employeeId);
        
			//     $kgiTeams = KgiTeam::find()
			// 	->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,
			// kgi_team.teamId,kgi_team.target,kgi_team.month,kgi_team.year')
			// 	->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
			// 	->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
			// 	->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4],"kgi_team.month" => $mount, "kgi_team.year" => $year])
			// 	->andFilterWhere(["kgi_team.teamId" => $teamId])
			// 	->orderBy("k.createDateTime DESC,t.teamName ASC")
			// 	->asArray()
			// 	->all();

			// 	$kpiTeams = KpiTeam::find()
			// 	->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_team.kpiTeamId,k.companyId,
			// kpi_team.teamId,kpi_team.target,kpi_team.month,kpi_team.year')
			// 	->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
			// 	->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
			// 	->where(["kpi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_team.month" => $mount, "kpi_team.year" => $year])
			// 	->andFilterWhere(["kpi_team.teamId" => $teamId])
			// 	->orderBy("k.createDateTime DESC,t.teamName ASC")
			// 	->asArray()
			// 	->all();

            $kgiTeams = KgiTeamHistory::find()
            ->select([
                'a.kgiId', 'a.target', 'a.result', 'a.status', 'a.teamId', 'a.kgiTeamId',
                'kgi_team_history.kgiTeamHistoryId', 'kgi_team_history.month', 'kgi_team_history.year',
                'k.kgiName', 'k.unitId', 'k.quantRatio', 'k.priority', 
                'k.amountType', 'k.code', 'k.companyId'
            ])
            ->leftJoin('kgi_team a', 'a.kgiTeamId = kgi_team_history.kgiTeamId')
            ->leftJoin('kgi k', 'a.kgiId = k.kgiId')
            ->leftJoin('team t', 't.teamId = a.teamId')
            ->where([
                'a.status' => [1, 2, 4],
                'k.status' => [1, 2, 4],
                'a.teamId' => $teamId,
                'kgi_team_history.month' => $mount,
                'kgi_team_history.year' => $year,
            ])
            ->andWhere([
                'kgi_team_history.kgiTeamHistoryId' => new \yii\db\Expression(
                    "(SELECT MAX(kgiTeamHistoryId) 
                      FROM kgi_team_history 
                      WHERE kgiTeamId = a.kgiTeamId 
                      AND month = :month)"
                )
            ])
            ->addParams([':month' => $mount])
            ->orderBy(['kgi_team_history.kgiTeamHistoryId' => SORT_DESC])
            ->asArray()
            ->all();
        

            $kpiTeams = KpiTeamHistory::find()
            ->select([
                'a.kpiId', 'a.target', 'a.result', 'a.status', 'a.teamId', 'a.kpiTeamId',
                'kpi_team_history.kpiTeamHistoryId', 'kpi_team_history.month', 'kpi_team_history.year',
                'k.kpiName', 'k.unitId', 'k.quantRatio', 'k.priority', 
                'k.amountType', 'k.code', 'k.companyId'
            ])
            ->leftJoin('kpi_team a', 'a.kpiTeamId = kpi_team_history.kpiTeamId')
            ->leftJoin('kpi k', 'a.kpiId = k.kpiId')
            ->leftJoin('team t', 't.teamId = a.teamId')
            ->where([
                'a.status' => [1, 2, 4],
                'k.status' => [1, 2, 4],
                'a.teamId' => $teamId,
                'kpi_team_history.month' => $mount,
                'kpi_team_history.year' => $year,
            ])
            ->andWhere([
                'kpi_team_history.kpiTeamHistoryId' => new \yii\db\Expression(
                    "(SELECT MAX(kpiTeamHistoryId) 
                    FROM kpi_team_history 
                    WHERE kpiTeamId = a.kpiTeamId 
                    AND month = :month)"
                )
            ])
            ->addParams([':month' => $mount])
            ->orderBy(['kpi_team_history.kpiTeamHistoryId' => SORT_DESC])
            ->asArray()
            ->all();


    
        // นับจำนวนของแต่ละคิวรี้
        $kgiTeamCount = count($kgiTeams);
        $kpiTeamCount = count($kpiTeams);
        $have = ''; // สร้างตัวแปรเปล่าสำหรับเก็บค่าที่วนลูป

        if (isset($kgiTeams) && count($kgiTeams) > 0) {
            $totlePercent = 0;
			foreach ($kgiTeams as $kgiTeam) :

                $kgiTeamHistory = KgiTeamHistory::find()
					->where(["kgiTeamId" => $kgiTeam["kgiTeamId"], "month" => $mount, "year" => $year])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kgiTeamHistory) || empty($kgiTeamHistory)) {
					$kgiTeamHistory = KgiTeam::find()
						->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kgiTeamHistory["target"] != '' && $kgiTeamHistory["target"] != 0 && $kgiTeamHistory["target"] != null) {
					if ($kgiTeam["code"] == '<' || $kgiTeam["code"] == '=') {
						$ratio = ($kgiTeamHistory["result"] / $kgiTeamHistory["target"]) * 100;
					} else {
						if ($kgiTeamHistory["result"] != '' && $kgiTeamHistory["result"] != 0) {
							$ratio = ($kgiTeamHistory["target"] / $kgiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}

                if (strlen($kgiTeam["kgiName"]) > 18) {
					$kginame = substr($kgiTeam["kgiName"], 0, 18) . '. . .';
				} else {
					$kginame = $kgiTeam["kgiName"];
				}

                $kgiData[$kgiTeam["kgiTeamId"]] = [
					"name" => $kginame,
                    "companyId" => $kgiTeam["companyId"],
                    "target" => $kgiTeamHistory["target"],
                    "result" => $kgiTeamHistory["result"],
                    "status" => $kgiTeamHistory["status"],
					"quantRatio" => $kgiTeam["quantRatio"],
					"code" => $kgiTeam["code"],
					"percentage" => $ratio, 
                    "amountType" => $kgiTeam["amountType"],
                    "active" => '',
                    "id" => $kgiTeam["kgiTeamId"],
					"kgiId" => $kgiTeam["kgiId"],
                    // "due" => ModelMaster::engDate(KgiTeam::lastestCheckDate($kgiTeam["kgiTeamId"]), 2), //lastest check date
                    "due" =>  ModelMaster::engDate($kgiTeamHistory["nextCheckDate"], 2),
					"last" =>  ModelMaster::engDate($kgiTeamHistory["nextCheckDate"], 2)         
					
				];
                $totlePercent = $totlePercent + $ratio;
            endforeach;
            $totlePercentKGI = ceil($totlePercent / $kgiTeamCount);
        }

        if (isset($kpiTeams) && count($kpiTeams) > 0) {
            $totlePercent = 0;
			foreach ($kpiTeams as $kpiTeam) :

                $kpiTeamHistory = KpiTeamHistory::find()
					->where(["kpiTeamId" => $kpiTeam["kpiTeamId"], "month" => $mount, "year" => $year])
					->asArray()
					->orderBy('createDateTime DESC')
					->one();
				if (!isset($kpiTeamHistory) || empty($kpiTeamHistory)) {
					$kpiTeamHistory = kpiTeam::find()
						->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
						->asArray()
						->orderBy('createDateTime DESC')
						->one();
				}
				$ratio = 0;
				if ($kpiTeamHistory["target"] != '' && $kpiTeamHistory["target"] != 0 && $kpiTeamHistory["target"] != null) {
					if ($kpiTeam["code"] == '<' || $kpiTeam["code"] == '=') {
						$ratio = ($kpiTeamHistory["result"] / $kpiTeamHistory["target"]) * 100;
					} else {
						if ($kpiTeamHistory["result"] != '' && $kpiTeamHistory["result"] != 0) {
							$ratio = ($kpiTeamHistory["target"] / $kpiTeamHistory["result"]) * 100;
						} else {
							$ratio = 0;
						}
					}
				} else {
					$ratio = 0;
				}

                if (strlen($kpiTeam["kpiName"]) > 18) {
					$kpiname = substr($kpiTeam["kpiName"], 0, 18) . '. . .';
				} else {
					$kpiname = $kpiTeam["kpiName"];
				}

                $kpiData[$kpiTeam["kpiTeamId"]] = [
					"name" => $kpiname,
                    "companyId" => $kpiTeam["companyId"],
                    "target" => $kpiTeamHistory["target"],
                    "status" => $kpiTeamHistory["status"],
					"quantRatio" => $kpiTeam["quantRatio"],
					"code" => $kpiTeam["code"],
					"result" => $kpiTeamHistory["result"],
					"percentage" => $ratio,
                    "amountType" => $kpiTeam["amountType"],
                    "active" => '',
                    "id" => $kpiTeam["kpiTeamId"],
					"kpiId" => $kpiTeam["kpiId"],
                    // "due" => ModelMaster::engDate(kpiTeam::lastestCheckDate($kpiTeam["kpiTeamId"]), 2), //lastest check date
                    "due" =>  ModelMaster::engDate($kpiTeamHistory["nextCheckDate"], 2),
					"last" =>  ModelMaster::engDate($kpiTeamHistory["nextCheckDate"], 2)         
					
				];
                $totlePercent = $totlePercent + $ratio;
            endforeach;
            $totlePercentKPI = ceil($totlePercent / $kpiTeamCount);
        }
        
        // ส่งผลลัพธ์เป็น JSON  
        $data = [
            'KFI'=>  ['kfiCount' => [],'KFIData' => [],'showPercent' => [] ],
            'KGI'=>  ['kgiCount' => $kgiTeamCount,'KGIData' => $kgiData,'showPercent' => $totlePercentKGI],
            'KPI'=>  ['kpiCount' => $kpiTeamCount,'KPIData' => $kpiData,'showPercent' => $totlePercentKPI]
        ];
    
        return json_encode($data);
    }
    
    public function actionDashbordEmployee($employeeId, $userId, $role)
    {
        $kpiData = [];
        $kgiData = [];
        $kfiData = [];
        $totlePercentKPI = 0;
        $totlePercentKGI = 0;
        $totlePercentKFI = 0;

        // $mount = 01;
        // $year = 2025;

        $mount = date('m');
        $year = date('Y');
        $employeeId = Employee::employeeId($userId);

        $subQueryKgi = KgiEmployeeHistory::find()
        ->select('MAX(kgiEmployeeHistoryId)')
        ->where([
            'kgiEmployeeId' => new \yii\db\Expression('a.kgiEmployeeId'),
            'month' => $mount,
        ]);

        $subQueryKpi = KpiEmployeeHistory::find()
        ->select('MAX(kpiEmployeeHistoryId)')
        ->where([
            'kpiEmployeeId' => new \yii\db\Expression('a.kpiEmployeeId'),
            'month' => $mount,
        ]);
    
    
        $kgiEmployee = KgiEmployeeHistory::find()
            ->alias('b')
            ->select([
                'a.kgiId',
                'b.kgiEmployeeHistoryId',
                'k.kgiName',
                'k.priority',
                'k.quantRatio',
                'k.amountType',
                'k.code',
                'a.target',
                'a.result',
                'a.status',
                'a.employeeId',
                'k.unitId',
                'b.month',
                'b.year',
                'k.kgiId',
                'k.companyId',
                'e.teamId',
                'a.kgiEmployeeId',
            ])
            ->leftJoin(['a' => 'kgi_employee'], 'a.kgiEmployeeId = b.kgiEmployeeId')
            ->leftJoin(['k' => 'kgi'], 'a.kgiId = k.kgiId')
            ->leftJoin(['e' => 'employee'], 'e.employeeId = a.employeeId')
            ->where([
                'a.status' => [1, 2, 4],
                'k.status' => [1, 2, 4],
                'a.employeeId' =>  $employeeId,
                'b.month' => $mount,
                'b.year' => $year,
            ])
            ->andWhere(['b.kgiEmployeeHistoryId' => $subQueryKgi])
            ->orderBy(['b.kgiEmployeeHistoryId' => SORT_DESC])
            ->asArray()
            ->all();


            $kpiEmployee = KpiEmployeeHistory::find()
            ->alias('b')
            ->select([
                'a.kpiId',
                'b.kpiEmployeeHistoryId',
                'k.kpiName',
                'k.priority',
                'k.quantRatio',
                'k.amountType',
                'k.code',
                'a.target',
                'a.result',
                'a.status',
                'a.employeeId',
                'k.unitId',
                'b.month',
                'b.year',
                'k.kpiId',
                'k.companyId',
                'e.teamId',
                'a.kpiEmployeeId',
            ])
            ->leftJoin(['a' => 'kpi_employee'], 'a.kpiEmployeeId = b.kpiEmployeeId')
            ->leftJoin(['k' => 'kpi'], 'a.kpiId = k.kpiId')
            ->leftJoin(['e' => 'employee'], 'e.employeeId = a.employeeId')
            ->where([
                'a.status' => [1, 2, 4],
                'k.status' => [1, 2, 4],
                'a.employeeId' =>  $employeeId,
                'b.month' => $mount,
                'b.year' => $year,
            ])
            ->andWhere(['b.kpiEmployeeHistoryId' => $subQueryKpi])
            ->orderBy(['b.kpiEmployeeHistoryId' => SORT_DESC])
            ->asArray()
            ->all();
    

			// $kpiEmployee = kpiEmployee::find()
			// 	->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
			// kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
			// kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
			// 	->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
			// 	->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
			// 	->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId, "kpi_employee.month" => $mount, "kpi_employee.year" => $year])
			// 	->orderby('k.createDateTime')
			// 	->asArray()
			// 	->all();
    
        // นับจำนวนของแต่ละคิวรี้
        $kgiEmployeeCount = count($kgiEmployee);
        $kpiEmployeeCount = count($kpiEmployee);
        $have = ''; // สร้างตัวแปรเปล่าสำหรับเก็บค่าที่วนลูป

        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            $totlePercent = 0;
			foreach ($kgiEmployee as $kgi) :
                $kgiEmployeeHistory = KgiEmployeeHistory::find()
                ->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4], "month" => $mount, "year" => $year])
                ->asArray()
                ->orderBy('createDateTime DESC')
                ->one();
            if (!isset($kgiEmployeeHistory) || empty($kgiEmployeeHistory)) {
                $kgiEmployeeHistory = KgiEmployee::find()
                    ->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4]])
                    ->asArray()
                    ->orderBy('createDateTime DESC')
                    ->one();
            }
            $ratio = 0;
            if ($kgiEmployeeHistory["target"] != '' && $kgiEmployeeHistory["target"] != 0) {
                if ($kgi["code"] == '<' || $kgi["code"] == '=') {
                    $ratio = ($kgiEmployeeHistory["result"] / $kgiEmployeeHistory["target"]) * 100;
                } else {
                    if ($kgiEmployeeHistory["result"] != '' && $kgiEmployeeHistory["result"] != 0) {
                        $ratio = ($kgiEmployeeHistory["target"] / $kgiEmployeeHistory["result"]) * 100;
                    } else {
                        $ratio = 0;
                    }
                }
            } else {
                $ratio = 0;
            }
            if (strlen($kgi["kgiName"]) > 18) {
                $kginame = substr($kgi["kgiName"], 0, 18) . '. . .';
            } else {
                $kginame = $kgi["kgiName"];
            }
            $kgiData[$kgi["kgiEmployeeId"]] = [
                    "name" => $kginame,
                    "companyId" => $kgi["companyId"],
                    "target" => $kgiEmployeeHistory["target"],
                    "status" => $kgiEmployeeHistory["status"],
					"quantRatio" => $kgi["quantRatio"],
					"code" => $kgi["code"],
					"result" => $kgiEmployeeHistory["result"],
					"percentage" => $ratio,
                    "amountType" => $kgi["amountType"],
                    "active" => '',
                    "id" => $kgi["kgiEmployeeId"],
					"kgiId" => $kgi["kgiId"],
                    "due" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2),
					"last" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2)  
            ];
                $totlePercent = $totlePercent + $ratio;
            endforeach;
            $totlePercentKGI = ceil($totlePercent / $kgiEmployeeCount);
        }



        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            $totlePercent = 0;
			foreach ($kpiEmployee as $kpi) :
                $kpiEmployeeHistory = KpiEmployeeHistory::find()
                ->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4], "month" => $mount, "year" => $year])
                ->asArray()
                ->orderBy('createDateTime DESC')
                ->one();
            if (!isset($kpiEmployeeHistory) || empty($kpiEmployeeHistory)) {
                $kpiEmployeeHistory = kpiEmployee::find()
                    ->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
                    ->asArray()
                    ->orderBy('createDateTime DESC')
                    ->one();
            }
            $ratio = 0;
            if ($kpiEmployeeHistory["target"] != '' && $kpiEmployeeHistory["target"] != 0) {
                if ($kpi["code"] == '<' || $kpi["code"] == '=') {
                    $ratio = ($kpiEmployeeHistory["result"] / $kpiEmployeeHistory["target"]) * 100;
                } else {
                    if ($kpiEmployeeHistory["result"] != '' && $kpiEmployeeHistory["result"] != 0) {
                        $ratio = ($kpiEmployeeHistory["target"] / $kpiEmployeeHistory["result"]) * 100;
                    } else {
                        $ratio = 0;
                    }
                }
            } else {
                $ratio = 0;
            }
            if (strlen($kpi["kpiName"]) > 18) {
                $kpiname = substr($kpi["kpiName"], 0, 18) . '. . .';
            } else {
                $kpiname = $kpi["kpiName"];
            }
            $kpiData[$kpi["kpiEmployeeId"]] = [
                    "name" => $kpiname,
                    "companyId" => $kpi["companyId"],
                    "target" => $kpiEmployeeHistory["target"],
                    "status" => $kpiEmployeeHistory["status"],
					"quantRatio" => $kpi["quantRatio"],
					"code" => $kpi["code"],
					"result" => $kpiEmployeeHistory["result"],
					"percentage" => $ratio, 
                    "amountType" => $kpi["amountType"],
                    "active" => '',
                    "id" => $kpi["kpiEmployeeId"],
					"kpiId" => $kpi["kpiId"],
                    "due" =>  ModelMaster::engDate($kpiEmployeeHistory["nextCheckDate"], 2),
					"last" =>  ModelMaster::engDate($kpiEmployeeHistory["nextCheckDate"], 2)  
            ];
                $totlePercent = $totlePercent + $ratio;
            endforeach;
            $totlePercentKPI = ceil($totlePercent / $kpiEmployeeCount);
        }

        
        // ส่งผลลัพธ์เป็น JSON
        $data = [
            'KFI'=>  ['kfiCount' => [],'KFIData' => [],'showPercent' => [] ],
            'KGI'=>  ['kgiCount' => $kgiEmployeeCount,'KGIData' => $kgiData,'showPercent' => $totlePercentKGI],
            'KPI'=>  ['kpiCount' => $kpiEmployeeCount,'KPIData' => $kpiData,'showPercent' => $totlePercentKPI]
        ];
    
        return json_encode($data);
    }

    public function actionChartKfi($currentCategory, $companyId, $teamId, $employeeId) {
        // สร้างอาร์เรย์ข้อมูลที่ต้องการ
        $monthlyData = [
            1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => [], 10 => [], 11 => [], 12 => []
        ];
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $monthlySumPercent = [];
        $currentYear = date('Y'); // หาปีปัจจุบัน

        foreach( $months as $month => $data) {

            $kfiHistory = KfiHistory::find()
            ->join("LEFT JOIN", "kfi", "kfi.kfiId = kfi_history.kfiId") // LEFT JOIN with the kfi table
            ->select(['kfi_history.*', 'kfi.companyId'])
            ->where([
                "kfi_history.status" => [1, 2, 4], // Referencing kfi_history table correctly
                "kfi_history.year" => $currentYear,
                "kfi.companyId" => $companyId // Referencing kfi table correctly
            ])
            ->orderBy('kfiHistoryId DESC') // Ordering by kfiHistoryId
            ->asArray() // Return as an array
            ->all(); // Fetch all results

            // return json_encode($kfiHistory);

            if(count( $kfiHistory) > 0){
                foreach ($kfiHistory as $entry) {
                    $month = intval($entry['month']); 
                    $ratio = 0;
                    $found = false;
                                
                    foreach ($monthlyData[$month] as $mainId) {
                        if ($mainId['kfiId'] == $entry['kfiId']) {
                                $found = true;
                                // break;
                        }
                    }
                    if (!$found) {
                            if ($entry["target"] != '' && $entry["target"] != 0) {
                                if ($entry["code"] == '<' || $entry["code"] == '=') {
                                    $ratio = ($entry["result"] / $entry["target"]) * 100;
                                } else {
                                    if ($entry["result"] != '' && $entry["result"] != 0) {
                                        $ratio = ($entry["target"] / $entry["result"]) * 100;
                                    } else {
                                        $ratio = 0;
                                    }
                                }
                            } else {
                                $ratio = 0;
                            }

                            // เก็บข้อมูลตามเดือน
                            $monthlyData[$month][] = [
                                "kfiId" => $entry["kfiId"],
                                "name" => $entry["kfiHistoryName"],
                                "month" => $entry["month"],
                                "year" => $entry["year"],
                                "target" => $entry["target"],
                                "result" => $entry["result"],
                                "kfiHistory" => $entry["kfiHistoryId"],
                                "percentage" => round($ratio, 2)
                            ];
                    }
                }
            }    
        }

        // return json_encode($monthlyData);
        
        foreach ($monthlyData as $month => $data) {
            // หากเดือนนั้นไม่มีข้อมูล
            if (empty($data)) {
                $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
            } else {
                $totalPercentage = 0;
                $count = 0;
        
                // ลูปผ่านข้อมูลในแต่ละเดือน
                foreach ($data as $item) {
                    $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                    $count++;  // นับจำนวนรายการ
                }
        
                // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                if ($count > 0) {
                    $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                } else {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                }
            }
        }
        // return json_encode($monthlySumPercent);


        $data = [
            'currentCategory' => $currentCategory,
            'companyId' => $companyId,
            'teamId' => $teamId,
            'employeeId' => $employeeId,
            'performance' => $monthlySumPercent,
        ];

        // ส่งข้อมูลกลับเป็น JSON
        return json_encode($data);
    }



    public function actionChartKgi($currentCategory, $companyId, $teamId, $employeeId) {

        $monthlyData = [
            1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => [], 10 => [], 11 => [], 12 => []
        ];
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $monthlySumPercent = [];
        $currentYear = date('Y'); // หาปีปัจจุบัน

        if($currentCategory == 'Company'){

            foreach( $months as $month => $data) {
                $kgiHistory = KgiHistory::find()
                ->join("LEFT JOIN", "kgi", "kgi.kgiId = kgi_history.kgiId") // LEFT JOIN with the kgi table
                ->select(['kgi_history.*', 'kgi.companyId'])
                ->where([
                    "kgi_history.status" => [1, 2, 4],  // Referencing kgi_history table
                    "kgi_history.year" => $currentYear,
                    "kgi_history.month" => $data,       // Add month condition here
                    "kgi.companyId" => $companyId      // Referencing kgi table correctly
                ])
                ->orderBy('kgiHistoryId DESC')
                ->asArray()
                ->all();

                    if(count( $kgiHistory) > 0){
                        foreach ($kgiHistory as $entry) {

                            $month = intval($entry['month']);  // แปลงเป็น int
                            $ratio = 0;
                            $found = false;
                                
                                foreach ($monthlyData[$month] as $mainId) {
                                    if ($mainId['kgiId'] == $entry['kgiId']) {
                                            $found = true;
                                            // break;
                                    }
                                }
                                if (!$found) {
                                    if ($entry["targetAmount"] != '' && $entry["targetAmount"] != 0) {
                                        if ($entry["code"] == '<' || $entry["code"] == '=') {
                                            $ratio = ($entry["result"] / $entry["targetAmount"]) * 100;
                                        } else {
                                            if ($entry["result"] != '' && $entry["result"] != 0) {
                                                $ratio = ($entry["targetAmount"] / $entry["result"]) * 100;
                                            } else {
                                                $ratio = 0;
                                            }
                                        }
                                    } else {
                                        $ratio = 0;
                                    }
                                    // เก็บข้อมูลตามเดือน
                                    $monthlyData[$month][] = [
                                        "kgiId" => $entry["kgiId"],
                                        "name" => $entry["kgiHistoryName"],
                                        "month" => $entry["month"],
                                        "target" => $entry["targetAmount"],
                                        "result" => $entry["result"],
                                        "percentage" => round($ratio, 2)
                                    ];
                                }
                        }
                    }
                }
            // คำนวณผลรวมของเปอร์เซ็นต์ในแต่ละเดือน

        foreach ($monthlyData as $month => $data) {
            // หากเดือนนั้นไม่มีข้อมูล
            if (empty($data)) {
                $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
            } else {
                $totalPercentage = 0;
                $count = 0;
        
                // ลูปผ่านข้อมูลในแต่ละเดือน
                foreach ($data as $item) {
                    $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                    $count++;  // นับจำนวนรายการ
                }
        
                // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                if ($count > 0) {
                    $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                } else {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                }
            }
        }

        }else if($currentCategory == 'Team'){

            $KgiTeamHistory = KgiTeamHistory::find()
            ->select(['a.*', 'b.kgiId', 'c.code'])
            ->from(['a' => 'kgi_team_history'])
            ->leftJoin(['b' => 'kgi_team'], 'b.kgiTeamId = a.kgiTeamId')
            ->leftJoin(['c' => 'kgi'], 'c.kgiId = b.kgiId')
            ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear,"b.teamId" => $teamId,"c.companyId" => $companyId  ])
            ->orderBy(['a.month' => SORT_ASC, 'a.kgiTeamHistoryId' => SORT_DESC])
            ->asArray()
            ->all();

            // return json_encode($KgiTeamHistory);

            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KgiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                $found = false;
                                
                    foreach ($monthlyData[$month] as $mainId) {
                        if ($mainId['kgiTeamId'] == $entry['kgiTeamId']) {
                                $found = true;
                                // break;
                        }
                    }
                    if (!$found) {    
                    // คำนวณค่า ratio
                        if ($entry["target"] != '' && $entry["target"] != 0) {
                            if ($entry["code"] == '<' || $entry["code"] == '=') {
                                $ratio = ($entry["result"] / $entry["target"]) * 100;
                            } else {
                                if ($entry["result"] != '' && $entry["result"] != 0) {
                                    $ratio = ($entry["target"] / $entry["result"]) * 100;
                                } else {
                                    $ratio = 0;
                                }
                            }
                        } else {
                            $ratio = 0;
                        }

                        // เก็บข้อมูลตามเดือน
                        $monthlyData[$month][] = [
                            "kgiTeamId" => $entry["kgiTeamId"],
                            //    "name" => $entry["kgiHistoryName"],
                            "month" => $entry["month"],
                            "year" => $entry["year"],
                            "kgiTeamHistoryId" => $entry["kgiTeamHistoryId"],                        
                            "target" => $entry["target"],
                            "result" => $entry["result"],
                            "percentage" => round($ratio, 2)
                        ];
                    }
            }
            // return json_encode($monthlyData);
            foreach ($monthlyData as $month => $data) {
                // หากเดือนนั้นไม่มีข้อมูล
                if (empty($data)) {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                } else {
                    $totalPercentage = 0;
                    $count = 0;
            
                    // ลูปผ่านข้อมูลในแต่ละเดือน
                    foreach ($data as $item) {
                        $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                        $count++;  // นับจำนวนรายการ
                    }
            
                    // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                    if ($count > 0) {
                        $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                    } else {
                        $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                    }
                }
            }

        }else if($currentCategory == 'Self'){
            // $KgiTeamHistory = KgiEmployeeHistory::find()
            // ->select(['a.*', 'b.kgiId', 'c.code'])
            // ->from(['a' => 'kgi_employee_history'])
            // ->leftJoin(['b' => 'kgi_employee'], 'b.kgiEmployeeId = a.kgiEmployeeId')
            // ->leftJoin(['c' => 'kgi'], 'c.kgiId = b.kgiId')
            // ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear,"b.employeeId" => $employeeId,"c.companyId" => $companyId  ])
            // ->orderBy(['a.month' => SORT_ASC, 'a.kgiEmployeeId' => SORT_DESC])
            // ->asArray()
            // ->all();

            $subQuery = KgiEmployeeHistory::find()
            ->select('MAX(kgiEmployeeHistoryId)')
            ->where([
                'kgiEmployeeId' => new \yii\db\Expression('b.kgiEmployeeId')
            ])
            ->andWhere('month = a.month'); // ให้เลือก MAX ตามเดือนของแต่ละ record

            $KgiTeamHistory = KgiEmployeeHistory::find()
                ->alias('a')
                ->select([
                    'a.*', 
                    'b.kgiId', 
                    'c.code'
                ])
                ->leftJoin(['b' => 'kgi_employee'], 'b.kgiEmployeeId = a.kgiEmployeeId')
                ->leftJoin(['c' => 'kgi'], 'c.kgiId = b.kgiId')
                ->where([
                    'a.status' => [1, 2, 4],
                    'b.employeeId' => $employeeId,
                    'a.year' => $currentYear,
                    'c.companyId' => $companyId ,
                ])
                ->andWhere(['a.kgiEmployeeHistoryId' => $subQuery])
                ->orderBy(['a.kgiEmployeeHistoryId' => SORT_DESC])
                ->asArray()
                ->all();


       
            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KgiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                $found = false;
                                
                    foreach ($monthlyData[$month] as $mainId) {
                        if ($mainId['kgiEmployeeId'] == $entry['kgiEmployeeId']) {
                                $found = true;
                                // break;
                        }
                    }
                    if (!$found) {   
                // คำนวณค่า ratio
                    if ($entry["target"] != '' && $entry["target"] != 0) {
                        if ($entry["code"] == '<' || $entry["code"] == '=') {
                            $ratio = ($entry["result"] / $entry["target"]) * 100;
                        } else {
                            if ($entry["result"] != '' && $entry["result"] != 0) {
                                $ratio = ($entry["target"] / $entry["result"]) * 100;
                            } else {
                                $ratio = 0;
                            }
                        }
                    } else {
                        $ratio = 0;
                    }

                // เก็บข้อมูลตามเดือน
                    $monthlyData[$month][] = [
                        "kgiEmployeeId" => $entry["kgiEmployeeId"],
                        //"name" => $entry["kgiHistoryName"],
                        "month" => $entry["month"],
                        "target" => $entry["target"],
                        "result" => $entry["result"],
                        "percentage" => round($ratio, 2)
                    ];
                }
            }
            // return json_encode($monthlyData);

            foreach ($monthlyData as $month => $data) {
                // หากเดือนนั้นไม่มีข้อมูล
                if (empty($data)) {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                } else {
                    $totalPercentage = 0;
                    $count = 0;
            
                    // ลูปผ่านข้อมูลในแต่ละเดือน
                    foreach ($data as $item) {
                        $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                        $count++;  // นับจำนวนรายการ
                    }
            
                    // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                    if ($count > 0) {
                        $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                    } else {
                        $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                    }
                }
            }

        }

            // สร้างอาร์เรย์ข้อมูลที่ต้องการ
             $data = [
                    'currentCategory' => $currentCategory,
                    'companyId' => $companyId,
                    'teamId' => $teamId,
                    'employeeId' => $employeeId,
                    'performance' => $monthlySumPercent,
            ];
    
        // ส่งข้อมูลกลับเป็น JSON
        return json_encode($data);
    }


    public function actionChartKpi($currentCategory, $companyId, $teamId, $employeeId) {
        $monthlyData = [
            1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => [], 10 => [], 11 => [], 12 => []
        ];
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $monthlySumPercent = [];
        $currentYear = date('Y'); // หาปีปัจจุบัน

        if($currentCategory == 'Company'){
            
            foreach($months as $month => $data) {
                $kpiHistory = KpiHistory::find()
                ->join("LEFT JOIN", "kpi", "kpi.kpiId = kpi_history.kpiId") 
                ->select(['kpi_history.*', 'kpi.companyId'])
                ->where([
                    "kpi_history.status" => [1, 2, 4],  
                    "kpi_history.year" => $currentYear,
                    "kpi_history.month" => $data,       
                    "kpi.companyId" => $companyId     
                ])
                ->orderBy('kpiHistoryId DESC')
                ->asArray()
                ->all();
                
                    if(count( $kpiHistory) > 0){
                        foreach ($kpiHistory as $entry) {
                                $month = intval($entry['month']);
                                $ratio = 0;
                                $found = false;
                                
                                foreach ($monthlyData[$month] as $mainId) {
                                    if ($mainId['kpiId'] == $entry['kpiId']) {
                                            $found = true;
                                            // break;
                                    }
                                }
                                if (!$found) {
                                    if ($entry["targetAmount"] == null || $entry["targetAmount"] == '' || $entry["targetAmount"] == 0) {
                                        $ratio = 0;
                                    } else {
                                        if ($entry["code"] == '<' || $entry["code"] == '=') {
                                            $ratio = ((int)$entry['result'] / (int)$entry["targetAmount"]) * 100;
                                        } else {
                                            if ($entry["result"] != '' && $entry["result"] != 0) {
                                                $ratio = ((int)$entry["targetAmount"] / (int)$entry["result"]) * 100;
                                            } else {
                                                $ratio = 0;
                                            }
                                        }
                                    }
                        
                                    $monthlyData[$month][] = [
                                        "kpiId" => $entry["kpiId"],
                                        "name" => $entry["kpiHistoryName"],
                                        "month" => $entry["month"],
                                        "target" => $entry["targetAmount"],
                                        "result" => $entry["result"],
                                        "kpiHistoryId" => $entry["kpiHistoryId"],
                                        "percentage" => round($ratio, 2)
                                    ];	
                                }
                        }
                    }
            }        
            
            // return json_encode($monthlyData);
            // throw new Exception(print_r($monthlyData,true));
            
            foreach ($monthlyData as $month => $data) {
                // หากเดือนนั้นไม่มีข้อมูล
                if (empty($data)) {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                } else {
                    $totalPercentage = 0;
                    $count = 0;
            
                    // ลูปผ่านข้อมูลในแต่ละเดือน
                    foreach ($data as $item) {
                        $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                        $count++;  // นับจำนวนรายการ
                    }
            
                    // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                    if ($count > 0) {
                        $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                    } else {
                        $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                    }
                }
            }

        }else if($currentCategory == 'Team'){
            $KpiTeamHistory = KpiTeamHistory::find()
            ->select(['a.*', 'b.kpiId', 'c.code'])
            ->from(['a' => 'kpi_team_history'])
            ->leftJoin(['b' => 'kpi_team'], 'b.kpiTeamId = a.kpiTeamId')
            ->leftJoin(['c' => 'kpi'], 'c.kpiId = b.kpiId')
            ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear,"b.teamId" => $teamId,"c.companyId" => $companyId  ])
            ->orderBy(['a.month' => SORT_ASC, 'a.kpiTeamHistoryId' => SORT_DESC])
            ->asArray()
            ->all();


            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KpiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                $found = false;
                                
                foreach ($monthlyData[$month] as $mainId) {
                    if ($mainId['kpiTeamId'] == $entry['kpiTeamId']) {
                            $found = true;
                            // break;
                    }
                }
                if (!$found) {       
                // คำนวณค่า ratio
                    if ($entry["target"] != '' && $entry["target"] != 0) {
                        if ($entry["code"] == '<' || $entry["code"] == '=') {
                            $ratio = ($entry["result"] / $entry["target"]) * 100;
                        } else {
                            if ($entry["result"] != '' && $entry["result"] != 0) {
                                $ratio = ($entry["target"] / $entry["result"]) * 100;
                            } else {
                                $ratio = 0;
                            }
                        }
                    } else {
                        $ratio = 0;
                    }

                    // เก็บข้อมูลตามเดือน
                    $monthlyData[$month][] = [
                        "kpiTeamId" => $entry["kpiTeamId"],
                        //    "name" => $entry["kgiHistoryName"],
                        "month" => $entry["month"],
                        "target" => $entry["target"],
                        "result" => $entry["result"],
                        "percentage" => round($ratio, 2)
                    ];
                }
                // return json_encode($monthlyData);
            }

            foreach ($monthlyData as $month => $data) {
                // หากเดือนนั้นไม่มีข้อมูล
                if (empty($data)) {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                } else {
                    $totalPercentage = 0;
                    $count = 0;
            
                    // ลูปผ่านข้อมูลในแต่ละเดือน
                    foreach ($data as $item) {
                        $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                        $count++;  // นับจำนวนรายการ
                    }
            
                    // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                    if ($count > 0) {
                        $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                    } else {
                        $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                    }
                }
            }

        }else if($currentCategory == 'Self'){
            // $KpiTeamHistory = KpiEmployeeHistory::find()
            // ->select(['a.*', 'b.kpiId', 'c.code'])
            // ->from(['a' => 'kpi_employee_history'])
            // ->leftJoin(['b' => 'kpi_employee'], 'b.kpiEmployeeId = a.kpiEmployeeId')
            // ->leftJoin(['c' => 'kpi'], 'c.kpiId = b.kpiId')
            // ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear, "b.employeeId" => $employeeId,"c.companyId" => $companyId])
            // ->orderBy(['a.month' => SORT_ASC, 'a.kpiEmployeeId' => SORT_DESC])
            // ->asArray()
            // ->all();

            $subQuery = KpiEmployeeHistory::find()
            ->select('MAX(kpiEmployeeHistoryId)')
            ->where([
                'kpiEmployeeId' => new \yii\db\Expression('b.kpiEmployeeId')
            ])
            ->andWhere('month = a.month'); // ให้เลือก MAX ตามเดือนของแต่ละ record

            $KpiTeamHistory = KpiEmployeeHistory::find()
                ->alias('a')
                ->select([
                    'a.*', 
                    'b.kpiId', 
                    'c.code'
                ])
                ->leftJoin(['b' => 'kpi_employee'], 'b.kpiEmployeeId = a.kpiEmployeeId')
                ->leftJoin(['c' => 'kpi'], 'c.kpiId = b.kpiId')
                ->where([
                    'a.status' => [1, 2, 4],
                    'b.employeeId' => $employeeId,
                    'a.year' => $currentYear,
                    'c.companyId' => $companyId ,
                ])
                ->andWhere(['a.kpiEmployeeHistoryId' => $subQuery])
                ->orderBy(['a.kpiEmployeeHistoryId' => SORT_DESC])
                ->asArray()
                ->all();

            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KpiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                $found = false;
                                
                    foreach ($monthlyData[$month] as $mainId) {
                        if ($mainId['kpiEmployeeId'] == $entry['kpiEmployeeId']) {
                                $found = true;
                                // break;
                        }
                    }
                    if (!$found) {   
                    // คำนวณค่า ratio
                        if ($entry["target"] != '' && $entry["target"] != 0) {
                            if ($entry["code"] == '<' || $entry["code"] == '=') {
                                $ratio = ($entry["result"] / $entry["target"]) * 100;
                            } else {
                                if ($entry["result"] != '' && $entry["result"] != 0) {
                                    $ratio = ($entry["target"] / $entry["result"]) * 100;
                                } else {
                                    $ratio = 0;
                                }
                            }
                        } else {
                            $ratio = 0;
                        }

                    // เก็บข้อมูลตามเดือน
                        $monthlyData[$month][] = [
                            "kpiEmployeeId" => $entry["kpiEmployeeId"],
                            //"name" => $entry["kgiHistoryName"],
                            "month" => $entry["month"],
                            "target" => $entry["target"],
                            "result" => $entry["result"],
                            "percentage" => round($ratio, 2)
                        ];
                    }

            }

            foreach ($monthlyData as $month => $data) {
                // หากเดือนนั้นไม่มีข้อมูล
                if (empty($data)) {
                    $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                } else {
                    $totalPercentage = 0;
                    $count = 0;
            
                    // ลูปผ่านข้อมูลในแต่ละเดือน
                    foreach ($data as $item) {
                        $totalPercentage += floatval($item['percentage']);  // บวกเปอร์เซ็นต์ทั้งหมด
                        $count++;  // นับจำนวนรายการ
                    }
            
                    // คำนวณค่าเฉลี่ยเปอร์เซ็นต์
                    if ($count > 0) {
                        $monthlySumPercent[$month] = round($totalPercentage / $count, 2);  // คำนวณค่าเฉลี่ย
                    } else {
                        $monthlySumPercent[$month] = 0;  // ถ้าไม่มีข้อมูลในเดือนนั้น
                    }
                }
            }

        }
    
            $data = [
                'currentCategory' => $currentCategory,
                'companyId' => $companyId,
                'teamId' => $teamId,
                'employeeId' => $employeeId,
                'performance' => $monthlySumPercent,
            ];
        // ส่งข้อมูลกลับเป็น JSON
        return json_encode($data);
    }

    public function actionUpcomingSchedule($id,$role, $companyId, $teamId, $employeeId) {
		$data = [];
        $kficompany = 0;
        $kpicompany = 0;
        $kgicompany = 0;

        $kpiteam = 0;
        $kgiteam= 0;

        $kpiself = 0;
        $kgiself= 0;

        $today = new DateTime(); // Get today's date

        $type = '';
        if($role >= 6){
            //company
                // KFI Sub Query
                $kfiHistory = KfiHistory::find()
                ->alias('main')
                ->select([
                    'main.kfiHistoryId',
                    'main.kfiId',
                    'main.kfiHistoryName',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.code',
                    'main.target',
                    'main.result',
                    'main.createrId',
                    'main.titleProgress',
                    'main.description',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kfi.kfiName',
                    'kfi.companyId',
                ])
                ->leftJoin('kfi', 'main.kfiId = kfi.kfiId')
                ->where([
                    'main.status' => [1, 2, 4],
                ])
                ->andWhere([
                    'main.updateDateTime' => (new \yii\db\Query())
                        ->select('MAX(sub.updateDateTime)')
                        ->from(['sub' => 'kfi_history'])
                        ->where('sub.kfiId = main.kfiId')
                        ->andWhere(['sub.status' => [1, 2, 4]])
                ])
                ->andWhere([
                    'or',
                    ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                    ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                ])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kfiHistoryId' => SORT_DESC,
                ])
                ->asArray()
				->all();
                // return json_encode($kfiHistory);

                        
                // KPI Sub Query
                $kpiHistory = kpiHistory::find()
                ->alias('main')
                ->select([
                    'main.kpiHistoryId',
                    'main.kpiId',
                    'main.kpiHistoryName',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.createrId',
                    'main.titleProcess',
                    'main.description',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kpi.kpiName',
                    'kpi.companyId',
                ])
                ->leftJoin('kpi', 'main.kpiId = kpi.kpiId')
                ->where([
                    'main.status' => [1, 2, 4],
                ])
                ->andWhere([
                    'main.updateDateTime' => (new \yii\db\Query())
                        ->select('MAX(sub.updateDateTime)')
                        ->from(['sub' => 'kpi_history'])
                        ->where('sub.kpiId = main.kpiId')
                        ->andWhere(['sub.status' => [1, 2, 4]])
                ])
                ->andWhere([
                    'or',
                    ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                    ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                ])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kpiHistoryId' => SORT_DESC,
                ])
                ->asArray()
				->all();
                // return json_encode($kpiHistory);

                            
                // KGI Sub Query
                $kgiHistory = kgiHistory::find()
                ->alias('main')
                ->select([
                    'main.kgiHistoryId',
                    'main.kgiId',
                    'main.kgiHistoryName',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.titleProcess',
                    'main.description',
                    'main.createrId',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kgi.kgiName',
                    'kgi.companyId',
                ])
                ->leftJoin('kgi', 'main.kgiId = kgi.kgiId')
                ->where([
                    'main.status' => [1, 2, 4],
                ])
                ->andWhere([
                    'main.updateDateTime' => (new \yii\db\Query())
                        ->select('MAX(sub.updateDateTime)')
                        ->from(['sub' => 'kgi_history'])
                        ->where('sub.kgiId = main.kgiId')
                        ->andWhere(['sub.status' => [1, 2, 4]])
                ])
                ->andWhere([
                    'or',
                    ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                    ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                ])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kgiHistoryId' => SORT_DESC,
                ])
                ->asArray()
				->all();
                // return json_encode($kgiHistory);


                if (isset($kfiHistory) && count($kfiHistory) > 0) {
                    foreach ($kfiHistory as $history) :
                        
                        $time = explode(' ', $history["createDateTime"]);
                        // $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $data['kficom' . $history["kfiHistoryId"]] = [
                                "id" => $history["kfiId"],
                                "historyId" => $history["kfiHistoryId"],
                                "typeId" => '0',
                                "type" => 'company',
                                "page" => 'kfi',
                                "title" => $history["kfiName"],
                                "description" => $history["description"],
                                "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $history["status"], 
                                "month" => $history["month"],
                                "year" => $history["year"],
                                "nextCheckDate" => $history["nextCheckDate"],
                                "creater" => User::employeeNameByuserId($history["createrId"]),
                            ];
                            $kficompany++;
                        }
                    endforeach;
                }

                if (isset($kpiHistory) && count($kpiHistory) > 0) {
                    foreach ($kpiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        // $employeeId = Employee::employeeId($history["createrId"]);
                        $data['kpicom' . $history["kpiHistoryId"]] = [
                            "id" => $history["kpiId"],
                            "historyId" => $history["kpiHistoryId"],
                            "typeId" => '0',
                            "type" => 'company',
                            "page" => 'kpi',
                            "title" => $history["kpiName"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kpicompany++;
                    endforeach;
                }


                if (isset($kgiHistory) && count($kgiHistory) > 0) {
                    foreach ($kgiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        // $employeeId = Employee::employeeId($history["createrId"]);
                        $data['kgicom' . $history["kgiHistoryId"]] = [
                            "id" => $history["kgiId"],
                            "historyId" => $history["kgiHistoryId"],
                            "typeId" => '0',
                            "type" => 'company',
                            "page" => 'kgi',
                            "title" => $history["kgiName"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kgicompany++;
                    endforeach;
                }
            //companyEnd
            // return json_encode($data);

            //team
               // คำสั่ง SQL สำหรับ kgi_team_history
                        $kgiTeamHistory = KgiTeamHistory::find()
                        ->alias('main')
                        ->select([
                            'main.kgiTeamHistoryId',
                            'main.kgiTeamId',
                            'main.target',
                            'main.result',
                            'main.detail',
                            'main.fromDate',
                            'main.toDate',
                            'main.nextCheckDate',
                            'main.month',
                            'main.year',
                            'main.createrId',
                            'main.status',
                            'main.status',
                            'main.createDateTime',
                            'main.updateDateTime',
                            'kgi_team.kgiId',
                            'kgi_team.teamId',
                            'kgi_team.kgiTeamId',
                            'kgi.kgiName',
                            'kgi.companyId',
                        ])
                        ->leftJoin('kgi_team', 'main.kgiTeamId = kgi_team.kgiTeamId')
                        ->leftJoin('kgi', 'kgi_team.kgiId = kgi.kgiId')
                        ->where([
                            'main.status' => [1, 2, 4],
                        ])
                        ->andWhere([
                            'main.updateDateTime' => (new \yii\db\Query())
                                ->select('MAX(sub.updateDateTime)')
                                ->from(['sub' => 'kgi_team_history'])
                                ->where('sub.kgiTeamId = main.kgiTeamId')
                                ->andWhere(['sub.status' => [1, 2, 4]])
                        ])
                        ->andWhere([
                            'or',
                            ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                            ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                        ])
                        ->andWhere(['IS NOT', 'kgi_team.kgiTeamId', null])
                        ->orderBy([
                            'main.year' => SORT_DESC,
                            'main.month' => SORT_DESC,
                            'main.kgiTeamHistoryId' => SORT_DESC,
                        ])
                        ->asArray()  // แปลงผลลัพธ์เป็น array
                        ->all();     // ดึงข้อมูลทั้งหมด
                        // return json_encode($kgiTeamHistory);

                        // คำสั่ง SQL สำหรับ kpi_team_history
                        $kpiTeamHistory = kpiTeamHistory::find()
                        ->alias('main')
                        ->select([
                            'main.kpiTeamHistoryId',
                            'main.kpiTeamId',
                            'main.target',
                            'main.result',
                            'main.detail',
                            'main.fromDate',
                            'main.toDate',
                            'main.nextCheckDate',
                            'main.month',
                            'main.year',
                            'main.createrId',
                            'main.status',
                            'main.createDateTime',
                            'main.updateDateTime',
                            'kpi_team.kpiId',
                            'kpi_team.teamId',
                            'kpi_team.kpiTeamId',
                            'kpi.kpiName',
                            'kpi.companyId',
                        ])
                        ->leftJoin('kpi_team', 'main.kpiTeamId = kpi_team.kpiTeamId')
                        ->leftJoin('kpi', 'kpi_team.kpiId = kpi.kpiId')
                        ->where([
                            'main.status' => [1, 2, 4],
                        ])
                        ->andWhere([
                            'main.updateDateTime' => (new \yii\db\Query())
                                ->select('MAX(sub.updateDateTime)')
                                ->from(['sub' => 'kpi_team_history'])
                                ->where('sub.kpiTeamId = main.kpiTeamId')
                                ->andWhere(['sub.status' => [1, 2, 4]])
                        ])
                        ->andWhere([
                            'or',
                            ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                            ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                        ])
                        ->andWhere(['IS NOT', 'kpi_team.kpiTeamId', null])
                        ->orderBy([
                            'main.year' => SORT_DESC,
                            'main.month' => SORT_DESC,
                            'main.kpiTeamHistoryId' => SORT_DESC,
                        ])
                        ->asArray()  // แปลงผลลัพธ์เป็น array
                        ->all();     // ดึงข้อมูลทั้งหมด
                        // return json_encode($kpiTeamHistory);


                        if (!empty($kgiTeamHistory)) {
                            foreach ($kgiTeamHistory as $history) {
                                $time = explode(' ', $history["createDateTime"]);
                                // $employeeId = Employee::employeeId($history["createrId"]);
                                $data['kgiteam' . $history["kgiTeamHistoryId"]] = [
                                    "id" => $history["kgiId"],
                                    "historyId" => $history["kgiTeamHistoryId"],
                                    "typeId" => $history["kgiTeamId"],
                                    "type" => 'team',
                                    "page" => 'kgi',
                                    "title" => $history["kgiName"],
                                    "description" => $history["detail"],
                                    "creater" => User::employeeNameByuserId($history["createrId"]),
                                    "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                    "time" => ModelMaster::timeText($time[1]),
                                    "status" => $history["status"],
                                    "month" => $history["month"],
                                    "year" => $history["year"]
                                ];
                                $kgiteam++;
                            }
                        }

                        if (!empty($kpiTeamHistory)) {
                            foreach ($kpiTeamHistory as $teamhistory) {
                                $time = explode(' ', $teamhistory["createDateTime"]);
                                // $employeeId = Employee::employeeId($teamhistory["createrId"]);                           
                                $data['kpiteam' . $teamhistory["kpiTeamHistoryId"]] = [
                                    "id" => $teamhistory["kpiId"],
                                    "historyId" => $teamhistory["kpiTeamHistoryId"],
                                    "typeId" => $teamhistory["kpiTeamId"],
                                    "type" => 'team',
                                    "page" => 'kpi',
                                    "title" => $teamhistory["kpiName"],
                                    "description" => $teamhistory["detail"],
                                    "creater" => User::employeeNameByuserId($teamhistory["createrId"]),
                                    "createDate" => ModelMaster::engDateHr($teamhistory["createDateTime"]),
                                    "time" => ModelMaster::timeText($time[1]),
                                    "status" => $teamhistory["status"],
                                    "month" => $teamhistory["month"],
                                    "year" => $teamhistory["year"]
                                ];
                                $kpiteam++;
                            }
                        }
                        // return json_encode($data);
            //teamEND

            //employee
               // Query for kgi_employee_history
                    $kgiEmployeeHistory = KgiEmployeeHistory::find()
                    ->alias('main')
                    ->select([
                        'main.kgiEmployeeHistoryId',
                        'main.kgiEmployeeId',
                        'main.target',
                        'main.result',
                        'main.fromDate',
                        'main.toDate',
                        'main.detail',
                        'main.nextCheckDate',
                        'main.month',
                        'main.year',
                        'main.lastCheckDate',
                        'main.createrId',
                        'main.status',
                        'main.createDateTime',
                        'main.updateDateTime',
                        'kgi_employee.kgiId',
                        'kgi_employee.kgiEmployeeId',
                        'kgi.kgiName',  // Alias 'description' for kgiName
                        'kgi.companyId',
                    ])
                    ->leftJoin('kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
                    ->leftJoin('kgi', 'kgi_employee.kgiId = kgi.kgiId')
                    ->where([
                        'main.status' => [1, 2, 4],
                    ])
                    ->andWhere([
                        'main.updateDateTime' => (new \yii\db\Query())
                            ->select('MAX(sub.updateDateTime)')
                            ->from(['sub' => 'kgi_employee_history'])
                            ->where('sub.kgiEmployeeId = main.kgiEmployeeId')
                            ->andWhere(['sub.status' => [1, 2, 4]])
                    ])
                    ->andWhere([
                        'or',
                        ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                        ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                    ])
                    ->andWhere(['IS NOT', 'kgi_employee.kgiEmployeeId', null])
                    ->orderBy([
                        'main.year' => SORT_DESC,
                        'main.month' => SORT_DESC,
                        'main.kgiEmployeeHistoryId' => SORT_DESC,
                    ])
                    ->asArray()  // แปลงผลลัพธ์เป็น array
                    ->all();     // ดึงข้อมูลทั้งหมด
                    // return json_encode($kgiEmployeeHistory);


                    // Query for kpi_employee_history
                    $kpiEmployeeHistory = kpiEmployeeHistory::find()
                    ->alias('main')
                    ->select([
                        'main.kpiEmployeeHistoryId',
                        'main.kpiEmployeeId',
                        'main.target',
                        'main.result',
                        'main.fromDate',
                        'main.toDate',
                        'main.detail',
                        'main.nextCheckDate',
                        'main.month',
                        'main.year',
                        'main.lastCheckDate',
                        'main.createrId',
                        'main.status',
                        'main.createDateTime',
                        'main.updateDateTime',
                        'kpi_employee.kpiId',
                        'kpi_employee.kpiEmployeeId',
                        'kpi.kpiName',  // Alias 'description' for kpiName
                        'kpi.companyId',
                    ])
                    ->leftJoin('kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
                    ->leftJoin('kpi', 'kpi_employee.kpiId = kpi.kpiId')
                    ->where([
                        'main.status' => [1, 2, 4],
                    ])
                    ->andWhere([
                        'main.updateDateTime' => (new \yii\db\Query())
                            ->select('MAX(sub.updateDateTime)')
                            ->from(['sub' => 'kpi_employee_history'])
                            ->where('sub.kpiEmployeeId = main.kpiEmployeeId')
                            ->andWhere(['sub.status' => [1, 2, 4]])
                    ])
                    ->andWhere([
                        'or',
                        ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                        ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                    ])
                    ->andWhere(['IS NOT', 'kpi_employee.kpiEmployeeId', null])
                    ->orderBy([
                        'main.year' => SORT_DESC,
                        'main.month' => SORT_DESC,
                        'main.kpiEmployeeHistoryId' => SORT_DESC,
                    ])
                    ->asArray()  // แปลงผลลัพธ์เป็น array
                    ->all();     // ดึงข้อมูลทั้งหมด
                    // return json_encode($kpiEmployeeHistory);

                    if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                        foreach ($kgiEmployeeHistory as $employeehistory) :
                            $time = explode(' ', $employeehistory["createDateTime"]);
                            // $employeeId = Employee::employeeId($employeehistory["createrId"]);
                            $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                                "id" => $employeehistory["kgiId"],
                                "historyId" => $employeehistory["kgiEmployeeHistoryId"],
                                "typeId" => $employeehistory["kgiEmployeeId"],
                                "type" => 'employee',
                                "page" => 'kgi',
                                "title" => $employeehistory["kgiName"],
                                "description" => $employeehistory["detail"],  // Use kgi description
                                "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $employeehistory["status"],
                                "month" => $employeehistory["month"],
                                "year" => $employeehistory["year"],
                                "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                            ];
                            $kgiself++;
                        endforeach;
                    }

                    if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                        foreach ($kpiEmployeeHistory as $employeehistory) :
                            $time = explode(' ', $employeehistory["createDateTime"]);
                            // $employeeId = Employee::employeeId($employeehistory["createrId"]);
                                $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                                "id" => $employeehistory["kpiId"],
                                "historyId" => $employeehistory["kpiEmployeeHistoryId"],
                                "typeId" => $employeehistory["kpiEmployeeId"],
                                "type" => 'employee',
                                "page" => 'kpi',
                                "title" => $employeehistory["kpiName"],
                                "description" => $employeehistory["detail"],  // Use kpi description
                                "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $employeehistory["status"],
                                "month" => $employeehistory["month"],
                                "year" => $employeehistory["year"],
                                "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                            ];
                            $kpiself++;
                        endforeach;
                    }
                    return json_encode($data);
            //employeeEND

        }else if($role >= 4) {
            // Manager view company
            // $type = 'Manager';
            // return json_encode($type);

            //company
                // KFI Sub Query
                $kfiHistory = KfiHistory::find()
                ->alias('main')
                ->select([
                    'main.kfiHistoryId',
                    'main.kfiId',
                    'main.kfiHistoryName',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.code',
                    'main.target',
                    'main.result',
                    'main.createrId',
                    'main.titleProgress',
                    'main.description',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kfi.kfiName',
                    'kfi.companyId',
                ])
                ->leftJoin('kfi', 'main.kfiId = kfi.kfiId')
                ->where([
                    'main.status' => [1, 2, 4],'kfi.companyId' => $companyId
                ])
                ->andWhere([
                    'main.updateDateTime' => (new \yii\db\Query())
                        ->select('MAX(sub.updateDateTime)')
                        ->from(['sub' => 'kfi_history'])
                        ->where('sub.kfiId = main.kfiId')
                        ->andWhere(['sub.status' => [1, 2, 4]])
                ])
                ->andWhere([
                    'or',
                    ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                    ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                ])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kfiHistoryId' => SORT_DESC,
                ])
                ->asArray()
				->all();
                // return json_encode($kfiHistory);

                        
                // KPI Sub Query
                $kpiHistory = kpiHistory::find()
                ->alias('main')
                ->select([
                    'main.kpiHistoryId',
                    'main.kpiId',
                    'main.kpiHistoryName',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.createrId',
                    'main.titleProcess',
                    'main.description',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kpi.kpiName',
                    'kpi.companyId',
                ])
                ->leftJoin('kpi', 'main.kpiId = kpi.kpiId')
                ->where([
                    'main.status' => [1, 2, 4],'kpi.companyId' => $companyId
                ])
                ->andWhere([
                    'main.updateDateTime' => (new \yii\db\Query())
                        ->select('MAX(sub.updateDateTime)')
                        ->from(['sub' => 'kpi_history'])
                        ->where('sub.kpiId = main.kpiId')
                        ->andWhere(['sub.status' => [1, 2, 4]])
                ])
                ->andWhere([
                    'or',
                    ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                    ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                ])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kpiHistoryId' => SORT_DESC,
                ])
                ->asArray()
				->all();
                // return json_encode($kpiHistory);

                            
                // KGI Sub Query
                $kgiHistory = kgiHistory::find()
                ->alias('main')
                ->select([
                    'main.kgiHistoryId',
                    'main.kgiId',
                    'main.kgiHistoryName',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.titleProcess',
                    'main.description',
                    'main.createrId',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kgi.kgiName',
                    'kgi.companyId',
                ])
                ->leftJoin('kgi', 'main.kgiId = kgi.kgiId')
                ->where([
                    'main.status' => [1, 2, 4],'kgi.companyId' => $companyId
                ])
                ->andWhere([
                    'main.updateDateTime' => (new \yii\db\Query())
                        ->select('MAX(sub.updateDateTime)')
                        ->from(['sub' => 'kgi_history'])
                        ->where('sub.kgiId = main.kgiId')
                        ->andWhere(['sub.status' => [1, 2, 4]])
                ])
                ->andWhere([
                    'or',
                    ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                    ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                ])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kgiHistoryId' => SORT_DESC,
                ])
                ->asArray()
				->all();
                // return json_encode($kgiHistory);
                
                if (isset($kfiHistory) && count($kfiHistory) > 0) {
                    foreach ($kfiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        // $employeeId = Employee::employeeId($history["createrId"]);
                        $data['kficom' . $history["kfiHistoryId"]] = [
                           "id" => $history["kfiId"],
                            "historyId" => $history["kfiHistoryId"],
                            "typeId" => '0',
                            "type" => 'company',
                            "page" => 'kfi',
                            "title" => $history["kfiName"],
                            "description" => $history["description"],
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"], 
                            "month" => $history["month"],
                            "year" => $history["year"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                        ];
                        $kficompany++;
                    endforeach;
                }

                if (isset($kpiHistory) && count($kpiHistory) > 0) {
                    foreach ($kpiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        // $employeeId = Employee::employeeId($history["createrId"]);
                        $data['kpicom' . $history["kpiHistoryId"]] = [
                            "id" => $history["kpiId"],
                            "historyId" => $history["kpiHistoryId"],
                            "typeId" => '0',
                            "type" => 'company',
                            "page" => 'kpi',
                            "title" => $history["kpiName"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kpicompany++;
                    endforeach;
                }

                if (isset($kgiHistory) && count($kgiHistory) > 0) {
                    foreach ($kgiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        // $employeeId = Employee::employeeId($history["createrId"]);
                        $data['kgicom' . $history["kgiHistoryId"]] = [
                            "id" => $history["kgiId"],
                            "historyId" => $history["kgiHistoryId"],
                            "typeId" => '0',
                            "type" => 'company',
                            "page" => 'kgi',
                            "title" => $history["kgiName"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kgicompany++;
                    endforeach;
                }
                // return json_encode($data);
            //companyEnd

            //team
               // คำสั่ง SQL สำหรับ kgi_team_history
               $kgiTeamHistory = KgiTeamHistory::find()
                        ->alias('main')
                        ->select([
                            'main.kgiTeamHistoryId',
                            'main.kgiTeamId',
                            'main.target',
                            'main.result',
                            'main.detail',
                            'main.fromDate',
                            'main.toDate',
                            'main.nextCheckDate',
                            'main.month',
                            'main.year',
                            'main.createrId',
                            'main.status',
                            'main.status',
                            'main.createDateTime',
                            'main.updateDateTime',
                            'kgi_team.kgiId',
                            'kgi_team.teamId',
                            'kgi_team.kgiTeamId',
                            'kgi.kgiName',
                            'kgi.companyId',
                        ])
                        ->leftJoin('kgi_team', 'main.kgiTeamId = kgi_team.kgiTeamId')
                        ->leftJoin('kgi', 'kgi_team.kgiId = kgi.kgiId')
                        ->where([
                            'main.status' => [1, 2, 4],'kgi.companyId' => $companyId
                        ])
                        ->andWhere([
                            'main.updateDateTime' => (new \yii\db\Query())
                                ->select('MAX(sub.updateDateTime)')
                                ->from(['sub' => 'kgi_team_history'])
                                ->where('sub.kgiTeamId = main.kgiTeamId')
                                ->andWhere(['sub.status' => [1, 2, 4]])
                        ])
                        ->andWhere([
                            'or',
                            ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                            ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                        ])
                        ->andWhere(['IS NOT', 'kgi_team.kgiTeamId', null])
                        ->orderBy([
                            'main.year' => SORT_DESC,
                            'main.month' => SORT_DESC,
                            'main.kgiTeamHistoryId' => SORT_DESC,
                        ])
                        ->asArray()  // แปลงผลลัพธ์เป็น array
                        ->all();     // ดึงข้อมูลทั้งหมด
                        // return json_encode($kgiTeamHistory);

                        // คำสั่ง SQL สำหรับ kpi_team_history
                        $kpiTeamHistory = kpiTeamHistory::find()
                        ->alias('main')
                        ->select([
                            'main.kpiTeamHistoryId',
                            'main.kpiTeamId',
                            'main.target',
                            'main.result',
                            'main.detail',
                            'main.fromDate',
                            'main.toDate',
                            'main.nextCheckDate',
                            'main.month',
                            'main.year',
                            'main.createrId',
                            'main.status',
                            'main.createDateTime',
                            'main.updateDateTime',
                            'kpi_team.kpiId',
                            'kpi_team.teamId',
                            'kpi_team.kpiTeamId',
                            'kpi.kpiName',
                            'kpi.companyId',
                        ])
                        ->leftJoin('kpi_team', 'main.kpiTeamId = kpi_team.kpiTeamId')
                        ->leftJoin('kpi', 'kpi_team.kpiId = kpi.kpiId')
                        ->where([
                            'main.status' => [1, 2, 4],'kpi.companyId' => $companyId
                        ])
                        ->andWhere([
                            'main.updateDateTime' => (new \yii\db\Query())
                                ->select('MAX(sub.updateDateTime)')
                                ->from(['sub' => 'kpi_team_history'])
                                ->where('sub.kpiTeamId = main.kpiTeamId')
                                ->andWhere(['sub.status' => [1, 2, 4]])
                        ])
                        ->andWhere([
                            'or',
                            ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                            ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                        ])
                        ->andWhere(['IS NOT', 'kpi_team.kpiTeamId', null])
                        ->orderBy([
                            'main.year' => SORT_DESC,
                            'main.month' => SORT_DESC,
                            'main.kpiTeamHistoryId' => SORT_DESC,
                        ])
                        ->asArray()  // แปลงผลลัพธ์เป็น array
                        ->all();     // ดึงข้อมูลทั้งหมด
                        // return json_encode($kpiTeamHistory);
                        
                        if (!empty($kgiTeamHistory)) {
                            foreach ($kgiTeamHistory as $history) {
                                $time = explode(' ', $history["createDateTime"]);
                                // $employeeId = Employee::employeeId($history["createrId"]);
                                $data['kgiteam' . $history["kgiTeamHistoryId"]] = [
                                    "id" => $history["kgiId"],
                                    "historyId" => $history["kgiTeamHistoryId"],
                                    "typeId" => $history["kgiTeamId"],
                                    "type" => 'team',
                                    "page" => 'kgi',
                                    "title" => $history["kgiName"],
                                    "description" => $history["detail"],
                                    "creater" => User::employeeNameByuserId($history["createrId"]),
                                    "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                    "time" => ModelMaster::timeText($time[1]),
                                    "status" => $history["status"],
                                    "month" => $history["month"],
                                    "year" => $history["year"]
                                ];
                                $kgiteam++;
                            }
                        }

                        if (!empty($kpiTeamHistory)) {
                            foreach ($kpiTeamHistory as $teamhistory) {
                                $time = explode(' ', $teamhistory["createDateTime"]);
                                // $employeeId = Employee::employeeId($teamhistory["createrId"]);
                                $data['kpiteam' . $teamhistory["kpiTeamHistoryId"]] = [
                                    "id" => $teamhistory["kpiId"],
                                    "historyId" => $teamhistory["kpiTeamHistoryId"],
                                    "typeId" => $teamhistory["kpiTeamId"],
                                    "type" => 'team',
                                    "page" => 'kpi',
                                    "title" => $teamhistory["kpiName"],
                                    "description" => $teamhistory["detail"],
                                    "creater" => User::employeeNameByuserId($teamhistory["createrId"]),
                                    "createDate" => ModelMaster::engDateHr($teamhistory["createDateTime"]),
                                    "time" => ModelMaster::timeText($time[1]),
                                    "status" => $teamhistory["status"],
                                    "month" => $teamhistory["month"],
                                    "year" => $teamhistory["year"]
                                ];
                                $kpiteam++;
                            }
                        }
                        // return json_encode($data);
            //teamEND

            //employee
               // Query for kgi_employee_history
               $kgiEmployeeHistory = KgiEmployeeHistory::find()
               ->alias('main')
               ->select([
                   'main.kgiEmployeeHistoryId',
                   'main.kgiEmployeeId',
                   'main.target',
                   'main.result',
                   'main.fromDate',
                   'main.toDate',
                   'main.detail',
                   'main.nextCheckDate',
                   'main.month',
                   'main.year',
                   'main.lastCheckDate',
                   'main.createrId',
                   'main.status',
                   'main.createDateTime',
                   'main.updateDateTime',
                   'kgi_employee.kgiId',
                   'kgi_employee.kgiEmployeeId',
                   'kgi.kgiName',  // Alias 'description' for kgiName
                   'kgi.companyId',
               ])
               ->leftJoin('kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
               ->leftJoin('kgi', 'kgi_employee.kgiId = kgi.kgiId')
               ->where([
                   'main.status' => [1, 2, 4],
               ])
               ->andWhere([
                   'main.updateDateTime' => (new \yii\db\Query())
                       ->select('MAX(sub.updateDateTime)')
                       ->from(['sub' => 'kgi_employee_history'])
                       ->where('sub.kgiEmployeeId = main.kgiEmployeeId')
                       ->andWhere(['sub.status' => [1, 2, 4]])
               ])
               ->andWhere([
                   'or',
                   ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                   ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
               ])
               ->andWhere(['IS NOT', 'kgi_employee.kgiEmployeeId', null])
               ->orderBy([
                   'main.year' => SORT_DESC,
                   'main.month' => SORT_DESC,
                   'main.kgiEmployeeHistoryId' => SORT_DESC,
               ])
               ->asArray()  // แปลงผลลัพธ์เป็น array
               ->all();     // ดึงข้อมูลทั้งหมด
               // return json_encode($kgiEmployeeHistory);


               // Query for kpi_employee_history
               $kpiEmployeeHistory = kpiEmployeeHistory::find()
               ->alias('main')
               ->select([
                   'main.kpiEmployeeHistoryId',
                   'main.kpiEmployeeId',
                   'main.target',
                   'main.result',
                   'main.fromDate',
                   'main.toDate',
                   'main.detail',
                   'main.nextCheckDate',
                   'main.month',
                   'main.year',
                   'main.lastCheckDate',
                   'main.createrId',
                   'main.status',
                   'main.createDateTime',
                   'main.updateDateTime',
                   'kpi_employee.kpiId',
                   'kpi_employee.kpiEmployeeId',
                   'kpi.kpiName',  // Alias 'description' for kpiName
                   'kpi.companyId',
               ])
               ->leftJoin('kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
               ->leftJoin('kpi', 'kpi_employee.kpiId = kpi.kpiId')
               ->where([
                   'main.status' => [1, 2, 4],
               ])
               ->andWhere([
                   'main.updateDateTime' => (new \yii\db\Query())
                       ->select('MAX(sub.updateDateTime)')
                       ->from(['sub' => 'kpi_employee_history'])
                       ->where('sub.kpiEmployeeId = main.kpiEmployeeId')
                       ->andWhere(['sub.status' => [1, 2, 4]])
               ])
               ->andWhere([
                   'or',
                   ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                   ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
               ])
               ->andWhere(['IS NOT', 'kpi_employee.kpiEmployeeId', null])
               ->orderBy([
                   'main.year' => SORT_DESC,
                   'main.month' => SORT_DESC,
                   'main.kpiEmployeeHistoryId' => SORT_DESC,
               ])
               ->asArray()  // แปลงผลลัพธ์เป็น array
               ->all();     // ดึงข้อมูลทั้งหมด
               // return json_encode($kpiEmployeeHistory);


                    if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                    foreach ($kgiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        // $employeeId = Employee::employeeId($employeehistory["createrId"]);
                        $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                            "id" => $employeehistory["kgiId"],
                            "historyId" => $employeehistory["kgiEmployeeHistoryId"],
                            "typeId" => $employeehistory["kgiEmployeeId"],
                            "type" => 'employee',
                            "page" => 'kgi',
                            "title" => $employeehistory["kgiName"],
                            "description" => $employeehistory["detail"],  // Use kgi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kgiself++;
                    endforeach;
                    }

                    if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                    foreach ($kpiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        // $employeeId = Employee::employeeId($employeehistory["createrId"]);
                        $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                            "id" => $employeehistory["kpiId"],
                            "historyId" => $employeehistory["kpiEmployeeHistoryId"],
                            "typeId" => $employeehistory["kpiEmployeeId"],
                            "type" => 'employee',
                            "page" => 'kpi',
                            "title" => $employeehistory["kpiName"],
                            "description" => $employeehistory["detail"],  // Use kpi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kpiself++;
                    endforeach;
                    }
                    return json_encode($data);
            //employeeEND

        }else if($role == 3) {
        // Leader view team
        // $type = 'Leader';
            //team
                    // คำสั่ง SQL สำหรับ kgi_team_history
                    $kgiTeamHistory = KgiTeamHistory::find()
                        ->alias('main')
                        ->select([
                            'main.kgiTeamHistoryId',
                            'main.kgiTeamId',
                            'main.target',
                            'main.result',
                            'main.detail',
                            'main.fromDate',
                            'main.toDate',
                            'main.nextCheckDate',
                            'main.month',
                            'main.year',
                            'main.createrId',
                            'main.status',
                            'main.status',
                            'main.createDateTime',
                            'main.updateDateTime',
                            'kgi_team.kgiId',
                            'kgi_team.teamId',
                            'kgi_team.kgiTeamId',
                            'kgi.kgiName',
                            'kgi.companyId',
                        ])
                        ->leftJoin('kgi_team', 'main.kgiTeamId = kgi_team.kgiTeamId')
                        ->leftJoin('kgi', 'kgi_team.kgiId = kgi.kgiId')
                        ->where([
                            'main.status' => [1, 2, 4],'kgi_team.teamId' => $teamId
                        ])
                        ->andWhere([
                            'main.updateDateTime' => (new \yii\db\Query())
                                ->select('MAX(sub.updateDateTime)')
                                ->from(['sub' => 'kgi_team_history'])
                                ->where('sub.kgiTeamId = main.kgiTeamId')
                                ->andWhere(['sub.status' => [1, 2, 4]])
                        ])
                        ->andWhere([
                            'or',
                            ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                            ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                        ])
                        ->andWhere(['IS NOT', 'kgi_team.kgiTeamId', null])
                        ->orderBy([
                            'main.year' => SORT_DESC,
                            'main.month' => SORT_DESC,
                            'main.kgiTeamHistoryId' => SORT_DESC,
                        ])
                        ->asArray()  // แปลงผลลัพธ์เป็น array
                        ->all();     // ดึงข้อมูลทั้งหมด
                        // return json_encode($kgiTeamHistory);

                        // คำสั่ง SQL สำหรับ kpi_team_history
                        $kpiTeamHistory = kpiTeamHistory::find()
                        ->alias('main')
                        ->select([
                            'main.kpiTeamHistoryId',
                            'main.kpiTeamId',
                            'main.target',
                            'main.result',
                            'main.detail',
                            'main.fromDate',
                            'main.toDate',
                            'main.nextCheckDate',
                            'main.month',
                            'main.year',
                            'main.createrId',
                            'main.status',
                            'main.createDateTime',
                            'main.updateDateTime',
                            'kpi_team.kpiId',
                            'kpi_team.teamId',
                            'kpi_team.kpiTeamId',
                            'kpi.kpiName',
                            'kpi.companyId',
                        ])
                        ->leftJoin('kpi_team', 'main.kpiTeamId = kpi_team.kpiTeamId')
                        ->leftJoin('kpi', 'kpi_team.kpiId = kpi.kpiId')
                        ->where([
                            'main.status' => [1, 2, 4],'kpi_team.teamId' => $teamId
                        ])
                        ->andWhere([
                            'main.updateDateTime' => (new \yii\db\Query())
                                ->select('MAX(sub.updateDateTime)')
                                ->from(['sub' => 'kpi_team_history'])
                                ->where('sub.kpiTeamId = main.kpiTeamId')
                                ->andWhere(['sub.status' => [1, 2, 4]])
                        ])
                        ->andWhere([
                            'or',
                            ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                            ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
                        ])
                        ->andWhere(['IS NOT', 'kpi_team.kpiTeamId', null])
                        ->orderBy([
                            'main.year' => SORT_DESC,
                            'main.month' => SORT_DESC,
                            'main.kpiTeamHistoryId' => SORT_DESC,
                        ])
                        ->asArray()  // แปลงผลลัพธ์เป็น array
                        ->all();     // ดึงข้อมูลทั้งหมด
                        // return json_encode($kpiTeamHistory);

                    if (!empty($kgiTeamHistory)) {
                        foreach ($kgiTeamHistory as $history) {
                            $time = explode(' ', $history["createDateTime"]);
                            // $employeeId = Employee::employeeId($history["createrId"]);
                            $data['kgiteam' . $history["kgiTeamHistoryId"]] = [
                                "id" => $history["kgiId"],
                                "historyId" => $history["kgiTeamHistoryId"],
                                "typeId" => $history["kgiTeamId"],
                                "type" => 'team',
                                "page" => 'kgi',
                                "title" => $history["kgiName"],
                                "description" => $history["detail"],
                                "creater" => User::employeeNameByuserId($history["createrId"]),
                                "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $history["status"],
                                "month" => $history["month"],
                                "year" => $history["year"]
                            ];
                            $kgiteam++;
                        }
                    }

                    if (!empty($kpiTeamHistory)) {
                        foreach ($kpiTeamHistory as $teamhistory) {
                            $time = explode(' ', $teamhistory["createDateTime"]);
                            // $employeeId = Employee::employeeId($teamhistory["createrId"]);
                            $data['kpiteam' . $teamhistory["kpiTeamHistoryId"]] = [
                                "id" => $teamhistory["kpiId"],
                                "historyId" => $teamhistory["kpiTeamHistoryId"],
                                "typeId" => $teamhistory["kpiTeamId"],
                                "type" => 'team',
                                "page" => 'kpi',
                                "title" => $teamhistory["kpiName"],
                                "description" => $teamhistory["detail"],
                                "creater" => User::employeeNameByuserId($teamhistory["createrId"]),
                                "createDate" => ModelMaster::engDateHr($teamhistory["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $teamhistory["status"],
                                "month" => $teamhistory["month"],
                                "year" => $teamhistory["year"]
                            ];
                            $kpiteam++;
                        }
                    }
                    // return json_encode($data);
        //teamEND

        //employee
            // Query for kgi_employee_history
            $kgiEmployeeHistory = KgiEmployeeHistory::find()
               ->alias('main')
               ->select([
                   'main.kgiEmployeeHistoryId',
                   'main.kgiEmployeeId',
                   'main.target',
                   'main.result',
                   'main.fromDate',
                   'main.toDate',
                   'main.detail',
                   'main.nextCheckDate',
                   'main.month',
                   'main.year',
                   'main.lastCheckDate',
                   'main.createrId',
                   'main.status',
                   'main.createDateTime',
                   'main.updateDateTime',
                   'kgi_employee.kgiId',
                   'kgi_employee.kgiEmployeeId',
                   'kgi.kgiName',  // Alias 'description' for kgiName
                   'kgi.companyId',
               ])
               ->leftJoin('kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
               ->leftJoin('kgi', 'kgi_employee.kgiId = kgi.kgiId')
               ->where([
                   'main.status' => [1, 2, 4],'main.kgiEmployeeId' => $employeeId
               ])
               ->andWhere([
                   'main.updateDateTime' => (new \yii\db\Query())
                       ->select('MAX(sub.updateDateTime)')
                       ->from(['sub' => 'kgi_employee_history'])
                       ->where('sub.kgiEmployeeId = main.kgiEmployeeId')
                       ->andWhere(['sub.status' => [1, 2, 4]])
               ])
               ->andWhere([
                   'or',
                   ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                   ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
               ])
               ->andWhere(['IS NOT', 'kgi_employee.kgiEmployeeId', null])
               ->orderBy([
                   'main.year' => SORT_DESC,
                   'main.month' => SORT_DESC,
                   'main.kgiEmployeeHistoryId' => SORT_DESC,
               ])
               ->asArray()  // แปลงผลลัพธ์เป็น array
               ->all();     // ดึงข้อมูลทั้งหมด
            //    return json_encode($kgiEmployeeHistory);

               // Query for kpi_employee_history
               $kpiEmployeeHistory = kpiEmployeeHistory::find()
               ->alias('main')
               ->select([
                   'main.kpiEmployeeHistoryId',
                   'main.kpiEmployeeId',
                   'main.target',
                   'main.result',
                   'main.fromDate',
                   'main.toDate',
                   'main.detail',
                   'main.nextCheckDate',
                   'main.month',
                   'main.year',
                   'main.lastCheckDate',
                   'main.createrId',
                   'main.status',
                   'main.createDateTime',
                   'main.updateDateTime',
                   'kpi_employee.kpiId',
                   'kpi_employee.kpiEmployeeId',
                   'kpi.kpiName',  // Alias 'description' for kpiName
                   'kpi.companyId',
               ])
               ->leftJoin('kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
               ->leftJoin('kpi', 'kpi_employee.kpiId = kpi.kpiId')
               ->where([
                   'main.status' => [1, 2, 4],'main.kpiEmployeeId' => $employeeId
               ])
               ->andWhere([
                   'main.updateDateTime' => (new \yii\db\Query())
                       ->select('MAX(sub.updateDateTime)')
                       ->from(['sub' => 'kpi_employee_history'])
                       ->where('sub.kpiEmployeeId = main.kpiEmployeeId')
                       ->andWhere(['sub.status' => [1, 2, 4]])
               ])
               ->andWhere([
                   'or',
                   ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                   ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
               ])
               ->andWhere(['IS NOT', 'kpi_employee.kpiEmployeeId', null])
               ->orderBy([
                   'main.year' => SORT_DESC,
                   'main.month' => SORT_DESC,
                   'main.kpiEmployeeHistoryId' => SORT_DESC,
               ])
               ->asArray()  // แปลงผลลัพธ์เป็น array
               ->all();     // ดึงข้อมูลทั้งหมด
            //    return json_encode($kpiEmployeeHistory);

                if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                    foreach ($kgiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                            "id" => $employeehistory["kgiId"],
                            "historyId" => $employeehistory["kgiEmployeeHistoryId"],
                            "typeId" => $employeehistory["kgiEmployeeId"],
                            "type" => 'employee',
                            "page" => 'kgi',
                            "title" => $employeehistory["kgiName"],
                            "description" => $employeehistory["detail"],  // Use kgi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kgiself++;
                    endforeach;
                }

                if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                    foreach ($kpiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                            "id" => $employeehistory["kpiId"],
                            "historyId" => $employeehistory["kpiEmployeeHistoryId"],
                            "typeId" => $employeehistory["kpiEmployeeId"],
                            "type" => 'employee',
                            "page" => 'kpi',
                            "title" => $employeehistory["kpiName"],
                            "description" => $employeehistory["detail"],  // Use kpi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kpiself++;
                    endforeach;
                }
                return json_encode($data);
        //employeeEND

        }else if ($role < 3){
         // Staff view self
        //  $type = 'Staff';
 //employee
            // Query for kgi_employee_history
            $kgiEmployeeHistory = KgiEmployeeHistory::find()
            ->alias('main')
            ->select([
                'main.kgiEmployeeHistoryId',
                'main.kgiEmployeeId',
                'main.target',
                'main.result',
                'main.fromDate',
                'main.toDate',
                'main.detail',
                'main.nextCheckDate',
                'main.month',
                'main.year',
                'main.lastCheckDate',
                'main.createrId',
                'main.status',
                'main.createDateTime',
                'main.updateDateTime',
                'kgi_employee.kgiId',
                'kgi_employee.kgiEmployeeId',
                'kgi.kgiName',  // Alias 'description' for kgiName
                'kgi.companyId',
            ])
            ->leftJoin('kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
            ->leftJoin('kgi', 'kgi_employee.kgiId = kgi.kgiId')
            ->where([
                'main.status' => [1, 2, 4],'main.kgiEmployeeId' => $employeeId
            ])
            ->andWhere([
                'main.updateDateTime' => (new \yii\db\Query())
                    ->select('MAX(sub.updateDateTime)')
                    ->from(['sub' => 'kgi_employee_history'])
                    ->where('sub.kgiEmployeeId = main.kgiEmployeeId')
                    ->andWhere(['sub.status' => [1, 2, 4]])
            ])
            ->andWhere([
                'or',
                ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
            ])
            ->andWhere(['IS NOT', 'kgi_employee.kgiEmployeeId', null])
            ->orderBy([
                'main.year' => SORT_DESC,
                'main.month' => SORT_DESC,
                'main.kgiEmployeeHistoryId' => SORT_DESC,
            ])
            ->asArray()  // แปลงผลลัพธ์เป็น array
            ->all();     // ดึงข้อมูลทั้งหมด
         //    return json_encode($kgiEmployeeHistory);

            // Query for kpi_employee_history
            $kpiEmployeeHistory = kpiEmployeeHistory::find()
            ->alias('main')
            ->select([
                'main.kpiEmployeeHistoryId',
                'main.kpiEmployeeId',
                'main.target',
                'main.result',
                'main.fromDate',
                'main.toDate',
                'main.detail',
                'main.nextCheckDate',
                'main.month',
                'main.year',
                'main.lastCheckDate',
                'main.createrId',
                'main.status',
                'main.createDateTime',
                'main.updateDateTime',
                'kpi_employee.kpiId',
                'kpi_employee.kpiEmployeeId',
                'kpi.kpiName',  // Alias 'description' for kpiName
                'kpi.companyId',
            ])
            ->leftJoin('kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
            ->leftJoin('kpi', 'kpi_employee.kpiId = kpi.kpiId')
            ->where([
                'main.status' => [1, 2, 4],'main.kpiEmployeeId' => $employeeId
            ])
            ->andWhere([
                'main.updateDateTime' => (new \yii\db\Query())
                    ->select('MAX(sub.updateDateTime)')
                    ->from(['sub' => 'kpi_employee_history'])
                    ->where('sub.kpiEmployeeId = main.kpiEmployeeId')
                    ->andWhere(['sub.status' => [1, 2, 4]])
            ])
            ->andWhere([
                'or',
                ['between', 'main.nextCheckDate', new Expression('DATE_SUB(CURDATE(), INTERVAL 7 DAY)'), new Expression('CURDATE()')],
                ['<=', 'main.nextCheckDate', new Expression('CURDATE()')],
            ])
            ->andWhere(['IS NOT', 'kpi_employee.kpiEmployeeId', null])
            ->orderBy([
                'main.year' => SORT_DESC,
                'main.month' => SORT_DESC,
                'main.kpiEmployeeHistoryId' => SORT_DESC,
            ])
            ->asArray()  // แปลงผลลัพธ์เป็น array
            ->all();     // ดึงข้อมูลทั้งหมด
         //    return json_encode($kpiEmployeeHistory);

             if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                 foreach ($kgiEmployeeHistory as $employeehistory) :
                     $time = explode(' ', $employeehistory["createDateTime"]);
                     $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                        "id" => $employeehistory["kgiId"],
                        "historyId" => $employeehistory["kgiEmployeeHistoryId"],
                        "typeId" => $employeehistory["kgiEmployeeId"],
                        "type" => 'employee',
                        "page" => 'kgi',
                         "title" => $employeehistory["kgiName"],
                         "description" => $employeehistory["detail"],  // Use kgi description
                         "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                         "time" => ModelMaster::timeText($time[1]),
                         "status" => $employeehistory["status"],
                         "month" => $employeehistory["month"],
                         "year" => $employeehistory["year"],
                         "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                     ];
                     $kgiself++;
                 endforeach;
             }

             if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                 foreach ($kpiEmployeeHistory as $employeehistory) :
                     $time = explode(' ', $employeehistory["createDateTime"]);
                     $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                        "id" => $employeehistory["kpiId"],
                        "historyId" => $employeehistory["kpiEmployeeHistoryId"],
                        "typeId" => $employeehistory["kpiEmployeeId"],
                        "type" => 'employee',
                        "page" => 'kpi',
                         "title" => $employeehistory["kpiName"],
                         "description" => $employeehistory["detail"],  // Use kpi description
                         "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                         "time" => ModelMaster::timeText($time[1]),
                         "status" => $employeehistory["status"],
                         "month" => $employeehistory["month"],
                         "year" => $employeehistory["year"],
                         "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                     ];
                     $kpiself++;
                 endforeach;
             }
    //employeeEND
        }

        $data = [
            'kficompany' => $kficompany,
            'kgicompany' => $kgicompany,
            'kpicompany' => $kpicompany,
            'kgiteam' => $kgiteam,
            'kpiteam' => $kpiteam,
            'kgiself' => $kgiself,
            'kpiself' => $kpiself
        ];
        
        // ส่งข้อมูลกลับเป็น JSON
        return json_encode($data);
    }

}    