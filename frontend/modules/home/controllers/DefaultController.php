<?php

namespace frontend\modules\home\controllers;

use frontend\models\hrvc\User;
use Yii;
use yii\web\Controller;
use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
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
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDashboard()
    {
        $userId = Yii::$app->user->id;
        $employeeId = User::employeeIdFromUserId($userId);
        $api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/employee/employee-detail?id=' . $employeeId);
		$employeeProfile = curl_exec($api);
		$employeeProfile = json_decode($employeeProfile, true);
        // throw new \Exception(print_r($employeeProfile, true));

        // curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/profile?employeeId=' . $employeeId);
		// $employeeProfile = curl_exec($api);
		// $employeeProfile = json_decode($employeeProfile, true);
		curl_close($api);

        return $this->render('dashboard', ['employeeProfile' =>$employeeProfile,'userId'=> $userId]);
    }

    public function actionCompanyTab() {
        $companyId = $_POST['companyId'];
        $groupId = Group::currentGroupId();
		$role = UserRole::userRight();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/dashbord-company?companyId=' . $companyId);
        $dashbordCompany = curl_exec($api);
        $dashbordCompany = json_decode($dashbordCompany, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/unit/all-unit');
		$units = curl_exec($api);
		$units = json_decode($units, true);

		curl_close($api);

        $months = ModelMaster::monthFull(1);
		$isManager = UserRole::isManager();

        return $this->renderPartial('dashbord_tabs_content', [
            'tab' => 'company',
            'contentDetail' => $dashbordCompany,
            "companies" => $companies,
			"units" => $units,
			"months" => $months,
            "isManager" => $isManager
        ]);
    }
    
    public function actionTeamTab() {
        $teamId = $_POST['teamId'];
    
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/dashbord-team?teamId=' . $teamId);
        $dashbordTeam = curl_exec($api);
        $dashbordTeam = json_decode($dashbordTeam, true);

        curl_close($api);

        return $this->renderPartial('dashbord_tabs_content', ['tab' => 'team','contentDetail' => $dashbordTeam]);
    }
    
    public function actionSelfTab() {
        $employeeId = $_POST['employeeId'];
    
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'home/dashbord/dashbord-employee?employeeId=' . $employeeId);
        $dashbordEmployee = curl_exec($api);
        $dashbordEmployee = json_decode($dashbordEmployee, true);
        
        curl_close($api);

        return $this->renderPartial('dashbord_tabs_content', ['tab' => 'self','contentDetail' => $dashbordEmployee]);
        
    }
    
}