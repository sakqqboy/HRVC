<?php

use common\models\ModelMaster;

$this->title = 'Create Branch';
?>
<div class="container-body submain-background mid-center">
    <div class="col-12">
        <?= Yii::t('app', 'Create Branch') ?>
    </div>
    <div class="mid-center max-background"
        style="height: 780px;
padding: 30px; gap: 7.721px; flex-shrink: 0;border-radius: 7.721px;background: #F4F6F9;">
        <div class="row all-row">
            <div class="d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg" style="width: 24px; height: 24px;">
                <div class="col-12 branch-title pt-5">
                    Branch
                </div>
            </div>
        </div>
        <div class="col-12 mt-30">
            <div class="alert alert-secondary-branch" role="alert">
                <div class="head-filter-branch">
                    <div class="text-quick-register">
                        <img src="<?= Yii::$app->homeUrl ?>image/icon-quick-registe.svg" style="height: 28px;">
                        Quick Register
                    </div>

                    <input type="hidden" id="branchId" value="">
                    <button class="btn-create-branch" id="create-branch">
                        Create <img src="<?= Yii::$app->homeUrl ?>image/create-plus.svg" style="width: 18px; height: 18px;">
                    </button>
                    <a class="btn btn-sm btn-warning" id="update-branch" style="display:none;">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" id="reset-branch" style="display:none;">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="body-filter-branch">
                    <div class="col-lg-3 col-md-6">
                        <div style="display: flex;
							width: 399px;
							flex-direction: column;
							align-items: flex-start;
							gap: 14px;">
                            <label class="form-label font-size-12 font-b"> <span class="text-danger">* </span>Company
                            </label>
                            <div class="col-12 font-b">
                                <?php
                                if (isset($companyId) && $companyId != '') {
                                ?>
                                    <input type="hidden" id="company" value="<?= $company['companyId'] ?>">
                                    <?= $company['companyName'] ?>
                                <?php
                                } else { ?>
                                    <select class="form-select" id="company">
                                        <option value="">Select Company</option>
                                        <?php
                                        if (isset($companies) && count($companies) > 0) {
                                            foreach ($companies as $c) : ?>
                                                <option value="<?= $c['companyId'] ?>"><?= $c['companyName'] ?></option>
                                        <?php
                                            endforeach;
                                        }
                                        ?>

                                    </select>
                                <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <div style="display: flex;
							width: 309px;
							flex-direction: column;
							align-items: flex-start;
							gap: 14px;">
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            Select Country</label>
                        <input type="text" class="form-control" id="branchName">
                    </div>
                    <div style="display: flex;
							width: 734px;
							flex-direction: column;
							align-items: flex-start;
							gap: 12px;">
                        <label for="exampleFormControlInput1" class="form-label font-size-12 font-b">
                            <span class="text-danger">* </span>
                            Branch Name</label>
                        <input type="text" class="form-control" id="description" placeholder="Write the name of the branch">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>