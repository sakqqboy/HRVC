<?php

namespace backend\modules\evaluation\controllers;

use backend\models\hrvc\BonusRecord;
use backend\models\hrvc\BonusTerm;
use backend\models\hrvc\Department;
use backend\models\hrvc\Employee;
use backend\models\hrvc\EmployeePimWeight;
use backend\models\hrvc\Environment;
use backend\models\hrvc\Frame;
use backend\models\hrvc\FrameTerm;
use backend\models\hrvc\TermItem;
use backend\models\hrvc\Title;
use common\models\ModelMaster;
use backend\models\hrvc\EmployeeEvaluator;
use backend\models\hrvc\EmployeeSalary;
use backend\models\hrvc\Rank;
use Exception;
use yii\db\Expression;
use yii\web\Controller;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class BonusController extends Controller
{
	public function actionIndex()
	{
	}
	public function actionBonusList($termId, $branchId)
	{
		$employees = Employee::find()
			->select('employee.employeeFirstname,employee.employeeSurename,t.titleName,t.titleId,d.departmentName,d.departmentId,
			employee.employeeId,employee.picture')
			->JOIN("LEFT JOIN", "title t", "employee.titleId=t.titleId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=employee.departmentId")
			->where([
				"employee.status" => [1, 2, 4],
				"employee.branchId" => $branchId
			])
			->orderBy('d.departmentName')
			->asArray()
			->all();
		$data = [];
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $employee) :
				$currentSalary = EmployeeSalary::evaluationSalary($employee["employeeId"], $termId);
				$rank = Rank::calculateEmployeeRank($termId, $employee["employeeId"]);
				$bonusRate = '-';
				$bonus = '-';
				$rankName = '-';
				$adjustment = 0.00;
				$trueBonusRate = '0';
				if (!isset($currentSalary) || empty($currentSalary)) {
					$currentSalary["salary"] = EmployeeSalary::EmployeeCurrentSalary($employee["employeeId"]);
				}
				if (isset($rank["bonusRate"]) && isset($currentSalary["salary"]) && $currentSalary["salary"] != '-') {
					$bonus = $rank["bonusRate"] * $currentSalary["salary"];
				}
				if (isset($rank["bonusRate"])) {
					$bonusRate = $rank["bonusRate"];
				}
				if (isset($currentSalary["bonus"]) && $currentSalary["salary"] && is_numeric($currentSalary["salary"])) {
					if ($currentSalary["bonus"] > $currentSalary["salary"]) {
						$adjustment = $currentSalary["bonus"] - $currentSalary["salary"];
					}
				} else {
					if (isset($rank["bonusRate"]) && is_numeric($currentSalary["salary"])) {
						$adjustment = $currentSalary["salary"] * $rank["bonusRate"];
					}
				}
				if (isset($rank["rankName"])) {
					$rankName = $rank["rankName"];
				}
				if (isset($currentSalary["salary"]) && is_numeric($currentSalary["salary"]) && isset($currentSalary["finalAdjustment"]) && $currentSalary["salary"] != 0) {
					$trueBonusRate = $currentSalary["finalAdjustment"] / $currentSalary["salary"];
				}
				if ($trueBonusRate == 0 && isset($currentSalary["bonusRate"])) {
					$trueBonusRate = $currentSalary["bonusRate"];
					if (isset($currentSalary["finalAdjustment"]) && $currentSalary["finalAdjustment"] == 0.00) {
						$trueBonusRate = $currentSalary["bonusRate"];
					}
				}
				$data[$employee["departmentId"]][$employee["employeeId"]] = [
					"firstname" => $employee["employeeFirstname"],
					"surename" => $employee["employeeSurename"],
					"titleName" => $employee["titleName"],
					"picture" => Employee::employeeImage($employee["employeeId"]),
					//"rank" => Rank::calculateEmployeeRank($termId, $employee["employeeId"]),

					//"bonusRate" => "1.2x",
					"rankName" => isset($currentSalary["rankName"]) ? $currentSalary["rankName"] : $rankName,
					"currentSalary" => isset($currentSalary["salary"]) ? $currentSalary["salary"] : EmployeeSalary::EmployeeCurrentSalary($employee["employeeId"]),
					"bonus" =>  isset($currentSalary["bonus"]) ? $currentSalary["bonus"] : $bonus,
					"bonusRate" =>  isset($currentSalary["bonusRate"]) ? $currentSalary["bonusRate"] : $bonusRate,
					"adjustment" => $adjustment, //
					"finalAdjustment" => isset($currentSalary["finalAdjustment"]) ? $currentSalary["finalAdjustment"] : 0,
					"payableBonus" => "", isset($currentSalary["finalAdjustment"]) ? $currentSalary["finalAdjustment"] : 0,
					"trueRateBonus" => $trueBonusRate
				];
			endforeach;
		}
		//var_dump($data);
		//throw new Exception(print_r($data, true));
		return json_encode($data);
	}
	public function actionBonusDetail($termId, $branchId)
	{
		$bonusTerm = BonusTerm::find()
			->where(["termId" => $termId, "status" => 1])
			->orderBy("createDateTime DESC")
			->asArray()
			->one();
		$data = [
			"budget" => 0,
			"totalBonus" => 0,
			"totalAdjust" => 0,
			"totalPayable" => 0,
			"totalSalary" => 0,
			"bonusRatio" => 0
		];
		$employees = Employee::find()
			->select('employeeId')
			->where(["status" => [1, 2, 4], "branchId" => $branchId])
			->asArray()
			->all();
		$total = 0;
		$totalSalary = 0;
		if (isset($employees) && count($employees) > 0) {
			foreach ($employees as $employee) :
				$bonusRecord = BonusRecord::find()->where(["employeeId" => $employee["employeeId"], "termId" => $termId])->one();
				$bonus = Rank::calculateEmployeeRank($termId, $employee["employeeId"]);
				if (isset($bonusRecord) && !empty($bonusRecord)) {
					$currentSalary = $bonusRecord["salary"];
				} else {
					$currentSalary = EmployeeSalary::EmployeeCurrentSalary($employee["employeeId"]);
					if (is_numeric($currentSalary) && isset($bonus["bonusRate"]) && is_numeric($bonus["bonusRate"])) {
						$adjustment = $bonus["bonusRate"] - $currentSalary;
						if ($adjustment < 0) {
							$adjustment = 0;
						}
						$bonusRecord = new BonusRecord();
						$bonusRecord->termId = $termId;
						$bonusRecord->employeeId = $employee["employeeId"];
						$bonusRecord->rankId = $bonus["rankId"];
						$bonusRecord->rankName = $bonus['rankName'];
						$bonusRecord->salary = $currentSalary;
						$bonusRecord->bonusRate = $bonus["bonusRate"];
						$bonusRecord->finalAdjustment = $adjustment;
						$bonusRecord->creator = null;
						$bonusRecord->status = 1;
						$bonusRecord->createDateTime = new Expression('NOW()');
						$bonusRecord->updateDateTime = new Expression('NOW()');
						$bonusRecord->save(false);
					}
				}
				if (is_numeric($currentSalary)) {
					$totalSalary += $currentSalary;
				}
				if (is_numeric($currentSalary) && isset($bonus["bonusRate"]) && is_numeric($bonus["bonusRate"])) {
					$total = $total + ($currentSalary * $bonus["bonusRate"]);
				}
			endforeach;
		}
		if (isset($bonusTerm) && !empty($bonusTerm)) {
			$adjust = $bonusTerm["budget"] - $total;
			if ($adjust > 0) {
				$adjust = 0;
			}
			if ($totalSalary == 0) {
				$bonusRatio = 0;
			} else {
				$bonusRatio = $total / $totalSalary;
			}
			$data = [
				"budget" => $bonusTerm["budget"],
				"totalBonus" => $total,
				"totalAdjust" => $adjust,
				"totalPayable" => $total,
				"totalSalary" => $totalSalary,
				"bonusRatio" => $bonusRatio
			];
		}
		return json_encode($data);
	}
}
