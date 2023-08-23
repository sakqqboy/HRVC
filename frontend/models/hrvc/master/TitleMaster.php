<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "title".
*
    * @property integer $titleId
    * @property string $titleName
    * @property integer $layerId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class TitleMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'title';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['titleName'], 'required'],
            [['layerId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['titleName'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'titleId' => 'Title ID',
    'titleName' => 'Title Name',
    'layerId' => 'Layer ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
