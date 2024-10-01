<?php

namespace frontend\modules\kgi\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use frontend\models\hrvc\UserRole;
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
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCompanyChart($hash)
    {
        $param = ModelMaster::decodeParams($hash);
        $kgiId = $param["kgiId"];
        $role = UserRole::userRight();
        $api = curl_init();
        curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-detail?id=' . $kgiId);
        $kgiDetail = curl_exec($api);
        $kgiDetail = json_decode($kgiDetail, true);

        curl_setopt($api, CURLOPT_URL, Path::Api() . 'kgi/management/kgi-history?kgiId=' . $kgiId);
        $history = curl_exec($api);
        $history = json_decode($history, true);

        curl_close($api);
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
            foreach ($history as $kgiHistoryId => $ht):
                if (!isset($summarizeMonth[$ht["year"]][$ht["month"]])) {
                    $summarizeMonth[$ht["year"]][$ht["month"]] = [
                        "year" => $ht["year"],
                        "month" => ModelMaster::fullMonthText($ht["month"]),
                        "result" => $ht["result"],
                        "target" => $ht["target"],
                        "kgiHistoryId" => $kgiHistoryId
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
            "kgiDetail" => $kgiDetail,
            "month" => $monthText,
            "target" => $targetText,
            "result" => $resultText
        ]);
    }
}
