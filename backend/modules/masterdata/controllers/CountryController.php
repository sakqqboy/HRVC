<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Country;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
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
        $countries = Country::find()->select('countryId,countryName')->where(["status" => 1])->asArray()->orderBy('countryName')->all();
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
            ->select('countryId,countryName')
            ->where(["countryId" => $id])
            ->asArray()
            ->one();
        return json_encode($country);
    }
}
