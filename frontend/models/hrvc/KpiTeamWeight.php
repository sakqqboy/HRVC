<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KpiTeamWeightMaster;

/**
* This is the model class for table "kpi_team_weight".
*
* @property integer $kpiTeamWeightId
* @property integer $kpiTeamId
* @property integer $kpiId
* @property integer $termId
* @property integer $employeeId
* @property string $level1
* @property string $level1End
* @property string $level2
* @property string $level2End
* @property string $level3
* @property string $level3End
* @property string $level4
* @property string $level4End
* @property string $weight
* @property integer $status
* @property string $createDateTime
* @property string $updateDatetime
*/

class KpiTeamWeight extends \frontend\models\hrvc\master\KpiTeamWeightMaster{
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
