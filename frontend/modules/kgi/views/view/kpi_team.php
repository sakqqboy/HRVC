<td colspan="8">
    <div class="row">
        <?php
        if (isset($kpiTeams) && count($kpiTeams) > 0) {
            foreach ($kpiTeams as $kpiTeam):
        ?>
                <div class="col-lg-4 col-md-3 col-sm-6 col-12   p-2">
                    <div class="col-12 pt-5 pb-5 pim-info">
                        <div class="row">
                            <div class="col-8 border-right">
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/team-blue.svg"
                                        class="pim-icon mr-3" style="margin-top:-4px;">
                                    <span class="font-size-12 font-b"><?= $kpiTeam["teamName"] ?></span>
                                    <div class="col-12 pim-subheader-font"><?= $kpiTeam["departmentName"] ?></div>
                                </div>
                                <div class="col-12 mt-10">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-2">
                                                    <?php
                                                    if (isset($kpiTeam['kpiEmployeeSelect'][0])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpiTeam['kpiEmployeeSelect'][0] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0">
                                                    <?php
                                                    if (isset($kpiTeam['kpiEmployeeSelect'][1])) {
                                                    ?>
                                                        <img src="<?= Yii::$app->homeUrl . $kpiTeam['kpiEmployeeSelect'][1] ?>"
                                                            class="pim-pic-grid">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-2 pic-after pt-0">
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
                                                    style="margin-left: -3px;height:24px;width:24px;border-radius:100%;">
                                                    <?= $kpiTeam["countTeamEmployee"] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end font-b font-size-10 pt-8">
                                            <?= $kpiTeam["target"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col-12 mt-5">
                                    <div role="progressbar_step_Blue" aria-valuenow="<?= $kpiTeam["ratio"] ?>" aria-valuemin="0"
                                        aria-valuemax="100" style="--value:<?= (int)$kpiTeam["ratio"] ?>;margin-top:-3px;">
                                    </div>
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