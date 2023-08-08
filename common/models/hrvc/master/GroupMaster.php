<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "group".
*
    * @property integer $groupId
    * @property string $groupName
    * @property string $location
    * @property string $industries
    * @property string $founded
    * @property string $website
    * @property string $director
    * @property string $email
    * @property string $contact
    * @property string $specialties
    * @property string $socialTag
    * @property string $about
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
            [['groupName'], 'required'],
            [['location', 'specialties', 'socialTag', 'about'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['groupName', 'industries', 'website'], 'string', 'max' => 255],
            [['founded', 'director', 'email', 'contact'], 'string', 'max' => 100],
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
    'location' => 'Location',
    'industries' => 'Industries',
    'founded' => 'Founded',
    'website' => 'Website',
    'director' => 'Director',
    'email' => 'Email',
    'contact' => 'Contact',
    'specialties' => 'Specialties',
    'socialTag' => 'Social Tag',
    'about' => 'About',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
