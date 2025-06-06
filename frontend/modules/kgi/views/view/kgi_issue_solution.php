<div class="col-lg-6">
	<div class="col-12 ligth-gray-box">
		<div class="row pl-15 pr-20">
			<div class="col-3  sub-tab-active pl-5">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning-full.png" class="pim-icon mr-3" style="margin-top: -6px;">
				<?= Yii::t('app', 'Report New Issus') ?>
			</div>
			<div class="col-9  sub-tab">
			</div>
		</div>
		<?php

		use yii\bootstrap5\ActiveForm;
		?>
		<div class="col-12 alert bg-white mt-15 pt-15 pr-30 pl-30" style="height:500px;overflow-y: auto;">
			<div class="row">
				<div class="col-12 head-gray-box pt-0">
					<span class=" head-gray-box-text"><?= Yii::t('app', 'Headline') ?></span>
					<div class="col-12">

						<input class="form-control font-size-12" name="newIssue" id="issue" required placeholder="Issue Headline">
					</div>
					<div class="col-12">
						<span class=" head-gray-box-text"><?= Yii::t('app', 'Description') ?></span>
						<textarea style="height: 350px;" class="form-control font-size-12" id="description" name="kgiDescription"></textarea>
					</div>
					<div id="attachFile-<?= $kgiId ?>" class="col-12 text-end font-size-12 mt-5"></div>
					<div class="col-12 text-end mt-5 mb-10 ">
						<label for="attachKgiFile">
							<a class="btn btn-bg-white-xs pb-0 pt-3" style="font-size: 10px;font-weight:300;margin:auto;">
								<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/clip.png" class="attach-icon" style="margin-top:-5px;">
								<?= Yii::t('app', 'Attachment') ?>
							</a>
						</label>
						<input id="attachKgiFile" accept=".pdf" type="file" style="display: none;" name="attachKgiFile" onchange="javascript:showAttachFileNameKgi(<?= $kgiId ?>)">
						<a class="btn-create font-size-12 pr-5 pl-5 mt-5 mb-10 no-underline ml-5" href="javascript:createNewIssue(<?= $kgiId ?>)">
							<?= Yii::t('app', 'Post Issue') ?>
						</a>
					</div>
				</div>

			</div>
		</div>
		<input type="hidden" name="kgiId" value="<?= $kgiId ?>">
		<input type="hidden" id="employeeId" name="employeeId" value="<?= $employeeId ?>">
	</div>
