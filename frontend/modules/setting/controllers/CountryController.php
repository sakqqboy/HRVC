<?php

namespace frontend\modules\setting\controllers;

use Exception;
use frontend\models\hrvc\Country;
use yii\web\Controller;

/**
 * Default controller for the `setting` module
 */
// header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
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
    public function actionCountryPicture()
    {
        $country = Country::find()->where(["status" => 1])->all();
        if (isset($country) && count($country) > 0) {
            foreach ($country as $c):
                $countryName = $c->countryName;
                $shortname = strtolower(substr($countryName, 0, 2));
                $saveName = 'images/flag/svg/' . $shortname . '.svg';
                $c->flag = $saveName;
                // if ($saveName == '\xEF\xBB.svg') {
                //     throw new Exception($c->countryName);
                // }

                $c->save(false);
            endforeach;
        }
    }
}
