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
            <button type="button" class="ADD-register"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/register-add.png" class="picregister-add">
                Add</button>
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
                    <div class="col-12 card pl-10 pr-10 pt-5 pb-10">
                        <div class="update_humanresource">Human Resource</div>
                        <div class="Assiociate_updated">Senior Assiociate</div>
                        <div class="row mt-30">
                            <div class="col-8">
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-4 font-size-10"><span class="font-b">9</span>/15</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-6" style="border:none;">
                    <div class="col-12 card">
                        <div class="row pl-10 pr-10 pt-10 pb-10">
                            <div class="col-6 update1_totaltitle1">
                                Total Title Salary
                            </div>
                            <div class="col-6 text-end update1_totaltitle2 pr-10">
                                ฿ <?= number_format(849978) ?>
                            </div>
                        </div>
                        <div class="col-12 pt-5 pb-10">
                            <div class="row">

                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                ?>
                                    <div class="col-2 ml-7">
                                        <label for="" class="Mini_updated1"> Minimum <span class="text-primary"> 0%</span></label>
                                        <div class="card badgeUp_dateborder" id=""><?= number_format(13291) ?></div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-12 Minimum_dash"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6" style="border:none;">
                    <div class="col-12 card">
                        <div class="row">
                            <div class="col-4 mt-20">
                                <div class="col-12 update1_totaltitle1"> Allowance</div>

                                <?php
                                for ($i = 1; $i <= 2; $i++) {
                                ?>

                                    <div class="col-12 card mt-10 pt-2 pb-2" style="border-radius: 2px;background-color:#F6F6F6;border:none;">
                                        <div class="row pl-6 pr-6">
                                            <div class="col-8 font-size-10">
                                                <i class="fa fa-minus-circle text-danger" aria-hidden="true"></i> Foods Allowance
                                            </div>
                                            <div class="col-4 font-b" style="font-size: 9px;">
                                                <?= number_format(2564) ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                            <div class="col-4">
                                <div class="col-12">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" placeholder="Allowance Name" disabled>
                                </div>
                                <div class="col-12 mt-20">
                                    <?php
                                    for ($i = 1; $i <= 2; $i++) {
                                    ?>

                                        <div class="col-12 card mt-10 pt-2 pb-2" style="border-radius: 2px;background-color:#F6F6F6;border:none;">
                                            <div class="row pl-6 pr-6">
                                                <div class="col-8 font-size-10">
                                                    <i class="fa fa-minus-circle text-danger" aria-hidden="true"></i> Foods Allowance
                                                </div>
                                                <div class="col-4 font-b" style="font-size: 9px;">
                                                    <?= number_format(256) ?>
                                                </div>
                                            </div>
                                        </div>
                                        33333333333333333333333333
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" class="form-control pt-4 pb-4 font-size-12" placeholder="Allowance Account" disabled>
                                    </div>
                                    <div class="col-4" style="margin-left: -8px;">
                                        <button class="btn btn-primary pt-4 pb-4 font-size-12">Add</button>
                                    </div>
                                </div>
                                <div class="col-12 mt-20">
                                    <?php
                                    for ($i = 1; $i <= 2; $i++) {
                                    ?>

                                        <div class="col-12 card mt-10 pt-2 pb-2" style="border-radius: 2px;background-color:#F6F6F6;border:none;">
                                            <div class="row pl-6 pr-6">
                                                <div class="col-8 font-size-10">
                                                    <i class="fa fa-minus-circle text-danger" aria-hidden="true"></i> Foods Allowance
                                                </div>
                                                <div class="col-4  font-b" style="font-size: 9px;">
                                                    <?= number_format(15600) ?>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 alert gray_update">
            <div class="row">
                <div class="col-2 registert_1">
                    employees
                </div>
                <div class="col-1 registert_1">
                    basic
                </div>
                <div class="col-1 registert_1">
                    house rent
                </div>
                <div class="col-1 registert_1">
                    tranport
                </div>
                <div class="col-1 registert_1">
                    dearness
                </div>
                <div class="col-1 registert_1">
                    medical
                </div>
                <div class="col-1 registert_1">
                    effort
                </div>
                <div class="col-1 registert_1">
                    kindness
                </div>
                <div class="col-1 registert_1">
                    extra
                </div>
                <div class="col-1 registert_1 rtext-socndary">
                    total <span style="color:#9E9E9E;">/mon</span>
                </div>
                <div class="col-1 registert_1">
                    action &nbsp; <i class="fa fa-pencil-square-o font-size-18" aria-hidden="true" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>
        <?php
        for ($i = 1; $i <= 8; $i++) {
        ?>
            <div class="col-12 alert" style="background-color: #F9F9F9;">
                <div class="row">
                    <div class="col-2 border-right">
                        <div class="row">
                            <div class="col-2">
                                <img src="<?= Yii::$app->homeUrl ?>image/user.png" class="brd_usering">
                            </div>
                            <div class="col-8 ml-10">
                                <span class="font-size-11"> Charles Bhattacharjya</span>
                                <div class="text_gray_AC"> Accounts & Taxation</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(4556265) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(251143) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(2514) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(1500) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(15000) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(1500154) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(254461) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right">
                        <?= number_format(25665) ?>
                    </div>
                    <div class="col-1 font-size-10 border-right font-b">
                        ฿<?= number_format(478447) ?><span style="color:#9E9E9E;">/Mon</span>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-pencil-square-o font-size-16" aria-hidden="true" style="cursor: pointer;"></i>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-trash-o font-size-16" aria-hidden="true" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>


<!-- Modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#salaryRegistration">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="salaryRegistration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row pl-20 pr-20 pt-">dfjdhf
                <div class="col-2">
                    <div class="modal-title" id="exampleModalLabel">
                        <img src="<?= Yii::$app->homeUrl ?>image/Roof.png" class="logo_regis">
                    </div>
                </div>
                <div class="col-8 font-size-13">
                    Tokyo Consulting Firm Limited
                </div>
                <div class="col-2 text-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>