</div>
<div class="col-lg-6">
	<div class="col-12 ligth-gray-box">
		<div class="row pl-15 pr-20">
			<div class="col-3  sub-tab-active pl-5">
				<?= Yii::t('app', 'Report History') ?>
			</div>
			<div class="col-9  sub-tab">
			</div>
		</div>
		<div class="col-12 alert bg-white mt-15 pt-10 pr-10 pl-10" style="height:500px;overflow-y: auto;">
			<div class="col-12 pim-name-detail">
				<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/warning-full.png" class="pim-icon mr-3" style="margin-top: -6px;">
				<?= $kgiName ?>
			</div>
			<div class="col-12 mt-10" id="updated-issue">
				<?php
				if (isset($kgiIssue) && count($kgiIssue) > 0) {
					$i = 1;
					foreach ($kgiIssue as $kgiIssueId => $issue) :
				?>
						<div class="row pl-12">
							<div class="col-7">
								<img src="<?= Yii::$app->homeUrl ?><?= $issue['image'] ?>" class="image-circle1 mr-5">
								<span class="poster-name">
									<?= $issue["employeeName"] ?>
								</span>
							</div>
							<div class="col-5 text-end pt-10 pim-create-time">
								<i class="fa fa-circle mr-3 text-secondary " aria-hidden="true"></i><?= $issue['createDateTime'] ?>
							</div>
						</div>
						<div class="col-12 pl-20 border-left-bottom-radius" style="background-color:white;">
							<div class="col-12 font-size-12 pt-5 pb-25">
								<div class="row">
									<div class="col-10 pr-0">
										<b><?= $issue['issue'] ?></b>
										<div class="col-12 mt-5" style="text-indent: 30px;">
											<?= $issue['description'] ?>
										</div>
									</div>
									<div class="col-2 pl-0 pr-0 middle">
										<?php
										//////////////////////////////////////////////////////// i s s u e   /////////////////////////////////////////////
										if ($issue["file"] != "") {
											$fileSize = filesize($issue["file"]) / 1000000;
										?>

											<a href="<?= Yii::$app->homeUrl . $issue['file'] ?>" target="_blank" class="btn btn-bg-white-xs pb-0 pt-3" style="font-size: 10px;font-weight:300;margin:auto;">
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
						<div class="col-12 mt-10" id="solution-<?= $kgiIssueId ?>">
							<?php
							//////////////////////////////////////////////////////// s o l u t i o n  /////////////////////////////////////////////
							if (isset($issue["solutionList"]) && count($issue["solutionList"]) > 0) {
								$i = 1;
								foreach ($issue["solutionList"] as $kgiSolutionId => $data) : ?>
									<div class="col-12 <?= $i < count($issue["solutionList"]) ? 'border-left-bottom-radius' : '' ?>" style="<?= $i == 1 ? 'margin-top: -22px;' : 'margin-top: -10px;' ?>" id="kgi-solution-<?= $kgiSolutionId ?>">
										<div class="row">
											<div style="width: 8%;"></div>
											<div style="width: 52%;background-color:white;" class="pl-0">
												<img src="<?= Yii::$app->homeUrl ?><?= $data['image'] ?>" class="image-circle1" style="margin-top: -3px;">&nbsp;
												<span class="poster-name"><?= $data['name'] ?></span>
											</div>
											<div class="pim-create-time text-end pt-10" style="width: 40%;background-color:white;">
												<i class="fa fa-circle mr-3 text-secondary " aria-hidden="true"></i><?= $data['createDateTime'] ?>
											</div>
										</div>
										<div class="col-12 pb-20 pl-30">
											<div class="col-12 font-size-12 mt-5">
												<div class="row">
													<div class="col-10 pr-0">
														<?= $data['solution'] ?>
													</div>
													<div class="col-2  pl-0 pr-0 middle">
														<?php
														if ($data["file"] != "") {
															//$fileSize = filesize($data["file"]) / 1000000;
														?>
															<a href="<?= Yii::$app->homeUrl . $data['file'] ?>" target="_blank" class="btn btn-bg-white-xs pb-0 pt-3" style="font-size: 10px;font-weight:300;margin:auto;">
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
							<?php
									$i++;
								endforeach;
							}
							?>
						</div>
						<div class="col-12 mb-10" style="display:none;" id="answer-site-<?= $kgiIssueId ?>">
							<div id="fileName-<?= $kgiIssueId ?>" class="col-12 text-end font-size-12"></div>
							<textarea name="" class="form-control font-size-12" id="answer-<?= $kgiIssueId ?>" style="height: 80px;"></textarea>
							<div class="col-12 text-end">
								<label for="attachKgiFileAnswer-<?= $kgiIssueId ?>" class="mt-2" style="cursor: pointer;">
									<a class="btn btn-bg-white-xs pb-0 pt-3" style="font-size: 10px;font-weight:300;margin:auto;">
										<img src="<?= Yii::$app->homeUrl ?>images/icons/Settings/clip.png" class="attach-icon" style="margin-top:-5px;">
										<?= Yii::t('app', 'Attachment') ?>
									</a>
								</label>
								<input id="attachKgiFileAnswer-<?= $kgiIssueId ?>" accept=".pdf" type="file" style="display: none;" name="attachKgiFileAnswer-<?= $kgiIssueId ?>" onchange="javascript:showSelectFileNameKgi(<?= $kgiIssueId ?>)">
								<a href="javascript:answerKgiIssue(<?= $kgiIssueId ?>)" class="btn-reply font-size-10 mt-5 mb-10 no-underline" style="height: 25px;">
									<?= Yii::t('app', 'Reply Issue') ?>
								</a>
							</div>
						</div>
						<div class="col-12 text-end font-size-10 border-bottom pb-5 mb-15">
							<a href="javascript:showAnswer(<?= $kgiIssueId ?>,1)" id="reply-<?= $kgiIssueId ?>"><?= Yii::t('app', 'Reply') ?></a>
							<a href="javascript:showAnswer(<?= $kgiIssueId ?>,2)" style="display:none;" id="cancel-<?= $kgiIssueId ?>"><?= Yii::t('app', 'Cancel') ?></a>
						</div>
				<?php
						$i++;
					endforeach;
				}
				?>
				<input type="hidden" name="kgiId" value="<?= $kgiId ?>">
				<input type="hidden" name="employeeId" value="<?= $employeeId ?>">

			</div>
		</div>
	</div>
</div>