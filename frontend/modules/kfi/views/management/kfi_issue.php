<ul>
	<?php

	use frontend\models\hrvc\User;
	use yii\bootstrap5\ActiveForm;

	if (isset($kfiIssue) && count($kfiIssue) > 0) {
		foreach ($kfiIssue as $issue) :
	?>
			<li class="li-circle">
				<img src="<?= Yii::$app->homeUrl ?><?= $issue['image'] ?>" class="image-circle1"><span class="li-name"><?= $issue["employeeName"] ?>
					<span class="Report-Issue"> <?= $issue['createDateTime'] ?> <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> </span>
			</li>
			<div class="style-circle-li">
				<span>
					<?= $issue['issue'] ?>
				</span>
			</div>
			<div class="alert alert-secondary ml-30" style="border: none;">
				<div class="row">
					<div class="col-lg-7 col-md-6 col-12">
						<span class="badge bg-white"> <img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down"></span> <span class="text-dark"> 115 IHI July Invoice(Gunman) 30.July.2021.pdf <span class="text-secondary font-size-12"> 2.3mb</span></span>
					</div>
					<div class="col-lg-5 col-md-6 col-12 text-end">
						<button class="btn btn-outline-secondary"> <i class="fa fa-eye" aria-hidden="true"></i></button>
						<button class="btn btn-outline-secondary"> <i class="fa fa-cloud-download" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<li class="li-circle1">
				<div class="col-12 card-hashed">
					<img src="<?= Yii::$app->homeUrl ?>image/Watanabe.png" class="image-hashed">&nbsp; <span class="font-size-12">Tadawoki Watanabe</span>
					<div class="col-12 mt-20">
						<div class="input-group pr-20">
							<input for class="form-control">
							<a><i class="fa fa-paperclip clip-file" aria-hidden="true"></i></a>
							<button class="btn btn-primary form-submitbotton" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit</button>
						</div>
						<div class="mt-20"></div>
					</div>
				</div>
			</li>
		<?php
		endforeach;
	} else {
		$form = ActiveForm::begin([
			'id' => 'create-new-kfi-issue',
			'method' => 'post',
			'options' => [
				'enctype' => 'multipart/form-data',
			],
			'action' => Yii::$app->homeUrl . 'kfi/management/create-new-issue'

		]); ?>
		<li class="li-circle1">
			<div class="col-12 card-hashed">
				<img src="<?= Yii::$app->homeUrl ?><?= $profile['picture'] ?>" class="image-hashed">&nbsp;
				<span class="font-size-12"><?= $profile['employeeFirstname'] ?> <?= $profile['employeeSurename'] ?></span>
				<div class="col-12 font-size-20 text-center text-b text-black-50 ">
					+ Add a new issue.
				</div>
				<div class="col-12 mt-20">
					<div class="input-group pr-20">
						<input class="form-control" name="newIssue" required>
						<label for="attachKfiFile" style="margin-top: -10px;">
							<i class="fa fa-paperclip clip-file" aria-hidden="true"></i>
						</label>
						<input id="attachKfiFile" type="file" style="display: none;" name="attachKfiFile">

						<button class="btn btn-primary form-submitbotton" type="submit">
							<i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
						</button>
					</div>
					<div class="mt-20"></div>
				</div>
			</div>
		</li>
		<input type="hidden" name="kfiId" value="<?= $kfiId ?>">
		<input type="hidden" name="employeeId" value="<?= $employeeId ?>">
		<?php ActiveForm::end(); ?>
	<?php
	}
	?>
</ul>