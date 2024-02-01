<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KFI';
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
					<?= $this->render('filter_list_search', [
						"companies" => $companies,
						"months" => $months,
						"companyId" => $companyId,
						"branchId" => $branchId,
						"month" => $month,
						"status" => $status,
						"branches" => $branches,
						"yearSelected" => $year
					]) ?>
					<input type="hidden" id="type" value="list">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">

						<div class="col-12 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="#" class="btn btn-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
								<a href="<?= Yii::$app->homeUrl . 'kfi/management/grid' ?>" class="btn btn-outline-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="nav nav-pills mb-3 col-12" id="pills-tab" role="tablist">
				<div class="col-12 tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-Financial" role="tabpanel" aria-labelledby="pills-Financial-tab">
						<div class="col-12 tb-5">
							<table class="table table-striped">
								<thead class="table-secondary">
									<tr class="transform-none">
										<th>KFI Contents</th>
										<th>Company Name</th>
										<th>Branch</th>
										<th>Quant Ratio</th>
										<th>Target</th>
										<th>Code</th>
										<th>Result</th>
										<th>Ratio</th>
										<th>Unit</th>
										<th>Month</th>
										<th>Next Check</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (isset($kfis) && count($kfis) > 0) {
										foreach ($kfis as $kfiId => $kfi) :
									?>
											<tr style="border-bottom: 10px white !important;" id="kfi-<?= $kfiId ?>" class="font-size-12">
												<td class="<?= $kfi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>">
													<!-- <span class="badge bg-info text-white">PL</span> --> <?= $kfi["kfiName"] ?>

												</td>
												<td><?= $kfi["companyName"] ?></td>
												<td>
													<img src="<?= Yii::$app->homeUrl ?><?= $kfi['flag'] ?>" class="Flag-Turkey">
													<?= $kfi["branchName"] ?>, <?= $kfi['countryName'] ?>
												</td>
												<td><?= $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
												<td class="text-end">
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
												</td>
												<td class="text-center"><?= $kfi["code"] ?></td>
												<td><?php
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
												</td>
												<td>
													<div id="progress1">
														<div data-num="<?= $kfi["ratio"] == '' ? 0 : $kfi["ratio"] ?>" class="progress-item1"></div>
													</div>
												</td>
												<td></td>
												<td><?= $kfi["month"] ?></td>
												<td><?= $kfi["status"] == 1 ? $kfi["nextCheck"] : '' ?></td>
												<td colspan="row">
													<span data-bs-toggle="modal" data-bs-target="#kfi-issue" onclick="javascript:showKfiComment(<?= $kfiId ?>)">
														<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td">
													</span>&nbsp;&nbsp;
													<span class="dropdown" href="#" role="but ton" id="dropdownMenuLink-<?= $kfiId ?>" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kfiId ?>">
														<?php
														if ($role >= 5) {
														?>
															<li data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="javascript:updateKfi(<?= $kfiId ?>)">
																<a class="dropdown-item" href="#">
																	<i class="fa fa-file-text-o" aria-hidden="true"></i>
																	<strong class="red">*</strong>
																</a>
															</li>
														<?php
														}
														?>
														<li data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)">
															<a class="dropdown-item" href="#">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>
														</li>
														<?php
														if ($role >= 5) {
														?>
															<li onclick="javascript:copyKfi(<?= $kfiId ?>)" title="Copy">
																<a class="dropdown-item" href="#">
																	<i class="fa fa-copy" aria-hidden="true"></i>
																</a>
															</li>
															<li data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)">
																<a class="dropdown-item" href="#">
																	<i class="fa fa-trash-o" aria-hidden="true"></i>
																</a>
															</li>
														<?php
														}
														?>
													</ul>
												</td>
											</tr>
									<?php
										endforeach;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-12 content-navitem">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
							</ul>
						</nav>
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
		"isManager" => $isManager,
		"units" => $units,
		"months" => $months,
		"companies" => $companies,
	]) ?>
	<?php ActiveForm::end(); ?>


	<?= $this->render('history_modal', [
		"units" => $units,
	]) ?>
	<?= $this->render('issue_modal') ?>
	<?= $this->render('delete_modal') ?>

</div>