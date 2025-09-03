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
        $pendingApprove = Api::connectApi(Path::Api() . 'home/default/pending-approval?role=' . $role . '&&employeeId=' . $employeeId);
        return $this->render('dashboard', [
            'employeeProfile' => $employeeProfile,
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
