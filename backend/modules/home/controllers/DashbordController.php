<?php

namespace backend\modules\home\controllers;

use backend\models\hrvc\Employee;
use backend\models\hrvc\Kfi;
use backend\models\hrvc\Kgi;
use backend\models\hrvc\KgiEmployee;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\Kpi;
use backend\models\hrvc\KpiEmployee;
use backend\models\hrvc\KpiTeam;
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

        $data = ['1','2'];
		// $kfi = Kfi::find()->where(["status" != '99','companyId' => $companyId])->asArray()->one();
		// $kgi = Kgi::find()->where(["status" != '99','companyId' => $companyId])->asArray()->one();
		// $kpi = Kpi::find()->where(["status" != '99','companyId' => $companyId])->asArray()->one();


       
        // ส่งผลลัพธ์เป็น JSON
        return json_encode($data);
    }

    public function actionDashbordTeam($companyId, $teamId)
    {

        $data = ['1','2'];
		$kgiTeam = KgiTeam::find()->where(["status" != '99','companyId' => $companyId,'teamId' => $teamId])->asArray()->one();
		$kpiTeam = KpiTeam::find()->where(["status" != '99','companyId' => $companyId,'teamId' => $teamId])->asArray()->one();


       
        // ส่งผลลัพธ์เป็น JSON
        return json_encode($data);
    }

    public function actionDashbordEmployee($companyId, $teamId, $employeeId)
    {

        $data = ['1','2'];
		$kgiEmployee = KgiEmployee::find()->where(["status" != '99','companyId' => $companyId,'teamId' => $teamId,'employeeId' => $employeeId])->asArray()->one();
		$kpiEmployee = KpiEmployee::find()->where(["status" != '99','companyId' => $companyId,'teamId' => $teamId,'employeeId' => $employeeId])->asArray()->one();


       
        // ส่งผลลัพธ์เป็น JSON
        return json_encode($data);
    }
}