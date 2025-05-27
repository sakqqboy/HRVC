<?php

namespace common/models\hrvc\master;

use Yii;

/**
* This is the model class for table "gul_sgs_log_events".
*
    * @property integer $id
    * @property integer $visitor_id
    * @property integer $ts
    * @property string $activity
    * @property string $description
    * @property string $ip
    * @property string $hostname
    * @property string $code
    * @property string $object_id
    * @property string $type
    * @property string $action
    * @property string $visitor_type
*/
class GulSgsLogEventsMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'gul_sgs_log_events';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['visitor_id', 'activity', 'description', 'object_id', 'type', 'action', 'visitor_type'], 'required'],
            [['visitor_id', 'ts'], 'integer'],
            [['activity', 'description', 'hostname', 'code', 'object_id', 'type', 'action', 'visitor_type'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 55],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'visitor_id' => 'Visitor ID',
    'ts' => 'Ts',
    'activity' => 'Activity',
    'description' => 'Description',
    'ip' => 'Ip',
    'hostname' => 'Hostname',
    'code' => 'Code',
    'object_id' => 'Object ID',
    'type' => 'Type',
    'action' => 'Action',
    'visitor_type' => 'Visitor Type',
];
}
}
