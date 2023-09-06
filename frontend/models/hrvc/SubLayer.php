<?php

namespace frontend\models\hrvc;

use Yii;
use \frontend\models\hrvc\master\SubLayerMaster;

/**
 * This is the model class for table "sub_layer".
 *
 * @property integer $subLayerId
 * @property string $subLayerName
 * @property integer $layerId
 * @property string $shortTag
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */

class SubLayer extends \frontend\models\hrvc\master\SubLayerMaster
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
    public static function subLayerInLayer($layerId)
    {
        $textSub = '';
        $subLayers = SubLayer::find()
            ->select('shortTag')
            ->where(["layerId" => $layerId])
            ->orderBy('shortTag')
            ->asArray()
            ->all();
        if (isset($subLayers) && count($subLayers) > 0) {
            foreach ($subLayers as $sub) :
                $textSub .= $sub["shortTag"] . '<br>';
            endforeach;
        }
        return $textSub;
    }
}
