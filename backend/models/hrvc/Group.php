<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\GroupMaster;

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

class Group extends \backend\models\hrvc\master\GroupMaster{
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
