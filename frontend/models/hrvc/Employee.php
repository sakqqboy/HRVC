<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\EmployeeMaster;
use common\helpers\Path;
use Exception;

/**
 * This is the model class for table "employee".
 *
 * @property integer $employeeId
 * @property string $employeeNumber
 * @property string $employeeFirstname
 * @property string $employeeSurename
 * @property string $employeeNickname
 * @property integer $gender
 * @property string $birthDate
 * @property string $email
 * @property string $telephoneNumber
 * @property integer $branchId
 * @property integer $departmentId
 * @property integer $positionId
 * @property integer $teamId
 * @property string $hireDate
 * @property string $picture
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Employee extends \frontend\models\hrvc\master\EmployeeMaster
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
    public function getUser()
    {
        return $this->hasOne(User::class, ['employeeId' => 'employeeId']);
    }
    public static function calculateDate($joinDate)
    {
        $today = date("Y-m-d");
        $now = strtotime($today);
        $joinDate = strtotime($joinDate);
        if ($now > $joinDate) {
            $diff = $now - $joinDate;
            $diffDate = floor($diff / 86400); //จำนวนวันที่ต่างกัน
            $years = floor($diffDate / 365);
            $diffYear = $diffDate % 365;
            $month = floor($diffYear / 30);
            $diffMonth = $month % 30;
            return $years . " Years " . $month . " months " . $diffMonth . " days";
        } else {
            return 0;
        }
    }
    public static function employeeName($employeeId)
    {
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('employeeFirstname,employeeSurename')
                ->where(["employeeId" => $employeeId])
                ->asArray()
                ->one();
            return $employee["employeeFirstname"] . " " . $employee["employeeSurename"];
        } else {
            return '';
        }
    }
    public static function employeeDetailByUserId($userId)
    {
        $employee = [];
        if ($userId != '') {
            $user = User::find()->where(["userId" => $userId])->asArray()->one();
            if (isset($user) && !empty($user)) {
                $employee = Employee::find()->select('branchId,companyId,employeeId')
                    ->where(["employeeId" => $user["employeeId"]])->asArray()->one();
            }
        }
        return $employee;
    }
    public static function employeeTitle($employeeId)
    {
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('t.titleName')
                ->JOIN("LEFT JOIN", "title t", "t.titleId=employee.titleId")
                ->where(["employee.employeeId" => $employeeId])
                ->asArray()
                ->one();
            return $employee["titleName"];
        } else {
            return '';
        }
    }
    public static function employeeBranch($employeeId)
    {
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('b.branchName')
                ->JOIN("LEFT JOIN", "branch b", "b.branchId=employee.branchId")
                ->where(["employee.employeeId" => $employeeId])
                ->asArray()
                ->one();
            return $employee["branchName"];
        } else {
            return '';
        }
    }
    public static function employeeTeam($employeeId)
    {
        $data = [];
        if ($employeeId != '') {
            $employee = Employee::find()
                ->select('t.teamName,t.teamId')
                ->JOIN("LEFT JOIN", "team t", "t.teamId=employee.teamId")
                ->where(["employee.employeeId" => $employeeId])
                ->asArray()
                ->one();

            $data = [
                "teamName" => $employee["teamName"],
                "teamId" => $employee["teamId"]
            ];
        }
        return $data;
    }
    public static function totalEmployee($companyId)
    {
        $count = Employee::find()
        ->where(['NOT IN', 'status', [99, 100]])
        ->andFilterWhere(['companyId' => $companyId])
        ->count();
        return $count;
    }
    public static function totalDraft($companyId)
    {
        $count = Employee::find()
            ->where(["status" => 100])
            ->andFilterWhere(["companyId" => $companyId])
            ->count();
        return $count;
    }
    public static function totalEmployeeWithFilter($companyId, $branchId, $departmentId, $teamId, $employeeConditionId)
    {
        $employee = Employee::find()
            ->where(["status" => [1, 2, 3, 4, 5, 6, 7]])
            ->andFilterWhere([
                "companyId" => $companyId,
                "branchId" => $branchId,
                "departmentId" => $departmentId,
                "teamId" => $teamId,
                "employeeConditionId" => $employeeConditionId,
            ])
            ->count();
        return $employee;
    }
    public static function totalDraftWithFilter($companyId, $branchId, $departmentId, $teamId)
    {
        $employee = Employee::find()
            ->where(["status" => 100])
            ->andFilterWhere([
                "companyId" => $companyId,
                "branchId" => $branchId,
                "departmentId" => $departmentId,
                "teamId" => $teamId,
            ])
            ->count();
        return $employee;
    }
    public static function employeeId($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        if (isset($user) && !empty($user)) {
            return $user["employeeId"];
        } else {
            return null;
        }
    }
    public static function EmployeeDetail($employeeId)
    {
        $employee = Employee::find()->where(["employeeId" => $employeeId])->asArray()->one();
        return $employee;
    }
    public static function employeeImage($employeeId)
    {
        $employee = Employee::find()
            ->select('picture')
            ->where(["employeeId" => $employeeId])
            ->asArray()
            ->one();
        $img = "images/employee/status/employee-nopic.svg";
        if (!empty($employee) && !empty($employee["picture"])) {
            $url = Path::frontendUrl() . $employee["picture"];

            // ดึง headers
            $headers = @get_headers($url);

            if ($headers !== false && strpos($headers[0], '200') !== false) {
                $img = $employee["picture"];
            }
        }
        return $img;
    }
    public static function employeeThreeImage($employees)
    {
        $selectPic = [];
        $img = [];
        if (isset($employees) && count($employees) > 0) {

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
                    if (isset($pic['picture']) && !empty($pic['picture'])) {
                        $file = Path::getHost() . $pic["picture"];
                        if (file_exists($file)) {
                            $img[$i] = $pic["picture"];
                        }
                    }
                    $i++;
                endforeach;
            }
        }
        return $img;
    }
}
