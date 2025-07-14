<?php

namespace frontend\models\hrvc;

use Exception;
use Yii;
use \frontend\models\hrvc\master\CompanyMaster;

/**
 * This is the model class for table "company".
 *
 * @property integer $companyId
 * @property string $companyName
 * @property integer $groupId
 * @property integer $countryId
 * @property string $website
 * @property string $location
 * @property string $industries
 * @property string $founded
 * @property string $director
 * @property string $email
 * @property string $contact
 * @property string $specialties
 * @property string $tag
 * @property string $about
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Company extends \frontend\models\hrvc\master\CompanyMaster
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
    public static function companyName($id)
    {
        $company = Company::find()->where(["companyId" => $id])->asArray()->one();
        if (isset($company) && !empty($company)) {
            return $company['companyName'];
        } else {
            return '';
        }
    }

    public static function companyImage($id)
    {
        $company = Company::find()->where(["companyId" => $id])->asArray()->one();
        if (isset($company) && !empty($company)) {
            return $company['picture'];
        } else {
            return 'images/company/profile/company.svg';
        }
    }
    public static function randomPic($allCompany, $total)
    {
        $withPicture = array_filter($allCompany, function ($item) {
            return !empty($item['picture']);
        });
        $withPicture = array_values($withPicture);
        $randomKeys = array_rand($withPicture, min($total, count($withPicture)));
        $randomKeys = (array) $randomKeys;
        $randomPictures = array_map(function ($key) use ($withPicture) {
            return $withPicture[$key]['picture'];
        }, $randomKeys);
        return $randomPictures;
    }

    public static function totalEmployeeCompany($companyId)
    {
        $employees = Employee::find()->select('employeeId')->where(["companyId" => $companyId])->asArray()->all();
        return count($employees);
    }
    public static function companyId($companyName)
    {
        $company = Company::find()->where(["companyName" => $companyName, "status" => 1])->asArray()->one();
        if (isset($company) && !empty($company)) {
            return $company["companyId"];
        } else {
            return '';
        }
    }
    public static function userCompany($userId)
    {
        $user = User::find()
            ->select('employeeId')
            ->where(["userId" => $userId])
            ->asArray()
            ->one();
        $employee = Employee::find()
            ->where(["employeeId" => $user["employeeId"]])
            ->asArray()
            ->one();
        return $employee["companyId"];
    }
}
