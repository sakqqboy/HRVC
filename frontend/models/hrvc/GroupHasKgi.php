<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\GroupHasKgiMaster;

/**
 * This is the model class for table "group_has_kgi".
 *
 * @property integer $groupHasKgiId
 * @property integer $kgiGroupId
 * @property integer $kgiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class GroupHasKgi extends \frontend\models\hrvc\master\GroupHasKgiMaster
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
    public static function totalKgi($kgiGroupId)
    {
        $groupHasKgi = GroupHasKgi::find()->where(["kgiGroupId" => $kgiGroupId, "status" => 1])->asArray()->all();
        return count($groupHasKgi);
    }
    public static function IsKgiInGroup($kgiId, $kgiGroupId)
    {
        $groupHasKgi = GroupHasKgi::find()->where(["kgiGroupId" => $kgiGroupId, "kgiId" => $kgiId, "status" => 1])->one();
        if (isset($groupHasKgi) && !empty($groupHasKgi)) {
            return 1;
        } else {
            return 0;
        }
    }
}
