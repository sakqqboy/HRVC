<?php

namespace frontend\modules\kgi\controllers;

use common\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\KpiEmployeeHistory;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $kpiEmployee = KpiEmployee::find()->where(["month" => '03', "year" => '2026'])->all();
        if (isset($kpiEmployee) && count($kpiEmployee) > 0) {
            foreach ($kpiEmployee as $kpi):
                $kpiEmployeeHistories = KpiEmployeeHistory::find()->where(["kpiEmployeeId" => $kpi->kpiEmployeeId])
                    ->andWhere("status!=2 and status!=99")
                    ->all();
                if (isset($kpiEmployeeHistories) && count($kpiEmployeeHistories) > 0) {
                    foreach ($kpiEmployeeHistories as $kph):
                        $kph->target = $kpi->target;
                        $kph->status = 1;
                        $kph->save(false);
                    endforeach;
                }
            endforeach;
        }
        $kgiEmployee = KgiEmployee::find()->where(["month" => '03', "year" => '2026'])->all();
        if (isset($kgiEmployee) && count($kgiEmployee) > 0) {
            foreach ($kgiEmployee as $kgi):
                $kgiEmployeeHistories = KgiEmployeeHistory::find()->where(["kgiEmployeeId" => $kgi->kgiEmployeeId])
                    ->andWhere("status!=2 and status!=99")
                    ->all();
                if (isset($kgiEmployeeHistories) && count($kgiEmployeeHistories) > 0) {
                    foreach ($kgiEmployeeHistories as $kph):
                        $kph->target = $kgi->target;
                        $kph->status = 1;
                        $kph->save(false);
                    endforeach;
                }
            endforeach;
        }
    }
}
