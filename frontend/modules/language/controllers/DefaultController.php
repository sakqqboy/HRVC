<?php

namespace frontend\modules\language\controllers;

use common\helpers\Path;
use Exception;
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
    public function actionIndex()
    {
        if (isset($_POST["english"])) {
            $model = new Translator();
            $model->english = $_POST["english"];
            $model->japanese = $_POST["japanese"];
            $model->status = 1;
            $model->save(false);
        }
        $language = Translator::find()->where(["status" => 1])->orderBy("english ASC")->asArray()->all();
        return $this->render('index', [
            "language" => $language
        ]);
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
        Translator::deleteAll(["id" => $_POST["id"]]);
        $res["status"] = true;
        return json_encode($res);
        //return $this->redirect('index');
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
}