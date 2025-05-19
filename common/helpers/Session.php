<?php

namespace common\helpers;

use Yii;

class Session
{
	public static function PimFilter($companyId, $branchId, $month, $year, $status, $type)
	{
		$teamId = null;
		$employeeId = null;
		$session = Yii::$app->session;
		$session->open();
		if ($companyId == "" && $branchId == "" && $month == "" && $status == "" && $year == "") {
			if ($session->has('kfi')) {
				$session->remove('kfi');
			}
			if ($session->has('kgi')) {
				$session->remove('kgi');
			}
			if ($session->has('kgiTeam')) {
				$session->remove('kgiTeam');
			}
			if ($session->has('kgiEmployee')) {
				$session->remove('kgiEmployee');
			}
			if ($session->has('kpi')) {
				$session->remove('kpi');
			}
			if ($session->has('kpiTeam')) {
				$session->remove('kpiTeam');
			}
			if ($session->has('kpiEmployee')) {
				$session->remove('kpiEmployee');
			}
		} else {
			if ($session->has('kgiTeam')) {
				$filter = $session->get('kgiTeam');
				$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			} else if ($session->has('kpiTeam')) {
				$filter = $session->get('kpiTeam');
				$teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
			}
			if ($session->has('kgiEmployee')) {
				$filter = $session->get('kgiEmployee');
				$employeeId = isset($filter["employeeId"]) && $filter["employeeId"] != null ? $filter["employeeId"] : null;
			} else if ($session->has('kpiEmployee')) {
				$filter = $session->get('kpiEmployee');
				$employeeId = isset($filter["employeeId"]) && $filter["employeeId"] != null ? $filter["employeeId"] : null;
			}

			$session->set('kfi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
		}
	}
	public static function PimTeamFilter($companyId, $branchId, $teamId, $month, $year, $status, $type)
	{
		$employeeId = null;
		$session = Yii::$app->session;
		$session->open();
		if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "") {
			if ($session->has('kfi')) {
				$session->remove('kfi');
			}
			if ($session->has('kgi')) {
				$session->remove('kgi');
			}
			if ($session->has('kgiTeam')) {
				$session->remove('kgiTeam');
			}
			if ($session->has('kgiEmployee')) {
				$session->remove('kgiEmployee');
			}
			if ($session->has('kpi')) {
				$session->remove('kpi');
			}
			if ($session->has('kpiTeam')) {
				$session->remove('kpiTeam');
			}
			if ($session->has('kpiEmployee')) {
				$session->remove('kpiEmployee');
			}
		} else {

			if ($session->has('kgiEmployee')) {
				$filter = $session->get('kgiEmployee');
				$employeeId = isset($filter["employeeId"]) && $filter["employeeId"] != null ? $filter["employeeId"] : null;
			} else if ($session->has('kpiEmployee')) {
				$filter = $session->get('kpiEmployee');
				$employeeId = isset($filter["employeeId"]) && $filter["employeeId"] != null ? $filter["employeeId"] : null;
			}
			$session->set('kfi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
		}
	}
	public static function PimEmployeeFilter($companyId, $branchId, $teamId, $employeeId, $month, $year, $status, $type)
	{
		$session = Yii::$app->session;
		$session->open();
		if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "" && $employeeId == '') {
			if ($session->has('kfi')) {
				$session->remove('kfi');
			}
			if ($session->has('kgi')) {
				$session->remove('kgi');
			}
			if ($session->has('kgiTeam')) {
				$session->remove('kgiTeam');
			}
			if ($session->has('kgiEmployee')) {
				$session->remove('kgiEmployee');
			}
			if ($session->has('kpi')) {
				$session->remove('kpi');
			}
			if ($session->has('kpiTeam')) {
				$session->remove('kpiTeam');
			}
			if ($session->has('kpiEmployee')) {
				$session->remove('kpiEmployee');
			}
		} else {
			$session->set('kfi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"teamId" => $teamId,
				"employeeId" => $employeeId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
		}
	}
	public static function deleteSession()
	{
		$session = Yii::$app->session;
		$session->open();
		if ($session->has('kfi')) {
			$session->remove('kfi');
		}
		if ($session->has('kgi')) {
			$session->remove('kgi');
		}
		if ($session->has('kgiTeam')) {
			$session->remove('kgiTeam');
		}
		if ($session->has('kgiEmployee')) {
			$session->remove('kgiEmployee');
		}
		if ($session->has('kpi')) {
			$session->remove('kpi');
		}
		if ($session->has('kpiTeam')) {
			$session->remove('kpiTeam');
		}
		if ($session->has('kpiEmployee')) {
			$session->remove('kpiEmployee');
		}
	}
}
