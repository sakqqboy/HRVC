<div class="col-12" style="<?= $lastestKgiSolutionId == 0 ? 'margin-top: -22px;' : 'margin-top: -10px;' ?>" id="kgi-solution-<?= $kgiSolutionId ?>">
	<div class="row">
		<div style="width: 8%;"></div>
		<div style="width: 52%;background-color:white;" class="pl-0">
			<img src="<?= Yii::$app->homeUrl ?><?= $image ?>" class="image-circle1" style="margin-top: -3px;">&nbsp;
			<span class="poster-name"><?= $name ?></span>
		</div>
		<div class="pim-create-time text-end pt-10" style="width: 40%;background-color:white;">
			<i class="fa fa-circle mr-3 text-secondary " aria-hidden="true"></i><?= $createDateTime ?>
		</div>
	</div>
	<div class="col-12 pb-20 pl-30">
		<div class="col-12 font-size-12 mt-5">
			<div class="row">
				<div class="col-10 pr-0">
					<?= $answer ?>
				</div>
				<div class="col-2  pl-0 pr-0 middle">
					<?php
					if ($file != "") {
						//$fileSize = filesize($data["file"]) / 1000000;
					?>
						<a href="<?= Yii::$app->homeUrl . $file ?>" target="_blank" class="btn btn-bg-white-xs pb-0 pt-3" style="font-size: 10px;font-weight:300;margin:auto;">
							<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/clip.png" class="attach-icon" style="margin-top:-5px;">
							<?= Yii::t('app', 'Attachment') ?>
						</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>