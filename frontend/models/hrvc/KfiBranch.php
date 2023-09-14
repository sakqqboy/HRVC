<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiBranchMaster;

/**
* This is the model class for table "kfi_branch".
*
* @property integer $kfiBranchId
* @property integer $kfiId
* @property integer $branchId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiBranch extends \frontend\models\hrvc\master\KfiBranchMaster{
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
