<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "group_has_kgi".
*
    * @property integer $groupHasKgiId
    * @property integer $kgiGroupId
    * @property integer $kgiId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class GroupHasKgiMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'group_has_kgi';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiGroupId', 'kgiId'], 'required'],
            [['kgiGroupId', 'kgiId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'groupHasKgiId' => 'Group Has Kgi ID',
    'kgiGroupId' => 'Kgi Group ID',
    'kgiId' => 'Kgi ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
