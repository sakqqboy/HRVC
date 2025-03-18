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
    public function actionDeleteOldPim()
    {
        KgiTeam::deleteAll("status=99 or year=2024");
        KgiHistory::deleteAll("status=99 or year=2024");
        KgiTeamHistory::deleteAll("status=99 or year=2024");
        KgiEmployee::deleteAll("status=99 or year=2024");
        KgiEmployeeHistory::deleteAll("status=99 or year=2024");
        KpiTeam::deleteAll("status=99 or year=2024");
        KpiHistory::deleteAll("status=99 or year=2024");
        KpiTeamHistory::deleteAll("status=99 or year=2024");
        KpiEmployee::deleteAll("status=99 or year=2024");
        KpiEmployeeHistory::deleteAll("status=99 or year=2024");

        Kfi::deleteAll("status=99");
        KfiHistory::deleteAll("status=99");
        KfiBranch::deleteAll("status=99");
        KfiDepartment::deleteAll("status=99");
        KfiEmployee::deleteAll("status=99");
        KfiHasKgi::deleteAll("status=99");
        KfiIssue::deleteAll("status=99");
        KfiSolution::deleteAll("status=99");




        Kgi::deleteAll("status=99");
        KgiHistory::deleteAll("status=99");
        KgiBranch::deleteAll("status=99");
        KgiDepartment::deleteAll("status=99");
        KgiEmployee::deleteAll("status=99");
        KgiEmployeeHistory::deleteAll("status=99");
        KgiGroup::deleteAll("status=99");
        KgiHasKpi::deleteAll("status=99");
        KgiIssue::deleteAll("status=99");
        KgiSolution::deleteAll("status=99");
        KgiTeam::deleteAll("status=99");
        KgiTeamHistory::deleteAll("status=99");


        Kpi::deleteAll("status=99");
        KpiHistory::deleteAll("status=99");
        KpiBranch::deleteAll("status=99");
        KpiDepartment::deleteAll("status=99");
        KpiEmployee::deleteAll("status=99");
        KpiEmployeeHistory::deleteAll("status=99");
        KpiIssue::deleteAll("status=99");
        KpiSolution::deleteAll("status=99");
        KpiTeam::deleteAll("status=99");
        KgiTeamHistory::deleteAll("status=99");


        KgiTeam::deleteAll("status=88");
        KgiTeamHistory::deleteAll("status=88");
        KgiEmployee::deleteAll("status=88");
        KgiEmployeeHistory::deleteAll("status=88");
        KpiTeam::deleteAll("status=88");
        KpiTeamHistory::deleteAll("status=88");
        KpiEmployee::deleteAll("status=88");
        KpiEmployeeHistory::deleteAll("status=88");
    }
}
