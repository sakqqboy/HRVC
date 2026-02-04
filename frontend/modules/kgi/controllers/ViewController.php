<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use FFI\Exception as FFIException;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class ViewController extends Controller
{
	public function beforeAction($action)
	{
		if (Yii::$app->user->id == '') {
			Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
			return false;
		}
		return parent::beforeAction($action);
	}
	public function actionIndex($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}

		$kgiHistoryId = $param["kgiHistoryId"] ?? 0;
		$kgiId = $param["kgiId"];
		$role = UserRole::userRight();
		$adminId = $gmId = $teamLeaderId = $managerId = $supervisorId = $staffId = '';

		if ($role == 7) $adminId = Yii::$app->user->id;
		if ($role == 6) $gmId = Yii::$app->user->id;
		if ($role == 5) $managerId = Yii::$app->user->id;
		if ($role == 4) $supervisorId = Yii::$app->user->id;
		if ($role == 3) $teamLeaderId = Yii::$app->user->id;
		if ($role == 1 || $role == 2) $staffId = Yii::$app->user->id;

		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$kgis = Api::connectApi(Path::Api() . 'kgi/management/kgi-history-summarize?kgiId=' . $kgiId);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$countAllCompany = count($allCompany);
		$companyPic = $countAllCompany > 0 ? Company::randomPic($allCompany, 3) : [];
		$totalBranch = Branch::totalBranch();
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		return $this->render('kgi_view', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgis" => $kgis,
			"kgiId" => $kgiId,
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"isManager" => $isManager,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch,
		]);
	}

	public function actionKgiTeamHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kgiTeamId = $param["kgiTeamId"];
		$teamId = $param["teamId"];
		$kgiId = $param["kgiId"];

		$kgiTeamsHistory = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history-summarize?kgiTeamId=' . $kgiTeamId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$countAllCompany = count($allCompany);
		$companyPic = $countAllCompany > 0 ? Company::randomPic($allCompany, 3) : [];
		$totalBranch = Branch::totalBranch();

		$kgiHistoryData = [];
		if (!empty($kgiTeamsHistory)) {
			foreach ($kgiTeamsHistory as $year => $months) {
				if (!is_array($months)) continue;
				foreach ($months as $month => $history) {
					if (!is_array($history)) continue;

					$kgiHistoryData[$year][$month] = [
						"kgiTeamHistoryId" => $history["kgiTeamHistoryId"] ?? null,
						"target" => $history['target'] ?? null,
						"unit" => $history['unit'] ?? null,
						"month" => ModelMaster::fullMonthText($month),
						"year" => $year,
						"teamId" => $teamId,
						"kgiId" => $kgiId,
						"status" => $history['status'] ?? null,
						"quantRatio" => $history["quantRatio"] ?? null,
						"code" => $history["code"] ?? null,
						"result" => $history['result'] ?? null,
						"ratio" => $history['ratio'] ?? null,
						"amountType" => $history["amountType"] ?? null,
						"isOver" => $history['isOver'] ?? null,
						"fromDate" => $history['fromDate'] ?? null,
						"toDate" => $history['toDate'] ?? null,
						"kgiEmployee" => KgiEmployee::countKgiEmployeeInTeam($teamId, $kgiId, $month, $year),
						"countTeam" => $history["countTeam"] ?? 0
					];
				}
			}
		}

		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

		return $this->render('kgi_team_history', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgiTeamsHistory" => $kgiHistoryData,
			"kgiId" => $kgiId,
			"kgiTeamId" => $kgiTeamId,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager,
			"teamId" => $teamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	public function actionKgiIndividualHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kgiEmployeeId = $param["kgiEmployeeId"];
		$kgiId = $param["kgiId"];

		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgis = Api::connectApi(Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$kgiEmployeeHistory = Api::connectApi(Path::Api() . 'kgi/kgi-personal/kgi-individual-summarize?kgiEmployeeId=' . $kgiEmployeeId);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

		$countAllCompany = count($allCompany);
		$companyPic = $countAllCompany > 0 ? Company::randomPic($allCompany, 3) : [];
		$totalBranch = Branch::totalBranch();

		// กรองข้อมูล teamMate และ countTeamEmployee
		$teamMate = [];
		$countTeamEmployee = 0;
		if (is_array($kgis) && !empty($kgis)) {
			foreach ($kgis as $value) {
				if (
					isset($value['kgiEmployeeId'], $value['kgiId']) &&
					$value['kgiEmployeeId'] == $kgiEmployeeId &&
					$value['kgiId'] == $kgiId
				) {
					$teamMate = $value['teamMate'] ?? [];
					$countTeamEmployee = $value['countTeamEmployee'] ?? 0;
					break;
				}
			}
		}

		return $this->render('kgi_employee_history', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgiEmployeeHistory" => $kgiEmployeeHistory,
			"kgiEmployeeId" => $kgiEmployeeId,
			"kgiId" => $kgiId,
			"countTeamEmployee" => $countTeamEmployee,
			"teamMate" => $teamMate,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	public function actionKgiHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kgiId = $param["kgiId"];
		$groupId = Group::currentGroupId();
		if ($groupId === null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$kgiHistoryId = $param["kgiHistoryId"] ?? 0;
		$openTab = $param["openTab"] ?? 0;
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		//throw new exception(print_r($kgiDetail, true));
		$countAllCompany = count($allCompany);
		$companyPic = $countAllCompany > 0 ? Company::randomPic($allCompany, 3) : [];
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		$totalBranch = Branch::totalBranch();

		return $this->render('kgi_history', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kgiHistoryId" => $kgiHistoryId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	// public function actionAllKgiHistory2()
	// {
	// 	$kgiId = $_POST["kgiId"];
	// 	$kgiHistoryId = $_POST["kgiHistoryId"];
	// 	$api = curl_init();
	// 	curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
	// 	curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

	// 	curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
	// 	$history = curl_exec($api);
	// 	$history = json_decode($history, true);
	// 	curl_close($api);
	// 	$monthDetail = [];
	// 	$summarizeMonth = [];
	// 	$res["monthlyDetailHistoryText"] = "";
	// 	if ($kgiHistoryId != 0) {
	// 		$kgiHistory = KgiHistory::find()
	// 			->where(["kgiHistoryId" => $kgiHistoryId])
	// 			->asArray()
	// 			->one();
	// 		$year = $kgiHistory["year"];
	// 		$month = $kgiHistory["month"];
	// 	} else {
	// 		$year = '';
	// 		$month = '';
	// 	}
	// 	if (isset($history) && count($history) > 0) {
	// 		//krsort($history);
	// 		foreach ($history as $kgiHistoryId => $ht):
	// 			if ($year != '' && $month != '' && $ht["year"] <= $year) {
	// 				if ($ht["year"] == $year) {
	// 					if ($ht["month"] <= $month) {
	// 						if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
	// 							$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
	// 							$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
	// 								"creater" => $ht["creater"],
	// 								"title" => $ht["title"],
	// 								"status" => $ht["status"],
	// 								"picture" => $ht["picture"],
	// 								"result" => $ht["result"],
	// 								"createDateTime" => $ht["createDateTime"]
	// 							];
	// 						} else {
	// 							$monthDetail[$ht["year"]][$ht["month"]][0] = [
	// 								"creater" => $ht["creater"],
	// 								"title" => $ht["title"],
	// 								"status" => $ht["status"],
	// 								"picture" => $ht["picture"],
	// 								"result" => $ht["result"],
	// 								"createDateTime" => $ht["createDateTime"]
	// 							];
	// 							$summarizeMonth[$ht["year"]][$ht["month"]] = [
	// 								"year" => $ht["year"],
	// 								"month" => ModelMaster::fullMonthText($ht["month"]),
	// 								"result" => $ht["result"],
	// 								"target" => $ht["target"],
	// 								"kgiHistoryId" => $kgiHistoryId

	// 							];
	// 						}
	// 					}
	// 				} else {
	// 					if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
	// 						$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
	// 						$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
	// 							"creater" => $ht["creater"],
	// 							"title" => $ht["title"],
	// 							"status" => $ht["status"],
	// 							"picture" => $ht["picture"],
	// 							"result" => $ht["result"],
	// 							"createDateTime" => $ht["createDateTime"]
	// 						];
	// 					} else {
	// 						$monthDetail[$ht["year"]][$ht["month"]][0] = [
	// 							"creater" => $ht["creater"],
	// 							"title" => $ht["title"],
	// 							"status" => $ht["status"],
	// 							"picture" => $ht["picture"],
	// 							"result" => $ht["result"],
	// 							"createDateTime" => $ht["createDateTime"]
	// 						];
	// 						$summarizeMonth[$ht["year"]][$ht["month"]] = [
	// 							"year" => $ht["year"],
	// 							"month" => ModelMaster::fullMonthText($ht["month"]),
	// 							"result" => $ht["result"],
	// 							"target" => $ht["target"],
	// 							"kgiHistoryId" => $kgiHistoryId

	// 						];
	// 					}
	// 				}
	// 			} else {
	// 				if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
	// 					$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
	// 					$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
	// 						"creater" => $ht["creater"],
	// 						"title" => $ht["title"],
	// 						"status" => $ht["status"],
	// 						"picture" => $ht["picture"],
	// 						"result" => $ht["result"],
	// 						"createDateTime" => $ht["createDateTime"]
	// 					];
	// 				} else {
	// 					$monthDetail[$ht["year"]][$ht["month"]][0] = [
	// 						"creater" => $ht["creater"],
	// 						"title" => $ht["title"],
	// 						"status" => $ht["status"],
	// 						"picture" => $ht["picture"],
	// 						"result" => $ht["result"],
	// 						"createDateTime" => $ht["createDateTime"]
	// 					];
	// 					$summarizeMonth[$ht["year"]][$ht["month"]] = [
	// 						"year" => $ht["year"],
	// 						"month" => ModelMaster::fullMonthText($ht["month"]),
	// 						"result" => $ht["result"],
	// 						"target" => $ht["target"],
	// 						"kgiHistoryId" => $kgiHistoryId

	// 					];
	// 				}
	// 			}
	// 		endforeach;
	// 		$res["monthlyDetailHistoryText"] = $this->renderAjax('kgi_update_history', [
	// 			"monthDetail" => $monthDetail,
	// 			"summarizeMonth" => $summarizeMonth
	// 		]);
	// 	}
	// 	return json_encode($res);
	// }
	public function actionAllKgiHistory()
	{
		$kgiId = $_POST["kgiId"];
		$kgiHistoryId = $_POST["kgiHistoryId"] ?? 0;
		$res = ["monthlyDetailHistoryText" => ""];

		// ดึงประวัติ KGI จาก API
		$history = Api::connectApi(Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);

		$monthDetail = [];
		$summarizeMonth = [];

		if ($kgiHistoryId != 0) {
			$kgiHistory = KgiHistory::find()
				->where(["kgiHistoryId" => $kgiHistoryId])
				->asArray()
				->one();
			$year = $kgiHistory["year"];
			$month = $kgiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}

		if (!empty($history)) {
			foreach ($history as $ht) {
				$y = $ht["year"];
				$m = $ht["month"];

				// ตรวจสอบเงื่อนไขปี-เดือน
				if ($year != '' && $month != '' && $y <= $year && ($y < $year || $m <= $month)) {
					// สร้าง array ของ monthDetail
					$monthDetail[$y][$m][] = [
						"creater" => $ht["creater"],
						"title" => $ht["title"],
						"status" => $ht["status"],
						"picture" => $ht["picture"],
						"result" => $ht["result"],
						"createDateTime" => $ht["createDateTime"]
					];
					$summarizeMonth[$y][$m] = [
						"year" => $y,
						"month" => ModelMaster::fullMonthText($m),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kgiHistoryId" => $kgiHistoryId
					];
				} else {
					// สำหรับ history ที่ไม่มีปี-เดือนกำหนด
					$monthDetail[$y][$m][] = [
						"creater" => $ht["creater"],
						"title" => $ht["title"],
						"status" => $ht["status"],
						"picture" => $ht["picture"],
						"result" => $ht["result"],
						"createDateTime" => $ht["createDateTime"]
					];
					$summarizeMonth[$y][$m] = [
						"year" => $y,
						"month" => ModelMaster::fullMonthText($m),
						"result" => $ht["result"],
						"target" => $ht["target"],
						"kgiHistoryId" => $kgiHistoryId
					];
				}
			}

			$res["monthlyDetailHistoryText"] = $this->renderAjax('kgi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}

		return json_encode($res);
	}

	public function actionKgiTeamEmployee()
	{
		
		$kgiId = $_POST["kgiId"];
		$kgiHistoryId = $_POST["kgiHistoryId"];
		// throw new exception(print_r($kgiHistoryId, true));
		$res["kpiEmployeeTeam"] = "";
		$kgiTeams = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-summarize?kgiId=' . $kgiId);
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/kgi-personal/assigned-kgi-employee?kgiId=' . $kgiId . '&&kgiHistoryId=0');
		$res["kgiEmployeeTeam"] = $this->renderAjax("kgi_employee_team_all", [
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"kgiHistoryId" => $kgiHistoryId
		]);

		return json_encode($res);
	}

	public function actionKgiIssue()
	{
		$kgiId = $_POST["kgiId"];
		$userId = Yii::$app->user->id;
		$employeeId = User::employeeIdFromUserId($userId);
		$res = ["kgiIssue" => ""];

		$kgiIssue = Api::connectApi(Path::Api() . 'kgi/management/kgi-issue?kgiId=' . $kgiId);
		$profile = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');

		$res["kgiIssue"] = $this->renderAjax("kgi_issue_solution", [
			"kgiId" => $kgiId,
			"kgiIssue" => $kgiIssue,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kgiName" => $kgiDetail["kgiName"]
		]);

		return json_encode($res);
	}

	public function actionKgiChart()
	{
		$kgiId = $_POST["kgiId"];
		$kgiHistoryId = $_POST["kgiHistoryId"];

		$history = Api::connectApi(Path::Api() . 'kgi/management/kgi-history-for-chart?kgiId=' . $kgiId . "&&kgiHistoryId=" . $kgiHistoryId);

		$monthDetail = [];
		$summarizeMonth = [];
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		$res["monthlyDetailHistoryText"] = "";

		if ($kgiHistoryId != 0) {
			$kgiHistory = KgiHistory::find()
				->where(["kgiHistoryId" => $kgiHistoryId])
				->asArray()
				->one();
			$year = $kgiHistory["year"];
			$month = $kgiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}

		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kgiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"kgiHistoryId" => $kgiHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kgiHistoryId" => $kgiHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"kgiHistoryId" => $kgiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kgiHistoryId" => $kgiHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"kgiHistoryId" => $kgiHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kgiHistoryId" => $kgiHistoryId
						];
					}
				}
				$i++;
			endforeach;
		}

		$summarizeMonth2 = array_slice($summarizeMonth2, -8);
		foreach ($summarizeMonth2 as $index => $data):
			$target[$index] = $data["target"];
			$result[$index] = $data["result"];
			$targetText .= $target[$index] . ',';
			$resultText .= $result[$index] . ',';
			$monthText .= '"' . substr($data["month"], 0, 3) . substr($data["year"], -2) . '",';
		endforeach;

		$monthText = substr($monthText, 0, -1);
		$targetText = substr($targetText, 0, -1);
		$resultText = substr($resultText, 0, -1);

		$res["kgiChart"] = $this->renderAjax('kgi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);

		return json_encode($res);
	}

	public function actionKgiKpi()
	{
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		if ($role == 7) {
			$adminId = Yii::$app->user->id;
		}
		if ($role == 6) {
			$gmId = Yii::$app->user->id;
		}
		if ($role == 5) {
			$managerId = Yii::$app->user->id;
		}
		if ($role == 4) {
			$supervisorId = Yii::$app->user->id;
		}
		if ($role == 3) {
			$teamLeaderId = Yii::$app->user->id;
		}
		if ($role == 1 || $role == 2) {
			$staffId = Yii::$app->user->id;
		}

		$kgiId = $_POST["kgiId"];

		$kgiHasKpi = Api::connectApi(Path::Api() . 'kgi/management/kgi-has-kpi?kgiId=' . $kgiId);
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");

		$ghp = [];

		$res["kpi"] = $this->renderAjax('kgi_kpi', [
			"kgiHasKpi" => $kgiHasKpi,
			"kgiId" => $kgiId,
			"kgiDetail" => $kgiDetail,
			"ghp" => $ghp,
			"role" => $role
		]);

		return json_encode($res);
	}

	public function actionKgiHasKpi()
	{
		$role = UserRole::userRight();
		$adminId = '';
		$gmId = '';
		$teamLeaderId = '';
		$managerId = '';
		$supervisorId = '';
		$staffId = '';
		if ($role == 7) {
			$adminId = Yii::$app->user->id;
		}
		if ($role == 6) {
			$gmId = Yii::$app->user->id;
		}
		if ($role == 5) {
			$managerId = Yii::$app->user->id;
		}
		if ($role == 4) {
			$supervisorId = Yii::$app->user->id;
		}
		if ($role == 3) {
			$teamLeaderId = Yii::$app->user->id;
		}
		if ($role == 1 || $role == 2) {
			$staffId = Yii::$app->user->id;
		}
		$kgiId = $_POST["kgiId"];
		$kgiHasKpi = Api::connectApi(Path::Api() . 'kgi/management/kgi-has-kpi?kgiId=' . $kgiId);
		$kgiDetail = Api::connectApi(Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kpis = Api::connectApi(Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$ghp = [];
		$res["kpi"] = $this->renderAjax('kpi', [
			"kgiHasKpi" => $kgiHasKpi,
			"kgiId" => $kgiId,
			"kgiDetail" => $kgiDetail,
			"kpis" => $kpis,
			"ghp" => $ghp
		]);
		return json_encode($res);
	}

	public function actionKpiTeam()
	{
		$role = UserRole::userRight();
		$kpiId = $_POST["kpiId"];
		$userId = Yii::$app->user->id;
		$kpiTeams = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team2?kpiId=' . $kpiId);
		$res["kpiTeam"] = $this->renderAjax('kpi_team', [
			"kpiTeams" => $kpiTeams
		]);
		return json_encode($res);
	}
	public function actionKgiTeamHistoryView()
	{
		$kgiId = $_POST['kgiId'];
		$teamId = $_POST['teamId'];
		$kgiHistoryId = $_POST['kgiHistoryId'];
		$kgiTeam = KgiTeam::find()->select('kgiTeamId')
			->where(["teamId" => $teamId, "kgiId" => $kgiId, "status" => [1, 2]])
			->asArray()
			->one();
		$kgi = Kgi::find()->where(["kgiId" => $kgiId])->asArray()->one();
		$team = Team::find()->where(["teamId" => $teamId])->asArray()->one();
		$departnemtName = Department::departmentNAme($team["departmentId"]);
		if (isset($kgiTeam) && !empty($kgiTeam)) {
			$kgiTeamId = $kgiTeam["kgiTeamId"];
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		$kgiTeamHistory = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team-history-view?kgiTeamId=' . $kgiTeamId);
		$teamText = $this->renderAjax('kgi_team_history_view', [
			"kgiTeamHistory" => $kgiTeamHistory,
			"team" => $team,
			"departmentName" => $departnemtName,
			"code" => $kgi["code"],
			"kgiId" => $kgi["kgiId"],
			"viewType" => $_POST['viewType'],
			"kgiHistoryId" => $kgiHistoryId
		]);
		$res["kgiTeam"] = $kgiTeam;
		$res["history"] = $teamText;
		return json_encode($res);
	}

	public function actionUpdateKgiTeamHistory()
	{
		$history = KgiTeamHistory::find()
			->where(['not in', 'status', [1, 2, 4, 5, 8, 99]])
			->all();
		foreach ($history as $kt):
			$kt->delete();
		endforeach;
		$kgiTeam = KgiTeam::find()->where(["status" => [1, 2, 4]])->asArray()->all();
		foreach ($kgiTeam as $kt):
			$history = KgiTeamHistory::find()->where(["kgiTeamId" => $kt["kgiTeamId"]])->asArray()->one();
			if (!isset($history) || empty($history)) {
				$kgiTeamHistory = new KgiTeamHistory();
				$kgiTeamHistory->kgiTeamId = $kt["kgiTeamId"];
				$kgiTeamHistory->target = $kt["target"];
				$kgiTeamHistory->result = $kt["result"];
				$kgiTeamHistory->month = $kt["month"];
				$kgiTeamHistory->year = $kt["year"];
				$kgiTeamHistory->status = $kt["status"];
				$kgiTeamHistory->createrId = $kt["createrId"];
				$kgiTeamHistory->createDateTime = new Expression('NOW()');
				$kgiTeamHistory->updateDateTime = new Expression('NOW()');
				$kgiTeamHistory->save(false);
			}
		endforeach;
	}
}
