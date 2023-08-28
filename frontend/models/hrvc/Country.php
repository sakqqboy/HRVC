<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\CountryMaster;

/**
 * This is the model class for table "country".
 *
 * @property integer $countryId
 * @property string $countryName
 * @property string $flag
 * @property string $lat
 * @property string $lng
 * @property integer $hasBranch
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Country extends \frontend\models\hrvc\master\CountryMaster
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
    public static function flagBranch($branchId)
    {
        $branch = Branch::find()->select('companyId')->where(["branchId" => $branchId])->asArray()->one();
        $company = Company::find()->select('countryId')->where(["companyId" => $branch["companyId"]])->asArray()->one();
        $country = Country::find()->select('flag')->where(["countryId" => $company["countryId"]])->asArray()->one();
        return  $country["flag"];
    }
    public static function CountryName($countryId)
    {
        $country = Country::find()->select('countryName')
            ->where(["countryId" => $countryId])->asArray()->one();
        return $country["countryName"];
    }
}
