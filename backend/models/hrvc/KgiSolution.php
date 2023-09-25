<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiSolutionMaster;

/**
* This is the model class for table "kgi_solution".
*
* @property integer $kgiSolutionId
* @property integer $kgiIssueId
* @property string $solution
* @property integer $parentId
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiSolution extends \backend\models\hrvc\master\KgiSolutionMaster{
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
