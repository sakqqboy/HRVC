<?php

use common\models\ModelMaster;

$this->title = 'Team';
$page = "grid";
// echo $data;
?>
<div class="contrainer-body mt-10">

    <div class="between-center mt-20" style="width: 100%;">
        <div class="col-8">
            <div class=" d-flex align-items-center gap-2">
                <img src="<?= Yii::$app->homeUrl ?>image/departments-black.svg" style="width: 24px; height: 24px;">
                <div class="pim-name-title ml-10">
                    <?= Yii::t('app', 'Teams') ?>
                </div>
                <a href="<?= Yii::$app->homeUrl ?>setting/team/create/<?= ModelMaster::encodeParams(["companyId" => '' , "branchId" => '', "departmentId" => '' ]) ?>"
                    style="text-decoration: none;">
                    <button type="button" class="btn-create" style="padding: 3px 9px;"
                        action="<?= Yii::$app->homeUrl ?>setting/branch/create-branch"><?= Yii::t('app', 'Create New') ?>
                        <img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/plus.svg"
                            style="width:18px; height:18px; margin-top:-3px;">
                    </button>
                </a>
            </div>
        </div>
        <div class="col-4" style="text-align: right;">
            <!-- filter -->

        </div>
    </div>

    <div class="pim-body company-group-edit bg-white mt-10">
        <div class="alert alert-branch-body" role="alert">
            <div class="row">

                <!-- endforeach -->
            </div>
        </div>

        <!-- pagination_page -->

    </div>
</div>

<div class="modal fade" id="departmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row" id="departmentModalBody" style="width: 100%; padding: 50px; gap: 30px;">
                <!-- AJAX content will be injected here -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="departmentDeleteModal" tabindex="-2" aria-labelledby="departmentDeleteModal"
    aria-hidden="true">
</div>