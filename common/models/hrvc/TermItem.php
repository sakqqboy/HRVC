<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\TermItemMaster;

/**
* This is the model class for table "term_item".
*
* @property integer $termItemId
* @property integer $termId
* @property string $itemName
* @property string $startDate
* @property string $finishDate
* @property integer $status
* @property string $createDateTime
* @property string $updateDateTime
*/

class TermItem extends \common\models\hrvc\master\TermItemMaster{
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
