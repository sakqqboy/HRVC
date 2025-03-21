<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use FFI\Exception as FFIException;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class ViewController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		//$this->setDefault();
		return true;
	}
	public function actionIndex($hash)
	{
		// $testparam = '2kuTjYKCc-NOCkEIOKgdoVOPLb_M7zajc1FJprQi-g0=';
		$param = ModelMaster::decodeParams($hash);
		// throw new Exception(print_r($param,true));
// 
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		if (isset($param["kgiHistoryId"])) {
			$kgiHistoryId = $param["kgiHistoryId"];
		} else {
			$kgiHistoryId = 0;
		}
		$kgiId = $param["kgiId"];
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
			//return $this->redirect(Yii::$app->homeUrl);
		}
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history-summarize?kgiId=' . $kgiId);
		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);
		curl_close($api);
		// throw new Exception(Yii::$app->user->id);
		//throw new Exception(print_r($kgiDetail, true));
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		// throw new Exception(print_r($kgis,true));

		return $this->render('kgi_view', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgis" => $kgis,
			"kgiId" => $kgiId,
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"isManager" => $isManager

		]);
	}
	public function actionKgiTeamHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kgiTeamId = $param["kgiTeamId"];
		$teamId = $param["teamId"];
		$kgiId = $param["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-history-summarize?kgiTeamId=' . $kgiTeamId);
		$kgiTeamsHistory = curl_exec($api);
		$kgiTeamsHistory = json_decode($kgiTeamsHistory, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		
		curl_close($api);
		$kgiHistoryData = [];

		if (!empty($kgiTeamsHistory)) {
			foreach ($kgiTeamsHistory as $year => $months) {
				if (!is_array($months)) {
					continue; // ข้ามค่าที่ไม่ใช่ array
				}

				foreach ($months as $month => $history) {
					if (!is_array($history)) {
						continue; // ข้ามค่าที่ไม่ใช่ array
					}

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
						"kgiEmployee" => KgiEmployee::countKgiEmployeeInTeam($teamId, $kgiId, $month, $year)
					];
				}
			}
		}
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		// throw new Exception(print_r($kgiHistoryData, true));
		return $this->render('kgi_team_history', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgiTeamsHistory" => $kgiHistoryData,
			"kgiId" => $kgiId,
			"kgiTeamId" => $kgiTeamId,
			"units" => $units,
			"months" => $months,
			"isManager" => $isManager,
			// "kgiEmployee" => $kgiEmployee,
			"teamId" => $teamId
		]);
	}
	public function actionKgiIndividualHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kgiEmployeeId = $param["kgiEmployeeId"];
		$kgiId = $param["kgiId"];
		// $kgis = $param["kgis"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		//throw new exception('kgi/kgi-personal/employee-kgi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$kgis = curl_exec($api);
		$kgis = json_decode($kgis, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-personal/kgi-individual-summarize?kgiEmployeeId=' . $kgiEmployeeId);
		$kgiEmployeeHistory = curl_exec($api);
		$kgiEmployeeHistory = json_decode($kgiEmployeeHistory, true);

		// ตรวจสอบว่า $kgis มีข้อมูล
		$teamMate = [];
		$countTeamEmployee = 0;

		if (is_array($kgis) && !empty($kgis)) {
			foreach ($kgis as $key => $value) {
				// กรองข้อมูลตาม $kgiEmployeeId และ $kgiId
				if (
					isset($value['kgiEmployeeId'], $value['kgiId']) &&
					$value['kgiEmployeeId'] == $kgiEmployeeId &&
					$value['kgiId'] == $kgiId
				) {

					// ดึงค่า teamMate และ countTeamEmployee
					if (isset($value['teamMate']) && isset($value['countTeamEmployee'])) {
						$teamMate = $value['teamMate'];
						$countTeamEmployee = $value['countTeamEmployee'];
					}
					break; // ออกจาก loop เมื่อพบข้อมูลที่ต้องการ
				}
			}
		}
		//   throw new Exception(print_r($countTeamEmployee,true));
		curl_close($api);
		return $this->render('kgi_employee_history', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgiEmployeeHistory" => $kgiEmployeeHistory,
			"kgiEmployeeId" => $kgiEmployeeId,
			"kgiId" => $kgiId,
			"countTeamEmployee" => $countTeamEmployee,
			"teamMate" => $teamMate


		]);
	}
	public function actionKgiHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kgiId = $param["kgiId"];
		$openTab = array_key_exists("openTab", $param) ? $param["openTab"] : 0;
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		if (isset($param["kgiHistoryId"])) {
			$kgiHistoryId = $param["kgiHistoryId"];
		} else {
			$kgiHistoryId = 0;
		}
		// throw new Exception(print_r($kgiHistoryId, true));

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		// throw new Exception(print_r($kgiDetail,true));


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-summarize?kgiId=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_close($api);
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		// throw new Exception(print_r($kgiDetail, true));
		return $this->render('kgi_history', [
			"role" => $role,
			"kgiDetail" => $kgiDetail,
			"kgiId" => $kgiId,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kgiTeams" => $kgiTeams,
			"kgiHistoryId" => $kgiHistoryId
		]);
	}
	public function actionAllKgiHistory()
	{
		$kgiId = $_POST["kgiId"];
		$kgiHistoryId = $_POST["kgiHistoryId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
		// $kgi = curl_exec($api);
		// $kgi = json_decode($kgi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId . '&&kgiHistoryId=' . $kgiHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
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
			//krsort($history);
			foreach ($history as $kgiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
								$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
								$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
									"creater" => $ht["creater"],
									"title" => $ht["title"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => $ht["result"],
									"createDateTime" => $ht["createDateTime"]
								];
							} else {
								$monthDetail[$ht["year"]][$ht["month"]][0] = [
									"creater" => $ht["creater"],
									"title" => $ht["title"],
									"status" => $ht["status"],
									"picture" => $ht["picture"],
									"result" => $ht["result"],
									"createDateTime" => $ht["createDateTime"]
								];
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kgiHistoryId" => $kgiHistoryId

								];
							}
						}
					} else {
						if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
							$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
							$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
								"creater" => $ht["creater"],
								"title" => $ht["title"],
								"status" => $ht["status"],
								"picture" => $ht["picture"],
								"result" => $ht["result"],
								"createDateTime" => $ht["createDateTime"]
							];
						} else {
							$monthDetail[$ht["year"]][$ht["month"]][0] = [
								"creater" => $ht["creater"],
								"title" => $ht["title"],
								"status" => $ht["status"],
								"picture" => $ht["picture"],
								"result" => $ht["result"],
								"createDateTime" => $ht["createDateTime"]
							];
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kgiHistoryId" => $kgiHistoryId

							];
						}
					}
				} else {
					if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
						$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
						$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
							"creater" => $ht["creater"],
							"title" => $ht["title"],
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => $ht["result"],
							"createDateTime" => $ht["createDateTime"]
						];
					} else {
						$monthDetail[$ht["year"]][$ht["month"]][0] = [
							"creater" => $ht["creater"],
							"title" => $ht["title"],
							"status" => $ht["status"],
							"picture" => $ht["picture"],
							"result" => $ht["result"],
							"createDateTime" => $ht["createDateTime"]
						];
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kgiHistoryId" => $kgiHistoryId

						];
					}
				}
			endforeach;
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
		$res["kgiEmployeeTeam"] = "";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/kgi-team/kgi-team-summarize?kgiId=' . $kgiId);
		$kgiTeams = curl_exec($api);
		$kgiTeams = json_decode($kgiTeams, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);
		curl_close($api);
		$res["kgiEmployeeTeam"] = $this->renderAjax("kgi_employee_team", [
			"kgiTeams" => $kgiTeams,
			"kgiDetail" => $kgiDetail

		]);
		return json_encode($res);
	}
	public function actionKgiIssue()
	{
		$kgiId = $_POST["kgiId"];
		$userId = Yii::$app->user->id;
		$employeeId = User::employeeIdFromUserId($userId);
		$res["kgiIssue"] = "";

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-issue?kgiId=' . $kgiId);
		$kgiIssue = curl_exec($api);
		$kgiIssue = json_decode($kgiIssue, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$profile = curl_exec($api);
		$profile = json_decode($profile, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_close($api);
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
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history-for-chart?kgiId=' . $kgiId . "&&kgiHistoryId=" . $kgiHistoryId);
		$history = curl_exec($api);
		$history = json_decode($history, true);
		curl_close($api);
		$monthDetail = [];
		$summarizeMonth = [];
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		//ksort($month);
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
			//return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
		}
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-has-kpi?kgiId=' . $kgiId);
		$kgiHasKpi = curl_exec($api);
		$kgiHasKpi = json_decode($kgiHasKpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . "&&kgiHistoryId=0");
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);


		$ghp = [];
		// if (count($kgiHasKpi) > 0) {
		// 	foreach ($kgiHasKpi as $gp):
		// 		$ghp[$gp["kpiId"]] = 1;
		// 	endforeach;
		// }

		curl_close($api);

		$res["kpi"] = $this->renderAjax('kgi_kpi', [
			"kgiHasKpi" => $kgiHasKpi,
			"kgiId" => $kgiId,
			"kgiDetail" => $kgiDetail,
			"kpis" => $kpis,
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
			//return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
		}
		$kgiId = $_POST["kgiId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-has-kpi?kgiId=' . $kgiId);
		$kgiHasKpi = curl_exec($api);
		$kgiHasKpi = json_decode($kgiHasKpi, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId . '&&kgiHistoryId=0');
		$kgiDetail = curl_exec($api);
		$kgiDetail = json_decode($kgiDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$kpis = curl_exec($api);
		$kpis = json_decode($kpis, true);


		$ghp = [];
		// if (count($kgiHasKpi) > 0) {
		// 	foreach ($kgiHasKpi as $gp):
		// 		$ghp[$gp["kpiId"]] = 1;
		// 	endforeach;
		// }

		curl_close($api);

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
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/kpi-team2?kpiId=' . $kpiId);
		//curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/kpi-team/all-team-kpi?userId=' . $userId . '&&role=' . $role);
		$kpiTeams = curl_exec($api);
		$kpiTeams = json_decode($kpiTeams, true);

		curl_close($api);
		//throw new Exception(print_r($kpiTeams, true));
		$res["kpiTeam"] = $this->renderAjax('kpi_team', [
			"kpiTeams" => $kpiTeams
		]);
		return json_encode($res);
	}
}