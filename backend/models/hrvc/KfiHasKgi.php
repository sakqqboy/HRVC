<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\KfiHasKgiMaster;

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

class KfiHasKgi extends \backend\models\hrvc\master\KfiHasKgiMaster
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
    public static function countKgiInkfi($kfiId)
    {
        $kfiHasKgi = KfiHasKgi::find()->where(["kfiId" => $kfiId])->all();
        return count($kfiHasKgi);
    }
    public static function countKfiWithKgi($kgiId)
    {
        $kfiHasKgi = KfiHasKgi::find()
            ->JOIN("LEFT JOIN", "kgi", "kgi.kgiId=kfi_has_kgi.kgiId")
            ->JOIN("LEFT JOIN", "kfi", "kfi.kfiId=kfi_has_kgi.kfiId")
            ->where(["kfi_has_kgi.kgiId" => $kgiId, "kfi.status" => 1, "kgi.status" => 1, "kfi_has_kgi.status" => 1])
            ->all();
        return count($kfiHasKgi);
    }
}
