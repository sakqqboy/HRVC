<?php

namespace common\models\hrvc;

use Yii;
use \common\models\hrvc\master\CertificateMaster;

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

class Certificate extends \common\models\hrvc\master\CertificateMaster{
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
