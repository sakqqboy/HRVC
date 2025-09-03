<?php

namespace frontend\modules\kpi\controllers;

use frontend\models\hrvc\KpiHistory;
use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\KpiEmployee;

use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `kpi` module
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
		$kpiId = $param["kpiId"];
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
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$kpis = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-summarize?kpiId=' . $kpiId);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		return $this->render('kpi_view', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpis" => $kpis,
			"kpiId" => $kpiId,
			"units" => $units,
			"companies" => $companies,
			"months" => $months,
			"isManager" => $isManager,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionKpiTeamHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiTeamId = $param["kpiTeamId"];
		$teamId = $param["teamId"];
		$kpiId = $param["kpiId"];
		$kpiTeamsHistory = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-history-summarize?kpiTeamId=' . $kpiTeamId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . "&&kpiHistoryId=0");
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		$kpiHistoryData = [];
		if (!empty($kpiTeamsHistory)) {
			foreach ($kpiTeamsHistory as $year => $months) {
				if (!is_array($months)) {
					continue;
				}
				foreach ($months as $month => $history) {
					if (!is_array($history)) {
						continue;
					}
					$kpiHistoryData[$year][$month] = [
						"kpiTeamHistoryId" => $history["kpiTeamHistoryId"] ?? null,
						"target" => $history['target'] ?? null,
						"unit" => $history['unit'] ?? null,
						"month" => ModelMaster::fullMonthText($month),
						"year" => $year,
						"teamId" => $teamId,
						"kpiId" => $kpiId,
						"status" => $history['status'] ?? null,
						"quantRatio" => $history["quantRatio"] ?? null,
						"code" => $history["code"] ?? null,
						"result" => $history['result'] ?? null,
						"ratio" => $history['ratio'] ?? null,
						"amountType" => $history["amountType"] ?? null,
						"isOver" => $history['isOver'] ?? null,
						"fromDate" => $history['fromDate'] ?? null,
						"toDate" => $history['toDate'] ?? null,
						"kpiEmployee" => KpiEmployee::countKpiEmployeeInTeam($teamId, $kpiId, $year, $month),
						"countTeam" => $history["countTeam"] ?? 0
					];
				}
			}
		}
		$isManager = UserRole::isManager();
		$months = ModelMaster::monthFull(1);
		return $this->render('kpi_team_history', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpiTeamsHistory" => $kpiHistoryData,
			"kpiTeamId" => $kpiTeamId,
			"kpiId" => $kpiId,
			"units" => $units,
			"isManager" => $isManager,
			"months" => $months,
			"teamId" => $teamId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}

	public function actionKpiIndividualHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiEmployeeId = $param["kpiEmployeeId"];
		$kpiId = $param["kpiId"];
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . "&&kpiHistoryId=0");
		$kpiEmployeeHistory = Api::connectApi(Path::Api() . 'kpi/kpi-personal/kpi-individual-summarize?kpiEmployeeId=' . $kpiEmployeeId);
		$kpis = Api::connectApi(Path::Api() . 'kpi/kpi-personal/employee-kpi?userId=' . Yii::$app->user->id . '&&role=' . $role);
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$totalBranch = Branch::totalBranch();
		$teamMate = [];
		$countTeamEmployee = 0;
		if (is_array($kpis) && !empty($kpis)) {
			foreach ($kpis as $key => $value) {
				if (
					isset($value['kpiEmployeeId'], $value['kpiId']) &&
					$value['kpiEmployeeId'] == $kpiEmployeeId &&
					$value['kpiId'] == $kpiId
				) {
					if (isset($value['teamMate']) && isset($value['countTeamEmployee'])) {
						$teamMate = $value['teamMate'];
						$countTeamEmployee = $value['countTeamEmployee'];
					}
					break;
				}
			}
		}
		return $this->render('kpi_employee_history', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpiEmployeeHistory" => $kpiEmployeeHistory,
			"kpiId" =>  $kpiId,
			"kpiEmployeeId" =>  $kpiEmployeeId,
			"teamMate" =>  $teamMate,
			"countTeamEmployee" =>  $countTeamEmployee,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionKpiHistory($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$role = UserRole::userRight();
		$kpiId = $param["kpiId"];
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		$kpiHistoryId = $param["kpiHistoryId"] ?? 0;
		$openTab = $param["openTab"] ?? 0;
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . "&&kpiHistoryId=" . $kpiHistoryId);
		$companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
		$allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
		$countAllCompany = 0;
		if (count($allCompany) > 0) {
			$countAllCompany = count($allCompany);
			$companyPic = Company::randomPic($allCompany, 3);
		}
		$months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();
		$totalBranch = Branch::totalBranch();
		return $this->render('kpi_history', [
			"role" => $role,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId,
			"openTab" => $openTab,
			"months" => $months,
			"isManager" => $isManager,
			"units" => $units,
			"companies" => $companies,
			"kpiHistoryId" => $kpiHistoryId,
			"allCompany" => $countAllCompany,
			"companyPic" => $companyPic,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionKpiTeamEmployee()
	{
		$kpiId = $_POST["kpiId"];
		$res["kpiEmployeeTeam"] = "";
		$kpiTeams = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-summarize?kpiId=' . $kpiId);
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/kpi-personal/assigned-kpi-employee?kpiId=' . $kpiId . "&&kpiHistoryId=0");
		$res["kpiEmployeeTeam"] = $this->renderAjax("kpi_employee_team_all", [
			"kpiTeams" => $kpiTeams,
			"kpiDetail" => $kpiDetail,
			"kpiId" => $kpiId
		]);
		return json_encode($res);
	}

	public function actionAllKpiHistory()
	{
		$kpiId = $_POST["kpiId"];
		$kpiHistoryId = $_POST["kpiHistoryId"];
		$history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId . '&&kpiHistoryId=' . $kpiHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
		$res["monthlyDetailHistoryText"] = "";
		if ($kpiHistoryId != 0) {
			$kpiHistory = KpiHistory::find()->where(["kpiHistoryId" => $kpiHistoryId])->asArray()->one();
			$year = $kpiHistory["year"];
			$month = $kpiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			foreach ($history as $kpiHistoryId2 => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year && $ht["month"] <= $month) {
						if (isset($monthDetail[$ht["year"]][$ht["month"]])) {
							$totalCount = count($monthDetail[$ht["year"]][$ht["month"]]);
							$monthDetail[$ht["year"]][$ht["month"]][$totalCount] = [
								"creater" => $ht["creater"],
								"title" => $ht["title"],
								"status" => $ht["status"],
								"picture" => $ht["picture"],
								"result" => $ht["result"],
								"createDateTime" => $ht["createDate"]
							];
						} else {
							$monthDetail[$ht["year"]][$ht["month"]][0] = [
								"creater" => $ht["creater"],
								"title" => $ht["title"],
								"status" => $ht["status"],
								"picture" => $ht["picture"],
								"result" => $ht["result"],
								"createDateTime" => $ht["createDate"]
							];
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId2
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
							"kpiHistoryId" => $kpiHistoryId2
						];
					}
				}
			endforeach;
			$res["monthlyDetailHistoryText"] = $this->renderAjax('kpi_update_history', [
				"monthDetail" => $monthDetail,
				"summarizeMonth" => $summarizeMonth
			]);
		}
		return json_encode($res);
	}
	public function actionKpiIssue()
	{
		$kpiId = $_POST["kpiId"];
		$userId = Yii::$app->user->id;
		$employeeId = User::employeeIdFromUserId($userId);
		$res["kpiIssue"] = "";
		$kpiIssue = Api::connectApi(Path::Api() . 'kpi/management/kpi-issue?kpiId=' . $kpiId);
		$profile = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
		$res["kpiIssue"] = $this->renderAjax("kpi_issue_solution", [
			"kpiId" => $kpiId,
			"kpiIssue" => $kpiIssue,
			"profile" => $profile,
			"employeeId" => $employeeId,
			"kpiName" => $kpiDetail["kpiName"]
		]);
		return json_encode($res);
	}
	public function actionKpiChart()
	{
		$kpiHistoryId = $_POST["kpiHistoryId"];
		$kpiId = $_POST["kpiId"];
		$history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-for-chart?kpiId=' . $kpiId . '&&kpiHistoryId=' . $kpiHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
		$year = 2024;
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		$res["monthlyDetailHistoryText"] = "";
		if ($kpiHistoryId != 0) {
			$kpiHistory = KpiHistory::find()->where(["kpiHistoryId" => $kpiHistoryId])->asArray()->one();
			$year = $kpiHistory["year"];
			$month = $kpiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kpiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year && $ht["month"] <= $month) {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId
							];
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kfpHistoryId" => $kpiHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kpiHistoryId" => $kpiHistoryId
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
		$res["kpiChart"] = $this->renderAjax('kpi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}

	public function actionKpiTeamChart()
	{
		$kpiHistoryId = $_POST["kpiHistoryId"];
		$kpiId = $_POST["kpiId"];
		$history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-for-chart?kpiId=' . $kpiId . '&&kpiHistoryId=' . $kpiHistoryId);
		$monthDetail = [];
		$summarizeMonth = [];
		$year = 2024;
		$months = ModelMaster::month();
		$monthText = '';
		$target = [];
		$targetText = "";
		$resultText = "";
		$result = [];
		$res["monthlyDetailHistoryText"] = "";
		if ($kpiHistoryId != 0) {
			$kpiHistory = KpiHistory::find()
				->where(["kpiHistoryId" => $kpiHistoryId])
				->asArray()
				->one();
			$year = $kpiHistory["year"];
			$month = $kpiHistory["month"];
		} else {
			$year = '';
			$month = '';
		}
		if (isset($history) && count($history) > 0) {
			$i = 0;
			foreach ($history as $kpiHistoryId => $ht):
				if ($year != '' && $month != '' && $ht["year"] <= $year) {
					if ($ht["year"] == $year) {
						if ($ht["month"] <= $month) {
							if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
								$summarizeMonth[$ht["year"]][$ht["month"]] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kpiHistoryId" => $kpiHistoryId
								];
								$summarizeMonth2[$i] = [
									"year" => $ht["year"],
									"month" => ModelMaster::fullMonthText($ht["month"]),
									"result" => $ht["result"],
									"target" => $ht["target"],
									"kpiHistoryId" => $kpiHistoryId
								];
							}
						}
					} else {
						if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
							$summarizeMonth[$ht["year"]][$ht["month"]] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId
							];
							$summarizeMonth2[$i] = [
								"year" => $ht["year"],
								"month" => ModelMaster::fullMonthText($ht["month"]),
								"result" => $ht["result"],
								"target" => $ht["target"],
								"kpiHistoryId" => $kpiHistoryId
							];
						}
					}
				} else {
					if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
						$summarizeMonth[$ht["year"]][$ht["month"]] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kfpHistoryId" => $kpiHistoryId
						];
						$summarizeMonth2[$i] = [
							"year" => $ht["year"],
							"month" => ModelMaster::fullMonthText($ht["month"]),
							"result" => $ht["result"],
							"target" => $ht["target"],
							"kpiHistoryId" => $kpiHistoryId
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
		$res["kpiChart"] = $this->renderAjax('kpi_chart', [
			"month" => $monthText,
			"target" => $targetText,
			"result" => $resultText
		]);
		return json_encode($res);
	}
	public function actionKpiKgi()
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
		$kpiId = $_POST["kpiId"];
		$kgiHasKpi = Api::connectApi(Path::Api() . 'kpi/management/kgi-kpi?kpiId=' . $kpiId);
		$kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
		$kgis = Api::connectApi(Path::Api() . 'kgi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
		$ghp = [];
		$res["kgi"] = $this->renderAjax('kgi_kpi', [
			"kgiHasKpi" => $kgiHasKpi,
			"kpiId" => $kpiId,
			"kpiDetail" => $kpiDetail,
			"kgis" => $kgis,
			"ghp" => $ghp,
			"role" => $role
		]);
		return json_encode($res);
	}

	public function actionKgiTeam()
	{
		$role = UserRole::userRight();
		$kgiId = $_POST["kgiId"];
		$userId = Yii::$app->user->id;
		$kgiTeams = Api::connectApi(Path::Api() . 'kgi/kgi-team/kgi-team2?kgiId=' . $kgiId);
		$res["kgiTeam"] = $this->renderAjax('kgi_team', [
			"kgiTeams" => $kgiTeams
		]);
		return json_encode($res);
	}
	public function actionKpiTeamHistoryView()
	{
		$kpiId = $_POST['kpiId'];
		$teamId = $_POST['teamId'];
		$kpiTeam = KpiTeam::find()->select('kpiTeamId')
			->where(["teamId" => $teamId, "kpiId" => $kpiId, "status" => [1, 2]])
			->asArray()
			->one();
		$kpi = Kpi::find()->where(["kpiId" => $kpiId])->asArray()->one();
		$team = Team::find()->where(["teamId" => $teamId])->asArray()->one();
		$departnemtName = Department::departmentNAme($team["departmentId"]);
		if (isset($kpiTeam) && !empty($kpiTeam)) {
			$kpiTeamId = $kpiTeam["kpiTeamId"];
			$res["status"] = true;
		} else {
			$res["status"] = false;
		}
		$kpiTeamHistory = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-team-history-view?kpiTeamId=' . $kpiTeamId);
		$teamText = $this->renderAjax('kpi_team_history_view', [
			"kpiTeamHistory" => $kpiTeamHistory,
			"team" => $team,
			"departmentName" => $departnemtName,
			"code" => $kpi["code"],
			"kpiId" => $kpi["kpiId"],
			"viewType" => $_POST['viewType']
		]);
		$res["kpiTeam"] = $kpiTeam;
		$res["history"] = $teamText;
		return json_encode($res);
	}

	public function actionUpdateKpiTeamHistory()
	{
		$history = KpiTeamHistory::find()
			->where(['not in', 'status', [1, 2, 4, 5, 8, 99]])
			->all();
		foreach ($history as $kt):
			$kt->delete();
		endforeach;

		$kpiTeam = KpiTeam::find()->where(["status" => [1, 2, 4]])->asArray()->all();
		foreach ($kpiTeam as $kt):
			$history = KpiTeamHistory::find()->where(["kpiTeamId" => $kt["kpiTeamId"]])->asArray()->one();
			if (!isset($history) || empty($history)) {
				$kpiTeamHistory = new KpiTeamHistory();
				$kpiTeamHistory->kpiTeamId = $kt["kpiTeamId"];
				$kpiTeamHistory->target = $kt["target"];
				$kpiTeamHistory->result = $kt["result"];
				$kpiTeamHistory->month = $kt["month"];
				$kpiTeamHistory->year = $kt["year"];
				$kpiTeamHistory->status = $kt["status"];
				$kpiTeamHistory->createrId = $kt["createrId"];
				$kpiTeamHistory->createDateTime = new Expression('NOW()');
				$kpiTeamHistory->updateDateTime = new Expression('NOW()');
				$kpiTeamHistory->save(false);
			}
		endforeach;
	}
	public function actionUpdateKpiEmployeeHistory()
	{

		$kpiEmployee = KpiEmployee::find()->where(["status" => [1, 2, 4]])->asArray()->all();
		foreach ($kpiEmployee as $kt):
			$history = KpiEmployeeHistory::find()->where(["kpiEmployeeId" => $kt["kpiEmployeeId"]])->asArray()->one();
			if (!isset($history) || empty($history)) {
				$kpiEmployeeHistory = new KpiEmployeeHistory();
				$kpiEmployeeHistory->kpiEmployeeId = $kt["kpiEmployeeId"];
				$kpiEmployeeHistory->target = $kt["target"];
				$kpiEmployeeHistory->result = $kt["result"];
				$kpiEmployeeHistory->month = $kt["month"];
				$kpiEmployeeHistory->year = $kt["year"];
				$kpiEmployeeHistory->status = $kt["status"];
				$kpiEmployeeHistory->createrId = $kt["createrId"];
				$kpiEmployeeHistory->createDateTime = new Expression('NOW()');
				$kpiEmployeeHistory->updateDateTime = new Expression('NOW()');
				$kpiEmployeeHistory->save(false);
			}
		endforeach;

		$kgiEmployee = KgiEmployee::find()->where(["status" => [1, 2, 4]])->asArray()->all();
		foreach ($kgiEmployee as $kt):
			$history = KgiEmployeeHistory::find()->where(["kgiEmployeeId" => $kt["kgiEmployeeId"]])->asArray()->one();
			if (!isset($history) || empty($history)) {
				$kgiEmployeeHistory = new KgiEmployeeHistory();
				$kgiEmployeeHistory->kgiEmployeeId = $kt["kgiEmployeeId"];
				$kgiEmployeeHistory->target = $kt["target"];
				$kgiEmployeeHistory->result = $kt["result"];
				$kgiEmployeeHistory->month = $kt["month"];
				$kgiEmployeeHistory->year = $kt["year"];
				$kgiEmployeeHistory->status = $kt["status"];
				$kgiEmployeeHistory->createrId = $kt["createrId"];
				$kgiEmployeeHistory->createDateTime = new Expression('NOW()');
				$kgiEmployeeHistory->updateDateTime = new Expression('NOW()');
				$kgiEmployeeHistory->save(false);
			}
		endforeach;
	}
}
