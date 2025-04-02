<?php

namespace frontend\modules\fs\controllers;

use common\models\ModelMaster;
use yii\web\Controller;

/**
 * Default controller for the `fs` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCompanyId()
	{
		$companyId=$_POST["companyId"];
		$res["companyId"]=ModelMaster::encodeParams(["companyId"=>$companyId]);
		return json_encode($res);
	}

}