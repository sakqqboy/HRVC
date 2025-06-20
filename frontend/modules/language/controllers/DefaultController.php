<?php

namespace frontend\modules\language\controllers;

use common\helpers\Path;
use Exception;
use frontend\models\hrvc\Country;
use frontend\models\hrvc\Translator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `language` module
 */
class DefaultController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex($english = false)
	{

		$language = Translator::find()->where(["status" => 1])->orderBy("english ASC")->asArray()->all();
		return $this->render('index', [
			"language" => $language,
			"english" => $english == false ? '' : urldecode($english)
		]);
	}
	public function actionCreate()
	{
		if (isset($_POST["english"])) {
			$model = new Translator();
			$model->english = $_POST["english"];
			$model->japanese = $_POST["japanese"];
			$model->thai = $_POST["thai"];
			$model->chinese = $_POST["chinese"];
			$model->vietnam = $_POST["vietnam"];
			$model->spanish = $_POST["spanish"];
			$model->indonesian = $_POST["indonesian"];
			$model->status = 1;
			if ($model->save(false)) {
				return $this->redirect(Yii::$app->homeUrl . 'language/default/index?english=' . $_POST["english"]);
			}
		}
		return $this->render('form');
	}
	public function actionUpdate($translatorId)
	{
		$lang = Translator::find()->where(["translatorId" => $translatorId])->one();
		if (isset($_POST["english"])) {
			$lang->english = $_POST["english"];
			$lang->japanese = $_POST["japanese"];
			$lang->thai = $_POST["thai"];
			$lang->chinese = $_POST["chinese"];
			$lang->vietnam = $_POST["vietnam"];
			$lang->spanish = $_POST["spanish"];
			$lang->indonesian = $_POST["indonesian"];
			$lang->status = 1;
			if ($lang->save(false)) {
				return $this->redirect('index?english=' . $_POST["english"]);
			}
		}
		return $this->render('form', ["lang" => $lang]);
	}
	public function actionEditTranslate()
	{
		$translate = Translator::find()->where(["id" => $_POST["id"]])->one();
		$res = [];
		if (isset($translate) && !empty($translate)) {
			$translate->japanese = $_POST["japan"];
			if ($translate->save(false)) {

				$res["status"] = true;
			} else {

				$res["status"] = false;
			}
		}
		return json_encode($res);
	}
	public function actionDeleteTranslate()
	{
		$res = [];
		Translator::deleteAll(["translatorId" => $_POST["id"]]);
		$res["status"] = true;
		return json_encode($res);
	}
	public function actionImportLanguage()
	{
		$right = 1;
		// $access = MemberHasType::checkMemberRight($right);
		// if ($access == 0) {
		//     return $this->redirect(Yii::$app->homeUrl . 'site/access-denied');
		// }
		$translate = [];
		$message = '';
		$imageObj = UploadedFile::getInstanceByName("languageFile");
		if (isset($imageObj) && !empty($imageObj)) {
			$urlFolder = Path::getHost() . 'file/import/language';
			if (!file_exists($urlFolder)) {
				mkdir($urlFolder, 0777, true);
			}
			$file = $imageObj->name;
			$filenameArray = explode('.', $file);
			$countArrayFile = count($filenameArray);
			$fileType = $filenameArray[$countArrayFile - 1];
			if ($fileType == 'xlsx' || $fileType == 'xls') {

				$fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
				$pathSave = $urlFolder . '/' . $fileName;
				if ($imageObj->saveAs($pathSave)) {
					$reader = new Xlsx();
					$spreadsheet = $reader->load($pathSave);
					$sheetData = $spreadsheet->getActiveSheet()->toArray();
					// unset($sheetData[0]);
					$i = 0;
					$textError = '';
					foreach ($sheetData as $data) :
						if ($i >= 1 && $data[0] != '') { //data begin
							$translate[$i] = [
								"english" => $data[0],
								"japanese" => $data[1],
								"chinese" => $data[2],
								"vietnam" => $data[3],
								"thai" => $data[4],
								"spanish" => $data[5],
								"indonesian" => $data[6],
							];
						}
						$i++;
					endforeach;
					//    throw new Exception(print_r($translate, true));
					if (count($translate) > 0) {
						if ($textError == '') {
							$this->saveData($translate);
							Yii::$app->getSession()->setFlash('alert', [
								'body' => '<strong>Success ! !</strong><div class="text-center">
								Add ' . count($translate) . 'words.
								</div>',
								'options' => [
									'id' => 'alert-success-add',
									'class' => 'add-question-success',
								]
							]);
						} else { //not upload
							$message = 'Please check the spelling of topic in<br>' . $textError . '<br> fix and import again.';
							Yii::$app->getSession()->setFlash('alert', [
								'body' => '<strong>Error ! ! !</strong><div class="text-center">
								' . $message  . '</div>',
								'options' => [
									'id' => 'alert-success-add',
									'class' => 'add-question-danger',
								]
							]);
						}
						return $this->render('index');
						//return $this->render('import');
					}
				} else {
					Yii::$app->getSession()->setFlash('alert', [
						'body' => '<strong>Error ! ! !</strong><div class="text-center">Please select .xlsx, .xlx file</div>',
						'options' => [
							'id' => 'alert-success-add',
							'class' => 'add-question-danger',
						]
					]);
				}
			} else {
				Yii::$app->getSession()->setFlash('alert', [
					'body' => '<strong>Error ! ! !</strong><div class="text-center">Please select .xlsx, .xlx file</div>',
					'options' => [
						'id' => 'alert-success-add',
						'class' => 'add-question-danger',
					]
				]);
			}
		}
		return $this->render('import');
	}
	public function saveData($data)
	{
		$transaction = Yii::$app->db->beginTransaction();

		try {
			if (count($data) > 0) {
				foreach ($data as $d) :
					$question = new Translator();
					$question->english = $d["english"];
					$question->japanese = $d["japanese"];
					$question->chinese = $d["chinese"];
					$question->vietnam = $d["vietnam"];
					$question->thai = $d["thai"];
					$question->spanish = $d["spanish"];
					$question->indonesian = $d["indonesian"];
					$question->status = 1;
					$question->save(false);
				endforeach;
			}
			$transaction->commit();
		} catch (\Exception $e) {
			$transaction->rollBack();
			throw $e;
		}
	}
	public function actionSearchEnglish()
	{
		$word = $_POST["word"];
		$languages = Translator::find()->where(['LIKE', 'LOWER(english)',  strtolower($word)])->asArray()->all();
		$text = "";
		if (count($languages) > 0) {
			$text = $this->renderAjax("search_result", [
				"languages" => $languages
			]);
		}
		$res["textSearch"] = $text;
		return json_encode($res);
	}
	public function actionInsertLanguage()
	{

		// foreach ($lines as $line) {
		// 	// ล้างช่องว่าง, วงเล็บ และอักขระส่วนเกิน
		// 	$clean = trim($line, " \t\n\r,()");
		// 	$parts = str_getcsv($clean, ",", "'"); // ใช้ parser สำหรับค่าที่อยู่ใน single quote

		// 	if (isset($parts[6])) {
		// 		$name = trim($parts[6]);
		// $inserts = "INSERT INTO `language` (`name`) VALUES ('" . addslashes($name) . "');";
		// 		Yii::$app->db->createCommand($inserts)->execute();
		// 	}
		// }

		// แสดงผล
		// echo $cleaned_languages;



		$textLanguage = "ar,Arabic,Saudi Arabia/
az,Azerbaijani,Azerbaijan/
be,Belarusian,Belarus/
bg,Bulgarian,Bulgaria/
bn,Bengali,Bangladesh/
bs,Bosnian,Bosnia and Herzegovina/
ca,Catalan,Andorra/
cs,Czech,Czech Republic/
cy,Welsh,United Kingdom/
da,Danish,Denmark/
de,German,Germany/
dv,Divehi,Maldives/
el,Greek,Greece/
en,English,United Kingdom/
es,Spanish,Spain/
et,Estonian,Estonia/
fa,Persian,Iran/
fi,Finnish,Finland/
fr,French,France/
ga,Irish,Ireland/
gu,Gujarati,India/
he,Hebrew,Israel/
hi,Hindi,India/
hr,Croatian,Croatia/
hu,Hungarian,Hungary/
hy,Armenian,Armenia/
id,Indonesian,Indonesia/
is,Icelandic,Iceland/
it,Italian,Italy/
ja,Japanese,Japan/
ka,Georgian,Georgia/
kk,Kazakh,Kazakhstan/
km,Khmer,Cambodia/
ko,Korean,South Korea/
ky,Kyrgyz,Kyrgyzstan/
lo,Lao,Laos/
lt,Lithuanian,Lithuania/
lv,Latvian,Latvia/
mk,Macedonian,North Macedonia/
ml,Malayalam,India/
mn,Mongolian,Mongolia/
mr,Marathi,India/
ms,Malay,Malaysia/
mt,Maltese,Malta/
my,Burmese,Myanmar/
ne,Nepali,Nepal/
nl,Dutch,Netherlands/
no,Norwegian,Norway/
pa,Punjabi,India/
pl,Polish,Poland/
pt,Portuguese,Portugal/
ro,Romanian,Romania/
ru,Russian,Russia/
si,Sinhala,Sri Lanka/
sk,Slovak,Slovakia/
sl,Slovenian,Slovenia/
sq,Albanian,Albania/
sr,Serbian,Serbia/
sv,Swedish,Sweden/
sw,Swahili,Tanzania/
ta,Tamil,India/
te,Telugu,India/
th,Thai,Thailand/
tr,Turkish,Turkey/
uk,Ukrainian,Ukraine/
ur,Urdu,Pakistan/
uz,Uzbek,Uzbekistan/
vi,Vietnamese,Vietnam/
zh,Chinese,China";
		$textLanguage = str_replace(["\r", "\n"], "", $textLanguage);
		$textlangArr1 = explode('/', $textLanguage);
		$sql1 = "DROP TABLE IF EXISTS `language`";
		Yii::$app->db->createCommand($sql1)->execute();
		$sql = "CREATE TABLE `language` (
  `LanguageId` BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
   `symbol` CHAR(3) DEFAULT NULL,
  `countryId` BIGINT(20) DEFAULT NULL,
  `status` TINYINT(10) DEFAULT 1,
  `createDateTime` DATETIME DEFAULT NULL,
  `updateDateTime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;";

		Yii::$app->db->createCommand($sql)->execute();
		foreach ($textlangArr1 as $country):
			$countryId = null;
			$countryArr = explode(",", $country);
			$symbol = $countryArr[0];
			$countryName = $countryArr[2];
			$language = $countryArr[1];
			$c = Country::find()->where(["countryName" => $countryName, "status" => 1])->asArray()->one();
			if (isset($c) && !empty($c)) {
				$countryId = $c["countryId"];
				$sql = "INSERT INTO `language` (`name`, `symbol`, `countryId`) VALUES (:name, :symbol, :countryId);";
				Yii::$app->db->createCommand($sql)
					->bindValues([
						':name' => $language,
						':symbol' => $symbol,
						':countryId' => $countryId
					])
					->execute();
			}
		endforeach;
	}
}
