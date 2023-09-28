<div class="col-12 pl-30 mt-5">
	<div class="col-12 comment-box">
		<img src="<?= Yii::$app->homeUrl ?><?= $image ?>" class="image-circle1">&nbsp;
		<span class="font-size-14"><?= $name ?></span>
		<span class="Report-Issue"> <?= $createDateTime ?>
			<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
		</span>
		<div class="style-circle-li" style="text-indent: 40px;">
			<span>
				<?= $answer ?>
			</span>
			<?php
			if ($file != "") {
			?>
				<div class="pr-10 mr-10 mt-10 pb-10" style="background-color:#F5F5F5;border-radius:5px;">
					<div class="row">
						<div class="col-lg-7 col-md-6 col-12 pt-15">
							<img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down">
							<span class="text-dark"> <?= $fileName ?><span class="text-secondary font-size-12"></span></span>
						</div>
						<div class="col-lg-5 col-md-6 col-12 text-end pt-15" style="text-indent: 0px;">
							<a href="<?= Yii::$app->homeUrl . $file ?>" target="_blank" class="btn btn-outline-secondary mr-5 btn-sm">
								<i class="fa fa-eye" aria-hidden="true"></i></a>
							<a class="btn btn-outline-secondary  btn-sm">
								<i class="fa fa-cloud-download" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>