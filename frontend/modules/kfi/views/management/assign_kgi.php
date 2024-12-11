<?php

use common\models\ModelMaster;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'Assign KGI');
?>
<div class="col-12 mt-90">
	<div class="row">
		<div class="col-9">
			<i class="fa fa-cog font-size-26 mr-3" aria-hidden="true"></i>
			<strong class="font-size-20"><?= Yii::t('app', 'Assign KGI for KFI') ?> : <?= $kfiName ?></strong>
		</div>
		<div class="col-3 text-end">
			<a href="<?= Yii::$app->homeUrl ?>kfi/management/kfi-kgi/<?= ModelMaster::encodeParams(['kfiId' => $kfiId]) ?>" class="font-size-14 btn btn-outline-secondary">
				<i class="fa fa-chevron-left mr-5" aria-hidden="true"></i>
				<?= Yii::t('app', 'KGI for KFI') ?>
			</a>
		</div>
	</div>
	<div class="alert-box text-center">
		<?= Yii::t('app', 'S A V E D ! ! !') ?>
	</div>
	<div class="row mt-40 pr-10">
		<div class="col-lg-6 col-12">
			<?php
			if (isset($kfiBranch) && count($kfiBranch) > 0) {
				$i = 1;
				//throw new Exception(print_r($kfiBranch, true));
				foreach ($kfiBranch as $branchId => $branchName) : ?>
					<div class="col-12 font-size-16 border-bottom choose-branch" onclick="javascript:kgiInBranchForKfi(<?= $kfiId ?>,<?= $branchId ?>)">
						<?= $i ?>.<span class="ml-5"><?= $branchName ?></span>
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
					<?= Yii::t('app', 'KGI') ?>
				</div>

				<div class="col-12 mt-10" id="kgi-branch">

				</div>
			</div>
		</div>
	</div>
</div>