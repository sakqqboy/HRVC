<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kgi_group".
*
    * @property integer $kgiGroupId
    * @property string $kgiGroupName
    * @property string $kgiGroupDetail
    * @property string $target
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KgiGroupMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kgi_group';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kgiGroupId', 'kgiGroupName'], 'required'],
            [['kgiGroupId'], 'integer'],
            [['kgiGroupDetail'], 'string'],
            [['target'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['kgiGroupName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kgiGroupId' => 'Kgi Group ID',
    'kgiGroupName' => 'Kgi Group Name',
    'kgiGroupDetail' => 'Kgi Group Detail',
    'target' => 'Target',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
