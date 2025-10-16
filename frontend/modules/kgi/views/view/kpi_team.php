<td colspan="8">
    <div class="row">
        <?php
        if (isset($kpiTeams) && count($kpiTeams) > 0) {
            foreach ($kpiTeams as $kpiTeam):
        ?>
                <div class="col-lg-4 col-md-3 col-sm-6 col-12   p-2">
                    <div class="col-12 pt-5 pb-5 pim-info">
                        <div class="row" style="--bs-gutter-x:0px;">
                            <div class="col-8 border-right">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg"
                                        class="pim-icon mr-3" style="margin-top:-4px;">
                                    <span class="font-size-12 font-b"><?= $kpiTeam["teamName"] ?></span>
                                    <div class="row mt-5" style="--bs-gutter-x:0px;">
                                        <div class="col-8 pim-subheader-font" style="font-size: 12px;"><?= $kpiTeam["departmentName"] ?></div>
                                        <div class="col-4 text-end pim-subheader-font pr-5" style="font-size: 12px;">Target</div>
                                    </div>

                                </div>
                                <div class="col-12 mt-5 pr-0">
                                    <div class="row" style="--bs-gutter-x:0px;">
                                        <div class="col-8">
                                            <div class="row" style="--bs-gutter-x:0px;">
                                                <div class="col-2 <?= $kpiTeam["countTeamEmployee"] == 0 ? 'd-none' : '' ?>">
                                                    <?php
                                                    if (isset($kpiTeam['kpiEmployeeSelect'][0])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpiTeam['kpiEmployeeSelect'][0] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0 <?= $kpiTeam["countTeamEmployee"] < 2 ? 'd-none' : '' ?>">
                                                    <?php
                                                    if (isset($kpiTeam['kpiEmployeeSelect'][1])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpiTeam['kpiEmployeeSelect'][1] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0 <?= $kpiTeam["countTeamEmployee"] < 3 ? 'd-none' : '' ?>">
                                                    <?php
                                                    if (isset($kpiTeam['kpiEmployeeSelect'][2])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpiTeam['kpiEmployeeSelect'][2] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-5 number-tag load-info pr-0 pl-0 pt-1"
                                                    style="margin-left:  <?= $kpiTeam['countTeamEmployee'] > 0 ? '-10px' : '5px' ?>;height:24px;width:24px;border-radius:100%;">
                                                    <?= $kpiTeam["countTeamEmployee"] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end font-b font-size-10 pt-8 pr-5">
                                            <?= $kpiTeam["target"] == '' ? '0.00' : $kpiTeam["target"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 align-content-center">
                                <div role="progressbar_step_Blue" aria-valuenow="<?= $kpiTeam["ratio"] ?>" aria-valuemin="0"
                                    aria-valuemax="100" style="--value:<?= (int)$kpiTeam["ratio"] ?>;margin-top:-3px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            endforeach;
        }
        ?>
    </div>
</td>