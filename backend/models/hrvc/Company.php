<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\CompanyMaster;

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

class Company extends \backend\models\hrvc\master\CompanyMaster{
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
}
