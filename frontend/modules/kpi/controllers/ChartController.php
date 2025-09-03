<?php

namespace frontend\modules\kpi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\components\Api;
use frontend\models\hrvc\UserRole;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `kgi` module
 */
class ChartController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->id == '') {
            Yii::$app->response->redirect(Yii::$app->homeUrl . 'site/login');
            return false;
        }
        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCompanyChart($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kpiId = $param["kpiId"];
        $role = UserRole::userRight();

        $kpiDetail = Api::connectApi(Path::Api() . 'kpi/management/kpi-detail?id=' . $kpiId . '&&kpiHistoryId=0');
        $history = Api::connectApi(Path::Api() . 'kpi/management/kpi-history?kpiId=' . $kpiId);

        $monthDetail = [];
        $summarizeMonth = [];
        $year = 2024;
        $months = ModelMaster::month();
        $monthText = '';
        $target = [];
        $targetText = "";
        $resultText = "";
        $result = [];

        if (isset($history) && count($history) > 0) {
            foreach ($history as $kpiHistoryId => $ht):
                if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
                    $summarizeMonth[$ht["year"]][$ht["month"]] = [
                        "year" => $ht["year"],
                        "month" => ModelMaster::fullMonthText($ht["month"]),
                        "result" => $ht["result"],
                        "target" => $ht["target"],
                        "kpiHistoryId" => $kpiHistoryId
                    ];
                }
            endforeach;
        }

        foreach ($months as $index => $month):
            if (isset($summarizeMonth[$year][$index])) {
                $target[$index] = $summarizeMonth[$year][$index]["target"];
                $result[$index] = $summarizeMonth[$year][$index]["result"];
            } else {
                $target[$index] = 0;
                $result[$index] = 0;
            }
            $targetText .= $target[$index] . ',';
            $resultText .= $result[$index] . ',';
            $monthText .= '"' . $month . '",';
        endforeach;

        $monthText = substr($monthText, 0, -1);
        $targetText = substr($targetText, 0, -1);
        $resultText = substr($resultText, 0, -1);

        return $this->render('company_chart', [
            "role" => $role,
            "kpiDetail" => $kpiDetail,
            "month" => $monthText,
            "target" => $targetText,
            "result" => $resultText
        ]);
    }
}
