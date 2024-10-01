<?php

namespace frontend\modules\kfi\controllers;

use common\models\hrvc\KfiBranch;
use frontend\models\hrvc\Kfi;
use frontend\models\hrvc\KfiDepartment;
use frontend\models\hrvc\KfiEmployee;
use frontend\models\hrvc\KfiHasKgi;
use frontend\models\hrvc\KfiHistory;
use frontend\models\hrvc\KfiIssue;
use frontend\models\hrvc\KfiSolution;
use frontend\models\hrvc\Kgi;
use frontend\models\hrvc\KgiBranch;
use frontend\models\hrvc\KgiDepartment;
use frontend\models\hrvc\KgiEmployee;
use frontend\models\hrvc\KgiEmployeeHistory;
use frontend\models\hrvc\KgiGroup;
use frontend\models\hrvc\KgiHasKpi;
use frontend\models\hrvc\KgiHistory;
use frontend\models\hrvc\KgiIssue;
use frontend\models\hrvc\KgiSolution;
use frontend\models\hrvc\KgiTeam;
use frontend\models\hrvc\KgiTeamHistory;

use frontend\models\hrvc\Kpi;
use frontend\models\hrvc\KpiBranch;
use frontend\models\hrvc\KpiDepartment;
use frontend\models\hrvc\KpiEmployee;
use frontend\models\hrvc\KpiEmployeeHistory;
use frontend\models\hrvc\KpiHistory;
use frontend\models\hrvc\KpiIssue;
use frontend\models\hrvc\KpiSolution;
use frontend\models\hrvc\KpiTeam;
use frontend\models\hrvc\KpiTeamHistory;
use yii\web\Controller;

/**
 * Default controller for the `kfi` module
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
    public function actionClearAll()
    {
        Kfi::deleteAll(1);
        KfiBranch::deleteAll(1);
        KfiDepartment::deleteAll(1);
        KfiEmployee::deleteAll(1);
        KfiHasKgi::deleteAll(1);
        KfiHistory::deleteAll(1);
        KfiIssue::deleteAll(1);
        KfiSolution::deleteAll(1);

        Kgi::deleteAll(1);
        KgiBranch::deleteAll(1);
        KgiHistory::deleteAll(1);
        KgiDepartment::deleteAll(1);
        KgiEmployee::deleteAll(1);
        KgiEmployeeHistory::deleteAll(1);
        KgiGroup::deleteAll(1);
        KgiHasKpi::deleteAll(1);
        KgiIssue::deleteAll(1);
        KgiSolution::deleteAll(1);
        KgiTeam::deleteAll(1);
        KgiTeamHistory::deleteAll(1);

        Kpi::deleteAll(1);
        KpiBranch::deleteAll(1);
        KpiHistory::deleteAll(1);
        KpiDepartment::deleteAll(1);
        KpiEmployee::deleteAll(1);
        KpiEmployeeHistory::deleteAll(1);
        KpiIssue::deleteAll(1);
        KpiSolution::deleteAll(1);
        KpiTeam::deleteAll(1);
        KpiTeamHistory::deleteAll(1);
    }
}
