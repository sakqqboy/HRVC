<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KgiBranchMaster;

/**
* This is the model class for table "kgi_branch".
*
* @property integer $kgiBranchId
* @property integer $kgiId
* @property integer $branchId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiBranch extends \common\models\hrvc\master\KgiBranchMaster{
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
