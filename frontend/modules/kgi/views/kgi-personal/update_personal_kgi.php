<?php

use common\models\ModelMaster;
use Faker\Core\Number;
use yii\bootstrap5\ActiveForm;

$this->title = "Update Individual KGI";
$form = ActiveForm::begin([
    'id' => 'update-personal-kgi',
    'method' => 'post',
    'options' => [
        'enctype' => 'multipart/form-data',
    ],
    'action' => Yii::$app->homeUrl . 'kgi/kgi-personal/save-update-personal-kgi'

]);
?>
<div class="col-12">
    <div class="row">
        <div class="col-10">
            <i class="fa fa-list-alt font-size-20" aria-hidden="true"></i>
            <strong class="font-size-20"><?= Yii::t('app', 'Update Individual KGI') ?></strong>
        </div>
        <div class="col-2 text-end">
            <a href="<?= isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Yii::$app->homeUrl . 'kgi/kgi-personal/individual-kgi-grid' ?>"
                class="btn btn-secondary font-size-12">
                <i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
                <?= Yii::t('app', 'Back') ?>
            </a>
        </div>
    </div>
    <div class="row mt-20">
        <div class="offset-lg-3 col-lg-6 col-12">
            <div class="alert mt-10 pim-body bg-white">
                <div class="col-12 mt-10 font-b border-bottom pb-10">
                    KGI : : <?= $kgiEmployeeDetail["kgiName"] ?>

                </div>
                <div class="col-12 mt-10">
                    <label for="" class="form-label font-size-12"></strong><?= Yii::t('app', 'Detail') ?></label>
                    <textarea class="form-control" name="detail" style="height: 100px;"
                        required><?= $kgiEmployeeDetail["detail"] ?></textarea>
                </div>
                <div class="row">
                    <div class="col-6 mt-10">
                        <label for="exampleFormControl" class="form-label font-size-13"><?= Yii::t('app', 'Target') ?></label>
                        <input class="form-control text-end" name="target" type="text"
                            value="<?= number_format($kgiEmployeeDetail['target'], 2) ?>">
                    </div>
                    <div class="col-6 mt-10">
                        <label for="exampleFormControl" class="form-label font-size-13"><?= Yii::t('app', 'Result') ?></label>
                        <input class="form-control text-end" name="result" type="text"
                            value="<?= number_format($kgiEmployeeDetail['result'], 2) ?>">
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong>
                            <?= Yii::t('app', 'Month') ?></label>
                        <select class="form-select font-size-13" required aria-label="Default select example" name="month"
                            id="month-update">
                            <?php
                            if (isset($kgiEmployeeDetail["month"]) && $kgiEmployeeDetail["month"] != '') { ?>
                                <option value="<?= $kgiEmployeeDetail["month"] ?>">
                                    <?= Yii::t('app',  ModelMaster::monthFull()[$kgiEmployeeDetail["month"]]) ?>
                                </option>
                            <?php

                            }
                            ?>
                            <option value=""><?= Yii::t('app', 'Month') ?></option>
                            <?php
                            if (isset($months) && count($months) > 0) {
                                foreach ($months as $value => $month) : ?>
                                    <option value="<?= $value ?>"><?= Yii::t('app', $month) ?></option>
                            <?php
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                        <label class="form-label font-size-12"><strong class="red">*</strong> <?= Yii::t('app', 'Year') ?></label>
                        <select class="form-select font-size-12" required name="year" id="year-update">
                            <?php
                            if (isset($kgiEmployeeDetail["year"]) && $kgiEmployeeDetail["year"] != '') { ?>
                                <option value="<?= $kgiEmployeeDetail["year"] ?>"><?= $kgiEmployeeDetail["year"] ?></option>
                            <?php

                            }
                            ?>
                            <option value=""><?= Yii::t('app', 'Year') ?></option>
                            <?php
                            $year = 2020;
                            $thisYear = date('Y');
                            while ($year < ($thisYear + 10)) { ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php
                                $year++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 mt-10">
                        <label for="exampleFormControl" class="form-label font-size-12"><?= Yii::t('app', 'Next Check Date') ?></label>
                        <?php
                        if ($kgiEmployeeDetail['nextCheckDate'] != null) {
                            $nextCheckDateArr = explode(' ', $kgiEmployeeDetail["nextCheckDate"]);
                            $nextCheckDate = $nextCheckDateArr[0];
                        } else {
                            $nextCheckDate = null;
                        }
                        ?>
                        <input class="form-control text-end font-size-13" name="nextCheckDate" type="date" required
                            value="<?= $nextCheckDate ?>">
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 pt-10">
                        <label for="exampleFormControl" class="form-label font-size-13"><strong class="red">*</strong>
                            <?= Yii::t('app', 'Status') ?></label>
                        <select class="form-select font-size-13" aria-label="Default select example" required name="status">
                            <?php
                            if ($kgiEmployeeDetail['status'] != null) {
                                if ($kgiEmployeeDetail['status'] == 1) { ?>
                                    <option value="1"><?= Yii::t('app', 'Active') ?></option>
                                <?php
                                } else { ?>
                                    <option value="2"><?= Yii::t('app', 'Finished') ?></option>
                            <?php
                                }
                            }
                            ?>
                            <?php
                            if ($kgiEmployeeDetail['status'] == null) {
                            ?>
                                <option value="1"><?= Yii::t('app', 'Active') ?></option>
                                <option value="2"><?= Yii::t('app', 'Finished') ?></option>
                                <?php
                            } else {
                                if ($kgiEmployeeDetail['status'] == 1) { ?>
                                    <option value="2"><?= Yii::t('app', 'Finished') ?></option>
                                <?php
                                } else { ?>
                                    <option value="1"><?= Yii::t('app', 'Active') ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="col-12 mt-15 text-end">
                    <input type="hidden" name="kgiEmployeeId" value="<?= $kgiEmployeeId ?>">
                    <input type="hidden" name="url" value="<?= Yii::$app->request->referrer ?>">
                    <button type="submit" class="btn btn-warning"><?= Yii::t('app', 'Update') ?></button>
                </div>

            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>