<?php

namespace common\helpers;

use Yii;

class Session
{
	public static function PimFilter($companyId, $branchId, $month, $year, $status, $type)
	{
		$session = Yii::$app->session;
		$session->open();
		if ($companyId == "" && $branchId == "" && $month == "" && $status == "" && $year == "") {
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
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kgiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpi', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiTeam', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
			$session->set('kpiEmployee', [
				"companyId" => $companyId,
				"branchId" => $branchId,
				"month" => $month,
				"year" => $year,
				"status" => $status,
				"type" => $type
			]);
		}
	}
}
