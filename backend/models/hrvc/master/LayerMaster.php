<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "layer".
*
    * @property integer $layerId
    * @property string $layerName
    * @property integer $priority
    * @property string $shortTag
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class LayerMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'layer';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['layerName', 'priority', 'shortTag'], 'required'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['layerName'], 'string', 'max' => 255],
            [['priority', 'status'], 'string', 'max' => 10],
            [['shortTag'], 'string', 'max' => 45],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'layerId' => 'Layer ID',
    'layerName' => 'Layer Name',
    'priority' => 'Priority',
    'shortTag' => 'Short Tag',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
