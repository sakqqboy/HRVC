<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\UnitMaster;

/**
 * This is the model class for table "unit".
 *
 * @property integer $unitId
 * @property string $unitName
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Unit extends \backend\models\hrvc\master\UnitMaster
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
    public static function unitName($unitId)
    {
        $unitName = '';
        $unit = Unit::find()->select('unitName')->where(["unitId" => $unitId])->asArray()->one();
        if (isset($unit) && !empty($unit)) {
            $unitName = $unit["unitName"];
        }
        return $unitName;
    }
}
