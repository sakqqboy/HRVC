<?php

namespace backend\modules\home\controllers;

use backend\models\hrvc\Employee;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\KfiHistory;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiHistory;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiHistory;
use backend\models\hrvc\KpiTeam;
use common\models\ModelMaster;
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
    
    public function actionDashbordTeam($teamId)
    {
        // ดึงข้อมูลออกจากฐานข้อมูล
        $kgiTeam = KgiTeam::find()->where(['<>', 'status', '99'])
                                   ->andWhere(['teamId' => $teamId])
                                   ->asArray()
                                   ->all();
        $kpiTeam = KpiTeam::find()->where(['<>', 'status', '99'])
                                   ->andWhere(['teamId' => $teamId])
                                   ->asArray()
                                   ->all();
    
        // นับจำนวนของแต่ละคิวรี้
        $kgiTeamCount = count($kgiTeam);
        $kpiTeamCount = count($kpiTeam);
    
        // ส่งผลลัพธ์เป็น JSON
        $data = [
            'kgiTeamCount' => $kgiTeamCount,
            'kpiTeamCount' => $kpiTeamCount,
        ];
    
        return json_encode($data);
    }
    
    public function actionDashbordEmployee( $employeeId)
    {
        // ดึงข้อมูลออกจากฐานข้อมูล
        $kgiEmployee = KgiEmployee::find()->where(['<>', 'status', '99'])
                                          ->andWhere(['employeeId' => $employeeId])
                                          ->asArray()
                                          ->all();
        $kpiEmployee = KpiEmployee::find()->where(['<>', 'status', '99'])
                                          ->andWhere(['employeeId' => $employeeId])
                                          ->asArray()
                                          ->all();
    
        // นับจำนวนของแต่ละคิวรี้
        $kgiEmployeeCount = count($kgiEmployee);
        $kpiEmployeeCount = count($kpiEmployee);
    
        // ส่งผลลัพธ์เป็น JSON
        $data = [
            'kgiEmployeeCount' => $kgiEmployeeCount,
            'kpiEmployeeCount' => $kpiEmployeeCount,
        ];
    
        return json_encode($data);
    }
}    