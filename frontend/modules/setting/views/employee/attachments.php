<div class="row">
	<div class="col-lg-6 col-md-6 col-12">
		<div class="col-12 pl-30 font-size-17 pt-60">
			<i class="fa fa-briefcase" aria-hidden="true"></i> Attachments
		</div>
		<hr>
		<div class="row pl-20">
			<div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
				<img src="<?= Yii::$app->homeUrl ?>image/Doc-1.png" class="image-file-plus1">
			</div>
			<div class="col-lg-6 col-md-6 col-12 pt-20">
				<strong class="text-dark"> Employee Agreement-DD.pdf</strong>
				<div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
				<div class="text-secondary font-size-14">last Updated <?= $updateDateTime ?></div>
			</div>
			<div class="col-lg-4 col-md-6 col-12 pt-30">
				<a href="javascript:showFile(1)" target="_blank" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></a>
				<a href="<?= Yii::$app->homeUrl . $resume ?>" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
			</div>
		</div>
		<hr>
		<div class="row pl-20">
			<div class="col-lg-2 col-md-6 col-12 pt-20 pl-20">
				<img src="<?= Yii::$app->homeUrl ?>image/Doc-2.png" class="image-file-plus1">
			</div>
			<div class="col-lg-6 col-md-6 col-12 pt-20">

				<strong class="text-dark"> Employee Agreement-DD.pdf</strong>
				<div class="text-secondary font-size-14" style="width: 80px;">Size 5.21 MB </div>
				<div class="text-secondary font-size-14">last Updated <?= $updateDateTime ?></div>
			</div>
			<div class="col-lg-4 col-md-6 col-12 pt-30">
				<a href="javascript:showFile(2)" target="_blank" class="btn btn-outline-secondary font-size-12"><i class="fa fa-eye" aria-hidden="true"></i></a>
				<a href="<?= Yii::$app->homeUrl . $agreement ?>" class="btn btn-outline-secondary font-size-12"><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6 col-12 form-pdf">
		<div class="col-12">
			<div class="myIframe">
				<iframe src="<?= Yii::$app->homeUrl . $resume ?>" title="description" id="file1" style="display: none;"></iframe>
				<iframe src="<?= Yii::$app->homeUrl . $agreement ?>" title="description" id="file2" style="display: none;"></iframe>
			</div>
		</div>
	</div>
</div>