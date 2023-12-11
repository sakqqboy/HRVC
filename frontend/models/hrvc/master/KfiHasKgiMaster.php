<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kfi_has_kgi".
*
    * @property integer $kfiHasKgiId
    * @property integer $kfiId
    * @property integer $kgiId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KfiHasKgiMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kfi_has_kgi';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kfiId', 'kgiId'], 'required'],
            [['kfiId', 'kgiId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 20],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kfiHasKgiId' => 'Kfi Has Kgi ID',
    'kfiId' => 'Kfi ID',
    'kgiId' => 'Kgi ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
