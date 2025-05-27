<?php

namespace frontend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "module".
*
    * @property integer $moduleId
    * @property string $moduleName
    * @property integer $status
    * @property string $createDatetime
    * @property string $updateDatetime
*/
class ModuleMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'module';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['status'], 'integer'],
            [['createDatetime', 'updateDatetime'], 'safe'],
            [['moduleName'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'moduleId' => 'Module ID',
    'moduleName' => 'Module Name',
    'status' => 'Status',
    'createDatetime' => 'Create Datetime',
    'updateDatetime' => 'Update Datetime',
];
}
}
