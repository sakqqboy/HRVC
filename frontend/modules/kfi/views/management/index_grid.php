<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KFI Grid View';
?>

<div class="col-12 mt-90 pd-Performance">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-20">
		<?= $this->render('header_filter') ?>

		<div class="alert alert-light-4">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12 key1">
					<div class="row">
						<div class="col-6 key1">
							Key Financial Indicators
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-primary font-size-14" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="fa fa-magic" aria-hidden="true"></i> Create New KFI</button>

						</div>
					</div>
				</div>

				<div class="col-lg-5 col-md-12 col-12 New-KFI">
					<div class="col-12">
						<div class="input-group">
							<span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected>Company</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected>Branch</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected>Month</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected>Type</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
							<select class="form-select font-size-13" aria-label="Example select">
								<option selected>Status</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12 New-date">
					<div class="row">
						<div class="col-8">
							<div class="input-group">
								<label class="input-group-text font-size-13" for="">Date</label>
								<input type="date" class="form-control font-size-13" name="birthday" id="">
							</div>
						</div>
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
									<div class="col-lg-4 col-md-6 col-sm-5 col-12 mt-20">
										<div class="col-12 border pl-20 pr-20 pt-20 pb-5" style="background-color:white;border-radius:10px;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
											<div class="row">
												<div class="col-lg-5 col-md-6 col-6">
													<div class="col-12 linechart-increase">
														<i class="fa fa-line-chart mr-5" aria-hidden="true"></i> <?= $kfi["kfiName"] ?>
													</div>
													<div class="col-12  ting-size mt-5">
														<?= $kfi["companyName"] ?>
													</div>
												</div>
												<div class="col-lg-7 col-md-6 col-6 pl-0 text-end">
													<div class="row">
														<div class="col-4 pr-0">
															<a class="btn btn-xs btn-outline-secondary pt-0" style="margin-left: 0px;" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)">
																<i class="fa fa-eye mt-6" aria-hidden="true" style="margin-left: -5px"></i>
															</a>
															<a class="btn btn-xs btn-outline-danger ml-5 pt-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)">
																<i class="fa fa-trash-o mt-6" aria-hidden="true" style="margin-left: -5px;"></i>
															</a>
														</div>
														<div class="col-8 text-start pl-0">
															<span class="badge rounded-pill bg-deadline0 ml-5" style="width:100%;">
																<span class="deadline-orange"> Deadline</span> <span class="mon-dark">: <?= $kfi['checkDate'] == "" ? 'Not set' : $kfi['checkDate'] ?></span>
															</span>
														</div>
													</div>

												</div>
												<div class="col-9 mt-10 font-size-12">
													<img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-is mr-3"> <?= $kfi["branchName"] ?>, Bangladesh
												</div>
												<div class="col-3 t-10">
													<span class="badge rounded-pill <?= $kfi['status'] == 1 ? 'bg-warning text-dark' : 'bg-success' ?>"> <?= $kfi['status'] == 1 ? 'In process' : 'Completed' ?></span>
												</div>
												<div class="col-12 mt-10">
													<div class="row">
														<div class="col-lg-2 col-md-6 col-2 font-size-16 pt-30" style="font-weight: 500;">
															<?= strtoupper(substr($kfi['month'], 0, 3)) ?>
														</div>
														<div class="col-lg-3 col-md-6 col-3">
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
															<div class="col-12" style="font-weight: 500;">
																<?= number_format($kfi["target"], 2) ?>
															</div>
														</div>
														<div class="col-lg-1 col-md-6 col-3 pt-13">

															<?= $kfi["code"] ?>
														</div>
														<div class="col-lg-3 cl-md-6 col-3">
															<div class="col-12 trophy-con">
																<i class="fa fa-trophy" aria-hidden="true"></i> Result
															</div>
															<div class="col-12 million-number" style="font-weight: 500;">
																<?= $kfi["result"] == '' ? '0' : $kfi["result"] ?>
															</div>
														</div>

														<div class="col-lg-2 col-md-6 col-6"></div>
														<div class="col-lg-4 col-md-6 col-6">
															<div class="col-12 padding-update">
																Update Interval
															</div>
															<div class="col-12 update-mouth mt-5">
																<?= $kfi["unit"] ?>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-6 pr-0">
															<div class="col-12 pr-0 pt-8">
																<div class="progress">
																	<div class="progress-bar" style="width:<?= number_format($kfi['ratio']) ?>%; background:#2F80ED;"></div>
																	<span class="badge rounded-pill  pro-load0"><?= $kfi['ratio'] ?>%</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12">
													<div class="row">
														<div class="col-lg-12 text-end pr-0">
															<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-ima mr-15" style="margin-top: -5px;">


															<span class="next-update-span" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick=" javascript:updateKfi(<?= $kfiId ?>)">
																<i class="fa fa-pencil-square-o font-size-19" aria-hidden="true"></i>

															</span> &nbsp;
															<span class="text-primary font-size-12">Next Update</span>
															<strong class="font-size-12"><?= $kfi['nextCheck'] == "" ? 'Not set' : $kfi['nextCheck'] ?></strong>
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
	]) ?>

	<?php ActiveForm::end(); ?>
	<?= $this->render('delete_modal') ?>
	<?= $this->render('history_modal', [
		"units" => $units,
	]) ?>
</div>