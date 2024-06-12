<?php

namespace frontend\models\hrvc\master;

use Yii;

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
    * @property string $updateDateTime
*/
class RankMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'rank';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['rankName', 'termId'], 'required'],
            [['termId'], 'integer'],
            [['max', 'min', 'increasement', 'bonusRate'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['rankName'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'rankId' => 'Rank ID',
    'rankName' => 'Rank Name',
    'termId' => 'Term ID',
    'max' => 'Max',
    'min' => 'Min',
    'increasement' => 'Increasement',
    'bonusRate' => 'Bonus Rate',
    'status' => 'Status',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
