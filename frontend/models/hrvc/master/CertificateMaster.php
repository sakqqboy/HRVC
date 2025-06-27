<?php

namespace frontend\models\hrvc\master;

use Yii;

/**
* This is the model class for table "certificate".
*
    * @property integer $cerId
    * @property string $cerName
    * @property integer $userId
    * @property string $issuing
    * @property string $credential
    * @property string $fromCerDate
    * @property string $toCerDate
    * @property integer $noExpiry
    * @property string $cerImage
    * @property string $certificate
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class CertificateMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'certificate';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['cerId'], 'required'],
            [['cerId', 'userId', 'noExpiry'], 'integer'],
            [['cerName', 'issuing', 'credential', 'cerImage', 'certificate'], 'string'],
            [['fromCerDate', 'toCerDate', 'createDateTime', 'updateDateTime'], 'safe'],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'cerId' => 'Cer ID',
    'cerName' => 'Cer Name',
    'userId' => 'User ID',
    'issuing' => 'Issuing',
    'credential' => 'Credential',
    'fromCerDate' => 'From Cer Date',
    'toCerDate' => 'To Cer Date',
    'noExpiry' => 'No Expiry',
    'cerImage' => 'Cer Image',
    'certificate' => 'Certificate',
    'createDateTime' => 'Create Date Time',
    'updateDateTime' => 'Update Date Time',
];
}
}
