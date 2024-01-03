<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KgiEmployeeHistoryMaster;

/**
* This is the model class for table "kgi_employee_history".
*
* @property integer $kgiEmployeeHistoryId
* @property integer $kgiEmployeeId
* @property string $target
* @property string $result
* @property string $detail
* @property string $nextCheckDate
* @property string $lastCheckDate
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class KgiEmployeeHistory extends \frontend\models\hrvc\master\KgiEmployeeHistoryMaster{
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
