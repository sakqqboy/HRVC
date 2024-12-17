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
                            'color' => '#B4C2F1',
                            'fillOpacity' => 0.4,
                            'lineWidth' => 2,
                            'marker' => [
                                'enabled' => true,
                                'fillColor' => '#748EE9',
                            ],
                        ],
                        [
                            'type' => 'line',
                            'name' => 'Gap',
                            'data' => array_fill(0, 12, 100.0), // ชุดข้อมูล Gap เป็น 100 ตลอด 12 จุด
                            'color' => '#748EE9',
                            'lineWidth' => 2,
                            'marker' => [
                                'enabled' => false,
                            ],
                            'showInLegend' => false,
                        ],
                    ],
                ],
            ];


            // $res['data'] = [
            //     [
            //         'title' => "KFI Performance",
            //         'series' => [
            //             [
            //                 'type' => 'areaspline', // เปลี่ยนประเภทเป็น areaspline
            //                 'name' => 'Performance',
            //                 'data' => [30.0, 50.0, 50.2, 20.0, 50.1, 30.5, 40.5, 50.0, 50.3, 50.7, 60.0, 40.0],
            //                 'color' => '#B4C2F1', // สีของเส้นและพื้นที่
            //                 'fillOpacity' => 0.4, // ความโปร่งใสของพื้นที่ใต้เส้น
            //                 'lineWidth' => 2, // ความหนาของเส้น
            //                 'marker' => [
            //                     'enabled' => true,
            //                     'fillColor' => '#748EE9', // สีของจุด marker
            //                 ],
            //             ],
            //             [
            //                 'type' => 'line',
            //                 'name' => 'Gap',
            //                 'data' => [100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0],
            //                 'color' => '#748EE9',
            //                 'lineWidth' => 2,
            //                 'marker' => [
            //                     'enabled' => false, // ปิดจุด marker บนเส้นนี้
            //                 ],
            //                 'showInLegend' => false,
            //             ],
            //         ],
            //     ],
            // ];
            

        } elseif ($type == 'KGI') {
            $res['data'] = [
                [
                    'title' => "KGI Performance",
                    'series' => [
                        [
                            'type' => 'areaspline',
                            'name' => 'Performance',
                            'data' => [20.0, 50.1, 50.8, 30.5, 40.0, 20.8, 30.5, 40.0, 40.5, 50.0, 50.7, 60.0],
                            'color' => '#FFBA00',
                            'fillOpacity' => 0.4,
                            'lineWidth' => 2,
							'marker' => ['enabled' => true, 'fillColor' => '#FFD000']
                            // 'marker' => ['radius' => 3],
                        ],
                        [
                            'type' => 'line',
                            'name' => 'Gap',
                            'data' => [100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0],
                            'color' => '#FFD000',
                            'lineWidth' => 2,
							'marker' => ['enabled' => false],
                            'showInLegend' => false,
                            // 'marker' => ['radius' => 4, 'fillColor' => '#FFD000'],
                        ],
                    ],
                ],
            ];
        } elseif ($type == 'KPI') {
            $res['data'] = [
                [
                    'title' => "KPI Performance",
                    'series' => [
                        [
                            'type' => 'areaspline',
                            'name' => 'Performance',
                            'data' => [30.5, 40.0, 40.8, 50.5, 40.8, 60.0, 60.5, 60.0, 70.2 , 50.5, 70.2, 60.0],
                            'color' => '#F20',
                            'fillOpacity' => 0.4,
                            'lineWidth' => 2,
							'marker' => ['enabled' => true, 'fillColor' => '#FF715B']
                            // 'marker' => ['radius' => 3],
                        ],
                        [
                            'type' => 'line',
                            'name' => 'Gap',
                            'data' => [100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0, 100.0],
                            'color' => '#FF715B',
                            'lineWidth' => 2,
							'marker' => ['enabled' => false],
                            'showInLegend' => false,
                            // 'marker' => ['radius' => 4, 'fillColor' => '#FF715B'],
                        ],
                    ],
                ],
            ];
        }
        curl_close($api);
    }

    // Return the result as a JSON response
    echo json_encode($res);
}

}