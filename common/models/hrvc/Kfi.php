<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KfiMaster;

/**
* This is the model class for table "kfi".
*
* @property integer $kfiId
* @property string $kfiName
* @property integer $companyId
* @property integer $branchId
* @property integer $unitId
* @property integer $targetAmount
* @property string $month
* @property integer $createrId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class Kfi extends \common\models\hrvc\master\KfiMaster{
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
