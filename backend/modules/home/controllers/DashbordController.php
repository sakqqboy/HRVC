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
use common\models\ModelMaster;
use DateTime;
use Yii;
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
        // ดึงข้อมูลออกจากฐานข้อมูล
        $kfis = Kfi::find()->where(['<>', 'status', '99'])
                          ->andWhere(['companyId' => $companyId])
                          ->asArray()
                          ->all();
        $kgis = Kgi::find()->where(['<>', 'status', '99'])
                          ->andWhere(['companyId' => $companyId])
                          ->asArray()
                          ->all();
        $kpis = Kpi::find()->where(['<>', 'status', '99'])
                          ->andWhere(['companyId' => $companyId])
                          ->asArray()
                          ->all();
    
        // นับจำนวนของแต่ละคิวรี้
        $kfiCount = count($kfis);
        $kgiCount = count($kgis);
        $kpiCount = count($kpis);
        $have = ''; // สร้างตัวแปรเปล่าสำหรับเก็บค่าที่วนลูป

        if (isset($kfis) && count($kfis) > 0) {
            $totlePercent = 0;
			foreach ($kfis as $kfi) :

                if (strlen($kfi["kfiName"]) > 34) {
					$kfiname = substr($kfi["kfiName"], 0, 34) . '. . .';
				} else {
					$kfiname = $kfi["kfiName"];
				}
             
                // $kfID = $kfi["kfiId"];
                    $kfiHistory = KfiHistory::find()
                        ->where(["kfiId" => $kfi["kfiId"], "status" => [1, 2]])
                        ->orderBy('year DESC,kfiHistoryId DESC')
                        ->asArray()
                        ->one();

                    if (isset($kfiHistory) && !empty($kfiHistory)) {
                        if ($kfi["targetAmount"] == null || $kfi["targetAmount"] == '' || $kfi["targetAmount"] == 0) {
                            $ratio = 0;
                        } else {
                            if ($kfiHistory["code"] == '<' || $kfiHistory["code"] == '=') {
                                $ratio = ((int)$kfiHistory['result'] / (int)$kfi["targetAmount"]) * 100;
                            } else {
                                //$ratio = ((int)$kfi['targetAmount'] / (int)$kfiHistory["result"]) * 100;
                                if ($kfiHistory["result"] != '' && $kfiHistory["result"] != 0) {
                                    $ratio = ((int)$kfi["targetAmount"] / (int)$kfiHistory["result"]) * 100;
                                } else {
                                    $ratio = 0;
                                }
                            }
                        }	

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
                            "target" => $kfi['targetAmount'],
                            "status" => $kfiHistory['status'],
                            "quantRatio" => $kfiHistory["quantRatio"],
                            "code" =>  $kfiHistory["code"],
                            "result" => $kfiHistory["result"],
                            "percentage" => number_format($showPercent, 2),
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

                if (strlen($kgi["kgiName"]) > 34) {
					$kginame = substr($kgi["kgiName"], 0, 34) . '. . .';
				} else {
					$kginame = $kgi["kgiName"];
				}
             
                    $kgiHistory = KgiHistory::find()
                        ->where(["kgiId" => $kgi["kgiId"], "status" => [1, 2]])
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
                            "percentage" => number_format($showPercent, 2),
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

                if (strlen($kpi["kpiName"]) > 34) {
					$kpiname = substr($kpi["kpiName"], 0, 34) . '. . .';
				} else {
					$kpiname = $kpi["kpiName"];
				}
             
                    $kpiHistory = KpiHistory::find()
                        ->where(["kpiId" => $kpi["kpiId"], "status" => [1, 2]])
                        ->orderBy('year DESC,kpiHistoryId DESC')
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
                            "percentage" => number_format($showPercent, 2),
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

            // $totlePercentKPI = $totlePercent;
		}

        $data = [
            'KFI' => ['kfiCount' => $kfiCount,'KFIData' => $kfiData,'showPercent' => $totlePercentKFI],
            'KGI'=>  ['kgiCount' => $kgiCount,'KGIData' => $kgiData,'showPercent' => $totlePercentKGI],
            'KPI'=>  ['kpiCount' => $kpiCount,'KPIData' => $kpiData,'showPercent' => $totlePercentKPI]
        ];
       
        return json_encode($data );
    }
    
    public function actionDashbordTeam($teamId, $userId, $role)
    {
        $employeeId = Employee::employeeId($userId);
		$employee = Employee::EmployeeDetail($employeeId);
        // if ($role <= 3) {
			$kgiTeams = KgiTeam::find()
				->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,
			kgi_team.teamId,kgi_team.target')
				->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
				->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
				->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->andFilterWhere(["kgi_team.teamId" => $teamId])
				->orderBy("k.createDateTime DESC,t.teamName ASC")
				->asArray()
				->all();
		// } else {
		// 	$kgiTeams = KgiTeam::find()
		// 		->select('k.kgiName,k.kgiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kgi_team.kgiTeamId,k.companyId,
		// 	kgi_team.teamId,kgi_team.target')
		// 		->JOIN("LEFT JOIN", "kgi k", "k.kgiId=kgi_team.kgiId")
		// 		->JOIN("LEFT JOIN", "team t", "t.teamId=kgi_team.teamId")
		// 		->where(["kgi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
		// 		->orderBy("k.createDateTime DESC,t.teamName ASC")
		// 		->asArray()
		// 		->all();
		// }

        // if ($role <= 3) {
			$kpiTeams = KpiTeam::find()
				->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_team.kpiTeamId,k.companyId,
			kpi_team.teamId,kpi_team.target')
				->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
				->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
				->where(["kpi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
				->andFilterWhere(["kpi_team.teamId" => $teamId])
				->orderBy("k.createDateTime DESC,t.teamName ASC")
				->asArray()
				->all();
		// } else {
		// 	$kpiTeams = kpiTeam::find()
		// 		->select('k.kpiName,k.kpiId,k.unitId,k.quantRatio,k.priority,k.amountType,k.code,kpi_team.kpiTeamId,k.companyId,
		// 	kpi_team.teamId,kpi_team.target')
		// 		->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_team.kpiId")
		// 		->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
		// 		->where(["kpi_team.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
		// 		->orderBy("k.createDateTime DESC,t.teamName ASC")
		// 		->asArray()
		// 		->all();
		// }

    
        // นับจำนวนของแต่ละคิวรี้
        $kgiTeamCount = count($kgiTeams);
        $kpiTeamCount = count($kpiTeams);
        $have = ''; // สร้างตัวแปรเปล่าสำหรับเก็บค่าที่วนลูป

        if (isset($kgiTeams) && count($kgiTeams) > 0) {
            $totlePercent = 0;
			foreach ($kgiTeams as $kgiTeam) :

                $kgiTeamHistory = KgiTeamHistory::find()
					->where(["kgiTeamId" => $kgiTeam["kgiTeamId"]])
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

                if (strlen($kgiTeam["kgiName"]) > 34) {
					$kginame = substr($kgiTeam["kgiName"], 0, 34) . '. . .';
				} else {
					$kginame = $kgiTeam["kgiName"];
				}

                $kgiData[$kgiTeam["kgiTeamId"]] = [
					"name" => $kginame,
                    "companyId" => $kgiTeam["companyId"],
                    "target" => $kgiTeamHistory["target"],
                    "status" => $kgiTeamHistory["status"],
					"quantRatio" => $kgiTeam["quantRatio"],
					"code" => $kgiTeam["code"],
					"result" => $kgiTeamHistory["result"],
					"percentage" => number_format($ratio, 2),
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
					->where(["kpiTeamId" => $kpiTeam["kpiTeamId"]])
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

                if (strlen($kpiTeam["kpiName"]) > 34) {
					$kpiname = substr($kpiTeam["kpiName"], 0, 34) . '. . .';
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
					"percentage" => number_format($ratio, 2),
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
        // ดึงข้อมูลออกจากฐานข้อมูล
        // $kgiEmployees = KgiEmployee::find()->where(['<>', 'status', '99'])
        //                                   ->andWhere(['employeeId' => $employeeId])
        //                                   ->asArray()
        //                                   ->all();
        // $kpiEmployees = KpiEmployee::find()->where(['<>', 'status', '99'])
        //                                   ->andWhere(['employeeId' => $employeeId])
        //                                   ->asArray()
        //                                   ->all();

        $employeeId = Employee::employeeId($userId);
		// if ($role <= 3) {
			$kgiEmployee = KgiEmployee::find()
				->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,
			kgi_employee.status,kgi_employee.employeeId,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,e.teamId,e.picture,
			kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
				->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kgi_employee.employeeId" => $employeeId])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		// } else {
		// 	$kgiEmployee = KgiEmployee::find()
		// 		->select('k.kgiName,k.priority,k.quantRatio,k.amountType,k.code,kgi_employee.target,kgi_employee.result,
		// 	kgi_employee.status,kgi_employee.employeeId,k.unitId,kgi_employee.month,kgi_employee.year,k.kgiId,k.companyId,e.teamId,e.picture,
		// 	kgi_employee.kgiEmployeeId,e.employeeFirstname,e.employeeSurename')
		// 		->JOIN("LEFT JOIN", "kgi k", "kgi_employee.kgiId=k.kgiId")
		// 		->JOIN("LEFT JOIN", "employee e", "e.employeeId=kgi_employee.employeeId")
		// 		->where(["kgi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
		// 		->orderby('k.createDateTime')
		// 		->asArray()
		// 		->all();
		// }


        // if ($role <= 3) {
			$kpiEmployee = kpiEmployee::find()
				->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
			kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
			kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
				->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
				->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
				->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4], "kpi_employee.employeeId" => $employeeId])
				->orderby('k.createDateTime')
				->asArray()
				->all();
		// } else {
		// 	$kpiEmployee = kpiEmployee::find()
		// 		->select('k.kpiName,k.priority,k.quantRatio,k.amountType,k.code,kpi_employee.target,kpi_employee.result,
		// 	kpi_employee.status,kpi_employee.employeeId,k.unitId,kpi_employee.month,kpi_employee.year,k.kpiId,k.companyId,e.teamId,e.picture,
		// 	kpi_employee.kpiEmployeeId,e.employeeFirstname,e.employeeSurename')
		// 		->JOIN("LEFT JOIN", "kpi k", "kpi_employee.kpiId=k.kpiId")
		// 		->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
		// 		->where(["kpi_employee.status" => [1, 2, 4], "k.status" => [1, 2, 4]])
		// 		->orderby('k.createDateTime')
		// 		->asArray()
		// 		->all();
		// }
    
        // นับจำนวนของแต่ละคิวรี้
        $kgiEmployeeCount = count($kgiEmployee);
        $kpiEmployeeCount = count($kpiEmployee);
        $have = ''; // สร้างตัวแปรเปล่าสำหรับเก็บค่าที่วนลูป

        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            $totlePercent = 0;
			foreach ($kgiEmployee as $kgi) :
                $kgiEmployeeHistory = KgiEmployeeHistory::find()
                ->where(["kgiEmployeeId" => $kgi["kgiEmployeeId"], "status" => [1, 2, 4]])
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
            if (strlen($kgi["kgiName"]) > 34) {
                $kginame = substr($kgi["kgiName"], 0, 34) . '. . .';
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
					"percentage" => number_format($ratio, 2),
                    "amountType" => $kgi["amountType"],
                    "active" => '',
                    "id" => $kgi["kgiEmployeeId"],
					"kgiId" => $kgi["kgiId"],
                    "due" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2),
					"last" =>  ModelMaster::engDate($kgiEmployeeHistory["nextCheckDate"], 2)  
            ];
                $totlePercent = $totlePercent + $ratio;
            endforeach;
            $totlePercentKPI = ceil($totlePercent / $kgiEmployeeCount);
        }



        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            $totlePercent = 0;
			foreach ($kpiEmployee as $kpi) :
                $kpiEmployeeHistory = KpiEmployeeHistory::find()
                ->where(["kpiEmployeeId" => $kpi["kpiEmployeeId"], "status" => [1, 2, 4]])
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
            if (strlen($kpi["kpiName"]) > 34) {
                $kpiname = substr($kpi["kpiName"], 0, 34) . '. . .';
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
					"percentage" => number_format($ratio, 2),
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
            'KGI'=>  ['kgiCount' => $kgiEmployeeCount,'KGIData' => $kgiData,'showPercent' => $totlePercentKPI],
            'KPI'=>  ['kpiCount' => $kpiEmployeeCount,'KPIData' => $kpiData,'showPercent' => $totlePercentKPI]
        ];
    
        return json_encode($data);
    }

    public function actionChartKfi($currentCategory, $companyId, $teamId, $employeeId) {
        // สร้างอาร์เรย์ข้อมูลที่ต้องการ
        $monthlyData = [
            1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [], 8 => [], 9 => [], 10 => [], 11 => [], 12 => []
        ];
        $currentYear = date('Y'); // หาปีปัจจุบัน

        
        $kfiHistory = KfiHistory::find()
        ->where(["status" => [1, 2, 4],"year" => $currentYear])
        ->orderBy('month ASC,kfiHistoryId DESC')
        ->asArray()
        ->all();

        // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน
        foreach ($kfiHistory as $entry) {
            $month = $entry['month'];  // เดือนจากข้อมูล
            $ratio = 0;
            
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
                "kfiId" => $entry["kfiId"],
                "name" => $entry["kfiHistoryName"],
                "month" => $entry["month"],
                "target" => $entry["target"],
                "result" => $entry["result"],
                "percentage" => round($ratio, 2)
            ];
        }

        // คำนวณผลรวมของเปอร์เซ็นต์ในแต่ละเดือน
        $monthlySumPercent = [];

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
        $monthlySumPercent = [];
        $currentYear = date('Y'); // หาปีปัจจุบัน

        if($currentCategory == 'Company'){

            //เอาออกมาทั้งหมด
            $kgiHistory = KgiHistory::find()
				->where(["status" => [1, 2, 4],"year" => $currentYear])
				->orderBy('month ASC,kgiHistoryId DESC')
				->asArray()
				->all();
        
                // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
        foreach ($kgiHistory as $entry) {

            $month = intval($entry['month']);  // แปลงเป็น int
            $ratio = 0;
            
            // // คำนวณค่า ratio
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
            ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear])
            ->orderBy(['a.month' => SORT_ASC, 'a.kgiTeamHistoryId' => SORT_DESC])
            ->asArray()
            ->all();

       
            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KgiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                    
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
                        "kgiId" => $entry["kgiId"],
                        //    "name" => $entry["kgiHistoryName"],
                        "month" => $entry["month"],
                        "target" => $entry["target"],
                        "result" => $entry["result"],
                        "percentage" => round($ratio, 2)
                    ];
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

            $KgiTeamHistory = KgiEmployeeHistory::find()
            ->select(['a.*', 'b.kgiId', 'c.code'])
            ->from(['a' => 'kgi_employee_history'])
            ->leftJoin(['b' => 'kgi_employee'], 'b.kgiEmployeeId = a.kgiEmployeeId')
            ->leftJoin(['c' => 'kgi'], 'c.kgiId = b.kgiId')
            ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear])
            ->orderBy(['a.month' => SORT_ASC, 'a.kgiEmployeeId' => SORT_DESC])
            ->asArray()
            ->all();
       
            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KgiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                
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
                    "kgiId" => $entry["kgiId"],
                    //"name" => $entry["kgiHistoryName"],
                    "month" => $entry["month"],
                    "target" => $entry["target"],
                    "result" => $entry["result"],
                    "percentage" => round($ratio, 2)
                ];
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
        $monthlySumPercent = [];
        $currentYear = date('Y'); // หาปีปัจจุบัน

        if($currentCategory == 'Company'){
            
            $kpiHistory = KpiHistory::find()
            ->where(["status" => [1, 2, 4],"year" => $currentYear])
            ->orderBy('month ASC,kpiHistoryId DESC')
            ->asArray()
            ->all();

            foreach ($kpiHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
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
                // เก็บข้อมูลตามเดือน
                $monthlyData[$month][] = [
                    "kpiId" => $entry["kpiId"],
                   "name" => $entry["kpiHistoryName"],
                    "month" => $entry["month"],
                    "target" => $entry["targetAmount"],
                    "result" => $entry["result"],
                    "percentage" => round($ratio, 2)
                ];	
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

        }else if($currentCategory == 'Team'){
            $KpiTeamHistory = KpiTeamHistory::find()
            ->select(['a.*', 'b.kpiId', 'c.code'])
            ->from(['a' => 'kpi_team_history'])
            ->leftJoin(['b' => 'kpi_team'], 'b.kpiTeamId = a.kpiTeamId')
            ->leftJoin(['c' => 'kpi'], 'c.kpiId = b.kpiId')
            ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear])
            ->orderBy(['a.month' => SORT_ASC, 'a.kpiTeamHistoryId' => SORT_DESC])
            ->asArray()
            ->all();

            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KpiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                    
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
                        "kgiId" => $entry["kpiId"],
                        //    "name" => $entry["kgiHistoryName"],
                        "month" => $entry["month"],
                        "target" => $entry["target"],
                        "result" => $entry["result"],
                        "percentage" => round($ratio, 2)
                    ];
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
            $KpiTeamHistory = KpiEmployeeHistory::find()
            ->select(['a.*', 'b.kpiId', 'c.code'])
            ->from(['a' => 'kpi_employee_history'])
            ->leftJoin(['b' => 'kpi_employee'], 'b.kpiEmployeeId = a.kpiEmployeeId')
            ->leftJoin(['c' => 'kpi'], 'c.kpiId = b.kpiId')
            ->where(['a.status' => [1, 2, 4], 'a.year' => $currentYear])
            ->orderBy(['a.month' => SORT_ASC, 'a.kpiEmployeeId' => SORT_DESC])
            ->asArray()
            ->all();

            // ลูปเพื่ออัพเดตข้อมูลในทุกเดือน actionDashbordCompany
            foreach ($KpiTeamHistory as $entry) {

                $month = intval($entry['month']);  // แปลงเป็น int
                $ratio = 0;
                
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
                    "kpiId" => $entry["kpiId"],
                    //"name" => $entry["kgiHistoryName"],
                    "month" => $entry["month"],
                    "target" => $entry["target"],
                    "result" => $entry["result"],
                    "percentage" => round($ratio, 2)
                ];
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
                $kfiSubQuery = (new Query())
                ->select('MAX(updateDateTime)')
                ->from('kfi_history sub')
                ->where('sub.kfiId = main.kfiId')
                ->andWhere(['sub.status' => [1, 2, 4]]);

                // Main Query with LEFT JOIN
                $kfiHistory = (new Query())
                ->select([
                    'main.kfiHistoryId',
                    'main.kfiId',
                    'main.createrId',
                    'main.kfiHistoryName',
                    'main.unitId',
                    'main.checkPeriodDate',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.quantRatio',
                    'main.amountType',
                    'main.code',
                    'main.historyStatus',
                    'main.target',
                    'main.result',
                    'main.formular',
                    'main.titleProgress',
                    'main.description AS kfiHistoryDescription',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kfi.kfiName AS description',  // ชื่อ KFI จากตาราง kfi
                    'kfi.companyId',
                ])
                ->from(['main' => 'kfi_history'])
                ->leftJoin(['kfi' => 'kfi'], 'main.kfiId = kfi.kfiId')  // LEFT JOIN ระหว่าง kfi_history และ kfi
                ->where(['main.status' => [1, 2, 4]])
                ->andWhere(['main.updateDateTime' => $kfiSubQuery])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kfiHistoryId' => SORT_DESC,
                ])
                ->all();

                        
                // KPI Sub Query
                $kpiSubQuery = (new Query())
                ->select('MAX(updateDateTime)')
                ->from('kpi_history sub')
                ->where('sub.kpiId = main.kpiId')
                ->andWhere(['sub.status' => [1, 2, 4]]);

                // Main Query with LEFT JOIN
                $kpiHistory = (new Query())
                ->select([
                    'main.kpiHistoryId',
                    'main.kpiId',
                    'main.createrId',
                    'main.titleProcess',
                    'main.kpiHistoryName',
                    'main.unitId',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.quantRatio',
                    'main.amountType',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.description AS kpiHistoryDescription',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kpi.kpiName AS description',  // ชื่อ KPI จากตาราง kpi
                    'kpi.companyId',
                ])
                ->from(['main' => 'kpi_history'])
                ->leftJoin(['kpi' => 'kpi'], 'main.kpiId = kpi.kpiId')  // LEFT JOIN ระหว่าง kpi_history และ kpi
                ->where(['main.status' => [1, 2, 4]])
                ->andWhere(['main.updateDateTime' => $kpiSubQuery])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kpiHistoryId' => SORT_DESC,
                ])
                ->all();

                            
                // KGI Sub Query
                $kgiSubQuery = (new Query())
                ->select('MAX(updateDateTime)')
                ->from('kgi_history sub')
                ->where('sub.kgiId = main.kgiId')
                ->andWhere(['sub.status' => [1, 2, 4]]);

                // Main Query
                $kgiHistory = (new Query())
                ->select([
                    'main.kgiHistoryId',
                    'main.kgiId',
                    'main.createrId',
                    'main.kgiHistoryName',
                    'main.unitId',
                    'main.titleProcess',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.quantRatio',
                    'main.amountType',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.description AS kgiHistoryDescription',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kgi.kgiName AS description',
                    'kgi.companyId',
                ])
                ->from(['main' => 'kgi_history'])
                ->leftJoin(['kgi' => 'kgi'], 'main.kgiId = kgi.kgiId') // ใช้ LEFT JOIN
                ->where(['main.status' => [1, 2, 4]])
                ->andWhere(['main.updateDateTime' => $kgiSubQuery])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kgiHistoryId' => SORT_DESC,
                ])
                ->all();

                if (isset($kfiHistory) && count($kfiHistory) > 0) {
                    foreach ($kfiHistory as $history) :
                        
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                        $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                        $interval = $today->diff($nextCheckDate); // Calculate the difference
                        if ($interval->days >= 7 && $nextCheckDate >= $today) {
                            $data['kficom' . $history["kfiHistoryId"]] = [
                                "title" => $history["titleProgress"],
                                "description" => $history["description"],
                                "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $history["historyStatus"], 
                                "month" => $history["month"],
                                "year" => $history["year"],
                                "creater" => User::employeeNameByuserId($history["createrId"]),
                            ];
                            $kficompany++;
                        }
                    }
                    endforeach;
                }

                if (isset($kpiHistory) && count($kpiHistory) > 0) {
                    foreach ($kpiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kpicom' . $history["kpiHistoryId"]] = [
                            "title" => $history["titleProcess"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kpicompany++;
                    }}
                    endforeach;
                }


                if (isset($kgiHistory) && count($kgiHistory) > 0) {
                    foreach ($kgiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kgicom' . $history["kgiHistoryId"]] = [
                            "title" => $history["titleProcess"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kgicompany++;
                    }}
                    endforeach;
                }
            //companyEnd

            //team
               // คำสั่ง SQL สำหรับ kgi_team_history
                        $sqlKgiHistory = "
                        SELECT 
                            main.kgiTeamHistoryId,
                            main.kgiTeamId,
                            main.target,
                            main.result,
                            main.detail,
                            main.fromDate,
                            main.toDate,
                            main.nextCheckDate,
                            main.month,
                            main.year,
                            main.createrId,
                            main.status,
                            main.createDateTime,
                            main.updateDateTime,
                            kgi_team.kgiId,
                            kgi_team.teamId,
                            kgi.kgiName AS description,
                            kgi.companyId
                        FROM kgi_team_history AS main
                        LEFT JOIN kgi_team AS kgi_team ON main.kgiTeamId = kgi_team.kgiTeamId
                        LEFT JOIN kgi AS kgi ON kgi_team.kgiId = kgi.kgiId
                        WHERE 
                            main.updateDateTime = (
                                SELECT MAX(sub.updateDateTime)
                                FROM kgi_team_history AS sub
                                WHERE sub.kgiTeamId = main.kgiTeamId
                                AND sub.status IN (1, 2, 4)
                            )
                        AND main.status IN (1, 2, 4)
                        ORDER BY 
                            main.kgiTeamHistoryId DESC;
                        ";

                        // คำสั่ง SQL สำหรับ kpi_team_history
                        $sqlKpiTeamHistory = "
                        SELECT 
                            main.kpiTeamHistoryId,
                            main.kpiTeamId,
                            main.target,
                            main.result,
                            main.detail,
                            main.fromDate,
                            main.toDate,
                            main.nextCheckDate,
                            main.month,
                            main.year,
                            main.createrId,
                            main.status,
                            main.createDateTime,
                            main.updateDateTime,
                            kpi_team.kpiId,
                            kpi_team.teamId,
                            kpi.kpiName AS description,
                            kpi.companyId
                        FROM kpi_team_history AS main
                        LEFT JOIN kpi_team AS kpi_team ON main.kpiTeamId = kpi_team.kpiTeamId
                        LEFT JOIN kpi AS kpi ON kpi_team.kpiId = kpi.kpiId
                        WHERE 
                            main.updateDateTime = (
                                SELECT MAX(sub.updateDateTime)
                                FROM kpi_team_history AS sub
                                WHERE sub.kpiTeamId = main.kpiTeamId
                                AND sub.status IN (1, 2, 4)
                            )
                        AND main.status IN (1, 2, 4)
                        ORDER BY 
                            main.kpiTeamHistoryId DESC;
                        ";

                        // ดึงข้อมูลจากฐานข้อมูล
                        $kgiHistory = Yii::$app->db->createCommand($sqlKgiHistory)->queryAll();
                        $kpiTeamHistory = Yii::$app->db->createCommand($sqlKpiTeamHistory)->queryAll();

                        if (!empty($kgiHistory)) {
                        foreach ($kgiHistory as $history) {
                            $time = explode(' ', $history["createDateTime"]);
                            $employeeId = Employee::employeeId($history["createrId"]);
                            if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                                $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                                $interval = $today->diff($nextCheckDate); // Calculate the difference
                                if ($interval->days >= 7 && $nextCheckDate >= $today) {                      
                            $data['kgiteam' . $history["kgiTeamHistoryId"]] = [
                                "title" => $history["detail"],
                                "description" => $history["description"],
                                "creater" => User::employeeNameByuserId($history["createrId"]),
                                "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $history["status"],
                                "month" => $history["month"],
                                "year" => $history["year"]
                            ];
                            $kgiteam++;
                        }}
                        }
                        }

                        if (!empty($kpiTeamHistory)) {
                        foreach ($kpiTeamHistory as $teamhistory) {
                            $time = explode(' ', $teamhistory["createDateTime"]);
                            $employeeId = Employee::employeeId($teamhistory["createrId"]);
                            if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                                $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                                $interval = $today->diff($nextCheckDate); // Calculate the difference
                                if ($interval->days >= 7 && $nextCheckDate >= $today) {
                            $data['kpiteam' . $teamhistory["kpiTeamHistoryId"]] = [
                                "title" => $teamhistory["detail"],
                                "description" => $teamhistory["description"],
                                "creater" => User::employeeNameByuserId($teamhistory["createrId"]),
                                "createDate" => ModelMaster::engDateHr($teamhistory["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $teamhistory["status"],
                                "month" => $teamhistory["month"],
                                "year" => $teamhistory["year"]
                            ];
                            $kpiteam++;
                        }}
                        }
                        }
            //teamEND

            //employee
               // Query for kgi_employee_history
                    $kgiEmployeeHistory = KgiEmployeeHistory::find()
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
                        'kgi.kgiName AS description',
                        'kgi.companyId'
                    ])
                    ->from('kgi_employee_history AS main')
                    ->leftJoin('kgi_employee AS kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
                    ->leftJoin('kgi AS kgi', 'kgi_employee.kgiId = kgi.kgiId')  // Corrected join here
                    ->where([
                        'main.updateDateTime' => new \yii\db\Expression(
                            '(SELECT MAX(sub.updateDateTime) FROM kgi_employee_history AS sub WHERE sub.kgiEmployeeId = main.kgiEmployeeId AND sub.status IN (1, 2, 4))'
                        ),
                        'main.status' => [1, 2, 4]
                    ])
                    ->orderBy(['main.kgiEmployeeHistoryId' => SORT_DESC])
                    ->asArray()
                    ->all();


                    if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                    foreach ($kgiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        $employeeId = Employee::employeeId($employeehistory["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                            "title" => $employeehistory["detail"],
                            "description" => $employeehistory["description"],  // Use kgi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kgiself++;
                    }}
                    endforeach;
                    }

                    // Query for kpi_employee_history
                    $kpiEmployeeHistory = KpiEmployeeHistory::find()
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
                        'kpi.kpiName AS description',
                        'kpi.companyId'
                    ])
                    ->from('kpi_employee_history AS main')
                    ->leftJoin('kpi_employee AS kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
                    ->leftJoin('kpi AS kpi', 'kpi_employee.kpiId = kpi.kpiId')  // All kgi changed to kpi
                    ->where([
                        'main.updateDateTime' => new \yii\db\Expression(
                            '(SELECT MAX(sub.updateDateTime) FROM kpi_employee_history AS sub WHERE sub.kpiEmployeeId = main.kpiEmployeeId AND sub.status IN (1, 2, 4))'
                        ),
                        'main.status' => [1, 2, 4]
                    ])
                    ->orderBy(['main.kpiEmployeeHistoryId' => SORT_DESC])
                    ->asArray()
                    ->all();


                    if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                    foreach ($kpiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        $employeeId = Employee::employeeId($employeehistory["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                            "title" => $employeehistory["detail"],
                            "description" => $employeehistory["description"],  // Use kpi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kpiself++;
                    }}
                    endforeach;
                    }

            //employeeEND
            

        }else if($role >= 4) {
            // Manager view company
            // $type = 'Manager';

            //company
                // KFI Sub Query
                $kfiSubQuery = (new Query())
                ->select('MAX(updateDateTime)')
                ->from('kfi_history sub')
                ->where('sub.kfiId = main.kfiId')
                ->andWhere(['sub.status' => [1, 2, 4]]);

                // Main Query with LEFT JOIN
                $kfiHistory = (new Query())
                ->select([
                    'main.kfiHistoryId',
                    'main.kfiId',
                    'main.createrId',
                    'main.kfiHistoryName',
                    'main.unitId',
                    'main.checkPeriodDate',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.quantRatio',
                    'main.amountType',
                    'main.code',
                    'main.historyStatus',
                    'main.target',
                    'main.result',
                    'main.formular',
                    'main.titleProgress',
                    'main.description AS kfiHistoryDescription',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kfi.kfiName AS description',  // KFI name
                    'kfi.companyId',
                    'kfi.kfiDetail',  // Additional field
                ])
                ->from(['main' => 'kfi_history'])
                ->leftJoin(['kfi' => 'kfi'], 'main.kfiId = kfi.kfiId')
                ->where(['main.status' => [1, 2, 4],'kfi.companyId' => $companyId])
                ->andWhere(['main.updateDateTime' => $kfiSubQuery])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kfiHistoryId' => SORT_DESC,
                ])
                ->all();
                        
                // KPI Sub Query
                $kpiSubQuery = (new Query())
                ->select('MAX(updateDateTime)')
                ->from('kpi_history sub')
                ->where('sub.kpiId = main.kpiId')
                ->andWhere(['sub.status' => [1, 2, 4]]);

                // Main Query with LEFT JOIN
                $kpiHistory = (new Query())
                ->select([
                    'main.kpiHistoryId',
                    'main.kpiId',
                    'main.createrId',
                    'main.titleProcess',
                    'main.kpiHistoryName',
                    'main.unitId',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.quantRatio',
                    'main.amountType',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.description AS kpiHistoryDescription',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kpi.kpiName AS description',  // KPI name
                    'kpi.companyId',
                    'kpi.kpiDetail',  // Additional field
                ])
                ->from(['main' => 'kpi_history'])
                ->leftJoin(['kpi' => 'kpi'], 'main.kpiId = kpi.kpiId')
                ->where(['main.status' => [1, 2, 4],'kpi.companyId' => $companyId])
                ->andWhere(['main.updateDateTime' => $kpiSubQuery])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kpiHistoryId' => SORT_DESC,
                ])
                ->all();
                            
                // KGI Sub Query
                $kgiSubQuery = (new Query())
                ->select('MAX(updateDateTime)')
                ->from('kgi_history sub')
                ->where('sub.kgiId = main.kgiId')
                ->andWhere(['sub.status' => [1, 2, 4]]);

                // Main Query
                $kgiHistory = (new Query())
                ->select([
                    'main.kgiHistoryId',
                    'main.kgiId',
                    'main.createrId',
                    'main.kgiHistoryName',
                    'main.unitId',
                    'main.titleProcess',
                    'main.nextCheckDate',
                    'main.fromDate',
                    'main.toDate',
                    'main.quantRatio',
                    'main.amountType',
                    'main.code',
                    'main.targetAmount',
                    'main.result',
                    'main.description AS kgiHistoryDescription',
                    'main.remark',
                    'main.month',
                    'main.year',
                    'main.status',
                    'main.createDateTime',
                    'main.updateDateTime',
                    'kgi.kgiName AS description',  // KGI name
                    'kgi.companyId',
                    'kgi.kgiDetail',  // Additional field
                ])
                ->from(['main' => 'kgi_history'])
                ->leftJoin(['kgi' => 'kgi'], 'main.kgiId = kgi.kgiId')
                ->where(['main.status' => [1, 2, 4],'kgi.companyId' => $companyId])
                ->andWhere(['main.updateDateTime' => $kgiSubQuery])
                ->orderBy([
                    'main.year' => SORT_DESC,
                    'main.month' => SORT_DESC,
                    'main.kgiHistoryId' => SORT_DESC,
                ])
                ->all();

                if (isset($kfiHistory) && count($kfiHistory) > 0) {
                    foreach ($kfiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kficom' . $history["kfiHistoryId"]] = [
                            "title" => $history["titleProgress"],
                            "description" => $history["description"],
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["historyStatus"], 
                            "month" => $history["month"],
                            "year" => $history["year"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                        ];
                        $kficompany++;
                    }}
                    endforeach;
                }

                if (isset($kpiHistory) && count($kpiHistory) > 0) {
                    foreach ($kpiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kpicom' . $history["kpiHistoryId"]] = [
                            "title" => $history["titleProcess"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kpicompany++;
                    }}
                    endforeach;
                }


                if (isset($kgiHistory) && count($kgiHistory) > 0) {
                    foreach ($kgiHistory as $history) :
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kgicom' . $history["kgiHistoryId"]] = [
                            "title" => $history["titleProcess"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kgicompany++;
                    }}
                    endforeach;
                }
            //companyEnd

            //team
               // คำสั่ง SQL สำหรับ kgi_team_history
                        $sqlKgiHistory = "
                        SELECT 
                            main.kgiTeamHistoryId,
                            main.kgiTeamId,
                            main.target,
                            main.result,
                            main.detail,
                            main.fromDate,
                            main.toDate,
                            main.nextCheckDate,
                            main.month,
                            main.year,
                            main.createrId,
                            main.status,
                            main.createDateTime,
                            main.updateDateTime,
                            kgi_team.kgiId,
                            kgi_team.teamId,
                            kgi.kgiName AS description,
                            kgi.companyId
                        FROM kgi_team_history AS main
                        LEFT JOIN kgi_team AS kgi_team ON main.kgiTeamId = kgi_team.kgiTeamId
                        LEFT JOIN kgi AS kgi ON kgi_team.kgiId = kgi.kgiId
                        WHERE 
                            main.updateDateTime = (
                                SELECT MAX(sub.updateDateTime)
                                FROM kgi_team_history AS sub
                                WHERE sub.kgiTeamId = main.kgiTeamId
                                AND sub.status IN (1, 2, 4)
                            )
                        AND main.status IN (1, 2, 4)
                        AND kgi.companyId = $companyId 
                        ORDER BY 
                            main.kgiTeamHistoryId DESC;
                        ";

                        // คำสั่ง SQL สำหรับ kpi_team_history
                        $sqlKpiTeamHistory = "
                        SELECT 
                            main.kpiTeamHistoryId,
                            main.kpiTeamId,
                            main.target,
                            main.result,
                            main.detail,
                            main.fromDate,
                            main.toDate,
                            main.nextCheckDate,
                            main.month,
                            main.year,
                            main.createrId,
                            main.status,
                            main.createDateTime,
                            main.updateDateTime,
                            kpi_team.kpiId,
                            kpi_team.teamId,
                            kpi.kpiName AS description,
                            kpi.companyId
                        FROM kpi_team_history AS main
                        LEFT JOIN kpi_team AS kpi_team ON main.kpiTeamId = kpi_team.kpiTeamId
                        LEFT JOIN kpi AS kpi ON kpi_team.kpiId = kpi.kpiId
                        WHERE 
                            main.updateDateTime = (
                                SELECT MAX(sub.updateDateTime)
                                FROM kpi_team_history AS sub
                                WHERE sub.kpiTeamId = main.kpiTeamId
                                AND sub.status IN (1, 2, 4)
                            )
                        AND main.status IN (1, 2, 4)
                        AND kpi.companyId = $companyId                         
                        ORDER BY 
                            main.kpiTeamHistoryId DESC;
                        ";

                        // ดึงข้อมูลจากฐานข้อมูล
                        $kgiHistory = Yii::$app->db->createCommand($sqlKgiHistory)->queryAll();
                        $kpiTeamHistory = Yii::$app->db->createCommand($sqlKpiTeamHistory)->queryAll();

                        if (!empty($kgiHistory)) {
                        foreach ($kgiHistory as $history) {
                            $time = explode(' ', $history["createDateTime"]);
                            $employeeId = Employee::employeeId($history["createrId"]);
                            if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                                $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                                $interval = $today->diff($nextCheckDate); // Calculate the difference
                                if ($interval->days >= 7 && $nextCheckDate >= $today) {
                            $data['kgiteam' . $history["kgiTeamHistoryId"]] = [
                                "title" => $history["detail"],
                                "description" => $history["description"],
                                "creater" => User::employeeNameByuserId($history["createrId"]),
                                "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $history["status"],
                                "month" => $history["month"],
                                "year" => $history["year"]
                            ];
                            $kgiteam++;
                        }}
                        }
                        }

                        if (!empty($kpiTeamHistory)) {
                        foreach ($kpiTeamHistory as $teamhistory) {
                            $time = explode(' ', $teamhistory["createDateTime"]);
                            $employeeId = Employee::employeeId($teamhistory["createrId"]);
                            if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                                $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                                $interval = $today->diff($nextCheckDate); // Calculate the difference
                                if ($interval->days >= 7 && $nextCheckDate >= $today) {
                            $data['kpiteam' . $teamhistory["kpiTeamHistoryId"]] = [
                                "title" => $teamhistory["detail"],
                                "description" => $teamhistory["description"],
                                "creater" => User::employeeNameByuserId($teamhistory["createrId"]),
                                "createDate" => ModelMaster::engDateHr($teamhistory["createDateTime"]),
                                "time" => ModelMaster::timeText($time[1]),
                                "status" => $teamhistory["status"],
                                "month" => $teamhistory["month"],
                                "year" => $teamhistory["year"]
                            ];
                            $kpiteam++;
                        }}
                        }
                        }
            //teamEND

            //employee
               // Query for kgi_employee_history
                    $kgiEmployeeHistory = KgiEmployeeHistory::find()
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
                        'kgi.kgiName AS description',
                        'kgi.companyId'
                    ])
                    ->from('kgi_employee_history AS main')
                    ->leftJoin('kgi_employee AS kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
                    ->leftJoin('kgi AS kgi', 'kgi_employee.kgiId = kgi.kgiId')  // Corrected join here
                    ->where([
                        'main.updateDateTime' => new \yii\db\Expression(
                            '(SELECT MAX(sub.updateDateTime) FROM kgi_employee_history AS sub WHERE sub.kgiEmployeeId = main.kgiEmployeeId AND sub.status IN (1, 2, 4))'
                        ),
                        'main.status' => [1, 2, 4],
                        'kgi.companyId' => $companyId
                    ])
                    ->orderBy(['main.kgiEmployeeHistoryId' => SORT_DESC])
                    ->asArray()
                    ->all();


                    if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                    foreach ($kgiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        $employeeId = Employee::employeeId($employeehistory["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                            "title" => $employeehistory["detail"],
                            "description" => $employeehistory["description"],  // Use kgi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kgiself++;
                    }}
                    endforeach;
                    }

                    // Query for kpi_employee_history
                    $kpiEmployeeHistory = KpiEmployeeHistory::find()
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
                        'kpi.kpiName AS description',
                        'kpi.companyId'
                    ])
                    ->from('kpi_employee_history AS main')
                    ->leftJoin('kpi_employee AS kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
                    ->leftJoin('kpi AS kpi', 'kpi_employee.kpiId = kpi.kpiId')  // All kgi changed to kpi
                    ->where([
                        'main.updateDateTime' => new \yii\db\Expression(
                            '(SELECT MAX(sub.updateDateTime) FROM kpi_employee_history AS sub WHERE sub.kpiEmployeeId = main.kpiEmployeeId AND sub.status IN (1, 2, 4))'
                        ),
                        'main.status' => [1, 2, 4],
                        'kpi.companyId' => $companyId
                    ])
                    ->orderBy(['main.kpiEmployeeHistoryId' => SORT_DESC])
                    ->asArray()
                    ->all();


                    if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                    foreach ($kpiEmployeeHistory as $employeehistory) :
                        $time = explode(' ', $employeehistory["createDateTime"]);
                        $employeeId = Employee::employeeId($employeehistory["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                            "title" => $employeehistory["detail"],
                            "description" => $employeehistory["description"],  // Use kpi description
                            "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $employeehistory["status"],
                            "month" => $employeehistory["month"],
                            "year" => $employeehistory["year"],
                            "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                        ];
                        $kpiself++;
                    }}
                    endforeach;
                    }
            //employeeEND

        }else if($role == 3) {
        // Leader view team
        // $type = 'Leader';
            //team
                    // คำสั่ง SQL สำหรับ kgi_team_history
                    $sqlKgiHistory = "
                    SELECT 
                        main.kgiTeamHistoryId,
                        main.kgiTeamId,
                        main.target,
                        main.result,
                        main.detail,
                        main.fromDate,
                        main.toDate,
                        main.nextCheckDate,
                        main.month,
                        main.year,
                        main.createrId,
                        main.status,
                        main.createDateTime,
                        main.updateDateTime,
                        kgi_team.kgiId,
                        kgi_team.teamId,
                        kgi.kgiName AS description,
                        kgi.companyId
                    FROM kgi_team_history AS main
                    LEFT JOIN kgi_team AS kgi_team ON main.kgiTeamId = kgi_team.kgiTeamId
                    LEFT JOIN kgi AS kgi ON kgi_team.kgiId = kgi.kgiId
                    WHERE 
                        main.updateDateTime = (
                            SELECT MAX(sub.updateDateTime)
                            FROM kgi_team_history AS sub
                            WHERE sub.kgiTeamId = main.kgiTeamId
                            AND sub.status IN (1, 2, 4)
                        )
                    AND main.status IN (1, 2, 4)
                    AND kgi.companyId = $companyId
                    AND kgi_team.teamId = $teamId                     
                    ORDER BY 
                        main.kgiTeamHistoryId DESC;
                    ";

                    // คำสั่ง SQL สำหรับ kpi_team_history
                    $sqlKpiTeamHistory = "
                    SELECT 
                        main.kpiTeamHistoryId,
                        main.kpiTeamId,
                        main.target,
                        main.result,
                        main.detail,
                        main.fromDate,
                        main.toDate,
                        main.nextCheckDate,
                        main.month,
                        main.year,
                        main.createrId,
                        main.status,
                        main.createDateTime,
                        main.updateDateTime,
                        kpi_team.kpiId,
                        kpi_team.teamId,
                        kpi.kpiName AS description,
                        kpi.companyId
                    FROM kpi_team_history AS main
                    LEFT JOIN kpi_team AS kpi_team ON main.kpiTeamId = kpi_team.kpiTeamId
                    LEFT JOIN kpi AS kpi ON kpi_team.kpiId = kpi.kpiId
                    WHERE 
                        main.updateDateTime = (
                            SELECT MAX(sub.updateDateTime)
                            FROM kpi_team_history AS sub
                            WHERE sub.kpiTeamId = main.kpiTeamId
                            AND sub.status IN (1, 2, 4)
                        )
                    AND main.status IN (1, 2, 4)
                    AND kpi.companyId = $companyId
                    AND kpi_team.teamId = $teamId                         
                    ORDER BY 
                        main.kpiTeamHistoryId DESC;
                    ";

                    // ดึงข้อมูลจากฐานข้อมูล
                    $kgiHistory = Yii::$app->db->createCommand($sqlKgiHistory)->queryAll();
                    $kpiTeamHistory = Yii::$app->db->createCommand($sqlKpiTeamHistory)->queryAll();

                    if (!empty($kgiHistory)) {
                    foreach ($kgiHistory as $history) {
                        $time = explode(' ', $history["createDateTime"]);
                        $employeeId = Employee::employeeId($history["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kgiteam' . $history["kgiTeamHistoryId"]] = [
                            "title" => $history["detail"],
                            "description" => $history["description"],
                            "creater" => User::employeeNameByuserId($history["createrId"]),
                            "createDate" => ModelMaster::engDateHr($history["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $history["status"],
                            "month" => $history["month"],
                            "year" => $history["year"]
                        ];
                        $kgiteam++;
                    }}
                    }
                    }

                    if (!empty($kpiTeamHistory)) {
                    foreach ($kpiTeamHistory as $teamhistory) {
                        $time = explode(' ', $teamhistory["createDateTime"]);
                        $employeeId = Employee::employeeId($teamhistory["createrId"]);
                        if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                            $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                            $interval = $today->diff($nextCheckDate); // Calculate the difference
                            if ($interval->days >= 7 && $nextCheckDate >= $today) {
                        $data['kpiteam' . $teamhistory["kpiTeamHistoryId"]] = [
                            "title" => $teamhistory["detail"],
                            "description" => $teamhistory["description"],
                            "creater" => User::employeeNameByuserId($teamhistory["createrId"]),
                            "createDate" => ModelMaster::engDateHr($teamhistory["createDateTime"]),
                            "time" => ModelMaster::timeText($time[1]),
                            "status" => $teamhistory["status"],
                            "month" => $teamhistory["month"],
                            "year" => $teamhistory["year"]
                        ];
                        $kpiteam++;
                    }}
                    }
                    }
        //teamEND

        //employee
            // Query for kgi_employee_history
                $kgiEmployeeHistory = KgiEmployeeHistory::find()
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
                    'kgi.kgiName AS description',
                    'kgi.companyId'
                ])
                ->from('kgi_employee_history AS main')
                ->leftJoin('kgi_employee AS kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
                ->leftJoin('kgi AS kgi', 'kgi_employee.kgiId = kgi.kgiId')  // Corrected join here
                ->where([
                    'main.updateDateTime' => new \yii\db\Expression(
                        '(SELECT MAX(sub.updateDateTime) FROM kgi_employee_history AS sub WHERE sub.kgiEmployeeId = main.kgiEmployeeId AND sub.status IN (1, 2, 4))'
                    ),
                    'main.status' => [1, 2, 4],
                    'kgi.companyId' => $companyId,
                    'kgi_employee.kgiEmployeeId' => $employeeId
                ])
                ->orderBy(['main.kgiEmployeeHistoryId' => SORT_DESC])
                ->asArray()
                ->all();


                if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
                foreach ($kgiEmployeeHistory as $employeehistory) :
                    $time = explode(' ', $employeehistory["createDateTime"]);
                    $employeeId = Employee::employeeId($employeehistory["createrId"]);
                    if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                        $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                        $interval = $today->diff($nextCheckDate); // Calculate the difference
                        if ($interval->days >= 7 && $nextCheckDate >= $today) {
                    $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                        "title" => $employeehistory["detail"],
                        "description" => $employeehistory["description"],  // Use kgi description
                        "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                        "time" => ModelMaster::timeText($time[1]),
                        "status" => $employeehistory["status"],
                        "month" => $employeehistory["month"],
                        "year" => $employeehistory["year"],
                        "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                    ];
                    $kgiself++;
                }}
                endforeach;
                }

                // Query for kpi_employee_history
                $kpiEmployeeHistory = KpiEmployeeHistory::find()
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
                    'kpi.kpiName AS description',
                    'kpi.companyId'
                ])
                ->from('kpi_employee_history AS main')
                ->leftJoin('kpi_employee AS kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
                ->leftJoin('kpi AS kpi', 'kpi_employee.kpiId = kpi.kpiId')  // All kgi changed to kpi
                ->where([
                    'main.updateDateTime' => new \yii\db\Expression(
                        '(SELECT MAX(sub.updateDateTime) FROM kpi_employee_history AS sub WHERE sub.kpiEmployeeId = main.kpiEmployeeId AND sub.status IN (1, 2, 4))'
                    ),
                    'main.status' => [1, 2, 4],
                    'kpi.companyId' => $companyId,
                    'kpi_employee.kpiEmployeeId' => $employeeId
                ])
                ->orderBy(['main.kpiEmployeeHistoryId' => SORT_DESC])
                ->asArray()
                ->all();


                if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
                foreach ($kpiEmployeeHistory as $employeehistory) :
                    $time = explode(' ', $employeehistory["createDateTime"]);
                    $employeeId = Employee::employeeId($employeehistory["createrId"]);
                    if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                        $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                        $interval = $today->diff($nextCheckDate); // Calculate the difference
                        if ($interval->days >= 7 && $nextCheckDate >= $today) {
                    $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                        "title" => $employeehistory["detail"],
                        "description" => $employeehistory["description"],  // Use kpi description
                        "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                        "time" => ModelMaster::timeText($time[1]),
                        "status" => $employeehistory["status"],
                        "month" => $employeehistory["month"],
                        "year" => $employeehistory["year"],
                        "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                    ];
                    $kpiself++;
                }}
                endforeach;
                }
        //employeeEND

        }else if ($role < 3){
         // Staff view self
        //  $type = 'Staff';
 //employee
            // Query for kgi_employee_history
            $kgiEmployeeHistory = KgiEmployeeHistory::find()
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
                'kgi.kgiName AS description',
                'kgi.companyId'
            ])
            ->from('kgi_employee_history AS main')
            ->leftJoin('kgi_employee AS kgi_employee', 'main.kgiEmployeeId = kgi_employee.kgiEmployeeId')
            ->leftJoin('kgi AS kgi', 'kgi_employee.kgiId = kgi.kgiId')  // Corrected join here
            ->where([
                'main.updateDateTime' => new \yii\db\Expression(
                    '(SELECT MAX(sub.updateDateTime) FROM kgi_employee_history AS sub WHERE sub.kgiEmployeeId = main.kgiEmployeeId AND sub.status IN (1, 2, 4))'
                ),
                'main.status' => [1, 2, 4],
                'kgi.companyId' => $companyId,
                'kgi_employee.kgiEmployeeId' => $employeeId
            ])
            ->orderBy(['main.kgiEmployeeHistoryId' => SORT_DESC])
            ->asArray()
            ->all();


            if (isset($kgiEmployeeHistory) && count($kgiEmployeeHistory) > 0) {
            foreach ($kgiEmployeeHistory as $employeehistory) :
                $time = explode(' ', $employeehistory["createDateTime"]);
                $employeeId = Employee::employeeId($employeehistory["createrId"]);
                if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                    $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                    $interval = $today->diff($nextCheckDate); // Calculate the difference
                    if ($interval->days >= 7 && $nextCheckDate >= $today) {
                $data['kgiself' . $employeehistory["kgiEmployeeHistoryId"]] = [
                    "title" => $employeehistory["detail"],
                    "description" => $employeehistory["description"],  // Use kgi description
                    "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                    "time" => ModelMaster::timeText($time[1]),
                    "status" => $employeehistory["status"],
                    "month" => $employeehistory["month"],
                    "year" => $employeehistory["year"],
                    "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                ];
                $kgiself++;
            }}
            endforeach;
            }

            // Query for kpi_employee_history
            $kpiEmployeeHistory = KpiEmployeeHistory::find()
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
                'kpi.kpiName AS description',
                'kpi.companyId'
            ])
            ->from('kpi_employee_history AS main')
            ->leftJoin('kpi_employee AS kpi_employee', 'main.kpiEmployeeId = kpi_employee.kpiEmployeeId')
            ->leftJoin('kpi AS kpi', 'kpi_employee.kpiId = kpi.kpiId')  // All kgi changed to kpi
            ->where([
                'main.updateDateTime' => new \yii\db\Expression(
                    '(SELECT MAX(sub.updateDateTime) FROM kpi_employee_history AS sub WHERE sub.kpiEmployeeId = main.kpiEmployeeId AND sub.status IN (1, 2, 4))'
                ),
                'main.status' => [1, 2, 4],
                'kpi.companyId' => $companyId,
                'kpi_employee.kpiEmployeeId' => $employeeId
            ])
            ->orderBy(['main.kpiEmployeeHistoryId' => SORT_DESC])
            ->asArray()
            ->all();


            if (isset($kpiEmployeeHistory) && count($kpiEmployeeHistory) > 0) {
            foreach ($kpiEmployeeHistory as $employeehistory) :
                $time = explode(' ', $employeehistory["createDateTime"]);
                $employeeId = Employee::employeeId($employeehistory["createrId"]);
                if (!empty($history["nextCheckDate"])) { // Check if nextCheckDate is not null or empty
                    $nextCheckDate = new DateTime($history["nextCheckDate"]); // Convert nextCheckDate to DateTime
                    $interval = $today->diff($nextCheckDate); // Calculate the difference
                    if ($interval->days >= 7 && $nextCheckDate >= $today) {
                $data['kpiself' . $employeehistory["kpiEmployeeHistoryId"]] = [
                    "title" => $employeehistory["detail"],
                    "description" => $employeehistory["description"],  // Use kpi description
                    "createDate" => ModelMaster::engDateHr($employeehistory["createDateTime"]),
                    "time" => ModelMaster::timeText($time[1]),
                    "status" => $employeehistory["status"],
                    "month" => $employeehistory["month"],
                    "year" => $employeehistory["year"],
                    "creater" => User::employeeNameByuserId($employeehistory["createrId"]),
                ];
                $kpiself++;
            }}
            endforeach;
            }
    //employeeEND
        }

        // $datas = [
        //     // 'kficompany' => $kficompany,
        //     // 'kgicompany' => $kgicompany,
        //     // 'kpicompany' => $kpicompany,
        //     'kgiteam' => $kgiteam,
        //     'kpiteam' => $kpiteam,
        //     'kgiself' => $kgiself,
        //     'kpiself' => $kpiself
        // ];
        
        // ส่งข้อมูลกลับเป็น JSON
        return json_encode($data);
    }

}    