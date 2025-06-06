<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\CompanyMaster;
use common\helpers\Path;

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

class Company extends \backend\models\hrvc\master\CompanyMaster
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
    public static function companyName($companyId)
    {
        $company = Company::find()->select('companyName')->where(["companyId" => $companyId])->asArray()->one();
        return $company["companyName"];
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
    public  static function companyPicture($picture)
    {

        $url = Path::frontendUrl() . $picture;
        $headers = @get_headers($url);

        if ($picture != '' && $headers && strpos($headers[0], '200') !== false) {
            $img = $picture;
        } else {
            $img = 'image/userProfile.png';
        }
        return $img;
    }
}
