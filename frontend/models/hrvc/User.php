<?php

namespace frontend\models\hrvc;
use common\helpers\Path;
use Exception;
use Yii;
use \frontend\models\hrvc\master\UserMaster;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property string $userName
 * @property string $password_hash
 * @property integer $employeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class User extends \frontend\models\hrvc\master\UserMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
    public static function userHeaderName()
    {
        if (Yii::$app->user->id) {
            $user = User::find()->where(["userId" => Yii::$app->user->id, "status" => 1])->asArray()->one();
            $employee = Employee::find()->where(["employeeId" => $user["employeeId"]])->asArray()->one();
            if (isset($employee) && !empty($employee)) {
                return $employee["employeeFirstname"] . " " . $employee["employeeSurename"];
            } else {
                return '';
            }
        }
    }
    public static function userHeaderImage()
    {
        if (Yii::$app->user->id) {
            $user = User::find()->where(["userId" => Yii::$app->user->id, "status" => 1])->asArray()->one();
            $employee = Employee::find()
                ->where(["employeeId" => $user["employeeId"]])
                ->asArray()
                ->one();
            // if ($employee["picture"] == '') {
            //     if ($employee["gender"] == '1') {
            //         $picture = 'image/user.png';
            //     } else {
            //         $picture = 'image/lady.jpg';
            //     }
            //     return $picture;
            // } else {
            //         $oldProfilePic = Path::getHost() . $employee["picture"];
            //         if (file_exists($oldProfilePic)) {
            //             unlink($oldProfilePic);
            //         }
            //     return $employee["picture"];
            // }
            $picturePath = Path::getHost() . $employee["picture"];

            // ถ้า picture ว่าง หรือ ไฟล์ไม่มีอยู่จริง
            if ($employee["picture"] == '' || !file_exists($picturePath)) {
                if ($employee["gender"] == '1') {
                    return 'image/user.svg'; // default ผู้ชาย
                } else {
                    return 'image/lady.jpg'; // default ผู้หญิง
                }
            }
            // ถ้ามีรูป และไฟล์มีจริง
            return $employee["picture"];
        }
    }
    public static function employeeIdFromUserId()
    {
        $user = User::find()->where(["userId" => Yii::$app->user->id])->asArray()->one();
        return $user["employeeId"];
    }
    public static function userTeamId()
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => Yii::$app->user->id])
            ->asArray()
            ->one();
        $employee = Employee::find()
            ->where(["employeeId" => $user["employeeId"]])
            ->asArray()
            ->one();
        return $employee["teamId"];
    }
    public static function userBranchId()
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => Yii::$app->user->id])
            ->asArray()
            ->one();
        $employee = Employee::find()
            ->where(["employeeId" => $user["employeeId"]])
            ->asArray()
            ->one();
        return $employee["branchId"];
    }
    public static function employeeNameByuserId($userId)
    {

        if ($userId != '') {
            $user = User::find()->where(["userId" => $userId])->asArray()->one();
            if (isset($user) && !empty($user)) {
                $employee = Employee::find()->where(["employeeId" => $user["employeeId"]])->asArray()->one();
                if (isset($employee) && !empty($employee)) {
                    return $employee["employeeFirstname"] . " " . $employee["employeeSurename"];
                }
            }
        }
        return '';
    }
    public static function userIdByEmployeeId($employeeId)
    {
        $user = User::find()->select('userId')
            ->where(["employeeId" => $employeeId, "status" => 1])
            ->asArray()
            ->one();
        if (isset($user) && !empty($user)) {
            return $user["userId"];
        } else {
            return  null;
        }
    }
    public static function employeeTitleDepartment()
    {
        $titleName = '';
        if (Yii::$app->user->id) {
            $user = User::find()->where(["userId" => Yii::$app->user->id])->asArray()->one();
            $employee = Employee::find()
                ->where(["employeeId" => $user["employeeId"]])
                ->asArray()
                ->one();
            if (isset($employee) && !empty($employee)) {
                $title = Title::find()
                    ->select('titleName')
                    ->where(["titleId" => $employee["titleId"]])
                    ->asArray()
                    ->one();
                $department = Department::find()
                    ->where(["departmentId" => $employee["departmentId"]])
                    ->asArray()
                    ->one();
                if (isset($title) && !empty($title) && !empty($department) && isset($department)) {
                    $titleName = $title["titleName"] . ' ' . $department["departmentName"];
                }
            }
        }
        return $titleName;
    }
}
