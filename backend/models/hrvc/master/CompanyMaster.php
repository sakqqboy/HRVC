<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "company".
*
    * @property integer $companyId
    * @property string $companyName
    * @property integer $groupId
    * @property integer $countryId
    * @property integer $headQuaterId
    * @property string $website
    * @property string $displayName
    * @property string $tagLine
    * @property string $location
    * @property string $city
    * @property string $postalCode
    * @property string $industries
    * @property string $founded
    * @property integer $directorId
    * @property string $email
    * @property string $contact
    * @property string $specialties
    * @property string $socialTag
    * @property string $about
    * @property string $banner
    * @property string $picture
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CompanyMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'company';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['companyName', 'groupId', 'displayName', 'location', 'industries'], 'required'],
            [['groupId', 'countryId', 'headQuaterId', 'directorId'], 'integer'],
            [['location', 'industries', 'contact', 'specialties', 'socialTag', 'about'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['companyName', 'website', 'displayName', 'tagLine', 'city', 'banner', 'picture'], 'string', 'max' => 255],
            [['postalCode', 'founded', 'email'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'companyId' => 'Company ID',
    'companyName' => 'Company Name',
    'groupId' => 'Group ID',
    'countryId' => 'Country ID',
    'headQuaterId' => 'Head Quater ID',
    'website' => 'Website',
    'displayName' => 'Display Name',
    'tagLine' => 'Tag Line',
    'location' => 'Location',
    'city' => 'City',
    'postalCode' => 'Postal Code',
    'industries' => 'Industries',
    'founded' => 'Founded',
    'directorId' => 'Director ID',
    'email' => 'Email',
    'contact' => 'Contact',
    'specialties' => 'Specialties',
    'socialTag' => 'Social Tag',
    'about' => 'About',
    'banner' => 'Banner',
    'picture' => 'Picture',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
