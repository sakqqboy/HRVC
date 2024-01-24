<?php

use common\models\ModelMaster;

$this->title = 'Assign KPI';
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-9">
			<i class="fa fa-cog font-size-26 mr-3" aria-hidden="true"></i>
			<strong class="font-size-20">Assign KPI to KGI : <?= $kgiName ?></strong>
		</div>
		<div class="col-3 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kgi/management/kgi-kpi/<?= ModelMaster::encodeParams(['kgiId' => $kgiId]) ?>" class="font-size-14 btn btn-outline-secondary">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				KPI for KGI
			</a>
		</div>
	</div>
	<div class="alert-box text-center">
		S A V E D ! ! !
	</div>

	<div class="row mt-40 pr-10">
		<div class="col-lg-6 col-12">
			<?php
			if (isset($kgiBranch) && count($kgiBranch) > 0) {
				$i = 1;
				//throw new Exception(print_r($kfiBranch, true));
				foreach ($kgiBranch as $branch) : ?>
					<div class="col-12 font-size-16 border-bottom choose-branch" onclick="javascript:kpiInBranchForKpi(<?= $kgiId ?>,<?= $branch['branchId'] ?>)">
						<?= $i ?>.<span class="ml-5"><?= $branch["branchName"] ?></span>
					</div>
			<?php
					$i++;
				endforeach;
			}
			?>
		</div>
		<div class="col-lg-6 col-12 border" style="min-height:500px;border-radius:5px;">
			<div class="row">
				<div class="col-12 font-b font-size-14 mt-10">
					KPI
				</div>
				<div class="col-12 mt-10" id="kpi-branch">

				</div>
			</div>
		</div>
	</div>
</div>