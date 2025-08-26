<?php

namespace frontend\modules\setting\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Employee;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Team;
use frontend\models\hrvc\UserRole;
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
class GroupController extends Controller
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
		if($role <= 3 ){
			return  $this->redirect(Yii::$app->request->referrer);
		}
        return true; //go to origin request
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDisplayGroup()
    {
        $role = UserRole::userRight();
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        if (isset($group) && !empty($group)) {
            return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
        }
        
        return $this->render('display_group', [
            "role" => $role
        ]);
    }

    public function actionCreateGroup()
    {
        $group = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        // if (isset($group) && !empty($group)) {
        //     return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $group["groupId"]]));
        // }
        if (isset($_POST["groupName"]) && trim($_POST["groupName"]) != '') {
            // throw new Exception('POST DATA: ' . print_r($_POST, true));

            $group = new Group();
            $group->groupName = $_POST["groupName"];
            $group->tagLine = $_POST["tagLine"];
            // $group->headQuaterName = $_POST["headQuaterName"];
            $group->displayName = $_POST["displayName"];
            $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["country"];
            // $group->city = $_POST["city"];
            // $group->postalCode = $_POST["postalCode"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->contact = $_POST["contact"];
            $group->founded = $_POST["founded"];
            $group->director = $_POST["director"];
            // $group->socialTag = $_POST["socialTag"];
            $group->socialInstargram = $_POST["instagram"];
            $group->socialFacebook = $_POST["facebook"];
            $group->socialYoutube = $_POST["youtube"];
            $group->socialLinkin = $_POST["linkedin"];
            $group->socialX = $_POST["twitter"];
            $group->about = $_POST["about"];
            $group->status = 1;
            $group->createDateTime = new Expression('NOW()');
            $group->updateDateTime =  new Expression('NOW()');
            $fileBanner = UploadedFile::getInstanceByName("imageUploadBanner");
            if (isset($fileBanner) && !empty($fileBanner)) {
                $path = Path::getHost() . 'images/group/banner/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileBanner->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileBanner->saveAs($pathSave);
                $group->banner = 'images/group/banner/' . $fileName;
            }
            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/group/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $fileImage->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileImage->saveAs($pathSave);
                $group->picture = 'images/group/profile/' . $fileName;
            }
            if ($group->save(false)) {
                $groupId = Yii::$app->db->lastInsertID;
                return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $groupId]));
            }
        }
        //
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $result1 = curl_exec($ch1);
        curl_close($ch1);
        $countries = json_decode($result1, true);
        return $this->render('create', [
            "countries" => $countries
        ]);
    }
    public function actionGroupView($hash)
    {

        $param = ModelMaster::decodeParams($hash);
        $groupId = $param["groupId"];
        $totalBranches = 0;
        $totalDepartment = 0;
        $totalTeam = 0;
        $totalEmployees = 0;
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
            //return $this->redirect(Yii::$app->homeUrl . 'kpi/kpi-personal/individual-kpi');
        }

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        $groupJson = curl_exec($api);
        $group = json_decode($groupJson, true);
        // throw new Exception(print_r($group,true));


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/company-group?id=' . $groupId . '&page=1' . '&limit=7');
        $companyJson = curl_exec($api);
        $companyGroup = json_decode($companyJson, true);

        curl_close($api);
        $employees = Employee::find()->select('employeeId')->where(["status" => 1])->all();
        $companies = Company::find()->where(["groupId" => $groupId, "status" => 1])->asArray()->all();
        if (isset($companies) && count($companies) > 0) {
            foreach ($companies as $company) :
                $branches = Branch::find()
                    ->where(["status" => 1, "companyId" => $company["companyId"]])
                    ->asArray()
                    ->all();
                if (isset($branches) && count($branches) > 0) {
                    foreach ($branches as $branch) :
                        $departments = Department::find()
                            ->where(["branchId" => $branch["branchId"], "status" => 1])
                            ->asArray()
                            ->all();
                        foreach ($departments as $department) :
                            $teams = Team::find()
                                ->where(["departmentId" => $department["departmentId"], "status" => 1])
                                ->asArray()
                                ->all();
                            // if (isset($teams) && count($teams) > 0) {
                            //     foreach ($teams as $team) :
                            //         $employees = Employee::find()
                            //             ->where(["status" => 1, "teamId" => $team["teamId"]])
                            //             ->asArray()
                            //             ->all();
                            //         $totalEmployees += count($employees);
                            //     endforeach;
                            // }
                            $totalTeam += count($teams);
                        endforeach;
                        $totalDepartment += count($departments);
                    endforeach;
                }
                $totalBranches += count($branches);
            endforeach;
        }
        $employees = Employee::find()
        ->where(["status" => 1])
        ->asArray()
        ->all();

        // กรองข้อมูลที่ picture ไม่เป็นค่าว่าง
        $filteredEmployees = array_filter($employees, function($employee) {
            return !empty($employee['picture']);
        });

        // จัดเรียงผลลัพธ์ให้อยู่ในอาเรย์ที่มีแค่ 3 ตัวแรก
        $filteredEmployees = array_values($filteredEmployees); // ใช้ array_values เพื่อรีเซ็ต index ของอาเรย์

        // เลือกแค่ 3 ตัวแรก
        $filteredEmployees = array_slice($filteredEmployees, 0, 3);

        // แสดงผลลัพธ์
        // print_r($filteredEmployees);

        $totalEmployees = count($employees);
        $branches = Branch::find()->select('branchId')->where(["status" => 1])->all();

        // throw new Exception(print_r($filteredEmployees,true));

        return $this->render('group_view', [
            "group" => $group,
            "companyGroup" => $companyGroup,
            "totalEmployees" => $totalEmployees,
            "totalBranches" => $totalBranches,
            "totalDepartment" => $totalDepartment,
            "totalTeam" => $totalTeam,
            "role" => $role,
            "employees" => $filteredEmployees
        ]);
    }
    public function actionUpdateGroup($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $groupId = $param["groupId"];

        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/active-country');
        $resultCountry = curl_exec($api);
        $countries = json_decode($resultCountry, true);


        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        $groupJson = curl_exec($api);
        $group = json_decode($groupJson, true);
        // throw new Exception(print_r($group,true));
        curl_setopt($api, CURLOPT_URL, Path::Api() . 'masterdata/country/country-detail?id=' . $group["countryId"]);
        $resultCountryDetail = curl_exec($api);
        $groupCountry = json_decode($resultCountryDetail, true);

        curl_close($api);
        return $this->render('update_group', [
            "countries" => $countries,
            "group" => $group,
            "groupCountry" => $groupCountry
        ]);
    }
    public function actionSaveUpdateGroup()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        // exit;
        if (isset($_POST["groupName"]) && trim($_POST["groupName"]) != '') {
            $group = Group::find()->where(["groupId" => $_POST["groupId"] - 543])->one();
            $oldBanner = $group->banner;
            $oldImage = $group->picture;
            $group->groupName = $_POST["groupName"];
            $group->tagLine = $_POST["tagLine"];
            $group->displayName = $_POST["displayName"];
            $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["country"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->founded = $_POST["founded"];
            $group->director = $_POST["director"];
            $group->socialInstargram = $_POST["instagram"];
            $group->socialFacebook = $_POST["facebook"];
            $group->socialYoutube = $_POST["youtube"];
            $group->socialLinkin = $_POST["linkedin"];
            $group->socialX = $_POST["twitter"];
            $group->about = $_POST["about"];
            $group->status = 1;
            $group->updateDateTime =  new Expression('NOW()');
            $fileBanner = UploadedFile::getInstanceByName("imageUploadBanner");
            if (isset($fileBanner) && !empty($fileBanner)) {
                $path = Path::getHost() . 'images/group/banner/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $oldPathBanner = Path::getHost() . $oldBanner;
                if (file_exists($oldPathBanner)) {
                    unlink($oldPathBanner);
                }
                $file = $fileBanner->name;
                $filenameArray = explode('.', $file);
                $countArrayFile = count($filenameArray);
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
                $pathSave = $path . $fileName;
                $fileBanner->saveAs($pathSave);
                $group->banner = 'images/group/banner/' . $fileName;
            }
            // $fileImage = UploadedFile::getInstanceByName("image");
            // if (isset($fileImage) && !empty($fileImage)) {
            //     $path = Path::getHost() . 'images/group/profile/';
            //     if (!file_exists($path)) {
            //         mkdir($path, 0777, true);
            //     }
            //     $oldPathPicture = Path::getHost() . $oldImage;
            //     if (file_exists($oldPathPicture)) {
            //         unlink($oldPathPicture);
            //     }
            //     $file = $fileImage->name;
            //     $filenameArray = explode('.', $file);
            //     $countArrayFile = count($filenameArray);
            //     $fileName = Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[$countArrayFile - 1];
            //     $pathSave = $path . $fileName;
            //     $fileImage->saveAs($pathSave);
            //     $group->picture = 'images/group/profile/' . $fileName;
            // }
            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/group/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // ลบรูปเก่าถ้ามี
                $oldPathPicture = Path::getHost() . $oldImage;
                if (file_exists($oldPathPicture)) {
                    unlink($oldPathPicture);
                }

                // สร้างชื่อไฟล์ใหม่
                $file = $fileImage->name;
                $filenameArray = explode('.', $file);
                $extension = strtolower(end($filenameArray)); // นามสกุล เช่น jpg, png
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $extension;
                $pathSave = $path . $fileName;

                // โหลดรูปภาพจาก temp
                $tempPath = $fileImage->tempName;

                // ใช้ GD library เพื่อครอบภาพ
                list($width, $height) = getimagesize($tempPath);
                $srcImg = null;

                if ($extension === 'jpg' || $extension === 'jpeg') {
                    $srcImg = imagecreatefromjpeg($tempPath);
                } elseif ($extension === 'png') {
                    $srcImg = imagecreatefrompng($tempPath);
                } elseif ($extension === 'gif') {
                    $srcImg = imagecreatefromgif($tempPath);
                }

                if ($srcImg) {
                    $cropSize = 135;
                    $dstImg = imagecreatetruecolor($cropSize, $cropSize);

                    // คำนวณตำแหน่ง crop ให้อยู่ตรงกลางของรูป
                    $minSize = min($width, $height);
                    $srcX = round(($width - $minSize) / 2);
                    $srcY = round(($height - $minSize) / 2);

                    imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $cropSize, $cropSize, $minSize, $minSize);

                    // บันทึกไฟล์ภาพที่ crop แล้ว
                    if ($extension === 'jpg' || $extension === 'jpeg') {
                        imagejpeg($dstImg, $pathSave, 90);
                    } elseif ($extension === 'png') {
                        imagepng($dstImg, $pathSave);
                    } elseif ($extension === 'gif') {
                        imagegif($dstImg, $pathSave);
                    }

                    imagedestroy($srcImg);
                    imagedestroy($dstImg);

                    // อัปเดตชื่อไฟล์ลง model
                    $group->picture = 'images/group/profile/' . $fileName;
                }
            }

            if ($group->save(false)) {
                $groupId = $_POST["groupId"] - 543;
                return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $groupId]));
            }
        }
    }
    public function actionFontSize()
    {
        $myfile = fopen(Path::urlUpload() . "css/layout/font.css", "w");
        $i = 10;
        $text = '';
        while ($i <= 100) {
            $text .= ".font-size-" . $i . "{font-size:" . $i . "px;}";
            $i++;
        }
        fwrite($myfile, $text);
        fclose($myfile);
    }
    public function actionLayout()
    {
        $myfile = fopen(Path::urlUpload() . "css/layout/layout.css", "w");
        $i = 0;
        $a = 1;
        $text = '';
        while ($a <= 8) {
            if ($i < 6) {
                $important = " !important";
            } else {
                $important = '';
            }
            if ($a == 1) {
                $text .= ".pt-" . $i . "{padding-top:" . $i . "px" . $important . ";}";
            }
            if ($a == 2) {
                $text .= ".pb-" . $i . "{padding-bottom:" . $i . "px" . $important . ";}";
            }
            if ($a == 3) {
                $text .= ".pl-" . $i . "{padding-left:" . $i . "px" . $important . ";}";
            }
            if ($a == 4) {
                $text .= ".pr-" . $i . "{padding-right:" . $i . "px" . $important . ";}";
            }
            if ($a == 5) {
                $text .= ".mt-" . $i . "{margin-top:" . $i . "px" . $important . ";}";
            }
            if ($a == 6) {
                $text .= ".mb-" . $i . "{margin-bottom:" . $i . "px" . $important . ";}";
            }
            if ($a == 7) {
                $text .= ".ml-" . $i . "{margin-left:" . $i . "px" . $important . ";}";
            }
            if ($a == 8) {
                $text .= ".mr-" . $i . "{margin-right:" . $i . "px" . $important . ";}";
            }
            $i++;
            if ($i > 100) {
                $a++;
                $i = 0;
            }
        }
        $text .= ".no-underline {text-decoration: none;}";
        fwrite($myfile, $text);
        fclose($myfile);
    }
}