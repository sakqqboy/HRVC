<?php

namespace frontend\modules\home\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\EmployeePimWeight;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\FrameTerm;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\web\Controller;

class DashboardController extends Controller
{
	public function beforeAction($action)
	{
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
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		$employeeId = User::employeeIdFromUserId();
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$employee = curl_exec($api);
		$employee = json_decode($employee, true);

		$termId = FrameTerm::currentTermId($employee["companyId"], $employee["branchId"]);

		//$termId = 20;
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/employee-evaluator?employeeId=' . $employeeId . '&&termId=' . $termId);
		$evaluator = curl_exec($api);
		$evaluator = json_decode($evaluator, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/eva/employee-pim?employeeId=' . $employeeId . '&&termId=' . $termId);
		$employeePim = curl_exec($api);
		$employeePim = json_decode($employeePim, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/eva/all-current-term?employeeId=' . $employeeId . '&&companyId=' . $employee["companyId"] . '&&branchId=' . $employee["branchId"]);
		$allCurrentTerm = curl_exec($api);
		$allCurrentTerm = json_decode($allCurrentTerm, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/eva/subordinate-current-term?evaluatorId=' .  $employeeId);
		$subordinateTerm = curl_exec($api);
		$subordinateTerm = json_decode($subordinateTerm, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		// throw new exception(print_r($subordinateTerm, true));
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
	public function actionKgiEmployeeId()
	{
		$kgiEmployeeId=$_POST["id"];
		$res["kgiEmployeeId"]=ModelMaster::encodeParams(["kgiEmployeeId"=>$kgiEmployeeId]);
		return json_encode($res);
	}

	public function actionKpiEmployeeId()
	{
		$kpiEmployeeId=$_POST["id"];
		$res["kpiEmployeeId"]=ModelMaster::encodeParams(["kpiEmployeeId"=>$kpiEmployeeId]);
		return json_encode($res);
	}

	public function actionChartDashbord()
    {
        $currentCategory = $_POST['currentCategory'] ?? '';  // Default to empty if not set
        $type = $_POST['type'] ?? '';  // Default to empty if not set
        $userId = Yii::$app->user->id;
        $Id = User::employeeIdFromUserId($userId);
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $Id);
        $employeeProfile = curl_exec($api);
        $employeeProfile = json_decode($employeeProfile, true);
        
        $companyId = $employeeProfile['companyId'];
        $teamId = $employeeProfile['teamId'];
        $employeeId = $employeeProfile['employeeId'];

        // throw new Exception("Company ID: {$companyId}, Team ID: {$teamId}, Employee ID: {$employeeId}");

        // $groupId = Group::currentGroupId();
        // $role = UserRole::userRight();
        // Your logic here to generate the response ($res)
        $res = [];

        if ($currentCategory && $type) {
            // Process data based on currentCategory and type
            // Example:
            $res['category'] = $currentCategory;
            $res['type'] = $type;

            if ($type == 'KFI') {
            $currentIndex = 0;
            } else if ($type == 'KPI') {
            $currentIndex = 1;
            }	else if ($type == 'KGI') {
            $currentIndex = 2;
            }

            // Add data based on the category and type
            // This is just an example; replace with your Performance logic
            if ($type == 'KFI') {
                
                //เรียก api ดึงดาต้ามา ใส่ในอาเรย์ก่อนresไป 
                // เรียก API ดึงข้อมูลมา
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/chart-kfi?currentCategory=' . $currentCategory . '&&companyId=' . $companyId . '&&teamId=' . $teamId . '&&employeeId=' . $employeeId);
                $chartKFI = curl_exec($api);
                $chartKFI = json_decode($chartKFI, true); // แปลง JSON เป็น Array
                // throw new Exception(print_r($chartKFI,true));
                // ตรวจสอบข้อมูลจาก API
                $performanceData = isset($chartKFI['performance']) ? $chartKFI['performance'] : [];

                // throw new Exception(print_r($performanceData,true));
                // ตรวจสอบและเติม 0 ให้ข้อมูล Performance ให้ครบ 12 ตัว
                $finalPerformanceData = [];
                for ($i = 1; $i <= 12; $i++) { // เปลี่ยน $i เริ่มจาก 1 ถึง 12
                    $finalPerformanceData[] = isset($performanceData[$i]) ? $performanceData[$i] : 0;
                }            

                // $finalPerformanceData = [79, 64, 25, 90, 10, 13, 191, 96, 101.358, 83, 6, 32] ;


                // throw new Exception(print_r($finalPerformanceData,true));
                // สร้างข้อมูลสำหรับกราฟ
                $res['data'] = [
                    [
                        'title' => "KFI Performance",
                        'series' => [
                            [
                                'type' => 'areaspline',
                                'name' => 'Performance',
                                'data' => $finalPerformanceData, // ชุดข้อมูล Performance
                                'color' => '#748EE9',
                                'fillOpacity' => 0.5,
                                'lineWidth' => 2,
                                'marker' => [
                                    'enabled' => true
                                ],
                                'visible' => true,
                                // 'enableMouseTracking' => false, // เปิดให้แสดง tooltip เมื่อเอาเมาส์ไปชี้
                                'showInLegend' => true
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Result',
                                'data' => $finalPerformanceData, // ชุดข้อมูล Performance
                                'color' => 'transparent', // ทำให้เส้นมองไม่เห็น
                                'lineWidth' => 0, // ไม่แสดงเส้น
                                'marker' => [
                                    'enabled' => false, // ไม่แสดงจุด
                                ],
                                'showInLegend' => false, // ไม่แสดงใน Legend
                                'enableMouseTracking' => true, // เปิดการติดตามเมาส์
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_map(function ($value) {
                                    return 100 - $value;
                                }, $finalPerformanceData), // คำนวณ Gap
                                'color' => 'transparent', // ทำให้เส้นมองไม่เห็น
                                'lineWidth' => 0, // ไม่แสดงเส้น
                                'marker' => [
                                    'enabled' => false, // ไม่แสดงจุด
                                ],
                                'showInLegend' => false, // ไม่แสดงใน Legend
                                'enableMouseTracking' => true, // เปิดการติดตามเมาส์
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Max',
                                'data' => array_fill(0, 12, 100.0), // ชุดข้อมูล Gap เป็น 100 ตลอด 12 จุด
                                'color' => '#748EE9',
                                'lineWidth' => 2,
                                'marker' => [
                                    'enabled' => false,
                                ],
                                'visible' => true,
                                'enableMouseTracking' => false, // เปิดให้แสดง tooltip เมื่อเอาเมาส์ไปชี้
                                'showInLegend' => false,
                            ],
                        ],
                    ],
                ];

                            // throw new Exception(print_r($res['data'],true));


            } elseif ($type == 'KGI') {
                // throw new Exception("Company ID: {$companyId}, Team ID: {$teamId}, Employee ID: {$employeeId}");

                // $url = Path::Api() .'home/dashbord/chart-kgi?currentCategory=' . $currentCategory . '&companyId=' . $companyId . '&teamId=' . $teamId . '&employeeId=' . $employeeId;
                // throw new Exception($url);

                curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/chart-kgi?currentCategory=' . $currentCategory . '&companyId=' . $companyId . '&teamId=' . $teamId . '&employeeId=' . $employeeId);
                // curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/chart-kgi?currentCategory=company&companyId=3&teamId=38&employeeId=266');
                $chartKGI = curl_exec($api);
                $chartKGI = json_decode($chartKGI, true); // แปลง JSON เป็น Array
                // throw new Exception(print_r($chartKGI,true));
                
                // ตรวจสอบข้อมูลจาก API
                $performanceData = isset($chartKGI['performance']) ? $chartKGI['performance'] : [];

                // throw new Exception(print_r($chartKGI['performance'],true));
                // ตรวจสอบและเติม 0 ให้ข้อมูล Performance ให้ครบ 12 ตัว
                $finalPerformanceData = [];
                for ($i = 1; $i <= 12; $i++) { // เปลี่ยน $i เริ่มจาก 1 ถึง 12
                    $finalPerformanceData[] = isset($performanceData[$i]) ? $performanceData[$i] : 0;
                }            


                $res['data'] = [
                    [
                        'title' => "KGI Performance",
                        'series' => [
                            [
                                'type' => 'areaspline',
                                'name' => 'Performance',
                                'data' => $finalPerformanceData, // ชุดข้อมูล Performance
                                'color' => '#FFBA00',
                                'fillOpacity' => 0.4,
                                'lineWidth' => 2,
                                'marker' => [
                                    'enabled' => true
                                ],
                                'visible' => true,
                                // 'enableMouseTracking' => false, // เปิดให้แสดง tooltip เมื่อเอาเมาส์ไปชี้
                                'showInLegend' => true,
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Result',
                                'data' => $finalPerformanceData, // ชุดข้อมูล Performance
                                'color' => 'transparent', // ทำให้เส้นมองไม่เห็น
                                'lineWidth' => 0, // ไม่แสดงเส้น
                                'marker' => [
                                    'enabled' => false, // ไม่แสดงจุด
                                ],
                                'showInLegend' => false, // ไม่แสดงใน Legend
                                'enableMouseTracking' => true, // เปิดการติดตามเมาส์
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_map(function ($value) {
                                    return 100 - $value;
                                }, $finalPerformanceData), // คำนวณ Gap
                                'color' => 'transparent', // ทำให้เส้นมองไม่เห็น
                                'lineWidth' => 0, // ไม่แสดงเส้น
                                'marker' => [
                                    'enabled' => false, // ไม่แสดงจุด
                                ],
                                'showInLegend' => false, // ไม่แสดงใน Legend
                                'enableMouseTracking' => true, // เปิดการติดตามเมาส์
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Max',
                                'data' => array_fill(0, 12, 100.0), // ชุดข้อมูล Max เป็น 100 ตลอด 12 จุด
                                'color' => '#FFD000',
                                'lineWidth' => 4,
                                'marker' => [
                                    'enabled' => false,
                                ],
                                'visible' => true,
                                'enableMouseTracking' => false, // เปิดให้แสดง tooltip เมื่อเอาเมาส์ไปชี้
                                'showInLegend' => false,
                            ],
                        ],
                    ],
                ];
            } elseif ($type == 'KPI') {

                
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/chart-kpi?currentCategory=' . $currentCategory . '&companyId=' . $companyId . '&teamId=' . $teamId . '&employeeId=' . $employeeId);
                // curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/chart-kgi?currentCategory=company&companyId=3&teamId=38&employeeId=266');
                $chartKGI = curl_exec($api);
                $chartKGI = json_decode($chartKGI, true); // แปลง JSON เป็น Array
                // throw new Exception(print_r($chartKGI,true));
                
                // ตรวจสอบข้อมูลจาก API
                $performanceData = isset($chartKGI['performance']) ? $chartKGI['performance'] : [];

                // throw new Exception(print_r($chartKGI['performance'],true));
                // ตรวจสอบและเติม 0 ให้ข้อมูล Performance ให้ครบ 12 ตัว
                $finalPerformanceData = [];
                for ($i = 1; $i <= 12; $i++) { // เปลี่ยน $i เริ่มจาก 1 ถึง 12
                    $finalPerformanceData[] = isset($performanceData[$i]) ? $performanceData[$i] : 0;
                }            

                $res['data'] = [
                    [
                        'title' => "KPI Performance",
                        'series' => [
                            [
                                'type' => 'areaspline',
                                'name' => 'Performance',
                                'data' => $finalPerformanceData, // ชุดข้อมูล Performance
                                'color' => '#F20',
                                'fillOpacity' => 0.4,
                                'lineWidth' => 2,
                                'marker' => [
                                    'enabled' => true
                                ],
                                'visible' => true,
                                // 'enableMouseTracking' => false, // เปิดให้แสดง tooltip เมื่อเอาเมาส์ไปชี้
                                'showInLegend' => true,
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Result',
                                'data' => $finalPerformanceData, // ชุดข้อมูล Performance
                                'color' => 'transparent', // ทำให้เส้นมองไม่เห็น
                                'lineWidth' => 0, // ไม่แสดงเส้น
                                'marker' => [
                                    'enabled' => false, // ไม่แสดงจุด
                                ],
                                'showInLegend' => false, // ไม่แสดงใน Legend
                                'enableMouseTracking' => true, // เปิดการติดตามเมาส์
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_map(function ($value) {
                                    return 100 - $value;
                                }, $finalPerformanceData), // คำนวณ Gap
                                'color' => 'transparent', // ทำให้เส้นมองไม่เห็น
                                'lineWidth' => 0, // ไม่แสดงเส้น
                                'marker' => [
                                    'enabled' => false, // ไม่แสดงจุด
                                ],
                                'showInLegend' => false, // ไม่แสดงใน Legend
                                'enableMouseTracking' => true, // เปิดการติดตามเมาส์
                            ],
                            [
                                'type' => 'line',
                                'name' => 'Gap',
                                'data' => array_fill(0, 12, 100.0), // ชุดข้อมูล Gap เป็น 100 ตลอด 12 จุด
                                'color' => '#FF715B',
                                'lineWidth' => 4,
                                'marker' => [
                                    'enabled' => false,
                                ],
                                'visible' => true,
                                'enableMouseTracking' => false, // เปิดให้แสดง tooltip เมื่อเอาเมาส์ไปชี้
                                'showInLegend' => false,
                            ],
                        ],
                    ],
                ];
            }
            curl_close($api);
        }

        // Return the result as a JSON response
        return json_encode($res);
    }

    
    public function actionUpcomingSchedule() {
        $data = [];
        $userId = Yii::$app->user->id;
        $Id = User::employeeIdFromUserId($userId);
		$role = UserRole::userRight();

        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $Id);
        $employeeProfile = curl_exec($api);
        $employeeProfile = json_decode($employeeProfile, true);
        
        $companyId = $employeeProfile['companyId'];
        $teamId = $employeeProfile['teamId'];
        $employeeId = $employeeProfile['employeeId'];
        // throw new Exception("Company ID: {$companyId}, Team ID: {$teamId}, Employee ID: {$employeeId}");

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/upcoming-schedule?id=' . $Id . '&role=' . $role . '&companyId='.$companyId.'&teamId='.$teamId.'&employeeId='.$employeeId);
		$upcoming = curl_exec($api);
		$upcoming = json_decode($upcoming, true);

        curl_close($api);

        return json_encode($upcoming);
    }



}