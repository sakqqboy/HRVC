<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KpiBranchMaster;

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

class KpiBranch extends \common\models\hrvc\master\KpiBranchMaster{
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
