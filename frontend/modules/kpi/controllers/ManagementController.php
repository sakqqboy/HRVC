<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\helpers\Session;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\KpiDepartment;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\KpiIssue;
use frontend\models\hrvc\KpiSolution;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\Title;
use frontend\models\hrvc\Unit;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

class ManagementController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->id == '') {
            Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
            return false;
        }
        $this->setDefault();
        return parent::beforeAction($action);
    }
    public function actionIndex($hash = null)
    {
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $role = UserRole::userRight();
        $adminId = '';
        $gmId = '';
        $teamLeaderId = '';
        $managerId = '';
        $supervisorId = '';
        $staffId = '';
        $companyId = '';
        if ($role == 7) $adminId = Yii::$app->user->id;
        if ($role == 6) $gmId = Yii::$app->user->id;
        if ($role == 5) $managerId = Yii::$app->user->id;
        if ($role == 4) $supervisorId = Yii::$app->user->id;
        if ($role == 3) $teamLeaderId = Yii::$app->user->id;
        if ($role == 1 || $role == 2) $staffId = Yii::$app->user->id;
        $currentPage = 1;
        if (isset($hash) && $hash != '') {
            $pageArr = explode('page', $hash);
            $currentPage = $pageArr[1];
        }
        $limit = 20;
        $session = Yii::$app->session;
        if ($session->has('kpi')) {
            $filter = $session->get('kpi');
            $companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
            $branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
            $teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
            $month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
            $status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
            $year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
            $type = "list";
            return $this->redirect(Yii::$app->homeUrl . 'kpi/management/kpi-search-result/' . ModelMaster::encodeParams([
                "companyId" => $companyId,
                "branchId" => $branchId,
                "teamId" => $teamId,
                "month" => $month,
                "status" => $status,
                "year" => $year,
                "type" => $type
            ]));
        }
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        $kpis = Api::connectApi(Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
        $allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        $countAllCompany = 0;
        if (count($allCompany) > 0) {
            $countAllCompany = count($allCompany);
            $companyPic = Company::randomPic($allCompany, 3);
        }
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        $employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
        $employeeCompanyId = $employee["companyId"];
        $totalKpi = Kpi::totalKpi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId);
        $totalPage = ceil($totalKpi / $limit);
        $pagination = ModelMaster::getPagination($currentPage, $totalPage);
        $totalBranch = Branch::totalBranch();
        return $this->render('index', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "kpis" => $kpis,
            "isManager" => $isManager,
            "role" => $role,
            "userId" => Yii::$app->user->id,
            "companyId" => $companyId,
            "employeeCompanyId" => $employeeCompanyId,
            "totalKpi" => $totalKpi,
            "currentPage" => $currentPage,
            "totalPage" => $totalPage,
            "pagination" => $pagination,
            "allCompany" => $countAllCompany,
            "companyPic" => $companyPic,
            "totalBranch" => $totalBranch
        ]);
    }

    public function actionGrid($hash = null)
    {
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $role = UserRole::userRight();
        $adminId = '';
        $gmId = '';
        $teamLeaderId = '';
        $managerId = '';
        $supervisorId = '';
        $staffId = '';
        $companyId = '';
        if ($role == 7) $adminId = Yii::$app->user->id;
        if ($role == 6) $gmId = Yii::$app->user->id;
        if ($role == 5) $managerId = Yii::$app->user->id;
        if ($role == 4) $supervisorId = Yii::$app->user->id;
        if ($role == 3) $teamLeaderId = Yii::$app->user->id;
        if ($role == 1 || $role == 2) $staffId = Yii::$app->user->id;
        $session = Yii::$app->session;
        if ($session->has('kpi')) {
            $filter = $session->get('kpi');
            $companyId = isset($filter["companyId"]) && $filter["companyId"] != null ? $filter["companyId"] : null;
            $branchId = isset($filter["branchId"]) && $filter["branchId"] != null ? $filter["branchId"] : null;
            $teamId = isset($filter["teamId"]) && $filter["teamId"] != null ? $filter["teamId"] : null;
            $month = isset($filter["month"]) && $filter["month"] != null ? $filter["month"] : null;
            $status = isset($filter["status"]) && $filter["status"] != null ? $filter["status"] : null;
            $year = isset($filter["year"]) && $filter["year"] != null ? $filter["year"] : null;
            $type = "grid";
            return $this->redirect(Yii::$app->homeUrl . 'kpi/management/kpi-search-result/' . ModelMaster::encodeParams([
                "companyId" => $companyId,
                "branchId" => $branchId,
                "teamId" => $teamId,
                "month" => $month,
                "status" => $status,
                "year" => $year,
                "type" => $type
            ]));
        }
        $currentPage = 1;
        if (isset($hash) && $hash != '') {
            $pageArr = explode('page', $hash);
            $currentPage = $pageArr[1];
        }
        $limit = 20;
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        //throw new exception('kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit);
        $kpis = Api::connectApi(Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit);

        $allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        $countAllCompany = 0;
        if (count($allCompany) > 0) {
            $countAllCompany = count($allCompany);
            $companyPic = Company::randomPic($allCompany, 3);
        }
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        $employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
        $employeeCompanyId = $employee["companyId"];
        $totalKpi = Kpi::totalKpi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId);
        $totalPage = ceil($totalKpi / $limit);
        $pagination = ModelMaster::getPagination($currentPage, $totalPage);
        $totalBranch = Branch::totalBranch();
        return $this->render('kpi_grid', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "kpis" => $kpis,
            "isManager" => $isManager,
            "role" => $role,
            "userId" => Yii::$app->user->id,
            "companyId" => $companyId,
            "employeeCompanyId" => $employeeCompanyId,
            "totalKpi" => $totalKpi,
            "currentPage" => $currentPage,
            "totalPage" => $totalPage,
            "pagination" => $pagination,
            "allCompany" => $countAllCompany,
            "companyPic" => $companyPic,
            "totalBranch" => $totalBranch
        ]);
    }


    public function actionCreateKpi()
    {
        if (isset($_POST["kpiName"]) && trim($_POST["kpiName"])) {
            $data = [
                'kpiName' => $_POST["kpiName"],
                'company' => $_POST["companyId"],
                'branch' => $_POST["branch"],
                'unit' => $_POST["unitId"],
                'amount' => $_POST["amount"],
                'month' => $_POST["month"],
                'year' => $_POST["year"],
                'detail' => $_POST["detail"],
                'amountType' => $_POST["amountType"],
                'code' => $_POST["code"],
                'quanRatio' => $_POST["quantRatio"],
                'nextCheckDate' => $_POST["nextCheckDate"],
                'fromDate' => $_POST["fromDate"],
                'toDate' => $_POST["toDate"],
                'department' => $_POST["department"],
                'team' => $_POST["team"],
                'priority' => $_POST["priority"],
                'status' => $_POST["status"],
                'result' => $_POST["result"],
            ];
            $result = isset($_POST["result"]) && $_POST["result"] != '' ? $_POST["result"] : 0;
            $kpi = new Kpi();
            $kpi->kpiName = $_POST["kpiName"];
            $kpi->companyId = $_POST["companyId"];
            $kpi->unitId = $_POST["unitId"];
            $kpi->fromDate = $_POST["fromDate"];
            $kpi->targetAmount = str_replace(",", "", $_POST["amount"]);
            $kpi->toDate = $_POST["toDate"];
            $kpi->kpiDetail = $_POST["detail"];
            $kpi->quantRatio = $_POST["quantRatio"];
            $kpi->priority = $_POST["priority"];
            $kpi->amountType = $_POST["amountType"];
            $kpi->code = $_POST["code"];
            $kpi->status = $_POST["status"];
            $kpi->month = $_POST["month"];
            $kpi->year = $_POST["year"];
            $kpi->createrId = Yii::$app->user->id;
            $kpi->createDateTime = new Expression('NOW()');
            $kpi->updateDateTime = new Expression('NOW()');
            if ($kpi->save(false)) {
                $kpiId = Yii::$app->db->lastInsertID;
                $kpiHistory = new KpiHistory();
                $kpiHistory->kpiId = $kpiId;
                $kpiHistory->unitId = $_POST["unitId"];
                $kpiHistory->nextCheckDate = $_POST["nextCheckDate"];
                $kpiHistory->targetAmount = str_replace(",", "", $_POST["amount"]);
                $kpiHistory->description = $_POST["detail"];
                $kpiHistory->quantRatio = $_POST["quantRatio"];
                $kpiHistory->priority = $_POST["priority"];
                $kpiHistory->amountType = $_POST["amountType"];
                $kpiHistory->code = $_POST["code"];
                $kpiHistory->status = $_POST["status"];
                $kpiHistory->month = $_POST["month"];
                $kpiHistory->year = $_POST["year"];
                $kpiHistory->result = $_POST["result"] ?? 0;
                $kpiHistory->createrId = Yii::$app->user->id;
                $kpiHistory->createDateTime = new Expression('NOW()');
                $kpiHistory->updateDateTime = new Expression('NOW()');
                $kpiHistory->fromDate = $_POST["fromDate"];
                $kpiHistory->toDate = $_POST["toDate"];
                $kpiHistory->save(false);
                if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
                    $this->saveKpiBranch($_POST["branch"], $kpiId);
                }
                if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
                    $this->saveKpiDepartment($_POST["department"], $kpiId);
                }
                if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
                    $this->saveKpiTeam($_POST["team"], $kpiId, $_POST["month"], $_POST["year"]);
                }
                return $this->redirect(Yii::$app->homeUrl . 'kpi/assign/assign/' . ModelMaster::encodeParams(["kpiId" => $kpiId, "companyId" => $_POST["companyId"], "month" => $_POST["month"], "year" => $_POST["year"]]));
            }
        } else {
            $role = UserRole::userRight();
            $groupId = Group::currentGroupId();
            $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
            $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
            $allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
            $countAllCompany = 0;
            if (count($allCompany) > 0) {
                $countAllCompany = count($allCompany);
                $companyPic = Company::randomPic($allCompany, 3);
            }
            $totalBranch = Branch::totalBranch();
            $data = [];
            return $this->render('kpi_from', [
                "role" => $role,
                "companies" => $companies,
                "units" => $units,
                "data" => $data,
                "lastUrl" => Yii::$app->request->referrer,
                "statusform" => "create",
                "allCompany" => $countAllCompany,
                "companyPic" => $companyPic,
                "totalBranch" => $totalBranch
            ]);
        }
    }

    public function saveKpiBranch($branch, $kpiId)
    {
        $kpiBranch = KpiBranch::find()->where(["kpiId" => $kpiId, "status" => 1])->all();
        if (isset($kpiBranch) && count($kpiBranch) > 0) {
            foreach ($kpiBranch as $kb) :
                foreach ($branch as $bb) :
                    if ($kb->branchId == $bb) {
                        $saveBranch[$kb->branchId] = 1;
                        break;
                    } else {
                        $saveBranch[$kb->branchId] = 0;
                    }
                endforeach;
                if ($saveBranch[$kb["branchId"]] == 0) {
                    $kb->status = 99;
                    $kb->save(false);
                }
            endforeach;
        }
        if (count($branch) > 0) {
            foreach ($branch as $b) :
                $old = KpiBranch::find()->where(["kpiId" => $kpiId, "branchId" => $b, "status" => 1])->one();
                if (!isset($old) || empty($old)) {
                    $kpiBranch = new KpiBranch();
                    $kpiBranch->kpiId = $kpiId;
                    $kpiBranch->branchId = $b;
                    $kpiBranch->status = 1;
                    $kpiBranch->createDateTime = new Expression('NOW()');
                    $kpiBranch->updateDateTime = new Expression('NOW()');
                    $kpiBranch->save(false);
                }
            endforeach;
        }
    }
    public function saveKpiDepartment($department, $kpiId)
    {
        $kpiDepartment = KpiDepartment::find()->where(["kpiId" => $kpiId, "status" => 1])->all();
        if (isset($kpiDepartment) && count($kpiDepartment) > 0) {
            foreach ($kpiDepartment as $kd) :
                foreach ($department as $dp) :
                    if ($kd->departmentId == $dp) {
                        $saveDepartment[$kd->departmentId] = 1;
                        break;
                    } else {
                        $saveDepartment[$kd->departmentId] = 0;
                    }
                endforeach;
                if ($saveDepartment[$kd->departmentId] == 0) {
                    $kd->status = 99;
                    $kd->save(false);
                }
            endforeach;
        }
        if (count($department) > 0) {
            foreach ($department as $d) :
                $old = KpiDepartment::find()->where(["kpiId" => $kpiId, "departmentId" => $d, "status" => 1])->one();
                if (!isset($old) || empty($old)) {
                    $kpiDepartment = new KpiDepartment();
                    $kpiDepartment->kpiId = $kpiId;
                    $kpiDepartment->departmentId = $d;
                    $kpiDepartment->status = 1;
                    $kpiDepartment->createDateTime = new Expression('NOW()');
                    $kpiDepartment->updateDateTime = new Expression('NOW()');
                    $kpiDepartment->save(false);
                }
            endforeach;
        }
    }
    public function saveKpiTeam($team, $kpiId, $month, $year)
    {
        $kpiTeam = KpiTeam::find()->where(["kpiId" => $kpiId, "status" => 1])->all();
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $kt) :
                foreach ($team as $tt) :
                    if ($kt->teamId == $tt) {
                        $saveTeam[$kt->teamId] = 1;
                        break;
                    } else {
                        $saveTeam[$kt->teamId] = 0;
                    }
                endforeach;
                if ($saveTeam[$kt["teamId"]] == 0) {
                    $kt->status = 99;
                    $kt->save(false);
                }
            endforeach;
        }
        if (count($team) > 0) {
            foreach ($team as $t) :
                $old = KpiTeam::find()->where(["kpiId" => $kpiId, "teamId" => $t, "status" => [1, 2, 4]])->one();
                if (!isset($old) || empty($old)) {
                    $kpiTeam = new KpiTeam();
                    $kpiTeam->kpiId = $kpiId;
                    $kpiTeam->teamId = $t;
                    $kpiTeam->status = 1;
                    $kpiTeam->month = $month;
                    $kpiTeam->year = $year;
                    $kpiTeam->createDateTime = new Expression('NOW()');
                    $kpiTeam->updateDateTime = new Expression('NOW()');
                    $kpiTeam->save(false);
                    $kpiTeamId = Yii::$app->db->lastInsertID;
                    $kpiTeamHistory = new KpiTeamHistory();
                    $kpiTeamHistory->kpiTeamId = $kpiTeamId;
                    $kpiTeamHistory->target = null;
                    $kpiTeamHistory->result = null;
                    $kpiTeamHistory->createrId = Yii::$app->user->id;
                    $kpiTeamHistory->month = $month;
                    $kpiTeamHistory->year = $year;
                    $kpiTeamHistory->status = 1;
                    $kpiTeamHistory->createDateTime = new Expression('NOW()');
                    $kpiTeamHistory->updateDateTime = new Expression('NOW()');
                    $kpiTeamHistory->save(false);
                }
            endforeach;
        }
    }
    public function saveKpiEmployee($team, $kpiId, $month, $year)
    {
        if (count($team) > 0) {
            foreach ($team as $t) :
                $employee = Employee::find()->where(["teamId" => $t, "status" => 1])->all();
                if (isset($employee) && count($employee) > 0) {
                    foreach ($employee as $e) :
                        $kpiEmployee = new KpiEmployee();
                        $kpiEmployee->employeeId = $e->employeeId;
                        $kpiEmployee->kpiId = $kpiId;
                        $kpiEmployee->createrId = Yii::$app->user->id;
                        $kpiEmployee->status = 1;
                        $kpiEmployee->createDateTime = new Expression('NOW()');
                        $kpiEmployee->updateDateTime = new Expression('NOW()');

                        $kpiEmployee->save(false);
                        $kpiEmployeeId = Yii::$app->db->lastInsertID;
                        $kpiEmployeeHistory = new KpiEmployeeHistory();
                        $kpiEmployeeHistory->kpiEmployeeId = $kpiEmployeeId;
                        $kpiEmployeeHistory->target = null;
                        $kpiEmployeeHistory->result = null;
                        $kpiEmployeeHistory->createrId = Yii::$app->user->id;
                        $kpiEmployeeHistory->status = 1;
                        $kpiEmployeeHistory->createDateTime = new Expression('NOW()');
                        $kpiEmployeeHistory->updateDateTime = new Expression('NOW()');
                        $kpiEmployeeHistory->save(false);
                    endforeach;
                }
            endforeach;
        }
    }
    public function actionPrepareUpdate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kpiId =  $param['kpiId'];
        if (!$kpiId || !is_numeric($kpiId)) {
            throw new Exception("Invalid kpi ID.");
        }
        $role = UserRole::userRight();
        $groupId = Group::currentGroupId();

        $kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');

        $companyId = $kpi["companyId"];
        $kpiBranch = Api::connectApi(Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
        $kpiBranchText = $this->renderAjax('multi_branch_update', [
            "branches" => $kpiBranch,
            "kpiId" => $kpiId
        ]);

        $kpiDepartment = Api::connectApi(Path::Api() . 'kpi/management/kpi-department?id=' . $kpiId);
        $kpiDepartmentText = $this->renderAjax('multi_department_update', [
            "d" => $kpiDepartment,
            "kpiId" => $kpiId
        ]);

        $kpiTeam = Api::connectApi(Path::Api() . 'kpi/management/kpi-team?id=' . $kpiId);
        $kpiTeamText = $this->renderAjax('multi_team_update', [
            "t" => $kpiTeam,
            "kpiId" => $kpiId
        ]);

        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');

        $countAllCompany = 0;
        if (count($allCompany) > 0) {
            $countAllCompany = count($allCompany);
            $companyPic = Company::randomPic($allCompany, 3);
        }
        $totalBranch = Branch::totalBranch();

        return $this->render('kpi_from', [
            "statusform" =>  "update",
            "role" => $role,
            "companies" => $companies,
            "units" => $units,
            "data" => $kpi,
            "kpiBranchText" => $kpiBranchText,
            "kpiDepartmentText" => $kpiDepartmentText,
            "kpiTeamText" => $kpiTeamText,
            "kpiId" => $kpiId,
            "lastUrl" => Yii::$app->request->referrer,
            "allCompany" => $countAllCompany,
            "companyPic" => $companyPic,
            "totalBranch" => $totalBranch
        ]);
    }

    public function actionUpdateKpi()
    {
        $isManager = UserRole::isManager();
        if (isset($_POST["kpiId"]) && $_POST["kpiId"] != "") {
            $result = isset($_POST["result"]) && $_POST["result"] != '' ? $_POST["result"] : 0;
            if ($result != $_POST["result"]) {
                $result = $_POST["result"];
            }
            $kpiId = $_POST["kpiId"];
            $kpi = Kpi::find()->where(["kpiId" => $kpiId])->one();
            $kpi->kpiName = $_POST["kpiName"];
            $kpi->companyId = $_POST["companyId"];
            $kpi->unitId = $_POST["unitId"];
            $kpi->fromDate = $_POST["fromDate"];
            $kpi->toDate = $_POST["toDate"];
            if ($kpi->fromDate == "") {
                $kpi->fromDate = $_POST["fromDate"];
            }
            if ($kpi->toDate == "") {
                $kpi->toDate = $_POST["toDate"];
            }
            if ($isManager == 1 && $_POST["amount"] != "") {
                $kpi->targetAmount = str_replace(",", "", $_POST["amount"]);
            }
            $kpi->kpiDetail = $_POST["detail"];
            $kpi->quantRatio = $_POST["quantRatio"];
            $kpi->priority = $_POST["priority"];
            $kpi->amountType = $_POST["amountType"];
            $kpi->code = $_POST["code"];
            $kpi->status = $_POST["status"];
            $kpi->month = $_POST["month"];
            $kpi->year = $_POST["year"];
            $kpi->result = str_replace(",", "", $result);
            $kpi->createrId = Yii::$app->user->id;
            $kpi->updateDateTime = new Expression('NOW()');
            if ($kpi->save(false)) {
                $kpiHistory = new KpiHistory();
                $kpiHistory->kpiId = $_POST["kpiId"];
                $kpiHistory->unitId = $_POST["unitId"];
                $kpiHistory->nextCheckDate = $_POST["nextCheckDate"];
                if ($isManager == 1) {
                    $kpiHistory->targetAmount = str_replace(",", "", $_POST["amount"]);
                } else {
                    $kpiHistory->targetAmount = $kpi->targetAmount;
                }
                $kpiHistory->description = $_POST["detail"];
                $kpiHistory->quantRatio = $_POST["quantRatio"];
                $kpiHistory->priority = $_POST["priority"];
                $kpiHistory->amountType = $_POST["amountType"];
                $kpiHistory->code = $_POST["code"];
                $kpiHistory->status = $_POST["status"];
                $kpiHistory->month = $_POST["month"];
                $kpiHistory->year = $_POST["year"];
                $kpiHistory->result = str_replace(",", "", $result);
                $kpiHistory->createrId = Yii::$app->user->id;
                $kpiHistory->createDateTime = new Expression('NOW()');
                $kpiHistory->updateDateTime = new Expression('NOW()');
                $kpiHistory->fromDate = $_POST["fromDate"];
                $kpiHistory->toDate = $_POST["toDate"];
                $kpiHistory->save(false);
                if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
                    $this->savekpiBranch($_POST["branch"], $kpiId);
                }
                if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
                    $this->savekpiDepartment($_POST["department"], $kpiId);
                }
                if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
                    $this->savekpiTeam($_POST["team"], $kpiId, $_POST["month"], $_POST["year"]);
                }
            }
        }
        return $this->redirect($_POST["url"]);
    }
    public function actionHistory()
    {
        $kpiId = $_POST["kpiId"];
        $kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $kpiTeams = Api::connectApi(Path::Api() . 'kpi/management/kpi-team?id=' . $kpiId);
        $res["teamText"] = $this->renderAjax('kpi_team', ["kpiTeams" => $kpiTeams, "kpiId" => $kpiId]);
        $kpiEmloyee = Api::connectApi(Path::Api() . 'kpi/management/kpi-employee?id=' . $kpiId);
        $res["employeeText"] = $this->renderAjax('kpi_member', ["kpiEmloyee" => $kpiEmloyee, "kpiId" => $kpiId]);
        $history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId);
        $res["historyText"] = $this->renderAjax('kpi_history', ["history" => $history]);
        $res["kpi"] = $kpi;
        return json_encode($res);
    }

    public function actionDeleteKpi()
    {
        $kpiId = $_POST["kpiId"];
        KpiTeam::updateAll(["status" => 99], ["kpiId" => $kpiId]);
        KpiDepartment::updateAll(["status" => 99], ["kpiId" => $kpiId]);
        KpiBranch::updateAll(["status" => 99], ["kpiId" => $kpiId]);
        KpiHistory::updateAll(["status" => 99], ["kpiId" => $kpiId]);
        Kpi::updateAll(["status" => 99], ["kpiId" => $kpiId]);
        $res["status"] = true;
        return json_encode($res);
    }
    public function actionShowComment()
    {
        $userId = Yii::$app->user->id;
        $employeeId = User::employeeIdFromUserId($userId);
        $kpiId = $_POST["kpiId"];
        $kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $kpiIssue = Api::connectApi(Path::Api() . 'kpi/management/kpi-issue?kpiId=' . $kpiId);
        $profile = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $res["status"] = true;
        $res["issueText"] = $this->renderAjax('kpi_issue', [
            "kpiIssue" => $kpiIssue,
            "kpiId" => $kpiId,
            "profile" => $profile,
            "employeeId" => $employeeId,
            "kpiName" => $kpi["kpiName"]
        ]);
        $res["historyText"] = $this->renderAjax('kpi_history2', [
            "kpiIssue" => $kpiIssue,
            "kpiId" => $kpiId,
            "profile" => $profile,
            "employeeId" => $employeeId,
            "kpiName" => $kpi["kpiName"]
        ]);
        $res["kpi"] = $kpi;
        return json_encode($res);
    }
    public function actionCreateNewIssue()
    {
        $kpiIssue = new KpiIssue();
        $kpiIssue->issue = $_POST["issue"];
        $kpiIssue->description = $_POST["description"];
        $kpiIssue->kpiId = $_POST["kpiId"];
        $kpiIssue->employeeId = $_POST["employeeId"];
        $kpiIssue->status = 1;
        $kpiIssue->createDateTime = new Expression('NOW()');
        $kpiIssue->updateDateTime = new Expression('NOW()');
        $file = '';
        $fileName = '';
        $res = [];
        if (isset($_FILES['file']['name'])) {
            $fileObj = UploadedFile::getInstanceByName("file");
            $filename = $_FILES['file']['name'];
            $path = Path::getHost() . 'file/kpi/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $filenameArray = explode('.', $filename);
            $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
            $pathSave = $path . $fileName;
            $fileObj->saveAs($pathSave);
            $kpiIssue->file = 'file/kpi/' . $fileName;
            $file = 'file/kpi/' . $fileName;
        }
        if ($kpiIssue->save(false)) {
            $res["status"] = true;
            $kpiIssue = Api::connectApi(Path::Api() . 'kpi/management/kpi-issue?kpiId=' . $_POST["kpiId"]);
            $res["text"] = $this->renderAjax("issue_history", [
                "kpiIssue" => $kpiIssue,
                "kpiId" => $_POST["kpiId"],
                "employeeId" => $_POST["employeeId"]
            ]);
        }
        return json_encode($res);
    }
    public function actionModalHistory()
    {
        $percentage = $_POST["percentage"];
        $result = $_POST["result"];
        $sumvalue = $_POST["sumvalue"];
        $targetAmount = $_POST["targetAmount"];
        $kpiId = $_POST["kpiId"];
        $month = $_POST["month"];
        $monthName = $_POST["monthName"];
        $year = $_POST["year"];
        $formattedRange = $_POST["formattedRange"];
        $history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-employee?kpiId=' . $kpiId . '&month=' . $month . '&year=' . $year);
        $historyTeam = Api::connectApi(Path::Api() . 'kpi/management/kpi-history-team?kpiId=' . $kpiId . '&month=' . $month . '&year=' . $year);
        $data = [
            "percentage" => $percentage,
            "result" => $result,
            "sumvalue" => $sumvalue,
            "targetAmount" => $targetAmount,
            "kpiId" => $kpiId,
            "month" => $monthName,
            "year" => $year,
            "formattedRange" => $formattedRange,
            "history" => $history,
            "historyTeam" => $historyTeam
        ];
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }

    public function actionSaveKpiAnswer()
    {
        $solution = $_POST["answer"];
        $kpiIssueId = $_POST["kpiIssueId"];
        $employeeId = User::employeeIdFromUserId(Yii::$app->user->id);
        $answer = new KpiSolution();
        $res["status"] = false;
        $file = '';
        $fileName = '';
        $lastestKpiIssue = KpiSolution::find()
            ->where(["kpiIssueId" => $kpiIssueId])
            ->orderBy('kpiSolutionId DESC')
            ->asArray()
            ->one();
        if (isset($lastestKpiIssue)) {
            $res["lastest"] = $lastestKpiIssue["kpiSolutionId"];
        } else {
            $res["lastest"] = 0;
        }
        if (isset($_FILES['file']['name'])) {
            $fileObj = UploadedFile::getInstanceByName("file");
            $filename = $_FILES['file']['name'];
            $path = Path::getHost() . 'file/kpi/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $filenameArray = explode('.', $filename);
            $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
            $pathSave = $path . $fileName;
            $fileObj->saveAs($pathSave);
            $answer->file = 'file/kpi/' . $fileName;
            $file = 'file/kpi/' . $fileName;
        }

        $answer->kpiIssueId = $kpiIssueId;
        $answer->solution = $solution;
        $answer->parentId = null;
        $answer->employeeId = $employeeId;
        $answer->status = 1;
        $answer->createDateTime = new Expression('NOW()');
        $answer->updateDateTime = new Expression('NOW()');
        $createDateTime = date('Y-m-d H:i:s');
        if ($answer->save(false)) {
            $kpiSolutionId = Yii::$app->db->lastInsertID;
            $kpiIssue = KpiIssue::find()
                ->select('kpiId,issue')
                ->where(["kpiIssueId" => $kpiIssueId])
                ->one();
            $kpiIssue->updateDateTime = new Expression('NOW()');
            $kpiId = $kpiIssue->kpiId;
            $kpiIssue->save(false);

            $res["commentText"] = $this->renderAjax('comment', [
                "name" => User::userHeaderName(),
                "image" => User::userHeaderImage(),
                "answer" => $solution,
                "createDateTime" => ModelMaster::timeMonthDateYear($createDateTime),
                "kpiIssueId" => $kpiIssueId,
                "file" => $file,
                "fileName" => $fileName,
                "lastestKpiSolutionId" => $res["lastest"],
                "kpiSolutionId" => $kpiSolutionId
            ]);
            $res["status"] = true;
            $res["issue"] = $kpiIssue["issue"];
            $res["solution"] = $solution;
            $res["kpiId"] = $kpiId;
        }

        return json_encode($res);
    }
    public function actionSearchKpi()
    {
        $companyId = isset($_POST["companyId"]) && $_POST["companyId"] != null ? $_POST["companyId"] : null;
        $branchId = isset($_POST["branchId"]) && $_POST["branchId"] != null ? $_POST["branchId"] : null;
        $teamId = isset($_POST["teamId"]) && $_POST["teamId"] != null ? $_POST["teamId"] : null;
        $month = isset($_POST["month"]) && $_POST["month"] != null ? $_POST["month"] : null;
        $status = isset($_POST["status"]) && $_POST["status"] != null ? $_POST["status"] : null;
        $year = isset($_POST["year"]) && $_POST["year"] != null ? $_POST["year"] : null;
        $type = $_POST["type"];
        return $this->redirect(Yii::$app->homeUrl . 'kpi/management/kpi-search-result/' . ModelMaster::encodeParams([
            "companyId" => $companyId,
            "branchId" => $branchId,
            "teamId" => $teamId,
            "month" => $month,
            "status" => $status,
            "year" => $year,
            "type" => $type
        ]));
    }
    public function actionKpiSearchResult($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $branchId = $param["branchId"];
        $teamId = $param["teamId"];
        $month = $param["month"];
        $status = $param["status"];
        $year = $param["year"];
        $type = $param["type"];
        $branches = [];
        $teams = [];
        Session::PimFilter($companyId, $branchId, $month, $year, $status, $type);
        if ($companyId == "" && $branchId == "" && $month == "" && $status == "" && $year == "") {
            if ($type == "list") {
                return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'kpi/management/grid');
            }
        }
        $currentPage = 1;
        $limit = 20;
        if (isset($param["currentPage"])) {
            $currentPage = $param["currentPage"];
        }
        $paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year;
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
        $paramText .= '&&adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId . '&&currentPage=' . $currentPage . '&&limit=' . $limit;
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $currentPage = 1;
        if (isset($hash) && $hash != '') {
            $pageArr = explode('page', $hash);
            if (isset($pageArr[1]) && is_numeric($pageArr[1])) {
                $currentPage = (int) $pageArr[1];
            }
        }
        $limit = 20;
        //  throw new Exception(print_r($paramText,true));
        $kpis = Api::connectApi(Path::Api() . 'kpi/management/kpi-filter?' . $paramText);
        // throw new Exception(print_r($kpis,true));
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        if ($companyId != "") {
            $branches = Api::connectApi(Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        }
        if ($branchId != "") {
            $teams = Api::connectApi(Path::Api() . 'masterdata/branch/branch-team?id=' . $branchId);
        }
        $allCompany = Api::connectApi(Path::Api() . 'masterdata/company/all-company');
        if ($type == "list") {
            $file = "index";
        } else {
            $file = "kpi_grid";
        }
        $countAllCompany = 0;
        if (count($allCompany) > 0) {
            $countAllCompany = count($allCompany);
            $companyPic = Company::randomPic($allCompany, 3);
        }
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        $filter = [
            "companyId" => $companyId,
            "branchId" => $branchId,
            "month" => $month,
            "year" => $year,
            "status" => $status,
            "branches" => $branches,
            "perPage" => 20,
        ];
        $employee = Employee::employeeDetailByUserId(Yii::$app->user->id);
        $employeeCompanyId = $employee["companyId"];
        $totalKpi = $kpis['total'];
        // $totalKpi = Kpi::totalKpi($adminId, $gmId, $managerId, $supervisorId, $teamLeaderId, $staffId);
        $totalPage = ceil($totalKpi / $limit);
        $pagination = ModelMaster::getPagination($currentPage, $totalPage);
        $totalBranch = Branch::totalBranch();
        return $this->render($file, [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "kpis" => $kpis,
            "companyId" => $companyId,
            "branchId" => $branchId,
            "teamId" => $teamId,
            "month" => $month,
            "status" => $status,
            "branches" => $branches,
            "teams" => $teams,
            "year" => $year,
            "isManager" => $isManager,
            "role" => $role,
            "userId" => Yii::$app->user->id,
            "employeeCompanyId" => $employeeCompanyId,
            "totalKpi" => $totalKpi,
            "currentPage" => $currentPage,
            "totalPage" => $totalPage,
            "pagination" => $pagination,
            "allCompany" => $countAllCompany,
            "companyPic" => $companyPic,
            "totalBranch" => $totalBranch,
            "filter" => $filter,
        ]);
    }
    public function actionCompanyMultiBranch()
    {
        $companyId = $_POST["companyId"];
        $acType = $_POST["acType"];
        $branches = Api::connectApi(Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
        if ($acType == "create") {
            $branchText = $this->renderAjax('multi_branch', ["branches" => $branches]);
        } else {
            $kpiId = $_POST["kpiId"];
            $branchText = $this->renderAjax('multi_branch_update', [
                "branches" => $branches,
                "kpiId" => $kpiId
            ]);
        }
        $res["status"] = true;
        $res["branchText"] = $branchText;
        return json_encode($res);
    }

    public function actionDepartmentMultiTeam()
    {
        $res["status"] = false;
        $t = [];
        $textTeam = '';
        $branchDepartment = [];
        $acType = $_POST["acType"];
        //throw new exception(print_r($_POST["multiBranch"], true));
        if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
            foreach ($_POST["multiBranch"] as $branchId) :
                if (isset($_POST["multiDepartment"]) && count($_POST["multiDepartment"]) > 0) {
                    foreach ($_POST["multiDepartment"] as $departmentId) :
                        if ($branchId != '') {
                            $department = Department::find()
                                ->where(["departmentId" => $departmentId, "branchId" => $branchId])
                                ->andWhere("status!=99")
                                ->one();
                            if (isset($department) && !empty($department)) {
                                $branchDepartment[$branchId][$departmentId] = $departmentId;
                            }
                        }
                    endforeach;
                }
            endforeach;
        }
        //throw new exception(print_r($branchDepartment, true));
        if (count($branchDepartment) > 0) {

            foreach ($branchDepartment as $branchId => $departments) :

                foreach ($departments as $dId => $id) :
                    $teams = Team::find()
                        ->where(["departmentId" => $dId])
                        ->andWhere("status!=99")
                        ->asArray()
                        ->orderBy("teamName")
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            $t[$dId][$team["teamId"]] = $team["teamName"];
                        endforeach;
                    }
                endforeach;
            endforeach;
            //throw new Exception(print_r($t, true));
            if ($acType == "create") {
                $textTeam .= $this->renderAjax('multi_team', [
                    "t" => $t,
                ]);
            } else {
                $kpiId = $_POST["kpiId"];
                $textTeam .= $this->renderAjax('multi_team_update', [
                    "t" => $t,
                    "kpiId" => $kpiId
                ]);
            }
            $res["status"] = true;
            $res["textTeam"] = $textTeam;
        }
        return json_encode($res);
    }
    public function actionBranchMultiDepartment()
    {
        $res["status"] = false;
        $acType = $_POST["acType"];
        if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
            //throw new Exception(print_r($_POST["multiBranch"], true));
            $branchIdArr = $_POST["multiBranch"];
            $d = [];
            if (count($branchIdArr) > 0) {
                $i = 0;
                foreach ($branchIdArr as $branchId) :
                    $department = Department::find()->where(["branchId" => $branchId, "status" => 1])->asArray()->all();
                    if (isset($department) && count($department) > 0) {
                        foreach ($department as $dep) :
                            $d[$dep["branchId"]][$dep["departmentId"]] = $dep["departmentName"];
                        endforeach;
                    }
                endforeach;
            }
            if ($acType == "create") {
                $textDepartment = $this->renderAjax('multi_department', [
                    "d" => $d,
                ]);
            } else {
                $kpiId = $_POST["kpiId"];
                $textDepartment = $this->renderAjax('multi_department_update', [
                    "d" => $d,
                    "kpiId" => $kpiId
                ]);
            }
            $res["status"] = true;
            $res["textDepartment"] = $textDepartment;
        }
        return json_encode($res);
    }
    public function actionCopyKpi($kpiId)
    {
        $kpi = Kpi::find()->where(["kpiId" => $kpiId])->asArray()->one();
        $copy = new Kpi();
        $copy->kpiName = $kpi["kpiName"] . ' copy';
        $copy->companyId = $kpi["companyId"];
        $copy->unitId = $kpi["unitId"];
        // $kpi->periodDate = $_POST["periodDate"];
        $copy->fromDate = $kpi["fromDate"];
        $copy->toDate = $kpi["toDate"];
        $copy->targetAmount = $kpi["targetAmount"];
        $copy->kpiDetail = $kpi["kpiDetail"];
        $copy->quantRatio = $kpi["quantRatio"];
        $copy->priority = $kpi["priority"];
        $copy->amountType = $kpi["amountType"];
        $copy->code = $kpi["code"];
        $copy->status = $kpi["status"];
        $copy->month = $kpi["month"];
        $copy->result = $kpi["result"];
        $copy->createrId = Yii::$app->user->id;
        $copy->createDateTime = new Expression('NOW()');
        $copy->updateDateTime = new Expression('NOW()');
        if ($copy->save(false)) {
            $kpiCopyId = Yii::$app->db->lastInsertID;

            if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
                $this->saveKpiBranch($_POST["branch"], $kpiId);
            }
            if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
                $this->saveKpiDepartment($_POST["department"], $kpiId);
            }
            if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
                $this->saveKpiTeam($_POST["team"], $kpiId, $kpi["month"], $kpi["year"]);
            }

            $branch = [];
            $branches = KpiBranch::find()
                ->select('branchId')
                ->where(["kpiId" => $kpiId])
                ->asArray()
                ->all();
            if (count($branches) > 0) {
                $i = 0;
                foreach ($branches as $b) :
                    $branch[$i] = $b["branchId"];
                    $i++;
                endforeach;
            }
            if (count($branch) > 0) {
                $this->saveKpiBranch($branch, $kpiCopyId);
            }
            $department = [];
            $departments = KpiDepartment::find()
                ->select('departmentId')
                ->where(["kpiId" => $kpiId])
                ->asArray()
                ->all();
            if (count($departments) > 0) {
                $i = 0;
                foreach ($departments as $d) :
                    $department[$i] = $d["departmentId"];
                    $i++;
                endforeach;
            }
            if (count($department) > 0) {
                $this->saveKpiDepartment($department, $kpiCopyId);
            }
            $team = [];
            $teams = KpiTeam::find()
                ->select('teamId')
                ->where(["kpiId" => $kpiId])
                ->asArray()
                ->all();
            if (count($teams) > 0) {
                $i = 0;
                foreach ($teams as $t) :
                    $team[$i] = $t["teamId"];
                    $i++;
                endforeach;
            }
            if (count($team) > 0) {
                $this->saveKpiTeam($team, $kpiCopyId, $kpi["month"], $kpi["year"]);
            }
            return $this->redirect('grid');
        }
    }
    public function actionAssignKpi()
    {
        $role = UserRole::userRight();
        if ($role < 3) {
            return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
        }
        $adminId = '';
        $managerId = '';
        $supervisorId = '';
        $staffId = '';
        $gmId = '';
        $teamLeaderId = '';
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
            return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
        }
        $kpis = Api::connectApi(Path::Api() . 'kpi/management/index?adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId);
        $months = ModelMaster::monthFull(1);
        return $this->render('assign', [
            "kpis" => $kpis,
            "months" => $months
        ]);
    }
    public function actionKpiBranch()
    {
        $companyId = $_POST["companyId"];
        $kpiId = $_POST["kpiId"];
        $branches = Api::connectApi(Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
        $textBranch = "";
        $textBranch .= $this->renderAjax('company_branch', ["branches" => $branches, "kpiId" => $kpiId]);
        $kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $res["kpiName"] = $kpi["kpiName"];
        $res["companyName"] = $kpi["companyName"];
        $res["textBranch"] = $textBranch;
        $res["status"] = $textBranch != "" ? true : false;
        return json_encode($res);
    }

    public function actionKpiAssignBranch()
    {
        $kpiId = $_POST["kpiId"];
        $branchId = $_POST["branchId"];
        $checked = $_POST["checked"];
        if ($checked == 1) {
            $kpiBranch = new KpiBranch();
            $kpiBranch->branchId = $branchId;
            $kpiBranch->kpiId = $kpiId;
            $kpiBranch->status = 1;
            $kpiBranch->createDateTime = new Expression('NOW()');
            $kpiBranch->updateDateTime = new Expression('NOW()');
            $kpiBranch->save(false);
        } else {
            KpiBranch::deleteAll(["branchId" => $branchId, "kpiId" => $kpiId]);
            $branchDepartment = Department::find()->where(["branchId" => $branchId])->asArray()->all();
            if (isset($branchDepartment) && count($branchDepartment) > 0) {
                foreach ($branchDepartment as $department) :
                    KpiDepartment::deleteAll(["departmentId" => $department["departmentId"], "kpiId" => $kpiId]);
                    $teams = Team::find()
                        ->where(["departmentId" => $department["departmentId"], "status" => 1])
                        ->asArray()
                        ->all();
                    if (isset($teams) && count($teams) > 0) {
                        foreach ($teams as $team) :
                            KpiTeam::deleteAll(["teamId" => $team["teamId"], "kpiId" => $kpiId]);
                            $employee = Employee::find()
                                ->where(["teamId" => $team["teamId"]])
                                ->asArray()
                                ->all();
                            if (isset($employee) && count($employee) > 0) {
                                foreach ($employee as $em) :
                                    KpiEmployee::deleteAll(["employeeId" => $em["employeeId"], "kpiId" => $kpiId]);
                                endforeach;
                            }
                        endforeach;
                    }
                endforeach;
            }
        }
        $kpiBranch = KpiBranch::find()
            ->where(["kpiId" => $kpiId, "status" => 1])
            ->asArray()
            ->all();
        $res["status"] = true;
        $res["totalBranch"] = count($kpiBranch);
        return json_encode($res);
    }
    public function actionKpiEmployee()
    {
        $kpiId = $_POST["kpiId"];
        $kpiBranch = KpiBranch::find()
            ->where(["kpiId" => $kpiId, "status" => 1])
            ->asArray()
            ->all();
        $employees = [];
        $departmentText = '<option value="">Department</option>';
        if (isset($kpiBranch) && count($kpiBranch) > 0) {
            $i = 0;
            foreach ($kpiBranch as $kb) :
                $employee = Employee::find()
                    ->where(["branchId" => $kb["branchId"], "status" => 1])
                    ->asArray()
                    ->orderBy('branchId,titleId')
                    ->all();
                if (isset($employee) && count($employee) > 0) {
                    foreach ($employee as $em) :
                        if ($em["picture"] != "") {
                            $picture = $em['picture'];
                        } else {
                            if ($em['gender'] == 1) {
                                $picture = 'image/user.png';
                            } else {
                                $picture = 'image/lady.jpg';
                            }
                        }
                        $employees[$i] = [
                            "name" => $em["employeeFirstname"] . ' ' . $em["employeeSurename"],
                            "id" => $em["employeeId"],
                            "branch" => Branch::branchName($em["branchId"]),
                            "department" => Department::departmentNAme($em["departmentId"]),
                            "team" => Team::teamName($em["teamId"]),
                            "picture" => $picture,
                            "title" => Title::titleName($em["titleId"])
                        ];
                        $i++;
                    endforeach;
                }
                $departments = Department::find()
                    ->select('departmentId,departmentName')
                    ->where(["branchId" => $kb["branchId"], "status" => 1])->asArray()
                    ->orderBy("departmentName")
                    ->all();
                if (isset($departments) && count($departments) > 0) {
                    foreach ($departments as $dp) :
                        $departmentText .= '<option value="' . $dp["departmentId"] . '">' . $dp["departmentName"] . '</option>';
                    endforeach;
                }

            endforeach;
        }

        $textEmployee = $this->renderAjax('branch_employee', ["employees" => $employees, "kpiId" => $kpiId]);
        $res["status"] = true;
        $res["textEmployee"] = $textEmployee;
        $res["departmentText"] = $departmentText;
        return json_encode($res);
    }
    public function actionCheckAllKpiEmployee()
    {
        $kpiId = $_POST["kpiId"];
        $kpiBranch = KpiBranch::find()
            ->where(["kpiId" => $kpiId, "status" => 1])
            ->asArray()
            ->all();
        $employees = [];
        if (isset($kpiBranch) && count($kpiBranch) > 0) {
            $i = 0;
            foreach ($kpiBranch as $kb) :
                $employee = Employee::find()
                    ->where(["branchId" => $kb["branchId"], "status" => 1])
                    ->asArray()
                    ->orderBy('branchId,titleId')
                    ->all();
                if (isset($employee) && count($employee) > 0) {
                    foreach ($employee as $em) :
                        $employees[$i] = $em["employeeId"];
                        $i++;
                    endforeach;
                }
            endforeach;
        }
        $res["employeeId"] = $employees;
        return json_encode($res);
    }
    public function actionKpiAssignEmployee()
    {
        $kpiId = $_POST["kpiId"];
        $employeeId = $_POST["employeeId"];
        $checked = $_POST["checked"];
        if ($checked == 1) {
            $kpiEmployee = new KpiEmployee();
            $kpiEmployee->employeeId = $employeeId;
            $kpiEmployee->kpiId = $kpiId;
            $kpiEmployee->status = 1;
            $kpiEmployee->createDateTime = new Expression('NOW()');
            $kpiEmployee->updateDateTime = new Expression('NOW()');
            $kpiEmployee->save(false);
            $kpiEmployeeId = Yii::$app->db->lastInsertID;
            $kpiEmployeeHistory = new KpiEmployeeHistory();
            $kpiEmployeeHistory->kpiEmployeeId = $kpiEmployeeId;
            $kpiEmployeeHistory->target = null;
            $kpiEmployeeHistory->result = null;
            $kpiEmployeeHistory->createrId = Yii::$app->user->id;
            $kpiEmployeeHistory->status = 1;
            $kpiEmployeeHistory->createDateTime = new Expression('NOW()');
            $kpiEmployeeHistory->updateDateTime = new Expression('NOW()');
            $kpiEmployeeHistory->save(false);
            $employee = Employee::find()
                ->select('departmentId,teamId')
                ->where(["employeeId" => $employeeId, "status" => 1])
                ->asArray()
                ->one();
            if (isset($employee) && !empty($employee)) {
                $kpiDepartment = KpiDepartment::find()
                    ->where(["kpiId" => $kpiId, "departmentId" => $employee["departmentId"], "status" => 1])
                    ->one();
                if (!isset($kpiDepartment) || empty($kpiDepartment)) {
                    $kpiDepartment = new KpiDepartment();
                    $kpiDepartment->kpiId = $kpiId;
                    $kpiDepartment->departmentId = $employee["departmentId"];
                    $kpiDepartment->status = 1;
                    $kpiDepartment->createDateTime = new Expression('NOW()');
                    $kpiDepartment->updateDateTime = new Expression('NOW()');
                    $kpiDepartment->save(false);
                }
                $kpiTeam = KpiTeam::find()
                    ->where(["kpiId" => $kpiId, "teamId" => $employee["teamId"], "status" => 1])
                    ->one();
                if (!isset($kpiTeam) || empty($kpiTeam)) {
                    $kpiTeam = new KpiTeam();
                    $kpiTeam->kpiId = $kpiId;
                    $kpiTeam->teamId = $employee["teamId"];
                    $kpiTeam->createrId = Yii::$app->user->id;
                    $kpiTeam->status = 1;
                    $kpiTeam->createDateTime = new Expression('NOW()');
                    $kpiTeam->updateDateTime = new Expression('NOW()');
                    $kpiTeam->save(false);
                }
            }
        } else {
            KpiEmployee::deleteAll(["employeeId" => $employeeId, "kpiId" => $kpiId]);
        }
        $kpiEmployee = KpiEmployee::find()
            ->where(["kpiId" => $kpiId, "status" => 1])
            ->asArray()
            ->all();
        $res["status"] = true;
        $res["totalEmployee"] = count($kpiEmployee);
        return json_encode($res);
    }
    public function actionSearchKpiEmployee()
    {
        $searchText = $_POST["searchText"];
        $kpiId = $_POST["kpiId"];
        $kpiBranch = KpiBranch::find()
            ->where(["kpiId" => $kpiId, "status" => 1])
            ->asArray()
            ->all();
        $teams = Team::find()->where(["status" => 1, "departmentId" => $_POST["departmentId"]])
            ->asArray()
            ->orderBy('teamId')
            ->all();
        $textTeam = '<option value="">Team</option>';
        if (isset($teams) && count($teams) > 0) {
            foreach ($teams as $team) :
                $textTeam .= '<option value="' . $team["teamId"] . '">' . $team["teamName"] . '</option>';
            endforeach;
        }
        $employees = [];
        if (isset($kpiBranch) && count($kpiBranch) > 0) {
            $i = 0;
            foreach ($kpiBranch as $kb) :
                $employee = Employee::find()
                    ->where(["status" => 1, "branchId" => $kb["branchId"]])
                    ->andWhere("employeeFirstName LIKE '" . $searchText . "%' or employeeSureName LIKE '" . $searchText . "%'")
                    ->andFilterWhere([
                        "departmentId" => $_POST["departmentId"],
                        "teamId" => $_POST["teamId"]
                    ])
                    ->orderBy('branchId,titleId')
                    ->asArray()
                    ->all();
                if (isset($employee) && count($employee) > 0) {
                    $i = 0;
                    foreach ($employee as $em) :
                        if ($em["picture"] != "") {
                            $picture = $em['picture'];
                        } else {
                            if ($em['gender'] == 1) {
                                $picture = 'image/user.png';
                            } else {
                                $picture = 'image/lady.jpg';
                            }
                        }
                        $employees[$i] = [
                            "name" => $em["employeeFirstname"] . ' ' . $em["employeeSurename"],
                            "id" => $em["employeeId"],
                            "branch" => Branch::branchName($em["branchId"]),
                            "department" => Department::departmentNAme($em["departmentId"]),
                            "team" => Team::teamName($em["teamId"]),
                            "picture" => $picture,
                            "title" => Title::titleName($em["titleId"])
                        ];
                        $i++;
                    endforeach;
                }
            endforeach;
        }
        $textSearch = $this->renderAjax('search_employee', [
            "employees" => $employees,
            "kpiId" => $kpiId
        ]);
        $res["status"] = true;
        $res["textEmployee"] = $textSearch;
        $res["textTeam"] = $textTeam;
        return json_encode($res);
    }
    public function actionSearchAssignKpi()
    {
        $month = $_POST['month'];
        $year = $_POST['year'];
        $paramText = 'companyId=&&branchId=&&teamId=&&month=' . $month . '&&status=&&year=' . $year;
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
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
        $paramText .= '&&adminId=' . $adminId . '&&gmId=' . $gmId . '&&managerId=' . $managerId . '&&supervisorId=' . $supervisorId . '&&teamLeaderId=' . $teamLeaderId . '&&staffId=' . $staffId;
        $kpis = Api::connectApi(Path::Api() . 'kpi/management/kpi-filter?' . $paramText);
        $kpiText = $this->renderAjax('assign_search', [
            "kpis" => $kpis
        ]);
        $res["kpiText"] = $kpiText;
        $res["status"] = true;
        return json_encode($res);
    }
    public function actionKpiKgi($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kpiId = $param["kpiId"];
        $kpiHasKgi = Api::connectApi(Path::Api() . 'kpi/management/kgi-kpi?kpiId=' . $kpiId . '&&kpiHistoryId=0');
        $kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        return $this->render('kgi_kpi', [
            "kpiDetail" => $kpiDetail,
            "kpiHasKgi" => $kpiHasKgi
        ]);
    }

    public function actionWaitApprove()
    {
        $role = UserRole::userRight();
        $teamKpis = [];
        $employeeKpis = [];
        if ($role < 3) {
            return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
        }
        $branchId = User::userBranchId();
        $departments = Department::find()
            ->where(["branchId" => $branchId, "status" => 1])
            ->asArray()
            ->all();
        if (isset($departments) && count($departments) > 0) {
            foreach ($departments as $department) :
                $teams = Team::find()
                    ->where(["departmentId" => $department["departmentId"], "status" => 1])
                    ->asArray()
                    ->all();
                if (isset($teams) && count($teams) > 0) {
                    foreach ($teams as $team) :
                        $kpiTeams = KpiTeam::find()
                            ->where(["teamId" => $team["teamId"]])
                            ->andWhere("status!=99")
                            ->asArray()
                            ->all();
                        if (isset($kpiTeams) && count($kpiTeams) > 0) {
                            foreach ($kpiTeams as $kpiTeam) :
                                $kpiTeamHistory = KpiTeamHistory::find()
                                    ->where(["kpiTeamId" => $kpiTeam["kpiTeamId"], "status" => 88])
                                    ->orderBy("createDateTime DESC")
                                    ->asArray()
                                    ->one();
                                $mainKpi = Kpi::find()
                                    ->select('priority,amountType')
                                    ->where(["kpiId" => $kpiTeam["kpiId"]])
                                    ->asArray()
                                    ->one();
                                if (isset($kpiTeamHistory) && !empty($kpiTeamHistory)) {
                                    $teamKpis[$kpiTeamHistory["kpiTeamHistoryId"]] = [
                                        "kpiId" => $kpiTeam["kpiId"],
                                        "kpiTeamId" => $kpiTeam["kpiTeamId"],
                                        "kpiName" => Kpi::kpiName($kpiTeam["kpiId"]),
                                        "company" => Branch::companyName($branchId),
                                        "branch" => Branch::branchName($branchId),
                                        "department" => Department::departmentNAme($department["departmentId"]),
                                        "teamId" => $kpiTeam["teamId"],
                                        "teamName" => Team::teamName($kpiTeam["teamId"]),
                                        "target" => $kpiTeam["target"],
                                        "reson" => $kpiTeamHistory["detail"],
                                        "newTarget" => $kpiTeamHistory["target"],
                                        "creater" => User::employeeNameByuserId($kpiTeamHistory["createrId"]), // userId
                                        "isOver" => ModelMaster::isOverDuedate(KpiTeam::nextCheckDate($kpiTeam['kpiTeamId'])),
                                        "priority" => $mainKpi["priority"],
                                        "month" => ModelMaster::fullMonthText($kpiTeamHistory["month"]),
                                        "status" => $kpiTeamHistory["status"],
                                        "amountType" => $mainKpi["amountType"]
                                    ];
                                }
                            endforeach;
                        }
                    endforeach;
                }
            endforeach;
        }
        //throw new exception(print_r($teamKpis, true));
        return $this->render('wait_approve1', [
            "role" => $role,
            "teamKpis" => $teamKpis,
            "employeeKpis" => $employeeKpis,
        ]);
    }
    public function actionWaitApproveKpiPersonal()
    {
        $role = UserRole::userRight();
        $employeeKpis = [];
        if ($role < 3) {
            return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
        }
        if ($role == 3) { //Team Leader
            $teamId = User::userTeamId();
            $kpiEmployees = KpiEmployee::find()
                ->select('kpi_employee.*,k.priority')
                ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
                ->JOIN("LEFT JOIN", "kpi k", "k.kpiId=kpi_employee.kpiId")
                ->where(["e.teamId" => $teamId, "k.status" => [1, 2]])
                ->asArray()
                ->orderBy('createDateTime')
                ->all();
            //throw new Exception(print_r($kpiEmployees, true));
            if (isset($kpiEmployees) && count($kpiEmployees) > 0) {
                foreach ($kpiEmployees as $kpiEmployee) :
                    $kpiEmployeeHistory = KpiEmployeeHistory::find()
                        ->where(["kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"], "status" => 88])
                        ->orderBy("createDateTime DESC")
                        ->asArray()
                        ->one();
                    if (isset($kpiEmployeeHistory) && !empty($kpiEmployeeHistory)) {
                        $employeeKpis[$kpiEmployeeHistory["kpiEmployeeHistoryId"]] = [
                            "kpiId" => $kpiEmployee["kpiId"],
                            "kpiName" => Kpi::kpiName($kpiEmployee["kpiId"]),
                            "employeeName" => Employee::employeeName($kpiEmployee["employeeId"]),
                            "target" => $kpiEmployee["target"],
                            "newTarget" => $kpiEmployeeHistory["target"],
                            "reson" => $kpiEmployeeHistory["detail"],
                            "priority" => $kpiEmployee["priority"],
                            "isOver" => ModelMaster::isOverDuedate(KpiEmployee::nextCheckDate($kpiEmployee['kpiEmployeeId'])),
                            "month" => ModelMaster::fullMonthText($kpiEmployeeHistory["month"]),
                            "status" => $kpiEmployee["status"],
                        ];
                    }
                endforeach;
            }
        }
        return $this->render('wait_approve_employee', [
            "role" => $role,
            "employeeKpis" => $employeeKpis,
        ]);
    }
    public function actionApproveKpiTeam($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kpiTeamHistory = KpiTeamHistory::find()
            ->where(["kpiTeamHistoryId" => $param["kpiTeamHistoryId"]])
            ->asArray()
            ->one();
        $kpiTeam = KpiTeam::find()
            ->where(["kpiTeamId" => $kpiTeamHistory["kpiTeamId"]])
            ->asArray()
            ->one();
        $kpiTeamHistories = KpiTeamHistory::find()
            ->where(["kpiTeamId" => $kpiTeamHistory["kpiTeamId"]])
            ->asArray()
            ->orderBy('createDateTime DESC')
            ->all();
        $allTeams = KpiTeam::find()
            ->select('t.teamName,kpi_team.*')
            ->JOIN("LEFT JOIN", "team t", "t.teamId=kpi_team.teamId")
            ->where(["kpiId" => $kpiTeam["kpiId"]])
            ->asArray()
            ->all();
        $kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiTeam["kpiId"] . '&&kpiHistoryId=0');
        return $this->render('kpi_team_history_detail', [
            "kpiDetail" => $kpiDetail,
            "teamName" => Team::teamName($kpiTeam["teamId"]),
            "kpiTeamHistories" => $kpiTeamHistories,
            "allTeams" => $allTeams,
            "kpiTeam" => $kpiTeam
        ]);
    }
    public function actionApproveKpiTarget()
    {
        $kpiTeamId = $_POST["kpiTeamId"];
        $approve = $_POST["approve"];
        $history = KpiTeamHistory::find()
            ->where(["kpiTeamId" => $kpiTeamId, "status" => 88])
            ->orderBy('createDateTime DESC')
            ->one();
        if ($approve == 1) {
            $history->status = 1;
            $kpiTeam = KpiTeam::find()->where(["kpiTeamId" => $kpiTeamId])->one();
            $kpiTeam->target = $history["target"];
            $kpiTeam->status = 1;
            $kpiTeam->save(false);
        } else {
            $history->status = 89;
        }
        $history->save(false);
        $res["status"] = true;
        return json_encode($res);
    }
    public function actionApproveKpiEmployee($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kpiEmployeeHistoryId = $param["kpiEmployeeHistoryId"];
        $teamId = User::userTeamId();
        $kpiEmployeeHistory = KpiEmployeeHistory::find()
            ->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId])
            ->asArray()
            ->one();
        $kpiEmployee = KpiEmployee::find()
            ->where(["kpiEmployeeId" => $kpiEmployeeHistory["kpiEmployeeId"]])
            ->asArray()
            ->one();
        $kpiEmployees = KpiEmployeeHistory::find()
            ->where(["kpiEmployeeId" => $kpiEmployee["kpiEmployeeId"]])
            ->orderBy('createDateTime DESC')
            ->asArray()
            ->all();
        $allEmployee = KpiEmployee::find()
            ->select('e.employeeFirstname,e.employeeSureName,e.teamId,kpi_employee.*')
            ->JOIN("LEFT JOIN", "employee e", "e.employeeId=kpi_employee.employeeId")
            ->where(["kpi_employee.kpiId" => $kpiEmployee["kpiId"], "e.teamId" => $teamId])
            ->orderBy('e.employeeFirstname')
            ->asArray()
            ->all();
        $kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiEmployee["kpiId"] . '&&kpiHistoryId=0');
        return $this->render('kpi_employee_history_detail', [
            "allEmployee" => $allEmployee,
            "kpiDetail" => $kpiDetail,
            "employeeName" => Employee::employeeName($kpiEmployee["employeeId"]),
            "kpiEmployee" => $kpiEmployee,
            "kpiEmployeeHistory" => $kpiEmployeeHistory,
            "kpiEmployees" => $kpiEmployees
        ]);
    }

    public function actionApproveKpiEmployeeTarget()
    {
        $kpiEmployeeHistoryId = $_POST["kpiEmployeeHistoryId"];
        $approve = $_POST["approve"];
        $history = KpiEmployeeHistory::find()
            ->where(["kpiEmployeeHistoryId" => $kpiEmployeeHistoryId, "status" => 88])
            ->orderBy('createDateTime DESC')
            ->one();
        if ($approve == 1) {
            $kpiEmployee = KpiEmployee::find()->where(["kpiEmployeeId" => $history->kpiEmployeeId])->one();
            $history->status = 1;
            $kpiEmployee->target = $history["target"];
            $kpiEmployee->status = 1;
            $kpiEmployee->save(false);
        } else {
            $history->status = 89;
        }
        $history->save(false);
        $res["status"] = true;
        return json_encode($res);
    }
    public function actionRelatedKgi()
    {
        $kpiId = $_POST["kpiId"];
        $kpiHasKgi = Api::connectApi(Path::Api() . 'kpi/management/kgi-kpi?kpiId=' . $kpiId);
        $kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $text = $this->renderAjax('kpi_has_kgi', ["kpiHasKgi" => $kpiHasKgi]);
        $res["kgiText"] = $text;
        $res["kpiName"] = $kpiDetail["kpiName"];
        return json_encode($res);
    }
    public function actionKpiDetail($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kpiId = $param["kpiId"];
        $kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $kpiTeams = Api::connectApi(Path::Api() . 'kpi/management/kpi-team?id=' . $kpiId);
        $res["teamText"] = $this->renderAjax('kpi_team', ["kpiTeams" => $kpiTeams, "kpiId" => $kpiId]);
        $kpiEmployee = Api::connectApi(Path::Api() . 'kpi/management/kpi-employee?id=' . $kpiId);
        $res["employeeText"] = $this->renderAjax('kpi_member', ["kpiEmloyee" => $kpiEmployee, "kpiId" => $kpiId]);
        $history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId);
        $res["historyText"] = $this->renderAjax('kpi_history', ["history" => $history]);
        $kpiIssue = Api::connectApi(Path::Api() . 'kpi/management/kpi-issue?kpiId=' . $kpiId);
        $res["issueText"] =  $this->renderAjax('kpi_issue_detail', [
            "kpiIssue" => $kpiIssue,
            "kpiId" => $kpiId,
        ]);
        $role = UserRole::userRight();
        return $this->render('kpi_detail', [
            'kpi' => $kpi,
            "kpiId" => $kpiId,
            "role" => $role,
            "kpiTeams" => $kpiTeams,
            "kpiEmloyee" => $kpiEmployee,
            "res" => $res
        ]);
    }

    public function actionDeleteKpiTeam()
    {
        $kpiTeamId = $_POST["kpiTeamId"];
        KpiTeam::updateAll(["status" => 99], ["kpiId" => $kpiTeamId]);
        KpiTeamHistory::updateAll(["status" => 99], ["kpiTeamId" => $kpiTeamId]);
        $res["status"] = true;
        return json_encode($res);
    }
    public function setDefault()
    {
        $deletedCompany = Company::find()->where(["status" => 99])->asArray()->all();
        if (isset($deletedCompany) && count($deletedCompany) > 0) {
            foreach ($deletedCompany as $company) :
                Kfi::updateAll(["status" => 99], ["companyId" => $company["companyId"]]);
                Kgi::updateAll(["status" => 99], ["companyId" => $company["companyId"]]);
                Kpi::updateAll(["status" => 99], ["companyId" => $company["companyId"]]);
            endforeach;
        }
    }
    public function actionNextKpiHistory()
    {
        $kpiHistoryId = $_POST["kpiHistoryId"];
        $currentHistory = KpiHistory::find()->where(["kpiHistoryId" => $kpiHistoryId])->asArray()->one();
        $kpiId = $currentHistory["kpiId"];
        $unit = Unit::find()->where(["unitId" => $currentHistory["unitId"]])->asArray()->one();
        if ($currentHistory["month"] != "" && $currentHistory["year"] != "") {
            $nextTargetMonthYear = ModelMaster::nextTargetMonthYear($unit["unitName"], $currentHistory["month"], $currentHistory["year"]);
            $nextMonth = $nextTargetMonthYear["nextMonth"];
            $nextYear = $nextTargetMonthYear["nextYear"];
        } else {
            $nextMonth = null;
            $nextYear = null;
        }
        $kpiHistory = new KpiHistory();
        $kpiHistory->kpiId = $currentHistory["kpiId"];
        $kpiHistory->createrId = Yii::$app->user->id;
        $kpiHistory->titleProcess = 'New target';
        $kpiHistory->description = $currentHistory["description"];
        $kpiHistory->nextCheckDate = null;
        $kpiHistory->amountType = $currentHistory["amountType"];
        $kpiHistory->code = $currentHistory["code"];
        $kpiHistory->status = 1;
        $kpiHistory->quantRatio = $currentHistory["quantRatio"];
        $kpiHistory->targetAmount =  $currentHistory["targetAmount"];
        $kpiHistory->result = 0;
        $kpiHistory->priority = $currentHistory["priority"];
        $kpiHistory->unitId =  $currentHistory["unitId"];
        $kpiHistory->month = $nextMonth;
        $kpiHistory->year = $nextYear;
        $kpiHistory->createDateTime = new Expression('NOW()');
        $kpiHistory->updateDateTime = new Expression('NOW()');
        if ($kpiHistory->save(false)) {
            $kpi = Kpi::find()->where(["kpiId" => $currentHistory["kpiId"]])->one();
            $kpi->status = 1;
            $kpi->month = $nextMonth;
            $kpi->year = $nextYear;
            $kpi->toDate = null;
            $kpi->fromDate = null;
            $kpi->result = 0.00;
            $kpi->updateDateTime = new Expression('NOW()');
            if ($kpi->save(false)) {
                $kpiTeam = KpiTeam::find()->where(["kpiId" => $currentHistory["kpiId"], "status" => 2])->all();
                foreach ($kpiTeam as $team) :
                    if ($team->month  == $nextMonth && $team->year  == $nextYear) {
                    } else {
                        // if ($team->status == 1) {
                        //     $status = 5;
                        // }
                        // if ($team->status == 2) {
                        $team->status = 1;
                        $team->month = $nextMonth;
                        $team->year = $nextYear;
                        $team->fromDate = null;
                        $team->toDate = null;
                        $team->nextCheckDate = null;
                        $team->result = 0.00;
                        //    }
                        $kpiTeamHistory = new kpiTeamHistory();
                        $kpiTeamHistory->kpiTeamId = $team->kpiTeamId;
                        $kpiTeamHistory->createrId = Yii::$app->user->id;
                        $kpiTeamHistory->month = $nextMonth;
                        $kpiTeamHistory->year = $nextYear;
                        $kpiTeamHistory->createDateTime = new Expression('NOW()');
                        $kpiTeamHistory->updateDateTime = new Expression('NOW()');
                        $kpiTeamHistory->detail = "auto set from company kpi";
                        $kpiTeamHistory->status = 1;
                        $kpiTeamHistory->save(false);
                        $team->save(false);
                    }
                endforeach;
                $kpiEmployee = KpiEmployee::find()->where(["kpiId" => $currentHistory["kpiId"], "status" => 2])->all();
                foreach ($kpiEmployee as $employee) :
                    if ($employee->month  == $nextMonth && $employee->year  == $nextYear) {
                    } else {
                        // if ($employee->status == 1) {
                        //     $statusEmployee = 5;
                        // }
                        // if ($employee->status == 2) {
                        // $statusEmployee = 1;
                        $employee->status = 1;
                        $employee->month = $nextMonth;
                        $employee->year = $nextYear;
                        $employee->fromDate = null;
                        $employee->toDate = null;
                        $employee->nextCheckDate = null;
                        $employee->result = 0.00;
                        // }
                        $kpiEmployeeHistory = new kpiEmployeeHistory();
                        $kpiEmployeeHistory->kpiEmployeeId = $employee->kpiEmployeeId;
                        $kpiEmployeeHistory->createrId = Yii::$app->user->id;
                        $kpiEmployeeHistory->month = $nextMonth;
                        $kpiEmployeeHistory->year = $nextYear;
                        $kpiEmployeeHistory->createDateTime = new Expression('NOW()');
                        $kpiEmployeeHistory->updateDateTime = new Expression('NOW()');
                        $kpiEmployeeHistory->detail = "auto set from company kpi";
                        $kpiEmployeeHistory->status = 1;
                        $kpiEmployeeHistory->save(false);
                        $employee->save(false);
                    }
                endforeach;
            }
        }

        return $this->redirect(Yii::$app->homeUrl . 'kpi/view/index/' . ModelMaster::encodeParams(["kpiId" => $kpiId]));
    }
    public function actionChanngeTeamTargetReason()
    {
        $kpiTeamHistoryId = $_POST["kpiTeamHistoryId"];
        $kpiTeamHistory = KpiTeamHistory::find()
            ->where(["kpiTeamHistoryId" => $kpiTeamHistoryId])
            ->asArray()
            ->one();

        if (isset($kpiTeamHistory) && !empty($kpiTeamHistory)) {
            $res["reason"] = $kpiTeamHistory["detail"];
        } else {
            $res["reason"] = "";
        }
        return json_encode($res);
    }
    public function actionAutoResult()
    {
        $kpiId = $_POST["kpiId"];
        $kpi = Kpi::find()->where(["kpiId" => $kpiId])->asArray()->one();
        $year = $kpi["year"];
        $month = $kpi["month"];
        $kpiTeam = KpiTeam::find()
            ->select('kpiTeamId,result')
            ->where([
                "kpiId" => $kpiId,
                "status" => [1, 2, 4],
                "month" => $month,
                "year" => $year
            ])
            ->asArray()
            ->all();
        $autoResult = 0;
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            foreach ($kpiTeam as $kg):
                $autoResult += $kg["result"];
            endforeach;
        }
        $res["result"] = $autoResult;
        return json_encode($res);
    }
    public function actionKpiUpdateHistory()
    {
        $kpiId = $_POST["kpiId"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $res = [];
        $role = UserRole::userRight();
        $teamId = Team::userTeam(Yii::$app->user->id);
        $kpi = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $kpiHistoryTeam = Api::connectApi(Path::Api() . 'kpi/kpi-team/kpi-history-team?kpiId=' . $kpiId . '&&month=' . $month . '&&year=' . $year);
        $kpiHistoryEmployee = Api::connectApi(Path::Api() . 'kpi/kpi-personal/kpi-history-employee?kpiId=' . $kpiId . '&&month=' . $month . '&&year=' . $year);
        $res["month"] = $kpi["monthNameFull"];
        $res["year"] = $kpi["year"];
        $res["fromDate"] = $kpi["fromDateDetail"];
        $res["toDate"] = $kpi["toDateDetail"];
        $res["target"] = number_format($kpi["targetAmount"]);
        $res["result"] = number_format($kpi["result"]);
        $res["ratio"] = (int)$kpi["ratio"];
        $res["dueBehide"] = 100 - (int)$kpi["ratio"];
        $teamText = $this->renderAjax('team_history', ["kpiHistoryTeam" => $kpiHistoryTeam]);
        $individualText = $this->renderAjax('individual_history', ["kpiHistoryEmployee" => $kpiHistoryEmployee, "role" => $role, "teamId" => $teamId]);
        $res["teamText"] = $teamText;
        $res["individualText"] = $individualText;
        return json_encode($res);
    }
    public function actionCheckKpiTeam()
    {
        $kpiId = $_POST["kpiId"];
        $kpiTeam = KpiTeam::find()->where(["kpiId" => $kpiId, "status" => 1])->asArray()->all();
        $res = [];
        $res["status"] = true;
        if (isset($kpiTeam) && count($kpiTeam) > 0) {
            $res["countTeam"] = count($kpiTeam);
        } else {
            $res["countTeam"] = 0;
        }
        return json_encode($res);
    }
}
