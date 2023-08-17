<div class="col-lg-4 col-md-5 col-sm-3 col-12">
	<div class="card" style="border: none;">
		<div class="card-body">
			<div class="row">
				<div class="col-3">
					<img src="<?= Yii::$app->homeUrl ?><?= $company['picture'] ?>" class=" card-tcf">
				</div>
				<div class="col-9">
					<div class="row">
						<div class="col-12 font-size-14 font-b pr-0 pl-4">
							<?= $branchName ?>
							<span class="ml-10 font-size-16 text-warning">
								<i class="fa fa-star" aria-hidden="true"></i>
							</span>
							<span class="font-size-12 text-primary">
								new
							</span>
						</div>
						<div class="col-1 mt-5 text-start  pr-0 pl-4">
							<img src="<?= Yii::$app->homeUrl ?><?= $country["flag"] ?>" class="card-round">
						</div>
						<div class="col-11 font-size-12 mt-10">
							<?= $company["city"] ?>, <?= $country["countryName"] ?>
						</div>
					</div>
					<div class="row">
						<div class="col-1  pr-0 pl-4 text-start">
							<img src="<?= Yii::$app->homeUrl ?>image/zoom.png" class="image-zoom">
						</div>
						<div class="col-7 font-size-12 pt-3">
							<?= $description ?>
						</div>
						<div class="col-4 pb-0 pr-0  text-end pt-10">
							<a href="javascript:updateBranch(<?= $branchId ?>)" class="btn btn-sm btn-outline-secondary font-size-12 mr-5">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
							<a href="javascript:deleteBranch(<?= $branchId ?>)" class="btn btn-sm btn-outline-danger font-size-12">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>