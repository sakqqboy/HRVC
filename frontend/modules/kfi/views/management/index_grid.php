<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KFI Grid View';
?>

<div class="col-12 mt-70">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i> <strong class="font-size-18"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-10">
		<?= $this->render('header_filter', [
			"role" => $role
		]) ?>

		<div class="alert alert-white-4 mt-10">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12 key1">
					<div class="row">
						<div class="col-6 key1">
							Key Financial Indicators
						</div>
						<div class="col-6 text-center">
							<?php
							if ($role >= 3) {
							?>
								<button type="button" class="btn btn-primary font-size-12" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="fa fa-magic" aria-hidden="true"></i> Create New KFI</button>
							<?php
							}
							?>
						</div>
					</div>
				</div>

				<div class="col-lg-7 col-md-12 col-12 New-KFI">
					<?= $this->render('filter_list', [
						"companies" => $companies,
						"months" => $months
					]) ?>
					<input type="hidden" id="type" value="grid">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">

						<div class="col-4 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="<?= Yii::$app->homeUrl . 'kfi/management/index' ?>" class="btn btn-outline-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
								<a href="#" class="btn btn-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nav nav-pills mb-3 col-12" id="pills-tab" role="tablist">
				<div class="col-12 tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active pl-10 pr-10" id="pills-Financial" role="tabpanel" aria-labelledby="pills-Financial-tab">
						<div class="row">
							<?php
							if (isset($kfis) && count($kfis) > 0) {
								foreach ($kfis as $kfiId => $kfi) :
							?>
									<div class="col-lg-4 col-md-6 col-sm-5 col-12 mt-20" id="kfi-<?= $kfiId ?>">
										<div class="col-12 border pl-20 pr-20 pt-10 pb-5 <?= $kfi['isOver'] == 1 ? 'bg-over' : 'bg-white' ?>" style="border-radius:10px;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
											<div class="row">
												<div class="col-12">
													<div class="row">
														<div class="col-12 text-end pr-0">
															<a class="btn btn-xs btn-outline-secondary pt-0" style="margin-left: 0px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)">
																<i class="fa fa-eye mt-6" aria-hidden="true" style="margin-left: -5px"></i>
															</a>
															<?php
															if ($role >= 5) {
															?>
																<a class="btn btn-xs btn-outline-danger ml-5 pt-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)">
																	<i class="fa fa-trash-o mt-6" aria-hidden="true" style="margin-left: -5px;"></i>
																</a>
															<?php
															}
															?>
														</div>
														<div class="col-9 linechart-increase" style="margin-top: -25px;">
															<i class="fa fa-line-chart mr-5" aria-hidden="true"></i> <?= $kfi["kfiName"] ?>
															<div class="col-12  ting-size mt-5">
																<?= $kfi["companyName"] ?>
															</div>
															<div class="col-12 font-size-12 mt-5">
																<img src="<?= Yii::$app->homeUrl ?><?= $kfi["flag"] ?>" class="image-is mr-3"> <?= $kfi["branchName"] ?>
															</div>

														</div>
													</div>
												</div>
												<div class="col-12 pl-0 text-end  pr-5 " style="margin-top:-35px;">
													<div class="offset-6 col-6 text-end pl-0 pr-0">
														<span class="badge rounded-pill bg-deadline0 ml-5" style="width:100%;">
															<span class="deadline-orange"> Term</span>
															<span class="font-size-10 text-dark" style="font-weight: 700;">: <?= $kfi['fromDate'] == "" ? 'Not set' : $kfi['fromDate'] ?> - </span>
															<span class="font-size-10 text-dark" style="font-weight: 700;"><?= $kfi['toDate'] == "" ? 'Not set' : $kfi['toDate'] ?></span>
														</span>
													</div>
												</div>
												<div class="col-12 text-end pr-0 " style="margin-top:-8px;">
													<span class="badge rounded-pill <?= $kfi['status'] == 1 ? 'bg-warning text-dark' : 'bg-success' ?>"> <?= $kfi['status'] == 1 ? 'In process' : 'Completed' ?></span>
												</div>
												<div class="col-12 mt-15">
													<div class="row">
														<div class="col-lg-1 col-md-6 col-2 font-size-14 pt-30 pr-0 pl-0 text-center" style="font-weight: 500;">
															<?= strtoupper(substr($kfi['month'], 0, 3)) ?>
														</div>
														<div class="col-lg-4 col-md-6 col-3">
															<div class="col-12 Quant-ratio">
																Quant Ratio
															</div>
															<div class="col-12 font-size-10 mt-3">
																<i class="fa fa-diamond" aria-hidden="true"></i> <?= $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?>
															</div>
														</div>

														<div class="col-lg-3 col-md-6 col-3">
															<div class="col-12 bullseye-con">
																<i class="fa fa-bullseye" aria-hidden="true"></i> Target
															</div>
															<div class="col-12 million-number" style="font-weight: 500;">
																<?php
																$decimal = explode('.', $kfi["target"]);
																if (isset($decimal[1])) {
																	if ($decimal[1] == '00') {
																		$show = number_format($decimal[0]);
																	} else {
																		$show = number_format($kfi["target"], 2);
																	}
																} else {
																	$show = number_format($kfi["target"]);
																}
																?>
																<?= $show ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
															</div>
														</div>
														<div class="col-lg-1 col-md-6 col-3 pt-10  text-center">

															<?= $kfi["code"] ?>
														</div>
														<div class="col-lg-3 cl-md-6 col-3">
															<div class="col-12 trophy-con">
																<i class="fa fa-trophy" aria-hidden="true"></i> Result
															</div>
															<div class="col-12 million-number" style="font-weight: 500;">
																<?php
																if ($kfi["result"] != '') {
																	$decimalResult = explode('.', $kfi["result"]);
																	if (isset($decimalResult[1])) {
																		if ($decimalResult[1] == '00') {
																			$showResult = number_format($decimalResult[0]);
																		} else {
																			$showResult = number_format($kfi["result"], 2);
																		}
																	} else {
																		$showResult = number_format($kfi["result"]);
																	}
																} else {
																	$showResult = 0;
																}
																?>
																<?= $showResult ?><?= $kfi["amountType"] == 1 ? '%' : '' ?>
															</div>
														</div>

														<div class="col-lg-1 col-md-6 col-6"></div>
														<div class="col-lg-4 col-md-6 col-6">
															<div class="col-12 padding-update">
																Update Interval
															</div>
															<div class="col-12 update-mouth mt-5">
																<?= $kfi["unit"] ?>
															</div>
														</div>
														<div class="col-lg-7 col-md-6 col-6 pr-0">
															<div class="col-12 pr-0 pt-8">
																<?php
																$percent = explode('.', $kfi['ratio']);
																if (isset($percent[1])) {
																	if ($percent[1] != '00') {
																		$showPercent = $kfi['ratio'];
																	} else {
																		$showPercent = $percent[0];
																	}
																} else {
																	$showPercent = $percent[0];
																}
																?>
																<div class="progress">
																	<div class="progress-bar" style="width:<?= $showPercent ?>%; background:#2F80ED;"></div>
																	<span class="badge rounded-pill  pro-load0"><?= $showPercent ?>%</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12" style="margin-top:-10px;">
													<div class="row">
														<div class="col-lg-12 text-end pr-0">
															<span data-bs-toggle="modal" data-bs-target="#kfi-issue" onclick="javascript:showKfiComment(<?= $kfiId ?>)">
																<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-ima" style="margin-top: -5px;cursor:pointer;">
															</span>&nbsp;&nbsp;
															<?php
															if ($role >= 5) {
															?>
																<span class="next-update-span" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="javascript:updateKfi(<?= $kfiId ?>)">
																	<i class="fa fa-pencil-square-o font-size-19" aria-hidden="true"></i>
																</span> &nbsp;
															<?php
															}
															?>
															<span class="text-primary font-size-12">Next Update</span>
															<strong class="font-size-12 <?= $kfi['nextCheck'] == "" || $kfi['isOver'] == 1 ? 'text-danger' : '' ?>">
																<?= $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?>
															</strong>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
							<?php
								endforeach;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" value="create" id="acType">
	<?php $form = ActiveForm::begin([
		'id' => 'create-kfi',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kfi/management/create-kfi'

	]); ?>
	<?= $this->render('create_modal', [
		"companies" => $companies,
		"units" => $units,
		"months" => $months
	]) ?>
	<?php ActiveForm::end(); ?>
	<?php $form = ActiveForm::begin([
		'id' => 'update-kfi',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kfi/management/save-update-kfi'

	]); ?>
	<?= $this->render('update_modal', [
		"units" => $units,
		"companies" => $companies,
		"months" => $months,
		"isManager" => $isManager
	]) ?>

	<?php ActiveForm::end(); ?>
	<?= $this->render('delete_modal') ?>
	<?= $this->render('history_modal', [
		"units" => $units,
	]) ?>
	<?= $this->render('issue_modal', [
		"units" => $units,
	]) ?>
	<?= $this->render('issue_modal') ?>
	<?= $this->render('modal_kgi') ?>
</div>