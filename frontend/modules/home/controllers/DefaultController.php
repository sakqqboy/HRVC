<?php

namespace frontend\modules\home\controllers;

use frontend\models\hrvc\User;
use Yii;
use yii\web\Controller;
use common\helpers\Path;
use common\helpers\Session;
use common\models\ModelMaster;
use Exception;
use frontend\components\Api;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\UserRole;

/**
 * Default controller for the `home` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        Session::deleteSession();
        return true;
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDashboard()
    {
        $userId = Yii::$app->user->id;
        $employeeId = User::employeeIdFromUserId($userId);
        $role = UserRole::userRight();
        $employeeProfile = Api::connectApi(Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
        // throw new Exception(print_r($employeeProfile, true));
            $employeeData = [
                'employeeId' => $employeeProfile['employeeId'],
                'employeeNumber' => $employeeProfile['employeeNumber'],
                'employeeFirstname' => $employeeProfile['employeeFirstname'],
                'employeeSurename' => $employeeProfile['employeeSurename'],
                'email' => $employeeProfile['email'],
                'companyId' => $employeeProfile['companyId'],
                'branchId' => $employeeProfile['branchId'],
                'departmentId' => $employeeProfile['departmentId'],
                'titleId' => $employeeProfile['titleId'],
                'teamId' => $employeeProfile['teamId'],
                'joinDate' => $employeeProfile['joinDate'],
                'hireDate' => $employeeProfile['hireDate'],
                'picture' => Employee::employeeImage($employeeProfile["employeeId"]),
                'employeeAgreement' => !empty($employeeProfile['employeeAgreement'])
                    ? $employeeProfile['employeeAgreement']
                    : null,
                'status' => $employeeProfile['status'],
                'companyName' => $employeeProfile['companyName'],
                'companyPicture' => Company::companyPicture($employeeProfile["cPicture"]),
                'countryName' => $employeeProfile['countryName'],
                'flag' => !empty($employeeProfile['flag'])
                    ? $employeeProfile['flag']
                    : 'images/flag/svg/default.svg',
                'titleName' => $employeeProfile['titleName'],
                'employeeConditionName' => $employeeProfile['employeeConditionName'],
                'statusName' => $employeeProfile['statusName'],
                'city' => $employeeProfile['city'],
                'shortTag' => $employeeProfile['shortTag'],
            ];
        $pendingApprove = Api::connectApi(Path::Api() . 'home/default/pending-approval?role=' . $role . '&&employeeId=' . $employeeId);
        return $this->render('dashboard', [
            'employeeProfile' => $employeeData,
            'userId' => $userId,
            'pendingApprove' => $pendingApprove
        ]);
    }

    public function actionCompanyTab()
    {
        $companyId = $_POST['companyId'];
        $groupId = Group::currentGroupId();
        $role = UserRole::userRight();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $dashbordCompany = Api::connectApi(Path::Api() . 'home/dashbord/dashbord-company?companyId=' . $companyId);
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        return $this->renderPartial('dashbord_tabs_content', [
            'tab' => 'company',
            'contentDetail' => $dashbordCompany,
            "companies" => $companies,
            "units" => $units,
            "months" => $months,
            "isManager" => $isManager,
            "role" => $role
        ]);
    }


    public function actionTeamTab()
    {
        $teamId = $_POST['teamId'];
        $userId = Yii::$app->user->id;
        $groupId = Group::currentGroupId();
        $role = UserRole::userRight();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $dashbordTeam = Api::connectApi(Path::Api() . 'home/dashbord/dashbord-team?teamId=' . $teamId . '&&userId=' . $userId . '&&role=' . $role);
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        return $this->renderPartial('dashbord_tabs_content', [
            'tab' => 'team',
            'contentDetail' => $dashbordTeam,
            "companies" => $companies,
            "units" => $units,
            "months" => $months,
            "isManager" => $isManager,
            "role" => $role
        ]);
    }

    public function actionSelfTab()
    {
        $employeeId = $_POST['employeeId'];
        $userId = Yii::$app->user->id;
        $groupId = Group::currentGroupId();
        $role = UserRole::userRight();
        if ($groupId == null) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
        }
        $dashbordEmployee = Api::connectApi(Path::Api() . 'home/dashbord/dashbord-employee?employeeId=' . $employeeId . '&&userId=' . $userId . '&&role=' . $role);
        $companies = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
        $units = Api::connectApi(Path::Api() . 'masterdata/unit/all-unit');
        $months = ModelMaster::monthFull(1);
        $isManager = UserRole::isManager();
        return $this->renderPartial('dashbord_tabs_content', [
            'tab' => 'self',
            'contentDetail' => $dashbordEmployee,
            "companies" => $companies,
            "units" => $units,
            "months" => $months,
            "isManager" => $isManager,
            "role" => $role
        ]);
    }
}
