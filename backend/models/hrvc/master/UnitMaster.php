<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "unit".
*
    * @property integer $unitId
    * @property string $unitName
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class UnitMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'unit';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['unitName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['unitName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'unitId' => 'Unit ID',
    'unitName' => 'Unit Name',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
