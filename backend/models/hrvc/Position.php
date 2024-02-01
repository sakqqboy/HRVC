<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\PositionMaster;

/**
 * This is the model class for table "position".
 *
 * @property integer $positionId
 * @property string $positionName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Position extends \backend\models\hrvc\master\PositionMaster
{
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
