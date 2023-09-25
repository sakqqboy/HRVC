<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KgiIssueMaster;

/**
* This is the model class for table "kgi_issue".
*
* @property integer $kgiIssueId
* @property string $issue
* @property integer $kgiId
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiIssue extends \backend\models\hrvc\master\KgiIssueMaster{
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
