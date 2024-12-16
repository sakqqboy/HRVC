<ul>
	<?php
	if (isset($kgiIssue) && count($kgiIssue) > 0) {
		$i = 1;
		foreach ($kgiIssue as $kgiIssueId => $issue) :
			if ($issue['image'] == '') {
				if ($issue["gender"] == 1) {
					$askImage = 'image/user.png';
				} else {
					$askImage = 'image/lady.jpg';
				}
			} else {
				$askImage = $issue['image'];
			}
	?>
			<li class="li-circle">
				<img src="<?= Yii::$app->homeUrl ?><?= $askImage ?>" class="image-circle1">
				<span class="li-name">
					<?= $issue["employeeName"] ?>
				</span>
				<span class="Report-Issue"> <?= $issue['createDateTime'] ?>
					<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
				</span>
			</li>
			<div class="col-12 border-left-dash mb-30">
				<div class="font-size-14 pl-30 pt-20 pb-10" style="text-indent: 40px;">
					<span>
						<?= $issue['issue'] ?>
					</span>
				</div>

				<?php

				if ($issue["file"] != "" && file_exists($issue["file"])) {
					$fileSize = filesize($issue["file"]) / 1000000;
				?>
					<div class="col-12 pr-10 mr-10  pb-10 text-end">

						<a href="<?= Yii::$app->homeUrl . $issue['file'] ?>" class="no-underline">
							<img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down">
							<span class="text-dark font-size-14"> <?= $kgiName ?>
								<span class="text-secondary font-size-12"> &nbsp;<?= number_format($fileSize, 2) ?> mb</span>
							</span>
						</a>

					</div>
				<?php
				}

				?>
				<hr>
				<div class="col-12 mt-5" id="solution-<?= $kgiIssueId ?>">
					<?php
					if (isset($issue["solutionList"]) && count($issue["solutionList"]) > 0) {
						foreach ($issue["solutionList"] as $kgiSolutionId => $data) :
							if ($data['image'] == '') {
								if ($data["gender"] == 1) {
									$answerImage = 'image/user.png';
								} else {
									$answerImage = 'image/lady.jpg';
								}
							} else {
								$answerImage = $issue['image'];
							}
					?>
							<div class="col-12 pl-30" style="margin-top: -10px;">
								<div class="col-12 comment-box">
									<img src="<?= Yii::$app->homeUrl ?><?= $answerImage ?>" class="image-circle1">&nbsp;
									<span class="font-size-14"><?= $data['name'] ?></span>
									<span class="Report-Issue"> <?= $data['createDateTime'] ?>
										<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
									</span>
									<div class="font-size-14 pl-30 pb-10" style="text-indent: 30px;">
										<span>
											<?= $data['solution'] ?>
										</span>
										<?php
										if ($data["file"] != "" && file_exists($data["file"])) {
											$fileSize = filesize($data["file"]) / 1000000;
										?>
											<div class="pr-10 mr-10 mt-10 pb-10" style="background-color:#F5F5F5;border-radius:5px;">
												<div class="row">
													<div class="col-lg-7 col-md-6 col-12 pt-15">
														<img src="<?= Yii::$app->homeUrl ?>image/pdf.png" class="pdf-down">
														<span class="text-dark"> <?= $data["file"] ?> <span class="text-secondary font-size-12"> &nbsp;<?= number_format($fileSize, 2) ?> mb</span></span>
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
					} else { ?>
						<div class="alert alert-light text-center">
							<?= Yii::t('app', 'Waiting for solution') ?>.
						</div>
					<?php

					}
					?>
				</div>
			</div>
			<hr>
	<?php
			$i++;
		endforeach;
	}
	?>

</ul>