<?php

use Faker\Core\Number;

$this->title = 'Salary Register';

?>

<div class="col-12 mt-90 alert alert-updated">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-6 col-6">
            <div class="col-12 updated_registersalary">
                Salary Registration
            </div>
        </div>
        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
            <button type="button" class="ADD-register pt-4 pb-4" data-bs-toggle="modal" data-bs-target="#salaryRegistration"><img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/register-add.png" class="picregister-add">&nbsp; Add</button>
        </div>
        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
            <div class="col-12 updated_evaluationQ">
                Evaluation Q4
            </div>
        </div>
        <div class="col-lg-1 col-md-6 col-sm-6 col-6">
            <span class="badge import_updated">
                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/updatedownload.png" class="pic_updateddownload1"> Import
            </span>
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
                    <div class="col-12 card pl-10 pr-10 pt-10">
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
                                    <div class="col-2 ml-5">
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
                        <div class="row pl-10 pr-10 pt-10">
                            <div class="col-4 mt-5">
                                <div class="col-12 update1_totaltitle1"> Allowance</div>

                                <?php
                                for ($i = 1; $i <= 2; $i++) {
                                ?>

                                    <div class="col-12 card mt-10 pt-4 pb-4" style="border-radius: 2px;background-color:#F6F6F6;border:none;">
                                        <div class="row pl-6 pr-6">
                                            <div class="col-8 " style="font-size: 7px;">
                                                <i class="fa fa-minus-circle text-danger" aria-hidden="true" style="cursor: pointer;"></i>&nbsp; Foods Allowance
                                            </div>
                                            <div class="col-4 font-b" style="font-size: 7px;">
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
                                    <input type="text" class="form-control pt-4 pb-4 font-size-10" placeholder="Allowance Name" style="border-radius: 3px;">
                                </div>
                                <div class=" col-12">
                                    <?php
                                    for ($i = 1; $i <= 2; $i++) {
                                    ?>

                                        <div class="col-12 card mt-10 pt-4 pb-4" style="border-radius: 2px;background-color:#F6F6F6;border:none;">
                                            <div class="row pl-6 pr-6">
                                                <div class="col-8" style="font-size: 7px;">
                                                    <i class="fa fa-minus-circle text-danger" aria-hidden="true" style="cursor: pointer;"></i>&nbsp; Foods Allowance
                                                </div>
                                                <div class="col-4 font-b" style="font-size: 7px;">
                                                    <?= number_format(256) ?>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" class="form-control pt-4 pb-4 font-size-10" placeholder="Allowance Account" style="border-radius: 3px;">
                                    </div>
                                    <div class="col-4" style="margin-left: -18px;margin-top:-2px;">
                                        <button class="btn btn-primary pt-3 pb-3 font-size-10">Add</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    for ($i = 1; $i <= 2; $i++) {
                                    ?>

                                        <div class="col-12 card mt-10 pt-4 pb-4" style="border-radius: 2px;background-color:#F6F6F6;border:none;">
                                            <div class="row pl-6 pr-6">
                                                <div class="col-8" style="font-size: 7px;">
                                                    <i class="fa fa-minus-circle text-danger" aria-hidden="true" style="cursor: pointer;"></i> &nbsp;Foods Allowance
                                                </div>
                                                <div class="col-4 font-b" style="font-size: 7px;">
                                                    <?= number_format(1560) ?>
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
                    total <span style="color:#9E9E9E;font-size:8px;">/mon</span>
                </div>
                <div class="col-1 registert_1">
                    action &nbsp; <i class="fa fa-pencil-square-o font-size-14" aria-hidden="true" style="cursor: pointer;"></i>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-2 registert_1">
                    name
                </div>
                <div class="col-1 registert_1">
                    basic
                </div>
                <div class="col-1  badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        House RE.. <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        tranpo.. <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        dearne.. <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        medical <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        effort <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        kindne.. <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        extra <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        <i class="fa fa-plus-square-o font-size-13" aria-hidden="true"></i> &nbsp; total
                    </div>
                </div>
                <div class="col-1 badge text-dark" style="background-color: #e1e1e2;border-radius:2px;">
                    <div class="registert_1">
                        action &nbsp; <i class="fa fa-floppy-o font-size-14" aria-hidden="true"></i>
                    </div>
                </div>
            </div> -->
        </div>

        <?php
        for ($i = 1; $i <= 8; $i++) {
        ?>
            <div class="col-12 alert" style="background-color: #F9F9F9;">
                <div class="row">
                    <div class="col-2 border-right">
                        <div class="row">
                            <div class="col-1">
                                <img src="<?= Yii::$app->homeUrl ?>image/man.png" class="brd_usering">
                            </div>
                            <div class="col-9">
                                <span class="text_gray_AC font-b"> Charles Bhattacharjya</span>
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
                        ฿<?= number_format(478447) ?><span style="color:#9E9E9E;font-size:8px;">/Mon</span>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-pencil-square-o font-size-13" aria-hidden="true" style="cursor: pointer;"></i>
                            </div>
                            <div class="col-4">
                                <i class="fa fa-trash-o font-size-13" aria-hidden="true" style="cursor: pointer;"></i>
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
<div class="modal fade" id="salaryRegistration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row pl-20 pr-20 pt-20 pb-20">
                <div class="col-1">
                    <div class="modal-title" id="exampleModalLabel">
                        <img src="<?= Yii::$app->homeUrl ?>image/BD.jpg" class="logo_regis">
                    </div>
                </div>
                <div class="col-7">
                    <div class="col-12 font-size-15 font-b">
                        Tokyo Consulting Firm Limited
                    </div>
                    <div class="col-12 font-size-12 pt-5">
                        <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="Log_name"> Dhaka, Bangladesh
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="col-12">
                        <button type="button" class="btn-close font-size-10" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="col-12 font-size-16 pt-8">
                        Salary Registration
                    </div>
                </div>
                <hr>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="col-12">
                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Team-1.png" style="width: 16px;margin-top: -5px;"> Select Participant
                        </div>
                        <div class="col-12">
                            <div class="card pl-10 pr-10 pt-10 pb-10 mt-15">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="color" class="form-control form-control-colo" id="exampleColorInput" value="#0D99D6" title="Choose your color" style="width: 35px;height:25px;">
                                        </div>
                                        <div class="col-9 font-size-12">
                                            Title
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 pt-10">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="select_ranky"> <span class="font-b font-size-13">Manager</span>
                                </div>
                                <div class="col-12 font-size-11 pt-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="">
                                            <img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="Log_name"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Rank-1.png" class="select_ranky"> <span class="font-b font-size-13">Junior Associate</span>
                                </div>
                                <div class="col-12 font-size-11 pt-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="">
                                            <img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="Log_name"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="">
                                        <label class="form-check-label" for="">
                                            <img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="Log_name"> Charles Bhattacharjya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-5">
                                Salary Breakdown
                            </div>
                            <div class="col-3">
                                <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/currency-gray.png">
                                <span class="text-secondary font-size-12">Currency</span>
                            </div>
                            <div class="col-4">
                                <select class="form-select font-size-12 pt-4 pb-4" aria-label="Default select example" style="border-radius:30px;">
                                    <option selected value="">select</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="card mt-13" style="background-color: #F4F6F9;">
                            <div class="row">
                                <label for="inputBasePay" class="col-sm-2 col-form-label font-size-12">Base Pay <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="inputBasePay" style="border-radius: 3px;">
                                </div>
                            </div>
                            <hr>
                            <div class="row pt-10 pb-10">

                                <label for="input" class="col-sm-2 col-form-label font-size-11">House Rent</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="" style="border-radius: 3px;">
                                </div>

                                <label for="input" class="col-sm-2 col-form-label font-size-12">Medical</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="" style="border-radius: 3px;">
                                </div>

                                <div class="pt-10"></div>

                                <label for="input" class="col-sm-2 col-form-label font-size-12">Trasport</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="" style="border-radius: 3px;">
                                </div>

                                <label for="input" class="col-sm-2 col-form-label font-size-12">Effort</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="" style="border-radius: 3px;">
                                </div>

                                <div class="pt-10"></div>

                                <label for="input" class="col-sm-2 col-form-label font-size-12">Dearness</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="" style="border-radius: 3px;">
                                </div>

                                <label for="input" class="col-sm-2 col-form-label font-size-12">Kindness</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control pt-4 pb-4 font-size-12" id="" style="border-radius: 3px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end pl-10 pr-10 pt-10 pb-10">
                <button type="button" class="btn btn-outline-danger pt-5 pb-5 font-size-13 pr-30 pl-30" style="border-radius: 3px;" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary pt-5 pb-5 font-size-13 pr-30 pl-30" style="border-radius: 3px;">Create</button>
            </div>
        </div>
    </div>
</div>