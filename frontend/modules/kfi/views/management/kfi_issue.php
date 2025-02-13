<ul>
	<?php

	use yii\bootstrap5\ActiveForm;

	if (isset($kfiIssue) && count($kfiIssue) > 0) {
		$i = 1;
		foreach ($kfiIssue as $kfiIssueId => $issue) :
	?>
			<li class="li-circle">
				<img src="<?= Yii::$app->homeUrl ?><?= $issue['image'] ?>" class="image-circle1">
				<span class="li-name">
					<?= $issue["employeeName"] ?>
				</span>
				<span class="Report-Issue"> <?= $issue['createDateTime'] ?>
					<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
				</span>
			</li>
			<div class="col-12 border-left-dash mb-30">
				<div class="style-circle-li" style="text-indent: 40px;">
					<span>
						<?= $issue['issue'] ?>
					</span>
				</div>

				<?php

				if ($issue["file"] != "") {
					$fileSize = filesize($issue["file"]) / 1000000;
				?>
					<div class="col-12 pr-10 mr-10  pb-10" style="background-color:#F5F5F5;border-radius:5px;">
						<div class="row">
							<div class="col-lg-7 col-md-6 col-12 pt-15 pl-20">
								<img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down">
								<span class="text-dark font-size-14"> <?= $kfiName ?><span class="text-secondary font-size-12"> &nbsp;<?= number_format($fileSize, 2) ?> mb</span></span>
							</div>
							<div class="col-lg-5 col-md-6 col-12 text-end pt-15">
								<a href="<?= Yii::$app->homeUrl . $issue['file'] ?>" target="_blank" class="btn btn-outline-secondary btn-sm mr-5">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<a class="btn btn-outline-secondary btn-sm">
									<i class="fa fa-cloud-download" aria-hidden="true"></i>
								</a>
							</div>
						</div>

					</div>
				<?php
				}

				?>
				<hr>
				<div class="col-12 mt-5" id="solution-<?= $kfiIssueId ?>">
					<?php
					if (isset($issue["solutionList"]) && count($issue["solutionList"]) > 0) {
						foreach ($issue["solutionList"] as $kfiSolutionId => $data) : ?>
							<div class="col-12 pl-30" style="margin-top: -10px;">
								<div class="col-12 comment-box">
									<img src="<?= Yii::$app->homeUrl ?><?= $data['image'] ?>" class="image-circle1">&nbsp;
									<span class="font-size-14"><?= $data['name'] ?></span>
									<span class="Report-Issue"> <?= $data['createDateTime'] ?>
										<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
									</span>
									<div class="style-circle-li" style="text-indent: 40px;">
										<span>
											<?= $data['solution'] ?>
										</span>
										<?php
										if ($data["file"] != "") {
											$fileSize = filesize($data["file"]) / 1000000;

										?>
											<div class="pr-10 mr-10 mt-10 pb-10" style="background-color:#F5F5F5;border-radius:5px;">
												<div class="row">
													<div class="col-lg-7 col-md-6 col-12 pt-15">
														<img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down">
														<span class="text-dark"> <?= $data["file"] ?> <span class="text-secondary font-size-12">&nbsp;<?= number_format($fileSize, 2) ?> mb</span></span>
													</div>
													<div class="col-lg-5 col-md-6 col-12 pt-15 text-end " style="text-indent: 0px;">
														<a href="<?= Yii::$app->homeUrl . $data['file'] ?>" target="_blank" class="btn btn-outline-secondary mr-5 btn-sm">
															<i class="fa fa-eye" aria-hidden="true"></i>
														</a>
														<a href="<?= Yii::$app->homeUrl . $data['file'] ?>" class="btn btn-outline-secondary  btn-sm">
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
					<?php
						endforeach;
					}
					?>
				</div>
				<div class="col-12 pl-30">

					<div class="col-12 card-dashed-gray">
						<img src="<?= Yii::$app->homeUrl ?><?= $profile['picture'] ?>" class="image-circle1">&nbsp;
						<span class="font-size-14"><?= $profile['employeeFirstname'] ?> <?= $profile['employeeSurename'] ?></span>

						<div class="col-12 mt-20">
							<div class="input-group pr-20">
								<div id="fileName-<?= $kfiIssueId ?>" class="col-12 text-end font-size-14"></div>
								<input for class="form-control" id="answer-<?= $kfiIssueId ?>">
								<label for="attachKfiFileAnswer-<?= $kfiIssueId ?>" class="mt-7" style="cursor: pointer;">
									<i class="fa fa-paperclip clip-file" aria-hidden="true"></i>
								</label>
								<input id="attachKfiFileAnswer-<?= $kfiIssueId ?>" accept=".pdf" type="file" style="display: none;" name="attachKfiFileAnswer-<?= $kfiIssueId ?>" onchange="javascript:showSelectFileName(<?= $kfiIssueId ?>)">
								<a href="javascript:answerKfiIssue(<?= $kfiIssueId ?>)" class="btn btn-primary font-size-13 pt-8">
									<i class="fa fa-paper-plane-o mr-5" aria-hidden="true"></i> <?= Yii::t('app', 'Submit') ?>
								</a>
							</div>
							<div class="mt-20"></div>
						</div>
					</div>
				</div>

			</div>
			<hr>
	<?php
			$i++;
		endforeach;
	}
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
			<img src="<?= Yii::$app->homeUrl ?><?= $profile['picture'] ?>" class="image-circle1">&nbsp;
			<span class="font-size-16"><?= $profile['employeeFirstname'] ?> <?= $profile['employeeSurename'] ?></span>
			<div class="col-12 font-size-20 text-center text-b text-black-50 ">
				<?= Yii::t('app', '+ Add a new issue') ?>.
			</div>
			<div class="col-12 mt-20">
				<div class="input-group pr-20">
					<div id="attachFile-<?= $kfiId ?>" class="col-12 text-end font-size-14"></div>
					<input class="form-control" name="newIssue" required>
					<label for="attachKfiFile" style="margin-top: -10px;">
						<i class="fa fa-paperclip clip-file" aria-hidden="true"></i>
					</label>
					<input id="attachKfiFile" accept=".pdf" type="file" style="display: none;" name="attachKfiFile" onchange="javascript:showAttachFileName(<?= $kfiId ?>)">

					<button class="btn btn-primary form-submitbotton" type="submit">
						<i class="fa fa-paper-plane-o mr-5" aria-hidden="true"></i> <?= Yii::t('app', 'Submit') ?>
					</button>
				</div>
				<div class="mt-20"></div>
			</div>
		</div>
	</li>
	<input type="hidden" name="kfiId" value="<?= $kfiId ?>">
	<input type="hidden" name="employeeId" value="<?= $employeeId ?>">
	<?php ActiveForm::end(); ?>

</ul>