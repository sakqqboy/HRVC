<?php

namespace frontend/models\hrvc\master;

use Yii;

/**
* This is the model class for table "structure".
*
    * @property integer $structureId
    * @property string $structureName
    * @property integer $type
    * @property integer $defaultValue
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class StructureMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'structure';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['structureName', 'type'], 'required'],
            [['defaultValue'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['structureName'], 'string', 'max' => 100],
            [['type', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'structureId' => 'Structure ID',
    'structureName' => 'Structure Name',
    'type' => 'Type',
    'defaultValue' => 'Default Value',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
