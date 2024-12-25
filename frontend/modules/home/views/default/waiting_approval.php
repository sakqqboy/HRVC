<?php

use common\models\ModelMaster;

if (isset($pendingApprove) && count($pendingApprove) > 0) { ?>
    <ul class="list-unstyled small">
        <?php

        foreach ($pendingApprove as $type => $PIM):
            if (count($PIM) > 0) {
                foreach ($PIM as $data):
                    if ($type == "kgiEmployee") {
                        $text = "Self KGI";
                        $name = $data["kgiName"];
                        $link = "kgi/management/wait-approve-kgi-personal";
                        $linkView = "kgi/kgi-personal/kgi-employee-history/" . ModelMaster::encodeParams([
                            'kgiId' => $data['kgiId'],
                            'kgiEmployeeHistoryId' => $data["kgiEmployeeHistoryId"],
                            'kgiEmployeeId' => $data["kgiEmployeeId"],
                            'openTab' => 1
                        ]);
                    }
                    if ($type == "kgiTeam") {
                        $text = "Team KGI";
                        $name = $data["kgiName"];
                        $link = "kgi/management/wait-approve";
                        $linkView = "kgi/kgi-team/kgi-team-history/" . ModelMaster::encodeParams([
                            'kgiId' => $data['kgiId'],
                            'kgiTeamHistoryId' => $data["kgiTeamHistoryId"],
                            'kgiTeamId' => $data["kgiTeamId"],
                            'openTab' => 1
                        ]);
                    }
                    if ($type == "kpiEmployee") {
                        $text = "Self KPI";
                        $name = $data["kpiName"];
                        $link = "kpi/management/wait-approve-kpi-personal";
                        $linkView = "kpi/kpi-personal/kpi-employee-history/" . ModelMaster::encodeParams([
                            'kpiId' => $data['kpiId'],
                            'kpiEmployeeHistoryId' => $data["kpiEmployeeHistoryId"],
                            'kpiEmployeeId' => $data["kpiEmployeeId"],
                            'openTab' => 1
                        ]);
                    }
                    if ($type == "kpiTeam") {
                        $text = "Team KPI";
                        $name = $data["kpiName"];
                        $link = "kpi/management/wait-approve";
                        $linkView = "kpi/kpi-team/kpi-team-history/" . ModelMaster::encodeParams([
                            'kpiId' => $data['kpiId'],
                            'kpiTeamHistoryId' => $data["kpiTeamHistoryId"],
                            'kpiTeamId' => $data["kpiTeamId"],
                            'openTab' => 1
                        ]);
                    }
                    if ($data["createrId"] == Yii::$app->user->id) {
        ?>
                        <a href="<?= Yii::$app->homeUrl ?><?= $linkView ?>" style="text-decoration: none;" class="text-dark">
                            <li class="schedule-item mt-5">
                                <strong><?= $data["name"] ?></strong> - <?= $data["employee"] ?><br>
                                <span class="text-muted">Pending since <?= $data["updateDateTime"] ?></span><br>
                                <span class="font-size-12"><strong><?= $text ?> : </strong><?= $name ?></span>
                            </li>
                        </a>

                    <?php
                    } else {
                    ?>
                        <a href="<?= Yii::$app->homeUrl ?><?= $link ?>" style="text-decoration: none;" class="text-dark">
                            <li class="schedule-item mt-5">
                                <strong><?= $data["name"] ?></strong> - <?= $data["employee"] ?><br>
                                <span class="text-muted">Pending since <?= $data["updateDateTime"] ?></span><br>
                                <span class="font-size-12"><strong><?= $text ?> : </strong><?= $name ?></span>
                            </li>
                        </a>

        <?php
                    }
                endforeach;
            }
        endforeach;
        ?>
    </ul>
<?php
} else { ?>
    <li class="schedule-item mt-5">
        <strong>There is no data.</strong>
    </li>
<?php
}
?>

<!-- <li class="schedule-item mt-5">
    <strong>Leave Request</strong> - Employee ID #12<br>
    <span class="text-muted">Pending since 29/11/2024</span>
</li>
<li class="schedule-item mt-5">
    <strong>Budget Approval</strong> - Marketing Campaign<br>
    <span class="text-muted">Pending since 25/11/2024</span>
</li>
<li class="schedule-item mt-5">
    <strong>Update KPI</strong> - Non-Japanese Client<br>
    <span class="text-muted">10:00 AM, 01/12/2024</span>
</li>
<li class="schedule-item mt-5">
    <strong>Submit Report</strong> - Team Performance<br>
    <span class="text-muted">2:00 PM, 01/12/2024</span>
</li>
<li class="schedule-item mt-5">
    <strong>Update KPI</strong> - Non-Japanese Client<br>
    <span class="text-muted">10:00 AM, 01/12/2024</span>
</li>
<li class="schedule-item mt-5">
    <strong>Submit Report</strong> - Team Performance<br>
    <span class="text-muted">2:00 PM, 01/12/2024</span>
</li> -->