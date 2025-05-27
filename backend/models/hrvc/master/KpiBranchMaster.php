<?php

namespace backend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "kpi_branch".
*
    * @property integer $kpiBranchId
    * @property integer $kpiId
    * @property integer $branchId
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class KpiBranchMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'kpi_branch';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['kpiId', 'branchId'], 'required'],
            [['kpiId', 'branchId'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'kpiBranchId' => 'Kpi Branch ID',
    'kpiId' => 'Kpi ID',
    'branchId' => 'Branch ID',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
