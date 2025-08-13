<div class="col-lg-6">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-3  sub-tab-active pl-5">
                <?= Yii::t('app', 'Update History') ?>
            </div>
            <div class="col-9  sub-tab">
            </div>
        </div>
        <div class="col-12 mt-15 pt-0 alert" style="height:500px;overflow-y: auto;">
            <div class="row">
                <div class="col-12">
                    <?php

                    use common\models\ModelMaster;

                    if (isset($monthDetail) && count($monthDetail) > 0) {
                        $i = 0;
                        foreach ($monthDetail as $year => $mDetail):

                            foreach ($mDetail as $month => $detail):
                    ?>
                    <div class="col-12 font-blue font-size-12 <?= $i > 0 ? 'mt-10' : '' ?>">
                        <?= ModelMaster::monthEng($month, 1) . ' ' . $year  ?></div>
                    <?php
                                if (count($detail) > 0) {
                                    $j = 0;
                                    foreach ($detail as $info):
                                ?>
                    <div class="col-12 small-content bg-white pl-10 <?= $j > 0 ? 'mt-10' : '' ?>">
                        <div class="row">
                            <div class="col-4">
                                <div class="col-12 font-size-12 pl-0 pt-3 font-b">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/check-black.svg"
                                        class="pim-icon mr-3" style="margin-top: -3px;">
                                    <?php
                                                        if ($info["status"] == 1) {
                                                            $statusText = "In-Process";
                                                        } else {
                                                            $statusText = "Completed";
                                                        }
                                                        ?>
                                    <span><?= Yii::t('app', $statusText) ?></span>
                                </div>
                                <div class="col-12 pim-employee-title" style="font-size: 10px !important;">
                                    <?= $info["createDateTime"] ?>
                                </div>
                            </div>
                            <div class="col-4 font-size-12 pt-10 pl-0 text-center">
                                <img src="<?= Yii::$app->homeUrl ?><?= $info['picture'] ?>" class="pim-pic-grid mr-5">
                                <?= $info["creater"] ?>
                            </div>
                            <div class="col-4 pr-20">
                                <div class="col-12 font-b font-size-12 text-end">
                                    <?= number_format($info["result"] ?? 0, 2) ?>
                                </div>
                                <div class="col-12 pim-employee-title text-end" style="font-size: 10px !important;">
                                    <?= Yii::t('app', 'Updated Result') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                                        $j++;
                                    endforeach;
                                }
                                $i++;
                            endforeach;
                        endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="col-12 ligth-gray-box">
        <div class="row pl-15 pr-20">
            <div class="col-4  sub-tab-active pl-5">
                <?= Yii::t('app', 'Monthly Achievements') ?>
            </div>
            <div class="col-8  sub-tab">
            </div>
        </div>
        <div class="col-12 alert  mt-15 pt-0" style="height:500px;overflow-y: auto;">
            <div class="col-12 font-size-12">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4 text-center font-b"><?= Yii::t('app', 'Target') ?> / <span
                            class="font-blue"><?= Yii::t('app', 'Result') ?></span></div>
                </div>

            </div>
            <div class="row">
                <?php
                $i = 0;
                if (isset($summarizeMonth) && count($summarizeMonth) > 0) {
                    foreach ($summarizeMonth as $year => $months):
                        foreach ($months as $month => $detail):
                ?>
                <div class="col-12 small-content bg-white  <?= $i > 0 ? 'mt-10' : '' ?> pt-8 pb-8">
                    <div class="row">
                        <div class="col-8 font-size-12 font-b pl-10">
                            <?= $detail["month"] ?> <?= $detail["year"] ?>
                        </div>
                        <div class="col-4 font-size-12 text-center">
                            <?= number_format($detail["target"], 2) ?> /
                            <span class="font-blue"><?= number_format($detail["result"], 2) ?></span>
                        </div>
                    </div>
                </div>
                <?php
                            $i++;
                        endforeach;

                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</div>