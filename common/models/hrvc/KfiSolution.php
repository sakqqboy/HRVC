<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\KfiSolutionMaster;

/**
* This is the model class for table "kfi_solution".
*
* @property integer $kfiSolutionId
* @property integer $kfiIssueId
* @property string $solution
* @property integer $parentId
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiSolution extends \common\models\hrvc\master\KfiSolutionMaster{
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
