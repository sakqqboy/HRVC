<?php

use yii\bootstrap5\ActiveForm;

$this->title = 'KFI';
?>

<div class="col-12 mt-90 pd-Performance">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-20">
		<div class="alert alert2-secondary2">
			<ul class="nav nav-pills" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link text-dark active" id="pills-Financial-tab" data-bs-toggle="pill" data-bs-target="#pills-Financial" type="button" role="tab" aria-controls="pills-Financial" aria-selected="true"><i class="fa fa-line-chart" aria-hidden="true"></i> Key Financial Indicator</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-dark" id="pills-Group-tab" data-bs-toggle="pill" data-bs-target="#pills-Group" type="button" role="tab" aria-controls="pills-Group" aria-selected="false"><i class="fa fa-flag-o" aria-hidden="true"></i> Key Group Indicator</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-dark" id="pills-Performance-tab" data-bs-toggle="pill" data-bs-target="#pills-Performance" type="button" role="tab" aria-controls="pills-Performance" aria-selected="false"><i class="fa fa-clock-o" aria-hidden="true"></i> Key Performance Indicator</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link text-dark" id="pills-Action-tab" data-bs-toggle="pill" data-bs-target="#pills-Action" type="button" role="tab" aria-controls="pills-Action" aria-selected="false"><i class="fa fa-list-ul" aria-hidden="true"></i> Key Action Indicator</a>
				</li>
				<li class="nav-item presentation-end" role="presentation">
					<a class="nav-link text-dark" id="pills-Setting-tab" data-bs-toggle="pill" data-bs-target="#pills-Setting" type="button" role="tab" aria-controls="pills-Action" aria-selected="false"><i class="fa fa-cog" aria-hidden="true"></i> Assign</a>
				</li>
			</ul>
		</div>

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
											<tr style="border-bottom: 10px white !important;" id="kfi-<?= $kfiId ?>">
												<td class="<?= $kfi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>">
													<!-- <span class="badge bg-info text-white">PL</span> --> <?= $kfi["kfiName"] ?>

												</td>
												<td><?= $kfi["companyName"] ?></td>
												<td>
													<img src="<?= Yii::$app->homeUrl ?>image/Flag-Turkey.png" class="Flag-Turkey">
													<?= $kfi["branchName"] ?>, <?= $kfi['countryName'] ?>
												</td>
												<td><?= $kfi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
												<td class="text-end"><?= number_format($kfi["target"], 2) ?></td>
												<td class="text-center"><?= $kfi["code"] ?></td>
												<td><?= $kfi["result"] ?></td>
												<td>
													<div id="progress1">
														<div data-num="<?= $kfi["ratio"] == '' ? 0 : $kfi["ratio"] ?>" class="progress-item1"></div>
													</div>
												</td>
												<td></td>
												<td><?= $kfi["month"] ?></td>
												<td><?= $kfi["nextCheck"] ?></td>
												<td colspan="row">
													<span data-bs-toggle="modal" data-bs-target="#exampleModalfirstone">
														<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td">
													</span>&nbsp;&nbsp;
													<span class="dropdown" href="#" role="but ton" id="dropdownMenuLink-<?= $kfiId ?>" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink-<?= $kfiId ?>">
														<li data-bs-toggle="modal" data-bs-target="#staticBackdrop2" onclick="javascript:updateKfi(<?= $kfiId ?>)">
															<a class="dropdown-item" href="#">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
																<strong class="red">*</strong>
															</a>
														</li>
														<li data-bs-toggle="modal" data-bs-target="#staticBackdrop3" onclick="javascript:kfiHistory(<?= $kfiId ?>)">
															<a class="dropdown-item" href="#">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>
														</li>
														<li data-bs-toggle="modal" data-bs-target="#staticBackdrop4" onclick="javascript:prepareDeleteKfi(<?= $kfiId ?>)">
															<a class="dropdown-item" href="#">
																<i class="fa fa-trash-o" aria-hidden="true"></i>
															</a>
														</li>
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


	<?= $this->render('history_modal', [
		"units" => $units,
	]) ?>
	<?= $this->render('comment_modal', [
		"units" => $units,
	]) ?>
	<?= $this->render('delete_modal') ?>

</div>