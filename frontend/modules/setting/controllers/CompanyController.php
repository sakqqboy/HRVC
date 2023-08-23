<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `setting` module
 */
class CompanyController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionCreate($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$groupId = $param["groupId"];
		$ch1 = curl_init();
		curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch1, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
		$result1 = curl_exec($ch1);
		curl_close($ch1);
		$countries = json_decode($result1, true);

		$headQuaterApi = curl_init();
		curl_setopt($headQuaterApi, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($headQuaterApi, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($headQuaterApi, CURLOPT_URL, Path::Api() . 'masterdata/company/header?id=' . $groupId);
		$headQuater = curl_exec($headQuaterApi);
		curl_close($headQuaterApi);
		$headQuater = json_decode($headQuater, true);


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
			$company->tagLine = $_POST["tagLine"];
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
		curl_setopt($apiCompany, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($apiCompany, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($apiCompany, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
		$groupJson = curl_exec($apiCompany);
		curl_close($apiCompany);
		$company = json_decode($groupJson, true);

		$branch = Branch::find()->select('branchId')->where(["companyId" => $companyId, "status" => 1])->asArray()->all();
		$totalBranch = count($branch);


		return $this->render('company_view', [
			"company" => $company,
			"totalBranch" => $totalBranch
		]);
	}
	public function actionUpdateCompany($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$companyId = $param["companyId"];

		$apiCountry = curl_init();
		curl_setopt($apiCountry, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($apiCountry, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($apiCountry, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
		$resultCountry = curl_exec($apiCountry);
		$countries = json_decode($resultCountry, true);
		curl_close($apiCountry);

		$apiCompany = curl_init();
		curl_setopt($apiCompany, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($apiCompany, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($apiCompany, CURLOPT_URL, Path::Api() . 'masterdata/company/company-detail?id=' . $companyId);
		$company = curl_exec($apiCompany);
		$company = json_decode($company, true);
		curl_close($apiCompany);

		$headQuaterApi = curl_init();
		curl_setopt($headQuaterApi, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($headQuaterApi, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($headQuaterApi, CURLOPT_URL, Path::Api() . 'masterdata/company/header?id=' . $company['groupId']);
		$headQuater = curl_exec($headQuaterApi);
		curl_close($headQuaterApi);
		$headQuater = json_decode($headQuater, true);

		$apiCountry = curl_init();
		curl_setopt($apiCountry, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($apiCountry, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($apiCountry, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $company["countryId"]);
		$resultCountryDetail = curl_exec($apiCountry);
		$companyCountry = json_decode($resultCountryDetail, true);
		curl_close($apiCountry);

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
			$company->tagLine = $_POST["tagLine"];
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
}
