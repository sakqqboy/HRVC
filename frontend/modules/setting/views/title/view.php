<?php

use common\models\ModelMaster;
use frontend\models\hrvc\Branch;
use frontend\models\hrvc\Company;
use frontend\models\hrvc\Department;
use frontend\models\hrvc\Layer;

$this->title = $title["titleName"];
?>
<div class="col-12 department-one  mb-20" style="margin-top: 90px;">
	<div class="col-12">
		<div class="row">
			<div class="col-10 branch-title">
				<a href="<?= Yii::$app->homeUrl ?>setting/title/index" class="btn btn-sm btn-outline-primary font-size-18 mr-10" style="margin-top: -10px;">
					<i class="fa fa-angle-left ml-10 mr-10" aria-hidden="true"></i>
				</a>
				<?= $title['titleName'] ?>
				<?php
				if ($title["shortTag"] != '') { ?>
					<span class="badge rounded-pill bg-primary font-size-18 ml-20" style="position: absolute;margin-top:10px;">
						<?= $title["shortTag"] ?>
					</span>
				<?php
				}
				?>
				<?= $title["shortTag"] == "" ? '' : '' ?>
			</div>
			<div class="col-2 pt-15 text-end">

				<a href="<?= Yii::$app->homeUrl ?>setting/title/update-title/<?= ModelMaster::encodeParams(['titleId' => $title['titleId']]) ?>" class="btn btn-sm btn-outline-dark mr-5 font-size-12">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</a>
				<a href="javascript:deleteTitle(<?= $title['titleId'] ?>)" class="btn btn-sm btn-outline-danger font-size-12">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>

				<input type="hidden" id="redirect" value="1">
				<input type="hidden" id="preUrl" name="preUrl" value="<?= $preUrl ?>">
			</div>
		</div>
	</div>
	<div class="col-7 mt-40">
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="col-4 font-b font-size-16">Company :</div>
					<div class="col-8  pl-0"><?= Company::companyName($companyId) ?></div>
				</div>

			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-4 font-b font-size-16 pl-0">Layer :</div>
					<div class="col-8  pl-0"><?= Layer::layerName($title['layerId']) ?></div>
				</div>
			</div>
			<div class="col-6 mt-15">
				<div class="row">
					<div class="col-4 font-b font-size-16">Branch :</div>
					<div class="col-8  pl-0">
						<?php
						if ($flag != "") { ?>
							<img src="<?= Yii::$app->homeUrl . $flag ?>" class="card-round mr-5">
						<?php
						}
						?>
						<?= Branch::branchName($branchId) ?>
					</div>
				</div>

			</div>
			<div class="col-6 mt-15">
				<div class="row">
					<div class="col-4 font-b font-size-16 pl-0">Department :</div>
					<div class="col-8  pl-0"><?= Department::departmentNAme($departmentId) ?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-50">
		<div class="row">
			<div class="col-7 ">
				<div class="col-12 font-size-16 font-b">
					Purpose of the Job
				</div>
				<div class="col-12 pl-20 mt-20 font-size-14" style="word-wrap: break-word;">
					<?= $title['purpose'] ?>
				</div>
				<div class="col-12 font-size-16 mt-40 font-b">
					Key Responsibility
				</div>
				<div class="col-12 pl-20 mt-20 font-size-14" style="word-wrap: break-word;">
					<?= $title['keyResponsibility'] ?>
				</div>
			</div>
			<div class="col-5 border-left view-show-tag">
				<div class="col-12 font-size-16 pl-20 font-b">
					Job Description
				</div>
				<div class="col-12 pl-20 mt-20 font-size-14" style="word-wrap: break-word;">
					<?= $title['jobDescription'] ?>
				</div>
				<div class="col-12 font-size-16 mt-40 font-b pl-20">
					Required Skill
				</div>
				<div class="col-12 pl-20 mt-10 " style="word-wrap: break-word;">
					<div class="tags-input font-size-14" style="border:0px;">
						<div id="tags" class="">
							<span id="show-text">
								<?php
								$i = 1;
								if (isset($skillArr) && count($skillArr) > 0) {
									foreach ($skillArr as $skill) : ?>
										<li class="mt-10">
											<?= $skill ?>
										</li>
								<?php
										$i++;
									endforeach;
								}
								?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>