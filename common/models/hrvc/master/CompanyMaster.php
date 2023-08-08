<?php

namespace common\models\hrvc\master;

use Yii;

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
            [['companyName', 'groupId', 'countryId'], 'required'],
            [['groupId', 'countryId'], 'integer'],
            [['location', 'industries', 'contact', 'specialties', 'tag', 'about'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['companyName', 'website'], 'string', 'max' => 255],
            [['founded', 'director', 'email'], 'string', 'max' => 100],
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
    'website' => 'Website',
    'location' => 'Location',
    'industries' => 'Industries',
    'founded' => 'Founded',
    'director' => 'Director',
    'email' => 'Email',
    'contact' => 'Contact',
    'specialties' => 'Specialties',
    'tag' => 'Tag',
    'about' => 'About',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
