<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\KpiDepartment;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\KpiIssue;
use frontend\models\hrvc\KpiSolution;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\User;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `kpi` module
 */
class ManagementController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        if (!Yii::$app->user->id) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $this->setDefault();
        return true;
    }
    public function actionIndex()
    {
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }

        $api = curl_init();
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
        $units = curl_exec($api);
        $units = json_decode($units, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/index');
        $kpis = curl_exec($api);
        $kpis = json_decode($kpis, true);

        curl_close($api);
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        return $this->render('index', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "kpis" => $kpis,
            "isManager" => $isManager
        ]);
    }
    public function actionGrid()
    {
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }

        $api = curl_init();
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
        $units = curl_exec($api);
        $units = json_decode($units, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/index');
        $kpis = curl_exec($api);
        $kpis = json_decode($kpis, true);

        curl_close($api);
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        return $this->render('kpi_grid', [
            "units" => $units,
            "companies" => $companies,
            "months" => $months,
            "kpis" => $kpis,
            "isManager" => $isManager
        ]);
    }
    public function actionCreateKpi()
    {
        if (isset($_POST["kpiName"]) && trim($_POST["kpiName"])) {
            $kpi = new Kpi();
            $kpi->kpiName = $_POST["kpiName"];
            $kpi->companyId = $_POST["companyId"];
            $kpi->unitId = $_POST["unit"];
            // $kpi->periodDate = $_POST["periodDate"];
            $kpi->fromDate = $_POST["fromDate"];
            $kpi->toDate = $_POST["toDate"];
            $kpi->targetAmount = $_POST["targetAmount"];
            $kpi->kpiDetail = $_POST["detail"];
            $kpi->quantRatio = $_POST["quantRatio"];
            $kpi->priority = $_POST["priority"];
            $kpi->amountType = $_POST["amountType"];
            $kpi->code = $_POST["code"];
            $kpi->status = $_POST["status"];
            $kpi->month = $_POST["month"];
            $kpi->result = $_POST["result"];
            $kpi->createrId = Yii::$app->user->id;
            $kpi->createDateTime = new Expression('NOW()');
            $kpi->updateDateTime = new Expression('NOW()');
            if ($kpi->save(false)) {
                $kpiId = Yii::$app->db->lastInsertID;
                if (isset($_POST["branch"]) && count($_POST["branch"]) > 0) {
                    $this->saveKpiBranch($_POST["branch"], $kpiId);
                }
                if (isset($_POST["department"]) && count($_POST["department"]) > 0) {
                    $this->saveKpiDepartment($_POST["department"], $kpiId);
                }
                if (isset($_POST["team"]) && count($_POST["team"]) > 0) {
                    $this->saveKpiTeam($_POST["team"], $kpiId);
                }
                return $this->redirect('index');
            }
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
    public function saveKpiTeam($team, $kpiId)
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
                $old = KpiTeam::find()->where(["kpiId" => $kpiId, "teamId" => $t, "status" => 1])->one();
                if (!isset($old) || empty($old)) {
                    $kpiTeam = new KpiTeam();
                    $kpiTeam->kpiId = $kpiId;
                    $kpiTeam->teamId = $t;
                    $kpiTeam->status = 1;
                    $kpiTeam->createDateTime = new Expression('NOW()');
                    $kpiTeam->updateDateTime = new Expression('NOW()');
                    $kpiTeam->save(false);
                }
            endforeach;
        }
    }
    public function actionPrepareUpdate()
    {
        $kpiId = $_POST["kpiId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
        $kpi = curl_exec($api);
        $kpi = json_decode($kpi, true);

        $companyId = $kpi["companyId"];
        $kpiBranchText = '';
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-branch?id=' . $companyId);
        $kpiBranch = curl_exec($api);
        $kpiBranch = json_decode($kpiBranch, true);
        $kpiBranchText = $this->renderAjax('multi_branch_update', [
            "branches" => $kpiBranch,
            "kpiId" => $kpiId
        ]);
        $branch["textBranch"] = $kpiBranchText;

        $kpiDepartmentText = '';
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-department?id=' . $kpiId);
        $kpiDepartment = curl_exec($api);
        $kpiDepartment = json_decode($kpiDepartment, true);
        $kpiDepartmentText = $this->renderAjax('multi_department_update', [
            "d" => $kpiDepartment,
            "kpiId" => $kpiId
        ]);
        $department["textDepartment"] = $kpiDepartmentText;


        $kpiTeamText = '';
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-team?id=' . $kpiId);
        $kpiTeam = curl_exec($api);
        $kpiTeam = json_decode($kpiTeam, true);
        $kpiTeamText = $this->renderAjax('multi_team_update', [
            "t" => $kpiTeam,
            "kpiId" => $kpiId
        ]);
        $team["textTeam"] = $kpiTeamText;


        $data = array_merge($kpi, $branch, $department, $team);
        // throw new Exception(print_r($data, true));
        curl_close($api);
        return json_encode($data);
    }
    public function actionUpdateKpi()
    {
        $isManager = UserRole::isManager();
        if (isset($_POST["kpiId"]) && $_POST["kpiId"] != "") {
            $kpiId = $_POST["kpiId"];
            //throw new Exception(print_r(Yii::$app->request->post(), true));
            $kpi = Kpi::find()->where(["kpiId" => $kpiId])->one();
            $kpi->kpiName = $_POST["kpiName"];
            $kpi->companyId = $_POST["companyId"];
            $kpi->unitId = $_POST["unit"];
            // $kpi->periodDate = $_POST["periodDate"];
            $kpi->fromDate = $_POST["fromDate"];
            $kpi->toDate = $_POST["toDate"];
            if ($kpi->fromDate == "") {
                $kpi->fromDate = $_POST["fromDate"];
            }
            if ($kpi->toDate == "") {
                $kpi->toDate = $_POST["toDate"];
            }
            if ($isManager == 1 && $kpi->targetAmount == "") {
                $kpi->targetAmount = $_POST["targetAmount"];
            }
            // $kpi->targetAmount = $_POST["targetAmount"];
            $kpi->kpiDetail = $_POST["detail"];
            $kpi->quantRatio = $_POST["quantRatio"];
            $kpi->priority = $_POST["priority"];
            $kpi->amountType = $_POST["amountType"];
            $kpi->code = $_POST["code"];
            $kpi->status = $_POST["status"];
            $kpi->month = $_POST["month"];
            $kpi->result = $_POST["result"];
            $kpi->createrId = Yii::$app->user->id;
            $kpi->updateDateTime = new Expression('NOW()');
            if ($kpi->save(false)) {
                $kpiHistory = new KpiHistory();
                $kpiHistory->kpiId = $_POST["kpiId"];
                $kpiHistory->kpiHistoryName = $_POST["historyName"];
                $kpiHistory->titleProcess = $_POST["historyName"];
                $kpiHistory->unitId = $_POST["unit"];
                // $kpiHistory->periodDate = $_POST["periodDate"];
                $kpiHistory->nextCheckDate = $_POST["nextDate"];
                if ($isManager == 1) {
                    $kpiHistory->targetAmount = $_POST["targetAmount"];
                } else {
                    $kpiHistory->targetAmount = $kpi->targetAmount;
                }
                $kpiHistory->description = $_POST["detail"];
                $kpiHistory->remark = $_POST["remark"];
                $kpiHistory->quantRatio = $_POST["quantRatio"];
                $kpiHistory->priority = $_POST["priority"];
                $kpiHistory->amountType = $_POST["amountType"];
                $kpiHistory->code = $_POST["code"];
                $kpiHistory->status = $_POST["status"];
                $kpiHistory->month = $_POST["month"];
                $kpiHistory->result = $_POST["result"];
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
                    $this->savekpiTeam($_POST["team"], $kpiId);
                }
                return $this->redirect('index');
            }
        }
        return $this->redirect('index');
    }
    public function actionHistory()
    {

        $kpiId = $_POST["kpiId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
        $kpi = curl_exec($api);
        $kpi = json_decode($kpi, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-team?id=' . $kpiId);
        $kpiTeams = curl_exec($api);
        $kpiTeams = json_decode($kpiTeams, true);
        $res["teamText"] = $this->renderAjax('kpi_team', ["kpiTeams" => $kpiTeams]);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-employee?id=' . $kpiId);
        $kpiEmloyee = curl_exec($api);
        $kpiEmloyee = json_decode($kpiEmloyee, true);
        $res["employeeText"] = $this->renderAjax('kpi_member', ["kpiEmloyee" => $kpiEmloyee]);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId);
        $history = curl_exec($api);
        $history = json_decode($history, true);
        $res["historyText"] = $this->renderAjax('kpi_history', ["history" => $history]);

        curl_close($api);

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
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId);
        $kpi = curl_exec($api);
        $kpi = json_decode($kpi, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-issue?kpiId=' . $kpiId);
        $kpiIssue = curl_exec($api);
        $kpiIssue = json_decode($kpiIssue, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        $profile = curl_exec($api);
        $profile = json_decode($profile, true);

        curl_close($api);
        $res["status"] = true;
        $res["issueText"] = $this->renderAjax('kpi_issue', [
            "kpiIssue" => $kpiIssue,
            "kpiId" => $kpiId,
            "profile" => $profile,
            "employeeId" => $employeeId,
            "kpiName" => $kpi["kpiName"]
        ]);
        $res["historyText"] =  $this->renderAjax('kpi_history2', [
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
        if (isset($_POST["newIssue"]) && trim($_POST["newIssue"]) != "") {
            $kpiIssue = new KpiIssue();

            $kpiIssue->issue = $_POST["newIssue"];
            $kpiIssue->kpiId = $_POST["kpiId"];
            $kpiIssue->employeeId = $_POST["employeeId"];
            $kpiIssue->status = 1;
            $kpiIssue->createDateTime = new Expression('NOW()');
            $kpiIssue->updateDateTime = new Expression('NOW()');
            $fileObj = UploadedFile::getInstanceByName("attachkpiFile");
            if (isset($fileObj) && !empty($fileObj)) {
                //throw new Exception("asdfad");
                $path = Path::getHost() . 'file/kpi/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileObj->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileObj->saveAs($pathSave);
                $kpiIssue->file = 'file/kpi/' . $fileName;
            }
            //throw new Exception(print_r(Yii::$app->request->post(), true));
            if ($kpiIssue->save(false)) {
                return $this->redirect('index');
            }
        }
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
        $createDateTime = date('Y-m-d');
        if ($answer->save(false)) {
            $res["commentText"] = $this->renderAjax('comment', [
                "name" => User::userHeaderName(),
                "image" => User::userHeaderImage(),
                "answer" => $solution,
                "createDateTime" => ModelMaster::engDate($createDateTime, 2),
                "kpiIssueId" => $kpiIssueId,
                "file" => $file,
                "fileName" => $fileName
            ]);
            $res["status"] = true;
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
        if ($companyId == "" && $branchId == "" && $teamId == "" && $month == "" && $status == "" && $year == "") {
            if ($type == "list") {
                return $this->redirect(Yii::$app->homeUrl . 'kpi/management/index');
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'kpi/management/grid');
            }
        }
        $paramText = 'companyId=' . $companyId . '&&branchId=' . $branchId . '&&teamId=' . $teamId . '&&month=' . $month . '&&status=' . $status . '&&year=' . $year;
        $groupId = Group::currentGroupId();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kpi/management/kpi-filter?' . $paramText);
        $kpis = curl_exec($api);
        $kpis = json_decode($kpis, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
        $units = curl_exec($api);
        $units = json_decode($units, true);

        if ($companyId != "") {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branches = curl_exec($api);
            $branches = json_decode($branches, true);
        }
        if ($branchId != "") {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/branch-team?id=' . $branchId);
            $teams = curl_exec($api);
            $teams = json_decode($teams, true);
        }

        curl_close($api);
        $months = ModelMaster::monthFull(1);
        if ($type == "list") {
            $file = "kpi_search_result";
        } else {
            $file = "kpi_search_result_grid";
        }
        $isManager = UserRole::isManager();
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
            "isManager" => $isManager
        ]);
    }
    public function actionDepartmentMultiTeam()
    {
        $res["status"] = false;
        $t = [];
        $textTeam = '';
        $branchDepartment = [];
        $acType = $_POST["acType"];
        if (isset($_POST["multiBranch"]) && count($_POST["multiBranch"]) > 0) {
            foreach ($_POST["multiBranch"] as $branchId) :
                if (isset($_POST["multiDepartment"]) && count($_POST["multiDepartment"]) > 0) {
                    foreach ($_POST["multiDepartment"] as $departmentId) :
                        if ($branchId != '') {
                            $department = Department::find()
                                ->where(["departmentId" => $departmentId, "branchId" => $branchId])
                                ->one();
                            if (isset($department) && !empty($department)) {
                                $branchDepartment[$branchId][$departmentId] = $departmentId;
                            }
                        }
                    endforeach;
                }
            endforeach;
        }
        if (count($branchDepartment) > 0) {

            foreach ($branchDepartment as $branchId => $departments) :

                foreach ($departments as $dId => $id) :
                    $teams = Team::find()
                        ->where(["departmentId" => $dId])
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
                $this->saveKpiTeam($_POST["team"], $kpiId);
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
                $this->saveKpiTeam($team, $kpiCopyId);
            }
            return $this->redirect('index');
        }
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
}
