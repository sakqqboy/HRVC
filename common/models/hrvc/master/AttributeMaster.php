<?php

namespace common\models\hrvc\master;

use Yii;

/**
* This is the model class for table "attribute".
*
    * @property integer $attributeId
    * @property string $attributeName
    * @property integer $round
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class AttributeMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'attribute';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['attributeName'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['attributeName'], 'string', 'max' => 100],
            [['round', 'status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'attributeId' => 'Attribute ID',
    'attributeName' => 'Attribute Name',
    'round' => 'Round',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
