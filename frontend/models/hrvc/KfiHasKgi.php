<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\KfiHasKgiMaster;

/**
 * This is the model class for table "kfi_has_kgi".
 *
 * @property integer $kfiHasKgiId
 * @property integer $kfiId
 * @property integer $kgiId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class KfiHasKgi extends \frontend\models\hrvc\master\KfiHasKgiMaster
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
    public static function isInthisKfi($kgiId, $kfiId)
    {
        $kfiKgi = KfiHasKgi::find()->where(["kgiId" => $kgiId, "kfiId" => $kfiId, "status" => 1])->one();
        if (isset($kfiKgi)) {
            return 1;
        } else {
            return 0;
        }
    }
}
