<?php

use common\models\ModelMaster;

$this->title = 'company';
?>

<div class="contrainer-body">
    <div class="col-lg-8 col-md-3 col-3 d-flex align-items-center gap-2">
        <img src="<?= Yii::$app->homeUrl ?>image/branch-icon-black.svg" style="width: 24px; height: 24px;">
        <div class="col-12 branch-title pt-5">
            Company
        </div>
        <a href="<?= Yii::$app->homeUrl ?>setting/company/create/<?= ModelMaster::encodeParams(['groupId' => $groupId]) ?>"
            class="btn btn-success">
            <i class="fa fa-plus" aria-hidden="true"></i> Add
        </a>
    </div>

    <div class="contrainer-body company-group-edit">

        <div class="col-12 mt-20 tb0">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-border-weight">
                        <th>SL</th>
                        <th>Assiociated Group</th>
                        <th>Company Name</th>
                        <th>Country</th>
                        <th>Industry</th>
                        <th class="long-about">About</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
				if (isset($companies) && count($companies) > 0) {
					$i = 1;
					foreach ($companies as $company) :
						$maxLength = 200;
						$about = substr($company['about'], 0, $maxLength);
				?>
                    <tr class="tr-font" id="company-<?= $company['companyId'] ?>">
                        <td class="text-center"><?= $i ?></td>
                        <td><?= $company['groupName'] ?></td>
                        <td><?php
								if ($company["picture"] != null) { ?>
                            <img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>" class="width-aa">
                            <?php
								} else { ?>
                            <img src="<?= Yii::$app->homeUrl . 'image/userProfile.png' ?>" class="width-aa">
                            <?php
								}
								?>
                            <?= $company['companyName'] ?>
                        </td>
                        <td><img src="<?= Yii::$app->homeUrl ?><?= $company['flag'] ?>" class="bangladresh-hrvc">
                            <?= $company['city'] ?>, <?= $company['countryName'] ?></td>
                        <td><?= $company['industries'] ?></td>
                        <td>
                            <?= $about ?>
                            <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                class="not"> <span class="text-primary">See more</span></a>
                        </td>
                        <td class="text-center">
                            <a href="<?= Yii::$app->homeUrl ?>setting/company/company-view/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                class="btn btn-outline-primary btn-sm Full-icon mt-10 mr-10">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="<?= Yii::$app->homeUrl ?>setting/company/update-company/<?= ModelMaster::encodeParams(['companyId' => $company['companyId']]) ?>"
                                class="btn btn-outline-secondary btn-sm Full-icon mt-10 mr-10">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:deleteCompany(<?= $company['companyId'] ?>)"
                                class="btn btn-outline-danger btn-sm Full-icon mt-10"><i class="fa fa-trash"
                                    aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php
						$i++;
					endforeach;
				}
				?>
                </tbody>
            </table>
        </div>
    </div>
</div>