<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Country;
use backend\models\hrvc\Currency;
use backend\models\hrvc\Nationality;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class CountryController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionActiveCountry()
    {
        $country = [];
        $countries = Country::find()->select('countryId,countryName,flag')->where(["status" => 1])->asArray()->orderBy('countryName')->all();
        //throw new Exception(print_r($countries, true));
        if (isset($countries) && count($countries) > 0) {
            foreach ($countries as $c) :
                $country[$c["countryId"]] = $c["countryName"];
            endforeach;
        }
        return json_encode($country);
    }
    public function actionCompanyCountry()
    {
        $country = [];
        $countries = Country::find()->select('countryId,countryName,flag')->where(["status" => 1,"hasBranch" => 1])->asArray()->orderBy('countryName')->all();
        //throw new Exception(print_r($countries, true));
        if (isset($countries) && count($countries) > 0) {
            foreach ($countries as $c) :
                $country[$c["countryId"]] = $c["countryName"];
            endforeach;
        }
        return json_encode($country);
    }

    public function actionCountryDetail($id)
    {
        $country = [];
        $country = Country::find()
            ->select('countryId,countryName,flag')
            ->where(["countryId" => $id])
            ->asArray()
            ->one();
        return json_encode($country);
    }
    public function actionNationality()
    {
        $nation = Nationality::find()->select('numCode,nationalityName')->where(1)->asArray()->orderBy('nationalityName')->all();
        return json_encode($nation);
    }
    public function actionAllCurrency()
    {
        $currency = Currency::find()
            ->select('code,symbol,currencyId')
            ->where(["status" => 1])
            ->andWhere('currencyId!=1')
            ->asArray()
            ->orderBy('')
            ->all();
        return json_encode($currency);
    }
}