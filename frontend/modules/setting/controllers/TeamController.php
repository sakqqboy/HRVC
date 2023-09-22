<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class TeamController extends Controller
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
        return true; //go to origin request
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $companyId = $param["companyId"];
        $allTeams = [];
        $companyName = '';
        $branches = [];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        if ($companyId != '') {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
            $company = curl_exec($api);
            $company = json_decode($company, true);
            $companyName = $company["companyName"];

            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
            $branches = curl_exec($api);
            $branches = json_decode($branches, true);

            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/company-team?id=' . $companyId);
            $allTeams = curl_exec($api);
            $allTeams = json_decode($allTeams, true);
            //throw new Exception(1);
        } else {
            curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/all-teams-detail');
            $allTeams = curl_exec($api);
            $allTeams = json_decode($allTeams, true);
            //throw new Exception(2);
        }
        $groupId = Group::currentGroupId();
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);

        curl_close($api);
        return $this->render('create', [
            "companies" => $companies,
            "allTeams" => $allTeams,
            "companyName" => $companyName,
            "companyId" => $companyId,
            "branches" => $branches
        ]);
    }
    public function actionCompanyBranch()
    {
        $companyId = $_POST["companyId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
        $branch = curl_exec($api);
        $branch = json_decode($branch, true);
        curl_close($api);
        $res = [];
        $textSelect = '<option value="">Selech branch</option>';
        if (count($branch) > 0) {
            foreach ($branch as $b) :
                $textSelect .= "<option value='" . $b['branchId'] . "'>" . $b['branchName'] . "</option>";
            endforeach;
        }
        $res["textSelect"] = $textSelect;
        return json_encode($res);
    }
    public function actionBranchDepartment()
    {
        $branchId = $_POST["branchId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/department/branch-department?id=' . $branchId);
        $department = curl_exec($api);
        $department = json_decode($department, true);
        curl_close($api);
        $res = [];
        $textSelect = '<option value="">Select Department</option>';
        if (count($department) > 0) {
            foreach ($department as $b) :
                $textSelect .= "<option value='" . $b['departmentId'] . "'>" . $b['departmentName'] . "</option>";
            endforeach;
        }
        $res["textSelect"] = $textSelect;
        return json_encode($res);
    }
    public function actionDepartmentTeam()
    {
        $departmentId = $_POST["departmentId"];
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/department-team?id=' . $departmentId);
        $team = curl_exec($api);
        $team = json_decode($team, true);
        curl_close($api);
        $res = [];
        $textSelect = '<option value="">Select Department</option>';
        if (count($team) > 0) {
            foreach ($team as $t) :
                $textSelect .= "<option value='" . $t['teamId'] . "'>" . $t['teamName'] . "</option>";
            endforeach;
        }
        $res["textSelect"] = $textSelect;
        return json_encode($res);
    }
    public function actionSaveCreateTeam()
    {
        $departmentId = $_POST["departmentId"];
        $teamName = $_POST["teamName"];
        $check = Team::find()
            ->where([
                "teamName" => $teamName,
                "departmentId" => $departmentId,
            ])
            ->one();
        if (isset($check) && !empty($check)) {
            $res["status"] = false;
        } else {
            $team = new Team();
            $team->departmentId = $departmentId;
            $team->teamName = $teamName;
            $team->status = 1;
            $team->createDateTime = new Expression('NOW()');
            $team->updateDateTime = new Expression('NOw()');
            if ($team->save(false)) {
                $teamId = Yii::$app->db->lastInsertID;
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
                $teamDetail = curl_exec($api);
                $teamDetail = json_decode($teamDetail, true);
                $textNewTeam = $this->renderAjax('new_team', [
                    "teamId" => $teamId,
                    "team" => $teamDetail
                ]);
                $res["textNewTeam"] = $textNewTeam;
                $res["status"] = true;
            }
        }
        return json_encode($res);
    }
    public function actionUpdateTeam()
    {
        $groupId = Group::currentGroupId();
        $teamId = $_POST["teamId"] - 543;
        $team = Team::find()->where(["teamId" => $teamId])->asArray()->one();

        $department = Department::find()
            ->select('departmentId,departmentName,branchId')
            ->where(["departmentId" => $team["departmentId"]])
            ->asArray()
            ->one();
        $branch = Branch::find()
            ->select('branchId,branchName,companyId')
            ->where(["branchId" => $department["branchId"]])
            ->asArray()
            ->one();
        $company = Company::find()
            ->select('companyId,companyName')
            ->where(["companyId" => $branch["companyId"]])
            ->asArray()
            ->one();
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $companies = curl_exec($api);
        $companies = json_decode($companies, true);
        curl_close($api);

        $textAllCompany = "<option value='" . $company['companyId'] . "'>" . $company['companyName'] . "</option>";
        $textAllCompany .= "<option value=''>Select Company</option>";
        if (count($companies) > 0) {
            foreach ($companies as $com) :
                $textAllCompany .= "<option value='" . $com['companyId'] . "'>" . $com['companyName'] . "</option>";
            endforeach;
        }

        $branches = Branch::find()
            ->select('branchId,branchName')
            ->where(["companyId" => $company["companyId"], "status" => 1])
            ->asArray()
            ->orderBy('branchName')
            ->all();
        $textAllBranch = "<option value='" . $branch['branchId'] . "'>" . $branch['branchName'] . "</option>";
        $textAllBranch .= "<option value=''>Select Branch</option>";
        if (count($branches) > 0) {
            foreach ($branches as $br) :
                $textAllBranch .= "<option value='" . $br['branchId'] . "'>" . $br['branchName'] . "</option>";
            endforeach;
        }

        $departments = Department::find()
            ->select('departmentId,departmentName')
            ->where(["branchId" => $branch["branchId"], "status" => 1])
            ->asArray()
            ->orderBy('departmentName')
            ->all();
        $textAllDepartment = "<option value='" . $department['departmentId'] . "'>" . $department['departmentName'] . "</option>";
        $textAllDepartment .= "<option value=''>Select Department</option>";
        if (count($departments) > 0) {
            foreach ($departments as $de) :
                $textAllDepartment .= "<option value='" . $de['departmentId'] . "'>" . $de['departmentName'] . "</option>";
            endforeach;
        }
        $res["textAllCompany"] = $textAllCompany;
        $res["textAllBranch"] = $textAllBranch;
        $res["textAllDepartment"] = $textAllDepartment;
        $res["teamName"] = $team["teamName"];
        return json_encode($res);
    }
    public function actionSaveUpdateTeam()
    {
        $departmentId = $_POST["departmentId"];
        $teamName = $_POST["teamName"];
        $teamId = $_POST["teamId"] - 543;
        $check = Team::find()
            ->where([
                "teamName" => $teamName,
                "departmentId" => $departmentId,
            ])
            ->andWhere("teamId!=$teamId")
            ->one();
        if (isset($check) && !empty($check)) {
            $res["status"] = false;
        } else {
            $team = Team::find()->where(["teamId" => $teamId])->one();
            $team->departmentId = $departmentId;
            $team->teamName = $teamName;
            $team->status = 1;
            $team->updateDateTime = new Expression('NOW()');
            if ($team->save(false)) {
                $api = curl_init();
                curl_setopt($api, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/team/team-detail?id=' . $teamId);
                $teamDetail = curl_exec($api);
                $teamDetail = json_decode($teamDetail, true);
                $textUpdateTeam = $this->renderAjax('update_team', [
                    "teamId" => $teamId,
                    "team" => $teamDetail
                ]);
                $res["textUpdateTeam"] = $textUpdateTeam;
                $res["status"] = true;
            }
        }
        return json_encode($res);
    }
    public function actionDeleteTeam()
    {
        $teamId = $_POST["teamId"] - 543;
        $team = Team::find()->where(["teamId" => $teamId])->one();
        $team->status = 99;

        if ($team->save(false)) {
            $res["status"] = true;
        } else {
            $res["status"] = false;
        }
        return json_encode($res);
    }
}
