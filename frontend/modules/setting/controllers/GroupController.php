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
use frontend\components\Api;

/**
 * Default controller for the `setting` module
 */
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
        if ($role <= 3) {
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
        $currentGroup = Group::find()->select('groupId')->where(["status" => 1])->asArray()->one();
        // if (isset($currentGroup) && !empty($currentGroup)) {
        //     return $this->redirect(Yii::$app->homeUrl . 'setting/group/group-view/' . ModelMaster::encodeParams(["groupId" => $currentGroup["groupId"]]));
        // }
        if (isset($_POST["groupName"]) && trim($_POST["groupName"]) != '') {
            $group = new Group();
            $group->groupName = $_POST["groupName"];
            $group->tagLine = $_POST["tagLine"];
            $group->displayName = $_POST["displayName"];
            // $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["country"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->contact = $_POST["contact"];
            $group->founded = $_POST["founded"];
            // $group->director = $_POST["director"];
            $group->socialInstargram = $_POST["instagram"] ?? "";
            $group->socialFacebook   = $_POST["facebook"] ?? "";
            $group->socialYoutube    = $_POST["youtube"] ?? "";
            $group->socialLinkin     = $_POST["linkedin"] ?? "";
            $group->socialX          = $_POST["twitter"] ?? "";
            $group->website          = $_POST["website"] ?? "";
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

        $countries = Api::connectApi(Path::Api() . 'masterdata/country/active-country');

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
        }

        $group = Api::connectApi(Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);
        //throw new Exception(print_r($group, true));
        $companyGroup = Api::connectApi(Path::Api() . 'masterdata/group/company-group?id=' . $groupId . '&page=1');

        // $employees = Employee::find()->select('employeeId')->where(["status" => 1])->all();
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
                            $totalTeam += count($teams);
                        endforeach;
                        $totalDepartment += count($departments);
                    endforeach;
                }
                $totalBranches += count($branches);
            endforeach;
        }
        $employees = Employee::find()
        ->select('picture')
        ->where(['status' => 1])
        ->andWhere(['NOT IN', 'employee_id', [99, 100]])
        ->asArray()
        ->all();

        // กรองข้อมูลที่ picture ไม่เป็นค่าว่าง
        $selectPic = [];
        $img = [];
        if (count($employees) >= 3) {
            $randomEmpployee = array_rand($employees, 3);
            $selectPic[0] = $employees[$randomEmpployee[0]];
            $selectPic[1] = $employees[$randomEmpployee[1]];
            $selectPic[2] = $employees[$randomEmpployee[2]];
        } else {
            if (count($employees) > 0) {
                $selectPic = $employees;
                sort($selectPic);
            }
        }
        $i = 0;
        if (count($selectPic) > 0) {
            foreach ($selectPic as $pic):
                $img[$i] = 'images/employee/status/employee-nopic.svg';
                if (!empty($pic['picture'])) {
                    $file = Path::getHost() . $pic["picture"];
                    if (file_exists($file)) {
                        $img[$i] = $pic["picture"];
                    }
                }
                $i++;
            endforeach;
        }
        //throw new Exception(print_r($companyGroup, true));
        // จัดเรียงผลลัพธ์ให้อยู่ในอาเรย์ที่มีแค่ 3 ตัวแรก
        // $filteredEmployees = array_values($filteredEmployees); // ใช้ array_values เพื่อรีเซ็ต index ของอาเรย์

        // เลือกแค่ 3 ตัวแรก
        // $filteredEmployees = array_slice($filteredEmployees, 0, 3);

        // แสดงผลลัพธ์
        $totalEmployees = count($employees);
        $branches = Branch::find()->select('branchId')->where(["status" => 1])->all();

        return $this->render('group_view', [
            "group" => $group,
            "companyGroup" => $companyGroup,
            "totalEmployees" => $totalEmployees,
            "totalBranches" => $totalBranches,
            "totalDepartment" => $totalDepartment,
            "totalTeam" => $totalTeam,
            "role" => $role,
            "employees" => $img
        ]);
    }
    public function actionUpdateGroup($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $groupId = $param["groupId"];

        // ดึงข้อมูลประเทศทั้งหมด
        $countries = Api::connectApi(Path::Api() . 'masterdata/country/active-country');

        // ดึงรายละเอียดกลุ่ม
        $group = Api::connectApi(Path::Api() . 'masterdata/group/group-detail?id=' . $groupId);

        // ดึงรายละเอียดประเทศของกลุ่ม
        $groupCountry = Api::connectApi(Path::Api() . 'masterdata/country/country-detail?id=' . $group['countryId']);

        return $this->render('update_group', [
            "countries" => $countries,
            "group" => $group,
            "groupCountry" => $groupCountry
        ]);
    }
    public function actionSaveUpdateGroup()
    {
        // throw new Exception(print_r($_POST, true));
        if (isset($_POST["groupName"]) && trim($_POST["groupName"]) != '') {
            $group = Group::find()->where(["groupId" => $_POST["groupId"] - 543])->one();
            $oldBanner = $group->banner;
            $oldImage = $group->picture;
            $group->groupName = $_POST["groupName"];
            $group->tagLine = $_POST["tagLine"];
            $group->displayName = $_POST["displayName"];
            // $group->website = $_POST["website"];
            $group->location = $_POST["location"];
            $group->countryId = $_POST["country"];
            $group->industries = $_POST["industries"];
            $group->email = $_POST["email"];
            $group->founded = $_POST["founded"];
            $group->director = $_POST["director"] ?? null;
            $group->socialInstargram = $_POST["instagram"] ?? "";
            $group->socialFacebook   = $_POST["facebook"] ?? "";
            $group->socialYoutube    = $_POST["youtube"] ?? "";
            $group->socialLinkin     = $_POST["linkedin"] ?? "";
            $group->socialX          = $_POST["twitter"] ?? "";
            $group->website          = $_POST["website"] ?? "";
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
                if (file_exists($oldPathBanner) && $oldBanner != '') {
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

            $fileImage = UploadedFile::getInstanceByName("image");
            if (isset($fileImage) && !empty($fileImage)) {
                $path = Path::getHost() . 'images/group/profile/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // ลบรูปเก่าถ้ามี
                $oldPathPicture = Path::getHost() . $oldImage;
                if (file_exists($oldPathPicture) && $oldImage != '') {
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
                    $srcImg = @imagecreatefromjpeg($tempPath);
                } elseif ($extension === 'png') {
                    $srcImg = @imagecreatefrompng($tempPath);
                } elseif ($extension === 'gif') {
                    $srcImg = @imagecreatefromgif($tempPath);
                }


                if ($srcImg) {
                    $cropSize = 600;
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
    public function actionDirectorList()
    {
        $name = $_POST["name"];
        $nameArray = explode(' ', $name);
        $sql1 = [];
        $sql2 = [];
        $sql = [];
        $res = [];
        $firstname = $nameArray[0] ?? '';
        $surename = $nameArray[1] ?? '';
        if ($firstname != '') {
            $sql1 = ['LIKE', 'e.employeeFirstname', $firstname . '%', false];
            $sql = $sql1;
        }
        if ($surename != '') {
            $sql2 = ['LIKE', 'e.employeeSurename', $surename . '%', false];
            $sql = ['and', $sql1, $sql2];
        }
        if (!empty($sql)) {
            $employees = Employee::find()
                ->alias('e')
                ->select('e.employeeId,e.employeeFirstname,e.employeeSurename')
                ->JOIN("LEFT JOIN", "user u", "u.employeeId=e.employeeId")
                ->JOIN("LEFT JOIN", "user_role ur", "u.userId=ur.userId")
                ->where($sql)
                ->andWhere("ur.roleId<4 and e.status!=99")
                ->orderBy('e.employeeFirstname')
                ->asArray()
                ->all();

            $textEmployee = "";
            //throw new Exception(print_r($employees, true));
            if (isset($employees) && count($employees) > 0) {
                $i = 1;
                foreach ($employees as $employee):
                    $employeeId = $employee["employeeId"];
                    $employeeFirstname = $employee["employeeFirstname"];
                    $employeeSurename = $employee["employeeSurename"];
                    $textEmployee .= "<div class='director-box' id='director-" . $employeeId . "' onclick='javascript:selectDirector(" . $employeeId . ")'>$employeeFirstname $employeeSurename</div>";
                    $i++;
                endforeach;
            } else {
                $textEmployee = "<div class='director-box text-center'>Not found</div>";
            }
        }
        $res["status"] = true;
        $res["directorList"] = $textEmployee;
        return json_encode($res);
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
