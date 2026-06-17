<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "title".
*
    * @property integer $titleId
    * @property string $titleName
    * @property integer $layerId
    * @property integer $departmentId
    * @property string $jobDescription
    * @property string $purpose
    * @property string $keyResponsibility
    * @property string $requireSkill
    * @property string $shortTag
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
            [['titleName', 'departmentId'], 'required'],
            [['layerId', 'departmentId'], 'integer'],
            [['jobDescription', 'purpose', 'keyResponsibility'], 'string'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['titleName', 'requireSkill'], 'string', 'max' => 255],
            [['shortTag'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 4],
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
    'departmentId' => 'Department ID',
    'jobDescription' => 'Job Description',
    'purpose' => 'Purpose',
    'keyResponsibility' => 'Key Responsibility',
    'requireSkill' => 'Require Skill',
    'shortTag' => 'Short Tag',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
