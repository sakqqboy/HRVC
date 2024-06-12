<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\RankMaster;

/**
* This is the model class for table "rank".
*
* @property integer $rankId
* @property string $rankName
* @property integer $termId
* @property string $max
* @property string $min
* @property string $increasement
* @property string $bonusRate
* @property integer $status
* @property string $createDateTime
* @property string $updateaTime
*/

class Rank extends \frontend\models\hrvc\master\RankMaster{
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
