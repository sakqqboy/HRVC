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
use frontend\models\hrvc\UserRole;
use PHPUnit\TextUI\XmlConfiguration\Extension;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\components\Api;

/**
 * Default controller for the `setting` module
 */
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
		$role = UserRole::userRight();
		if ($role <= 3) {
			return  $this->redirect(Yii::$app->request->referrer);
		}
		return true; //go to origin request
	}


	public function actionDisplayCompany()
	{
		// throw new exception(print_r('dd', true));
		$group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
		if (!isset($group) || empty($group)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/display-group/');
		}
		$company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
		if (isset($company) && !empty($company)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-grid/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
		}

		$groupId = $group["groupId"];
		return $this->render('display_company', [
			"groupId" => $groupId
		]);
	}

	public function actionEncodeParamsCountry()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		$countryId = Yii::$app->request->post('countryId');
		$page = Yii::$app->request->post('page');

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => 1]);

		if ($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-grid-filter/' . $url);
		} else if ($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/index-filter/' . $url);
		} else {
			return "eror";
		}
	}

	public function actionEncodeParamsPage()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		$countryId = Yii::$app->request->post('countryId');
		$page = Yii::$app->request->post('page');
		$nextPage = Yii::$app->request->post('nextPage');

		$url =  ModelMaster::encodeParams(['countryId' => $countryId, 'nextPage' => $nextPage]);

		if ($page == 'grid') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-grid-filter/' . $url);
		} else if ($page == 'list') {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/index-filter/' . $url);
		} else {
			return "eror";
		}
	}

	public function actionIndex()
	{
		$role = UserRole::userRight();
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
		$group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
		if (!isset($group) && !empty($group)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
		}

		$company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
		if (!isset($company) && !empty($company)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/display-company/');
		}


		$groupId = $group["groupId"];
		$companies = Api::connectApi(
			Path::Api() . 'masterdata/group/company-group?id=' . $groupId . '&page=1&limit=7'
		);

		$numPage = Api::connectApi(
			Path::Api() . 'masterdata/group/company-page?id=' . $groupId . '&page=1&countryId=&limit=7'
		);

		$countries = Api::connectApi(
			Path::Api() . 'masterdata/country/company-country'
		);

		$data = [];
		if (!empty($companies)) {
			foreach ($companies as $company) :
				$companyId = $company['companyId'];

				$employees = Employee::find()
					->where(["companyId" => $companyId])
					->asArray()
					->all();

				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function ($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

				$branchIds = Branch::find()->select('branchId')
					->where(["companyId" => $companyId, "status" => 1])
					->asArray()->column();  // คืนค่าเป็น array แทน all()

				$totalBranch = count($branchIds);
				$totalEmployee = Employee::find()->where(["companyId" => $companyId, "status" => 1])->count();

				$departments = [];
				$teams = [];
				if (!empty($branchIds)) {
					$departments = Department::find()->select('departmentId')
						->where(["status" => 1])
						->andWhere(['IN', 'branchId', $branchIds])
						->asArray()->column();

					if (!empty($departments)) {
						$teams = Team::find()->select('teamId')
							->where(["status" => 1])
							->andWhere(['IN', 'departmentId', $departments])
							->asArray()->column();
					}
				}

				$relativePath = $company["picture"] ?? '';
				$absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

				if (!empty($relativePath) && file_exists($absolutePath)) {
					// ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
					$pictureUrl = $company["picture"];
				} else {
					// ❌ ไม่มีไฟล์ → ใช้รูป default แทน
					$pictureUrl = 'image/no-company.svg';
				}

				$data[] = [
					"about" => $company['about'],
					"picture" => $pictureUrl,
					"companyName" => $company['companyName'],
					"flag" => !empty($branch["flag"]) ? $company["flag"] : "image/e-world.svg",
					"city" => $company['city'],
					"countryName" => $company['countryName'],
					"companyId" => $company['companyId'],
					"totalDepartment" => count($departments),
					"totalTeam" => count($teams),
					"totalBranch" => $totalBranch,
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
			endforeach;
		}

		return $this->render('index', [
			"companies" => $data,
			"groupId" => $groupId,
			"countries" => $countries,
			"numPage" => $numPage,
			"countryId" => 0,
			"role" => $role
		]);
	}

	public function actionIndexFilter($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$countryId = $param["countryId"];
		$nextPage = $param["nextPage"];

		$role = UserRole::userRight();
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

		$group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
		if (!isset($group) && !empty($group)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
		}

		$company = Company::find()->select('companyId')->where(["status" => 1])->asArray()->one();
		if (!isset($company) && !empty($company)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/company/display-company/');
		}


		$groupId = $group["groupId"];
		$companies = Api::connectApi(
			Path::Api() . 'masterdata/group/company-group-filter?id=' . $groupId .
				'&countryId=' . $countryId .
				'&page=' . $nextPage .
				'&limit=7'
		);

		$numPage = Api::connectApi(
			Path::Api() . 'masterdata/group/company-page?id=' . $groupId .
				'&page=' . $nextPage .
				'&countryId=' . $countryId .
				'&limit=7'
		);

		$countries = Api::connectApi(
			Path::Api() . 'masterdata/country/company-country'
		);

		$data = [];
		if (!empty($companies)) {
			foreach ($companies as $company) :
				$companyId = $company['companyId'];

				$employees = Employee::find()
					->where(["companyId" => $companyId])
					->asArray()
					->all();

				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function ($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

				$branchIds = Branch::find()->select('branchId')
					->where(["companyId" => $companyId, "status" => 1])
					->asArray()->column();  // คืนค่าเป็น array แทน all()

				$totalBranch = count($branchIds);
				$totalEmployee = Employee::find()->where(["companyId" => $companyId, "status" => 1])->count();

				$departments = [];
				$teams = [];
				if (!empty($branchIds)) {
					$departments = Department::find()->select('departmentId')
						->where(["status" => 1])
						->andWhere(['IN', 'branchId', $branchIds])
						->asArray()->column();

					if (!empty($departments)) {
						$teams = Team::find()->select('teamId')
							->where(["status" => 1])
							->andWhere(['IN', 'departmentId', $departments])
							->asArray()->column();
					}
				}

				$relativePath = $company["picture"] ?? '';
				$absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

				if (!empty($relativePath) && file_exists($absolutePath)) {
					// ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
					$pictureUrl = $company["picture"];
				} else {
					// ❌ ไม่มีไฟล์ → ใช้รูป default แทน
					$pictureUrl = 'image/no-company.svg';
				}

				$data[] = [
					"about" => $company['about'],
					"picture" => $pictureUrl,
					"companyName" => $company['companyName'],
					"flag" => !empty($company["flag"]) ? $company["flag"] : "image/e-world.svg",
					"city" => $company['city'],
					"countryName" => $company['countryName'],
					"companyId" => $company['companyId'],
					"totalDepartment" => count($departments),
					"totalTeam" => count($teams),
					"totalBranch" => $totalBranch,
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
			endforeach;
		}

		return $this->render('index', [
			"companies" => $data,
			"groupId" => $groupId,
			"countries" => $countries,
			"numPage" => $numPage,
			"countryId" => $countryId,
			"role" => $role
		]);
	}

	public function actionCompanyGrid()
	{
		$group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
		if (!isset($group) && !empty($group)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
		}
		$role = UserRole::userRight();
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
		$groupId = $group["groupId"];
		$companies = Api::connectApi(
			Path::Api() . 'masterdata/group/company-group?id=' . $groupId . '&page=1&limit=6'
		);

		$numPage = Api::connectApi(
			Path::Api() . 'masterdata/group/company-page?id=' . $groupId . '&page=1&countryId=&limit=6'
		);

		$countries = Api::connectApi(
			Path::Api() . 'masterdata/country/company-country'
		);

		// ถ้าจะเช็ค error ให้ทำหลังจากดึงข้อมูล
		if (!$companies) {
			throw new Exception('API Error: ไม่สามารถดึงข้อมูล company-group ได้');
		}

		$data = [];
		if (!empty($companies)) {
			foreach ($companies as $company) :
				$companyId = $company['companyId'];
				$employees = Employee::find()
					->where(["companyId" => $companyId])
					->asArray()
					->all();
				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function ($employee) {
					return !empty($employee['picture']);
				});
				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);
				$totalEmployee = Employee::find()->where(["companyId" => $companyId, "status" => 1])->count();

				//นับจำนวน
				$branchIds = Branch::find()->select('branchId')
					->where(["companyId" => $companyId, "status" => 1])
					->asArray()->column();  // คืนค่าเป็น array แทน all()
				$totalBranch = count($branchIds);
				$departments = [];
				$teams = [];
				if (!empty($branchIds)) {
					$departments = Department::find()->select('departmentId')
						->where(["status" => 1])
						->andWhere(['IN', 'branchId', $branchIds])
						->asArray()->column();

					if (!empty($departments)) {
						$teams = Team::find()->select('teamId')
							->where(["status" => 1])
							->andWhere(['IN', 'departmentId', $departments])
							->asArray()->column();
					}
				}
				$relativePath = $company["picture"] ?? '';
				$absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

				if (!empty($relativePath) && file_exists($absolutePath)) {
					// ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
					$pictureUrl = $company["picture"];
				} else {
					// ❌ ไม่มีไฟล์ → ใช้รูป default แทน
					$pictureUrl = 'image/no-company.svg';
				}

				//เก็บค่า
				$data[] = [
					"about" => $company['about'],
					"picture" => $pictureUrl,
					"companyName" => $company['companyName'],
					"flag" => !empty($company["flag"]) ? $company["flag"] : "image/e-world.svg",
					"city" => $company['city'],
					"countryName" => $company['countryName'],
					"companyId" => $company['companyId'],
					"totalBranch" => $totalBranch,
					"totalDepartment" => count($departments),
					"totalTeam" => count($teams),
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
			endforeach;
		}

		return $this->render('company_grid', [
			"companies" => $data,
			"role" => $role,
			"groupId" => $groupId,
			"countries" => $countries,
			"numPage" => $numPage,
			"countryId" => 0
		]);
	}


	public function actionCompanyGridFilter($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$countryId = $param["countryId"];
		$nextPage = $param["nextPage"];
		$group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
		if (!isset($group) && !empty($group)) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group/');
		}
		$role = UserRole::userRight();
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
		$groupId = $group["groupId"];
		$companies = Api::connectApi(
			Path::Api() . 'masterdata/group/company-group-filter?id=' . $groupId . '&countryId=' . $countryId . '&page=' . $nextPage . '&limit=6'
		);

		$numPage = Api::connectApi(
			Path::Api() . 'masterdata/group/company-page?id=' . $groupId . '&page=' . $nextPage . '&countryId=' . $countryId . '&limit=6'
		);

		$countries = Api::connectApi(
			Path::Api() . 'masterdata/country/company-country'
		);

		$data = [];
		if (!empty($companies)) {
			foreach ($companies as $company) :
				$companyId = $company['companyId'];

				$employees = Employee::find()
					->where(["companyId" => $companyId])
					->asArray()
					->all();

				// กรองเฉพาะที่มี picture
				$filteredEmployees = array_filter($employees, function ($employee) {
					return !empty($employee['picture']);
				});

				// รีเซ็ต index และเลือกแค่ 3 คนแรก
				$filteredEmployees = array_slice(array_values($filteredEmployees), 0, 3);

				$branchIds = Branch::find()->select('branchId')
					->where(["companyId" => $companyId, "status" => 1])
					->asArray()->column();  // คืนค่าเป็น array แทน all()

				$totalBranch = count($branchIds);
				$totalEmployee = Employee::find()->where(["companyId" => $companyId, "status" => 1])->count();

				$departments = [];
				$teams = [];
				if (!empty($branchIds)) {
					$departments = Department::find()->select('departmentId')
						->where(["status" => 1])
						->andWhere(['IN', 'branchId', $branchIds])
						->asArray()->column();

					if (!empty($departments)) {
						$teams = Team::find()->select('teamId')
							->where(["status" => 1])
							->andWhere(['IN', 'departmentId', $departments])
							->asArray()->column();
					}
				}

				$relativePath = $company["picture"] ?? '';
				$absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');

				if (!empty($relativePath) && file_exists($absolutePath)) {
					// ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
					$pictureUrl = $company["picture"];
				} else {
					// ❌ ไม่มีไฟล์ → ใช้รูป default แทน
					$pictureUrl = 'image/no-company.svg';
				}

				$data[] = [
					"about" => $company['about'],
					"picture" => $pictureUrl,
					"companyName" => $company['companyName'],
					"flag" => !empty($company["flag"]) ? $company["flag"] : "image/e-world.svg",
					"city" => $company['city'],
					"countryName" => $company['countryName'],
					"companyId" => $company['companyId'],
					"totalDepartment" => count($departments),
					"totalTeam" => count($teams),
					"totalBranch" => $totalBranch,
					"totalEmployee" => $totalEmployee,
					"employees" => $filteredEmployees
				];
			endforeach;
		}

		return $this->render('company_grid', [
			"companies" => $data,
			"role" => $role,
			"groupId" => $groupId,
			"countries" => $countries,
			"numPage" => $numPage,
			"countryId" => $countryId
		]);
	}

	public function actionCreate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$groupId = $param["groupId"];
		$countries = Api::connectApi(
			Path::Api() . 'masterdata/country/active-country'
		);

		$headQuater = Api::connectApi(
			Path::Api() . 'masterdata/company/header?id=' . $groupId
		);

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
			$company->displayName = $_POST["displayName"];
			$company->founded = $_POST["founded"];
			$company->industries = $_POST["industries"];
			$company->countryId = $_POST["country"];
			$company->contact = $_POST["phone"]; //
			$company->email = $_POST["email"];
			$company->location = $_POST["location"];
			$company->about = $_POST["about"];
			$company->groupId = $_POST["groupId"] - 543;
			$company->directorId = $_POST["directorId"];
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

				// เตรียมชื่อไฟล์ใหม่
				$file = $fileImage->name;
				$filenameArray = explode('.', $file);
				$countArrayFile = count($filenameArray);
				$extension = strtolower($filenameArray[$countArrayFile - 1]);
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $extension;
				$pathSave = $path . $fileName;

				// โหลดภาพจาก temp path
				$tempPath = $fileImage->tempName;
				list($width, $height) = getimagesize($tempPath);

				// สร้างภาพต้นฉบับจาก temp
				$srcImg = null;
				if ($extension === 'jpg' || $extension === 'jpeg') {
					$srcImg = imagecreatefromjpeg($tempPath);
				} elseif ($extension === 'png') {
					$srcImg = imagecreatefrompng($tempPath);
				} elseif ($extension === 'gif') {
					$srcImg = imagecreatefromgif($tempPath);
				}

				if ($srcImg) {
					$cropSize = 131; // ขนาดที่ต้องการ
					$dstImg = imagecreatetruecolor($cropSize, $cropSize);

					// คำนวณขนาดสี่เหลี่ยมจัตุรัสเล็กสุดตรงกลางภาพ
					$minSize = min($width, $height);
					$srcX = round(($width - $minSize) / 2);
					$srcY = round(($height - $minSize) / 2);

					// crop และ resize
					imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $cropSize, $cropSize, $minSize, $minSize);

					// บันทึกไฟล์ภาพที่ถูก crop แล้ว
					if ($extension === 'jpg' || $extension === 'jpeg') {
						imagejpeg($dstImg, $pathSave, 90);
					} elseif ($extension === 'png') {
						imagepng($dstImg, $pathSave);
					} elseif ($extension === 'gif') {
						imagegif($dstImg, $pathSave);
					}

					imagedestroy($srcImg);
					imagedestroy($dstImg);

					// บันทึก path ไฟล์ลงใน model
					$company->picture = 'images/company/profile/' . $fileName;
				}
			}

			if ($company->save(false)) {
				$companyId = Yii::$app->db->lastInsertID;
				return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams(["companyId" => $companyId]));
			}else{
				throw new exception('Recording failed ');
			}
		} else {
			throw new exception('This Name does not exist');
		}
	}
	public function actionCompanyView($hash)
	{
		$role = UserRole::userRight();
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

		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];
		$branchs = [];
		$pictureUrl = '';

		$company = Api::connectApi(
			Path::Api() . 'masterdata/company/company-detail?id=' . $companyId
		);

		$directorId = $company["directorId"] ?? null;

		$director = [];
		if ($directorId) {
			$director = Api::connectApi(
				Path::Api() . 'masterdata/employee/employee-detail?id=' . $directorId
			);
		}

		$companyBranch = Api::connectApi(
			Path::Api() . 'masterdata/company/company-branch?id=' . $companyId
		);

		if (!empty($companyBranch)) {
			foreach ($companyBranch as $branch) {
				$relativePath = $branch["branchImage"] ?? '';

				$absolutePath = Yii::getAlias('@webroot') . '/' . ltrim($relativePath, '/');
				if (!empty($relativePath) && file_exists($absolutePath)) {
					// ✅ ไฟล์มีอยู่จริงในเครื่องที่รัน (local หรือ server)
					$pictureUrl = $branch["branchImage"];
				} else {
					// ❌ ไม่มีไฟล์ → ใช้รูป default แทน
					$pictureUrl = 'image/no-branch.svg';
				}
				$branchs[] = [
					'branchId' => $branch['branchId'],
					'branchName' => $branch['branchName'],
					'companyId' => $branch['companyId'],
					'description' => $branch['description'],
					'status' => $branch['status'],
					'companyName' => $branch['companyName'],
					'city' => $branch['city'],
					"picture" => !empty($branch["picture"]) ? $branch["picture"] : "image/no-company.svg",
					'branchImage' => $pictureUrl,
					'flag' => !empty($branch['flag']) ? $branch['flag'] :  'images/e-world.svg',
				];
			}
		}

		$totalDepartment = 0;
		$totalTeam = 0;
		$branch = Branch::find()->select('branchId')->where(["companyId" => $companyId, "status" => 1])->asArray()->all();

		$employees = Employee::find()->where(["companyId" => $companyId])->all();
		$filteredEmployees = array_filter($employees, function ($employee) {
			return !empty($employee['picture']);
		});

		// จัดเรียงผลลัพธ์ให้อยู่ในอาเรย์ที่มีแค่ 3 ตัวแรก
		$filteredEmployees = array_values($filteredEmployees); // ใช้ array_values เพื่อรีเซ็ต index ของอาเรย์

		// เลือกแค่ 3 ตัวแรก
		$filteredEmployees = array_slice($filteredEmployees, 0, 3);

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
		$totalEmployee = count($employees);
		return $this->render('company_view', [
			"company" => $company,
			"totalBranch" => $totalBranch,
			"totalDepartment" => $totalDepartment,
			"totalTeam" => $totalTeam,
			"totalEmployee" => $totalEmployee,
			"director" => $director,
			"role" => $role,
			"employees" => $filteredEmployees,
			"companyBranch" => $branchs
		]);
	}
	public function actionUpdateCompany($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];

		$countries = Api::connectApi(
			Path::Api() . 'masterdata/country/active-country'
		);

		$company = Api::connectApi(
			Path::Api() . 'masterdata/company/company-detail?id=' . $companyId
		);

		$headQuater = Api::connectApi(
			Path::Api() . 'masterdata/company/header?id=' . $company['groupId']
		);

		$companyCountry = Api::connectApi(
			Path::Api() . 'masterdata/country/country-detail?id=' . $company['countryId']
		);

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
			$company->displayName = $_POST["displayName"];
			$company->founded = $_POST["founded"];
			$company->industries = $_POST["industries"];
			$company->countryId = $_POST["country"];
			$company->contact = $_POST["phone"]; //
			$company->email = $_POST["email"];
			$company->location = $_POST["location"];
			$company->about = $_POST["about"];
			$company->directorId = $_POST["directorId"];
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
				// if (file_exists($oldPathBanner)) {
				// 	unlink($oldPathBanner,);
				// }

				// $oldPathBanner = Yii::getAlias('@frontend/web/') . $model->banner;

				if (!empty($model->banner) && file_exists($oldPathBanner) && is_file($oldPathBanner)) {
					unlink($oldPathBanner);
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

				// ลบรูปเก่าถ้ามี
				if (!empty($oldImage)) {
					$oldPathBanner = Path::getHost() . $oldImage;
					if (file_exists($oldPathBanner) && is_file($oldPathBanner)) {
						unlink($oldPathBanner);
					}
				}

				// เตรียมชื่อไฟล์ใหม่
				$file = $fileImage->name;
				$filenameArray = explode('.', $file);
				$fileExt = strtolower(end($filenameArray));
				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $fileExt;
				$pathSave = $path . $fileName;

				// โหลดภาพต้นฉบับจาก temp
				$tempPath = $fileImage->tempName;
				list($width, $height) = getimagesize($tempPath);
				$srcImg = null;

				// สร้าง resource ตามประเภทไฟล์
				if (in_array($fileExt, ['jpg', 'jpeg'])) {
					$srcImg = imagecreatefromjpeg($tempPath);
				} elseif ($fileExt === 'png') {
					$srcImg = imagecreatefrompng($tempPath);
				} elseif ($fileExt === 'gif') {
					$srcImg = imagecreatefromgif($tempPath);
				}

				if ($srcImg) {
					$cropSize = 131;
					$dstImg = imagecreatetruecolor($cropSize, $cropSize);

					// ตัดตรงกลางภาพ (square crop)
					$minSize = min($width, $height);
					$srcX = round(($width - $minSize) / 2);
					$srcY = round(($height - $minSize) / 2);

					// ครอบและปรับขนาด
					imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $cropSize, $cropSize, $minSize, $minSize);

					// บันทึกรูปภาพตามชนิด
					if (in_array($fileExt, ['jpg', 'jpeg'])) {
						imagejpeg($dstImg, $pathSave, 90);
					} elseif ($fileExt === 'png') {
						imagepng($dstImg, $pathSave);
					} elseif ($fileExt === 'gif') {
						imagegif($dstImg, $pathSave);
					}

					imagedestroy($srcImg);
					imagedestroy($dstImg);

					// อัปเดต path รูปในโมเดล
					$company->picture = 'images/company/profile/' . $fileName;
				}
			}


			if ($company->save(false)) {
				return $this->redirect(Yii::$app->homeUrl . 'setting/company/company-view/' . ModelMaster::encodeParams(["companyId" => $companyId]));
			} else {
				throw new exception('Recording failed ');
			}
		} else {
			throw new exception('This ID does not exist');
		}
	}
	public function actionCompanyBranch()
	{
		$companyId = $_POST["companyId"];
		$text = "<option value=''>Select Branch</option>";
		$branch = Api::connectApi(
			Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId
		);

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
	public function actionCompanyDepartment()
	{
		$companyId = $_POST["companyId"];
		$departments = Api::connectApi(
			Path::Api() . 'masterdata/department/company-department?id=' . $companyId
		);
		$option = '<option value="">Department</option>';
		$res["status"] = false;
		$res["department"] = '';
		if (isset($departments) && count($departments) > 0) {
			$res["status"] = true;
			foreach ($departments as $department) :
				$option .= '<option value="' . $department["departmentId"] . '">' . $department["departmentName"] . '</option>';
			endforeach;
			$res["department"] = $option;
		}
		return json_encode($res);
	}

	public function actionCompanyBranchList()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		// รับ JSON body โดยตรง
		$data = json_decode(file_get_contents("php://input"), true);
		$companyId = $data['companyId'] ?? null;

		if (!$companyId) {
			return ['error' => 'Missing companyId'];
		}

		// ใช้ Api::connectApi แทน curl
		$branches = Api::connectApi(
			Path::Api() . 'masterdata/branch/company-branch?id=' . $companyId
		);

		return $branches;
	}
}
