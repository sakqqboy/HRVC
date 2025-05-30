<?php
if (isset($history) && count($history)) {
    $i = 1;
    $total = count($history);
    foreach ($history as $historyId => $his) :
?>
        <div class="alert alert-light alertlight-Backdrop3">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="row">
                        <div class="col-2">
                            <span class="badge rounded-pill <?= $his["status"] == 1 ? 'bg-primary' : 'bg-success' ?>"> ✓</span>

                        </div>
                        <div class="col-10">
                            <?= $his["title"] ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="col-12 text-secondary font-size-12">
                        <i class="fa fa-user" aria-hidden="true"></i> <?= $his["creater"] ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row">
                        <div class="col-12 PM">
                            <?= $his["createDate"] ?>, <?= $his["time"] ?>
                            <div class="col-12 New mt-5">
                                <?= Yii::t('app', 'New Result') ?> : <strong> <?= number_format($his["result"]) ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($i < $total) {
        ?>
            <div class="col-12">
                <div class="successbackdrop4"></div>
            </div>
<?php
        }
        $i++;
    endforeach;
}
?>