<div class="modal fade" id="staticBackdrop1" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="height: 90px;">
                <h5 class="modal-title text-primary" id="staticBackdropLabel" style="margin-top:-20px;">
                    <i class="fa fa-magic" aria-hidden="true"></i> Create KFI
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="margin-top:-20px;"></button>

            </div>
            <div class="col-12 font-size-16 font-b pl-20" style="margin-top:-35px;">
                <i class="fa fa-line-chart" aria-hidden="true"></i> <?= Yii::t('app', 'Key Financial Indicator') ?>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label class="form-label font-size-12"><strong class="red">*</strong>
                                <?= Yii::t('app', 'KFI Contents') ?></label>
                            <input type="text" class="form-control" id="" name="kfiName" required>
                        </div>
                        <div class="col-12 pt-5">
                            <label class="form-label font-size-12"><strong class="red">*</strong>
                                <?= Yii::t('app', 'Company') ?></label>
                            <select class="form-select" name="company" id="companyId"
                                onchange="javascript:companyMultiBrachKfi()" required>
                                <option value=""><?= Yii::t('app', 'Select Company') ?></option>
                                <?php
								if (isset($companies) && count($companies) > 0) {
									foreach ($companies as $company) : ?>
                                <option value="<?= $company["companyId"] ?>"><?= $company["companyName"] ?></option>
                                <?php
									endforeach;
								}
								?>

                            </select>
                        </div>
                        <div class="col-12 mt-10">
                            <label for="input" class="form-label font-size-12"><strong class="red">*</strong>
                                <?= Yii::t('app', 'Branch') ?></label>

                            <div class="col-12 form-control">
                                <?= Yii::t('app', 'Select branch') ?>
                                <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>
                            <div class="col-12" id="show-multi-branch"></div>


                        </div>
                        <div class="col-12 mt-10">
                            <label for="input" class="form-label font-size-12"><strong class="red">*</strong>
                                <?= Yii::t('app', 'Department') ?></label>
                            <div class="col-12 form-control">
                                <?= Yii::t('app', 'Select Department') ?>
                                <i class="fa fa-angle-down pull-right mt-5" aria-hidden="true"></i>
                            </div>
                            <div class="col-12" id="show-multi-department"></div>
                        </div>
                        <div class="col-12 pt-10">
                            <label for="input" class="form-label font-size-12"><strong class="red">*</strong>
                                <?= Yii::t('app', 'Check Unit') ?></label>
                            <div class="btn-group  col-12" role="group" aria-label="Basic outlined example">
                                <?php
								if (isset($units) && count($units) > 0) {
									$i = 1;
									foreach ($units as $unit) :
										$style = "";
										$default = "";
										if ($i == 4) {
											$style = "border-radius:0 5px 5px 0;";
										}
										if ($i == 1) {
											$default = 'btn-primary';
										}
								?>
                                <button type="button" id="unit-<?= $unit['unitId'] ?>"
                                    class="btn border col-3  font-size-12 <?= $default ?>"
                                    onclick="javascript:selectUnit(<?= $unit['unitId'] ?>)" style="<?= $style ?>">
                                    <?= Yii::t('app', $unit["unitName"]) ?>
                                </button>
                                <?php
										$i++;
									endforeach;
								}
								?>

                                <input type="hidden" value="1" id="currentUnit" name="unit" required>
                                <input type="hidden" value="1" id="previousUnit" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-12 mt-10">
                            <div class="input-group">
                                <label for="input" class="form-label font-size-12"><strong class="red">*</strong>
                                    <?= Yii::t('app', 'Next Check Date') ?></label>
                                <div class="input-group">
                                    <span class="input-group-text font-size-12"><i class="fa fa-calendar-o"
                                            aria-hidden="true"></i> &nbsp;&nbsp; <?= Yii::t('app', 'Date') ?></span>
                                    <input type="date" aria-label="" class="form-control font-size-12" required
                                        name="nextCheckDate" id="nextCheckDate-create">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="col-12">
                            <label class="form-label font-size-12"> <?= Yii::t('app', 'KFI Details') ?></label>
                            <textarea class="form-control" name="detail" rows="9"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12 pt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong
                                        class="red">*</strong> <?= Yii::t('app', 'Quant Ratio') ?></label>
                                <select class="form-select font-size-13" id="quantRatio-create" name="quanRatio"
                                    required>
                                    <option value=""><?= Yii::t('app', 'Quantity') ?> <?= Yii::t('app', 'or') ?>
                                        <?= Yii::t('app', 'Quality') ?></option>
                                    <option value="1"><?= Yii::t('app', 'Quantity') ?></option>
                                    <option value="2"><?= Yii::t('app', 'Quality') ?></option>
                                </select>
                                <input type="hidden" name="kfiId" id="kfiId" value="">
                            </div>
                            <div class="col-lg-4 col-md-6 col-6 mt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong
                                        class="red">*</strong> <?= Yii::t('app', 'Amount Type') ?></label>
                                <select class="form-select font-size-12" id="amountType-create" name="amountType"
                                    required>
                                    <option value="">% <?= Yii::t('app', 'or') ?> <?= Yii::t('app', 'Number') ?>
                                    </option>
                                    <option value="1">%</option>
                                    <option value="2"><?= Yii::t('app', 'Number') ?></option>
                                </select>
                            </div>
                            <div class="col-lg-8 col-md-6 col-6   mt-10">
                                <label for="exampleFormControl" class="form-label font-size-13"><strong
                                        class="red">*</strong> <?= Yii::t('app', 'Code') ?></label>
                                <select class="form-select font-size-13" id="code-create" name="code" required>
                                    <option value="">
                                        <&nbsp;&nbsp;=&nbsp;&nbsp;>
                                    </option>
                                    <option value="<">
                                        &nbsp;&nbsp;<?= '<' ?>&nbsp;&nbsp;<?= Yii::t('app', 'Result more than target') ?>
                                    </option>
                                    <option value="=">
                                        &nbsp;&nbsp;=&nbsp;&nbsp;<?= Yii::t('app', 'Result equal target') ?></option>
                                    <option value=">">
                                        &nbsp;&nbsp;>&nbsp;&nbsp;<?= Yii::t('app', 'Result less than target') ?>
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 pt-10">
                                <label class="form-label font-size-12"><strong class="red">*</strong>
                                    <?= Yii::t('app', 'Target Amount') ?></label>
                                <input type="number" class="form-control" name="amount" step="any" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 pt-10">
                                <label class="form-label font-size-12"><strong class="red">*</strong>
                                    <?= Yii::t('app', 'Month') ?></label>
                                <select class="form-select font-size-12" required name="month">
                                    <option value=""><?= Yii::t('app', 'Select Month') ?></option>
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
                                <label class="form-label font-size-12"><strong class="red">*</strong>
                                    <?= Yii::t('app', 'Year') ?></label>
                                <select class="form-select font-size-12" required name="year">
                                    <option value=""><?= Yii::t('app', 'Select Year') ?></option>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><?= Yii::t('app', 'Create') ?></button>
            </div>
        </div>
    </div>
</div>