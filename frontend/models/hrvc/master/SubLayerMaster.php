<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "sub_layer".
*
    * @property integer $subLayerId
    * @property string $subLayerName
    * @property integer $layerId
    * @property string $shortTag
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class SubLayerMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'sub_layer';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['subLayerName', 'layerId'], 'required'],
            [['layerId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['subLayerName'], 'string', 'max' => 255],
            [['shortTag'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'subLayerId' => 'Sub Layer ID',
    'subLayerName' => 'Sub Layer Name',
    'layerId' => 'Layer ID',
    'shortTag' => 'Short Tag',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
