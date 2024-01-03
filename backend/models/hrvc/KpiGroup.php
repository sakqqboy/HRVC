<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KpiGroupMaster;

/**
* This is the model class for table "kpi_group".
*
* @property integer $kpiGroupId
* @property string $kpiGroupName
* @property integer $companyId
* @property integer $createrId
* @property string $kpiGroupDetail
* @property string $target
* @property integer $quantRatio
* @property string $priority
* @property integer $amountType
* @property string $month
* @property string $remark
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KpiGroup extends \backend\models\hrvc\master\KpiGroupMaster{
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }
}
