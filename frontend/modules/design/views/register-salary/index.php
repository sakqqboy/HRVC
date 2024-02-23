<?php

use Faker\Core\Number;

$this->title = 'Salary Register';

?>

<div class="col-12 mt-90 alert alert-updated">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <div class="col-12 updated_registersalary">
                Salary Register
            </div>
        </div>
        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
            <button type="button" class="ADD-register"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/register-add.png" class="picregister-add"> Add</button>
        </div>
        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
            <div class="col-12 updated_evaluationQ">
                Evaluation Q4
            </div>
        </div>
        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
            <div class="col-12">
                <button class="import_updated" type="submit"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/updatedownload.png" class="pic_updateddownload1"> Import</button>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6  col-6">
            <div class="col-12">
                <select class="form-select slec_updated" aria-label="Default select example">
                    <option selected value="">Select menu</option>
                    <option value="1">Human Resource</option>
                    <option value="2">Junior</option>
                    <option value="3">Staff</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <div class="col-12">
                <select class="form-select slec_updated" aria-label="Default select example">
                    <option selected value="">Select menu</option>
                    <option value="1">Human Resource</option>
                    <option value="2">Junior</option>
                    <option value="3">Staff</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <div class="col-12">
                <select class="form-select slec_updated" aria-label="Default select example">
                    <option selected value="">Select menu</option>
                    <option value="1">Human Resource</option>
                    <option value="2">Junior</option>
                    <option value="3">Staff</option>
                </select>
            </div>
        </div>
        <div class="col-lg-1 col-md-6 col-m1-12">
            <div class="col-12">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/24px/FilterPlus.png" class="Dark_filterupdated">
            </div>
        </div>
    </div>
    <div class="col-12 alert background_updateline">
        <div class="col-12 alert gray_update">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-6" style="border:none;">
                    <div class="col-12 card">
                        <div class="update_humanresource">Human Resource</div>
                        <div class="Assiociate_updated">Senior Assiociate</div>
                        <div id="root"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-6" style="border:none;">
                    <div class="col-12 card">
                        <div class="row">
                            <div class="col-6 update1_totaltitle1">
                                Total Title Salary
                            </div>
                            <div class="col-6 text-end update1_totaltitle2">
                                ฿ <?= number_format(849978) ?>
                            </div>
                        </div>
                        <div class="col-12 mt-20">
                            <div class="row">
                                <div class="col-2">
                                    <label for="" class="Mini_updated1">Minimum 0%</label>
                                    <div class="card badgeUp_dateborder" id=""><?= number_format(13291) ?></div>
                                </div>
                                <div class="col-2 ml-7">
                                    <label for="" class="Mini_updated1">Low 25%</label>
                                    <div class="card badgeUp_dateborder" id=""><?= number_format(13291) ?></div>
                                </div>
                                <div class="col-2 ml-7">
                                    <label for="" class="Mini_updated1">Low 25%</label>
                                    <div class="card badgeUp_dateborder" id=""><?= number_format(13291) ?></div>
                                </div>
                                <div class="col-2 ml-7">
                                    <label for="" class="Mini_updated1">Low 25%</label>
                                    <div class="card badgeUp_dateborder" id=""><?= number_format(13291) ?></div>
                                </div>
                                <div class="col-2 ml-7">
                                    <label for="" class="Mini_updated1">Low 25%</label>
                                    <div class="card badgeUp_dateborder" id=""><?= number_format(13291) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6" style="border:none;">
                    <div class="col-12 card">
                        Allowance
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>