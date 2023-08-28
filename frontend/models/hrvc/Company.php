<?php

namespace frontend\models\hrvc;

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
}
