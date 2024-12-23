<?php

namespace backend\modules\home\controllers;

use backend\models\hrvc\Branch;
use backend\models\hrvc\Employee;
use backend\models\hrvc\KgiTeam;
use backend\models\hrvc\KgiTeamHistory;
use yii\web\Controller;

/**
 * Default controller for the `home` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionPendingApproval($role, $employeeId)
    {
        $employeeBranchId = Employee::EmployeeDetail($employeeId)["branchId"];
        $kgiTeam = KgiTeam::find()
            ->select('kgiId')
            ->where(["status" => 88])
            ->groupBy('kgiId')
            ->all();
        $data = [];
        return json_encode($data);
    }
}
