<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\DepartmentTitle;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `setting` module
 */
// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
class CompanyController extends Controller
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
		$group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
		if (!isset($group) && !empty($group)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
		}
		$groupId = $group["groupId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId);
		$companies = curl_exec($api);
		$companies = json_decode($companies, true);
		//throw new exception(print_r($companies, true));
		curl_close($api);
		return $this->render('index', [
			"companies" => $companies,
			"groupId" => $groupId
		]);
	}
	public function actionCreate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$groupId = $param["groupId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
		$result1 = curl_exec($api);
		$countries = json_decode($result1, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/header?id=' . $groupId);
		$headQuater = curl_exec($api);
		$headQuater = json_decode($headQuater, true);

		curl_close($api);

		return $this->render('create', [
			"countries" => $countries,
			"groupId" => $groupId,
			"headQuater" => $headQuater
		]);
	}
	public function actionSaveCreateCompany()
	{
		if (isset($_POST["companyName"]) && trim($_POST["companyName"]) != '') {
			$company = new Company();
			$company->companyName = $_POST["companyName"];
			//$company->tagLine = $_POST["tagLine"];
			if (isset($_POST["headQuaterId"])) {
				$company->headQuaterId = $_POST["headQuaterId"] - 534;
			}
			$company->displayName = $_POST["displayName"];
			$company->website = $_POST["website"];
			$company->location = $_POST["location"];
			$company->groupId = $_POST["groupId"] - 543;
			$company->countryId = $_POST["country"];
			$company->city = $_POST["city"];
			$company->postalCode = $_POST["postalCode"];
			$company->industries = $_POST["industries"];
			$company->email = $_POST["email"];
			$company->contact = $_POST["contact"];
			$company->founded = $_POST["founded"];
			$company->director = $_POST["director"];
			$company->socialTag = $_POST["socialTag"];
			$company->about = $_POST["about"];
			$company->status = 1;
			$company->createDateTime = new Expression('NOW()');
			$company->updateDateTime =  new Expression('NOW()');
			$fileBanner = UploadedFile::getInstanceByName("imageUploadBanner");
			if (isset($fileBanner) && !empty($fileBanner)) {
				$path = Path::getHost() . 'images/company/banner/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$file = $fileBanner->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $path . $fileName;
				$fileBanner->saveAs($pathSave);
				$company->banner = 'images/company/banner/' . $fileName;
			}
			$fileImage = UploadedFile::getInstanceByName("image");
			if (isset($fileImage) && !empty($fileImage)) {
				$path = Path::getHost() . 'images/company/profile/';
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$file = $fileImage->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $path . $fileName;
				$fileImage->saveAs($pathSave);
				$company->picture = 'images/company/profile/' . $fileName;
			}
			if ($company->save(false)) {
				$companyId = Yii::$app->db->lastInsertID;
				return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams(["companyId" => $companyId]));
			}
		}
	}
	public function actionCompanyView($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];
		$apiCompany = curl_init();
		curl_setopt($apiCompany, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($apiCompany, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($apiCompany, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
		$groupJson = curl_exec($apiCompany);
		$company = json_decode($groupJson, true);

		curl_close($apiCompany);

		$totalDepartment = 0;
		$totalTeam = 0;
		$branch = Branch::find()->select('branchId')->where(["companyId" => $companyId, "status" => 1])->asArray()->all();
		$employee = Employee::find()->select('employeeId')->where(["companyId" => $companyId])->all();
		if (isset($branch) && count($branch) > 0) {
			foreach ($branch as $b) :
				$departments = Department::find()->select('departmentId')->where(["branchId" => $b["branchId"], "status" => 1])->asArray()->all();
				if (count($departments) > 0) {
					foreach ($departments as $dep) :
						$teams = Team::find()->select('teamId')->where(["departmentId" => $dep["departmentId"], "status" => 1])->asArray()->all();
						$totalTeam += count($teams);
					endforeach;
				}
				$totalDepartment += count($departments);
			endforeach;
		}


		$totalBranch = count($branch);
		$totalEmployee = count($employee);


		return $this->render('company_view', [
			"company" => $company,
			"totalBranch" => $totalBranch,
			"totalEmployee" => $totalEmployee,
			"totalDepartment" => $totalDepartment,
			"totalTeam" => $totalTeam
		]);
	}
	public function actionUpdateCompany($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];

		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
		$resultCountry = curl_exec($api);
		$countries = json_decode($resultCountry, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
		$company = curl_exec($api);
		$company = json_decode($company, true);


		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/company/header?id=' . $company['groupId']);
		$headQuater = curl_exec($api);
		$headQuater = json_decode($headQuater, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
		$resultCountryDetail = curl_exec($api);
		$companyCountry = json_decode($resultCountryDetail, true);

		curl_close($api);

		return $this->render('update_company', [
			"countries" => $countries,
			"company" => $company,
			"headQuater" => $headQuater,
			"companyCountry" => $companyCountry
		]);
	}
	public function actionSaveUpdateCompany()
	{
		if (isset($_POST["companyId"])) {
			$companyId = $_POST["companyId"] - 543;
			$company = Company::find()->where(["companyId" => $companyId])->one();
			$oldBanner = $company->banner;
			$oldImage = $company->picture;
			$company->companyName = $_POST["companyName"];
			// $company->tagLine = $_POST["tagLine"];
			$company->displayName = $_POST["displayName"];
			$company->website = $_POST["website"];
			$company->location = $_POST["location"];
			$company->countryId = $_POST["country"];
			$company->city = $_POST["city"];
			$company->postalCode = $_POST["postalCode"];
			$company->industries = $_POST["industries"];
			$company->email = $_POST["email"];
			$company->contact = $_POST["contact"];
			$company->founded = $_POST["founded"];
			$company->director = $_POST["director"];
			$company->socialTag = $_POST["socialTag"];
			$company->about = $_POST["about"];
			$company->status = 1;
			$company->createDateTime = new Expression('NOW()');
			$company->updateDateTime =  new Expression('NOW()');
			$fileBanner = UploadedFile::getInstanceByName("imageUploadBanner");
			if (isset($fileBanner) && !empty($fileBanner)) {
				$path = Path::getHost() . 'images/company/banner/';

				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$oldPathBanner = Path::getHost() . $oldBanner;
				if (file_exists($oldPathBanner)) {
					unlink($oldPathBanner,);
				}
				$file = $fileBanner->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $path . $fileName;
				$fileBanner->saveAs($pathSave);
				$company->banner = 'images/company/banner/' . $fileName;
			}
			$fileImage = UploadedFile::getInstanceByName("image");
			if (isset($fileImage) && !empty($fileImage)) {
				$path = Path::getHost() . 'images/company/profile/';

				if (!file_exists($path)) {
					mkdir($path, 0777, true);
				}
				$oldPathBanner = Path::getHost() . $oldImage;
				if (file_exists($oldPathBanner)) {
					unlink($oldPathBanner);
				}
				$file = $fileImage->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $path . $fileName;
				$fileImage->saveAs($pathSave);
				$company->picture = 'images/company/profile/' . $fileName;
			}
			if ($company->save(false)) {
				return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams(["companyId" => $companyId]));
			}
		}
	}
	public function actionCompanyBranch()
	{
		$companyId = $_POST["companyId"];
		$text = "<option value=''>Select Branch</option>";
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId);
		$branch = curl_exec($api);
		$branch = json_decode($branch, true);

		curl_close($api);

		$res["status"] = false;
		if (isset($branch) && count($branch) > 0) {
			$res["status"] = true;
			foreach ($branch as $b) :
				$text .= "<option value='" . $b['branchId'] . "'>" . $b['branchName'] . "</option>";
			endforeach;
		}
		$res["branchText"] = $text;
		return json_encode($res);
	}
	public function actionDeleteCompany()
	{
		$company = Company::find()->where(["companyId" => $_POST["companyId"]])->one();
		$company->status = 99;
		$company->updateDateTime = new Expression('NOW()');
		$res["status"] = false;
		if ($company->save(false)) {
			$branch = Branch::find()->where(["companyId" => $_POST["companyId"]])->all();
			if (isset($branch) && count($branch) > 0) {
				foreach ($branch as $b) :
					$b->status = 99;
					$b->save(false);
					$department = Department::find()->where(["branchId" => $b->branchId])->all();
					if (isset($department) && count($department) > 0) {
						foreach ($department as $dp) :
							DepartmentTitle::deleteAll(["departmentId" => $dp->departmentId]);
							$dp->status = 99;
							$dp->save(false);
							$teams = Team::find()->where(["departmentId" => $dp->departmentId])->all();
							if (isset($teams) && count($teams) > 0) {
								foreach ($teams as $t) :
									$t->status = 99;
									$t->save(false);
								endforeach;
							}
						endforeach;
					}
				endforeach;
			}
			$res["status"] = true;
		}
		return json_encode($res);
	}
	public function actionClearData()
	{
		$company = Company::find()->where(["status" => 99])->all();
		if (isset($company) && count($company) > 0) {
			foreach ($company as $c) :
				$branch = Branch::find()->where(["companyId" => $c->companyId])->all();
				if (isset($branch) && count($branch) > 0) {
					foreach ($branch as $b) :
						$b->status = 99;
						$b->save(false);
						$department = Department::find()->where(["branchId" => $b->branchId])->all();

					endforeach;
				}
			endforeach;
		}
		$branch = Branch::find()->where(["status" => 99])->all();
		if (isset($branch) && count($branch) > 0) {
			foreach ($branch as $b) :
				$department = Department::find()->where(["branchId" => $b->branchId])->all();
				if (isset($department) && count($department) > 0) {
					foreach ($department as $dp) :
						DepartmentTitle::deleteAll(["departmentId" => $dp->departmentId]);
						$dp->status = 99;
						$dp->save(false);
					endforeach;
				}
			endforeach;
		}
		$department = Department::find()->where(["status" => 99])->all();
		if (isset($department) && count($department) > 0) {
			foreach ($department as $dp) :
				DepartmentTitle::deleteAll(["departmentId" => $dp->departmentId]);
				$teams = Team::find()->where(["departmentId" => $dp->departmentId])->all();
				if (isset($teams) && count($teams) > 0) {
					foreach ($teams as $t) :
						$t->status = 99;
						$t->save(false);
					endforeach;
				}
			endforeach;
		}
	}
}
