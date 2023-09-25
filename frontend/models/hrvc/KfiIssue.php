<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiIssueMaster;

/**
* This is the model class for table "kfi_issue".
*
* @property integer $kfiIssueId
* @property string $issue
* @property integer $kfiId
* @property integer $employeeId
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KfiIssue extends \frontend\models\hrvc\master\KfiIssueMaster{
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
