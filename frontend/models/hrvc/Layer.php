<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\LayerMaster;

/**
 * This is the model class for table "layer".
 *
 * @property integer $layerId
 * @property string $layerName
 * @property integer $priority
 * @property string $shortTag
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class Layer extends \frontend\models\hrvc\master\LayerMaster
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
    public static function layerName($layerId)
    {
        $layer = Layer::find()->where(["layerId" => $layerId])->asArray()->one();
        return $layer["layerName"];
    }

    public static function shortName($layerId)
    {
        $layer = Layer::find()->where(["layerId" => $layerId])->asArray()->one();
        return $layer["shortTag"];
    }
    public static function  titileInLayer($layerId, $departmentId)
    {
        $titles = Title::find()
            ->where(["status" => 1, "layerId" => $layerId, "departmentId" => $departmentId])
            ->asArray()
            ->orderBy("titleId")
            ->all();
        $textTitle = "";
        if (isset($titles) && count($titles) > 0) {
            foreach ($titles as $title) :
                $textTitle .= "<div class='col-12 mt-10 pr-0'> -" . $title['titleName'] . "</div>";
            endforeach;
        }
        return $textTitle;
    }
    public static function layerId($layerName)
    {
        $layer = Layer::find()->select('layerId')->where(["layerName" => $layerName, "status" => 1])->asArray()->one();
        if (isset($layer) && !empty($layer)) {
            return $layer["layerId"];
        } else {
            return "";
        }
    }
}
