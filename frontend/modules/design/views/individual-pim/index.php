<?php

use Faker\Core\Number;
use Faker\Extension\NumberExtension;

$this->title = 'Individual Procress';
?>

<div class="col-12 mt-70 environment pt-10 pr-10 pl-10">
    <div class="bg-white pl-5 pr-5" style="border-radius: 5px;">
        <div class="individual_pim_step1">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="col-12 MY_PIM_PANEL">
                        MY PIM PANEL
                    </div>
                    <hr>
                    <div class="col-12">
                        <select class="form-select pt-5 pb-5" style="border-radius: 30px;font-size:13px;" aria-label="Default select example">
                            <option selected value="">this select</option>
                            <option value="1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Default radio
                                    </label>
                                </div>
                            </option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 border-left">
                    <div class="badge button1_dualpim">
                        <div class="color-004DB0-E2">E2</div>
                        <div class="color-004DB0-none">2022</div>
                    </div>
                    <span class="col-12 text-secondary">
                        Final Evaluation Phase
                    </span>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="col-12">
                        fmgp
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    fgdrtfu
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="individual_pim_step1 pt-10 pb-10">
                    <div class="col-3 badge pim1_formatnumkfi">
                        KFI &nbsp; <span class="text-danger"><?= number_format(60) ?>%</span>
                    </div>

                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                    ?>

                        <table class="table table-white table-striped mt-10">
                            <thead>
                                <tr>
                                    <td scope="col">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/linegroup-4.png" class="pim1-imageslinegroup"> <span class="font-size-11 text-secondary font-b">Sales</span>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <span class="name-priority">Priority</span>
                                        <div class="badge Priority">
                                            <div class="text-dark" style="margin-left:-2px;">A</div>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Target.png" class="individual_PIM_target1"><span class="font-size-10">Target</span>
                                        </div>
                                        <div class="col-12 pim_no">
                                            <?= number_format(15515) ?>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="text-primary font-size-11">Update</div>
                                        <div class="pt-5 font-size-10">Pending</div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/cal.png" class="width-ccal">
                                        </div>
                                        <div class="text-danger font-size-10 text-center pt-3">21-Dec-23</div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                    <?php
                    }
                    ?>

                    <div class="d-grid gap-2 col-6 mx-auto but_showmore">
                        <div class="showmore_pim">Show More <i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="individual_pim_step1 pt-10 pb-10">
                    <div class="col-3 badge pim1_formatnumkfi">
                        KGI &nbsp; <span class="text-danger"><?= number_format(60) ?>%</span>
                    </div>


                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                    ?>

                        <table class="table table-white table-striped mt-10">
                            <thead>
                                <tr>
                                    <td scope="col">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/linegroup-4.png" class="pim1-imageslinegroup"> <span class="font-size-11 text-secondary font-b">Sales</span>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <span class="name-priority">Priority</span>
                                        <div class="badge Priority">
                                            <div class="text-dark" style="margin-left:-2px;">A</div>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Target.png" class="individual_PIM_target1"><span class="font-size-10">Target</span>
                                        </div>
                                        <div class="col-12 pim_no">
                                            <?= number_format(15515) ?>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="text-primary font-size-11">Update</div>
                                        <div class="pt-5 font-size-10">Pending</div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/cal.png" class="width-ccal">
                                        </div>
                                        <div class="text-danger font-size-10 text-center pt-3">21-Dec-23</div>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    <?php
                    }
                    ?>

                    <div class="d-grid gap-2 col-6 mx-auto but_showmore">
                        <div class="showmore_pim">Show More <i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="individual_pim_step1 pt-10 pb-10">
                    <div class="col-3 badge pim1_formatnumkfi">
                        KPI &nbsp; <span class="text-danger"><?= number_format(60) ?>%</span>
                    </div>

                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                    ?>

                        <table class="table table-white table-striped mt-10">
                            <thead>
                                <tr>
                                    <td scope="col">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/linegroup-4.png" class="pim1-imageslinegroup"> <span class="font-size-11 text-secondary font-b">Sales</span>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <span class="name-priority">Priority</span>
                                        <div class="badge Priority">
                                            <div class="text-dark" style="margin-left:-2px;">A</div>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="col-12">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/Target.png" class="individual_PIM_target1"><span class="font-size-10">Target</span>
                                        </div>
                                        <div class="col-12 pim_no">
                                            <?= number_format(15515) ?>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="text-primary font-size-11">Update</div>
                                        <div class="pt-5 font-size-10">Pending</div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <img src="<?= Yii::$app->homeUrl ?>images/icons/Dark/48px/cal.png" class="width-ccal">
                                        </div>
                                        <div class="text-danger font-size-10 text-center pt-3">21-Dec-23</div>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                    <?php
                    }
                    ?>

                    <div class="d-grid gap-2 col-6 mx-auto but_showmore">
                        <div class="showmore_pim">Show More <i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>