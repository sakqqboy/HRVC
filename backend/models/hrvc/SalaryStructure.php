<?php

namespace backend\models\hrvc;

use Yii;
use \backend\models\hrvc\master\SalaryStructureMaster;

/**
 * This is the model class for table "salary_structure".
 *
 * @property integer $salaryStructureId
 * @property integer $salaryId
 * @property integer $structureId
 * @property integer $defaultValue
 * @property integer $currencyId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateTime
 */

class SalaryStructure extends \backend\models\hrvc\master\SalaryStructureMaster
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
    public static function salaryStructure($salaryId)
    {
        $salaryStructure = SalaryStructure::find()
            ->select('salary_structure.*,s.structureName,s.structureId')
            ->JOIN("LEFT JOIN", "structure s", "s.structureId=salary_structure.structureId")
            ->where(["salary_structure.salaryId" => $salaryId, "salary_structure.status" => [1]])
            ->asArray()
            ->orderBy('s.type,s.structureName')
            ->all();
        $data = [];
        if (isset($salaryStructure) && count($salaryStructure) > 0) {
            foreach ($salaryStructure as $ss) :
                $data[$ss["salaryStructureId"]] = [
                    "structureName" => $ss["structureName"],
                    "structureId" => $ss["structureId"],
                    "defaultValue" => $ss["defaultValue"],
                ];
            endforeach;
        }
        return $data;
    }
    public static function salaryStructureUpdate($salaryId)
    {
        $salaryStructure = SalaryStructure::find()
            ->select('salary_structure.*,s.structureName,s.structureId')
            ->JOIN("LEFT JOIN", "structure s", "s.structureId=salary_structure.structureId")
            ->where(["salary_structure.salaryId" => $salaryId, "salary_structure.status" => [1]])
            ->asArray()
            ->orderBy('s.type,s.structureName')
            ->all();
        $data = [];
        if (isset($salaryStructure) && count($salaryStructure) > 0) {
            foreach ($salaryStructure as $ss) :
                $data[$ss["structureId"]] = [
                    "structureName" => $ss["structureName"],
                    "defaultValue" => $ss["defaultValue"],
                ];
            endforeach;
        }
        return $data;
    }
}
