<?php

namespace backend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "group".
*
    * @property integer $groupId
    * @property string $groupName
    * @property string $headQuaterName
    * @property string $displayName
    * @property string $tagLine
    * @property string $location
    * @property integer $countryId
    * @property string $city
    * @property string $postalCode
    * @property string $industries
    * @property string $founded
    * @property string $website
    * @property string $director
    * @property string $email
    * @property string $contact
    * @property string $specialties
    * @property string $socialTag
    * @property string $about
    * @property string $picture
    * @property string $banner
    * @property string $socialInstargram
    * @property string $socialFacebook
    * @property string $socialYoutube
    * @property string $socialLinkin
    * @property string $socialX
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class GroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['groupName', 'displayName', 'location', 'industries', 'director', 'email'], 'required'],
            [['location', 'specialties', 'socialTag', 'about'], 'string'],
            [['countryId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['groupName', 'headQuaterName', 'displayName', 'tagLine', 'city', 'industries', 'website', 'picture', 'banner', 'socialInstargram', 'socialFacebook', 'socialYoutube', 'socialLinkin', 'socialX'], 'string', 'max' => 255],
            [['postalCode', 'founded', 'director', 'email', 'contact'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'groupId' => 'Group ID',
    'groupName' => 'Group Name',
    'headQuaterName' => 'Head Quater Name',
    'displayName' => 'Display Name',
    'tagLine' => 'Tag Line',
    'location' => 'Location',
    'countryId' => 'Country ID',
    'city' => 'City',
    'postalCode' => 'Postal Code',
    'industries' => 'Industries',
    'founded' => 'Founded',
    'website' => 'Website',
    'director' => 'Director',
    'email' => 'Email',
    'contact' => 'Contact',
    'specialties' => 'Specialties',
    'socialTag' => 'Social Tag',
    'about' => 'About',
    'picture' => 'Picture',
    'banner' => 'Banner',
    'socialInstargram' => 'Social Instargram',
    'socialFacebook' => 'Social Facebook',
    'socialYoutube' => 'Social Youtube',
    'socialLinkin' => 'Social Linkin',
    'socialX' => 'Social X',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
