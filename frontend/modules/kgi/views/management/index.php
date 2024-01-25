<?php

use frontend\models\hrvc\Kgi;
use yii\bootstrap5\ActiveForm;

$this->title = "KGI";
?>

<div class="col-12 mt-70">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-18" aria-hidden="true"></i>
		<strong class="font-size-18"> Performance Indicator Matrices (PIM)</strong>
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
							Key Goal Indicators
						</div>
						<div class="col-6 text-center">
							<?php
							if ($role >= 3) {
							?>
								<button type="button" class="btn btn-primary font-size-12" data-bs-toggle="modal" data-bs-target="#staticBackdrop5" onclick="javascript:changeType()">
									<i class="fa fa-magic" aria-hidden="true"></i> Create New KGI
								</button>
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
					<input type="hidden" id="type" value="list">
				</div>
				<div class="col-lg-1 col-md-6 col-12 New-date">
					<div class="row">
						<div class="col-12 new-light-4">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a class="btn btn-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
								<a href="<?= Yii::$app->homeUrl ?>kgi/management/grid" class="btn btn-outline-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php
				if ($role >= 3) {
				?>
					<div class="col-12 mt-10 text-end">

						<a href="<?= Yii::$app->homeUrl ?>kgi/kgi-personal/individual-kgi" class="font-size-14 no-underline-primary">
							<i class="fa fa-user mr-5" aria-hidden="true"></i>
							Individual
						</a>
					</div>
				<?php
				}
				?>
			</div>
			<div class="col-12">
				<table class="table table-striped">
					<thead class="table-secondary">
						<tr class="transform-none">
							<th>KGI Contents</th>
							<th>Company</th>
							<th>Branch</th>
							<th>Team KGI Contents</th>
							<th>Priority</th>
							<th>Employees</th>
							<th>Team</th>
							<th>QR</th>
							<th>target</th>
							<th>Code</th>
							<th>result</th>
							<th>ratio</th>
							<th>month</th>
							<th>Unit</th>
							<th>Last</th>
							<th>next</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (count($kgis) > 0) {
							foreach ($kgis as $kgiId => $kgi) :
								$show = Kgi::checkPermission($role, $kgiId, $userId);
								if ($show == 1) {
									$display = '';
								} else {
									$display = 'none';
								}
						?>
								<tr class="border-bottom-white2" id="kgi-<?= $kgiId ?>">
									<td class="<?= $kgi["status"] == 1 ? 'over-blue' : 'over-yellow' ?>"><?= $kgi["kgiName"] ?></td>
									<td><?= $kgi["companyName"] ?></td>
									<td><img src="<?= Yii::$app->homeUrl . $kgi['flag'] ?>" class="Flag-Turkey"> <?= $kgi["branch"] ?>, <?= $kgi["countryName"] ?></td>
									<td><?= $show ?></td>
									<td class="text-center"><?= $kgi["priority"] ?></td>
									<td>
										<div class="flex mb-5 -space-x-4">
											<?php
											if (isset($kgi["kgiEmployee"]) && count($kgi["kgiEmployee"]) > 0) {
												$e = 1;
												foreach ($kgi["kgiEmployee"] as $emp) :
											?>
													<img class="image-grid" src="<?= Yii::$app->homeUrl . $emp ?>">
											<?php
													if ($e == 3) {
														break;
													}
													$e++;
												endforeach;
											}
											?>
											<a class="no-underline-black ml-2 mt-3" href="#"><?= count($kgi["kgiEmployee"]) ?></a>
										</div>
									</td>
									<td>
										<span class="badge rounded-pill bg-secondary-bsc"><i class="fa fa-users" aria-hidden="true"></i> <?= $kgi["countTeam"] ?></span>
									</td>
									<td><?= $kgi["quantRatio"] == 1 ? 'Quantity' : 'Quality' ?></td>
									<td>
										<?php
										$decimal = explode('.', $kgi["targetAmount"]);
										if (isset($decimal[1])) {
											if ($decimal[1] == '00') {
												$show = $decimal[0];
											} else {
												$show = $kgi["targetAmount"];
											}
										} else {
											$show = $kgi["targetAmount"];
										}
										?>
										<?= $show ?>
									</td>
									<td>
										<?= $kgi["code"] ?>
									</td>
									<td>
										<?php
										if ($kgi["result"] != '') {
											$decimalResult = explode('.', $kgi["result"]);
											if (isset($decimalResult[1])) {
												if ($decimalResult[1] == '00') {
													$showResult = $decimalResult[0];
												} else {
													$showResult = $kgi["result"];
												}
											} else {
												$showResult = $kgi["result"];
											}
										} else {
											$showResult = 0;
										}
										?>
										<?= $showResult ?>
									</td>
									<td>
										<div id="progress1">
											<div data-num="<?= $kgi["ratio"] ?>" class="progress-item1"></div>
										</div>
									</td>
									<td><?= $kgi["month"] ?></td>
									<td><?= $kgi["unit"] ?></td>
									<td><?= $kgi["periodCheck"] ?></td>
									<td class="<?= $kgi['isOver'] == 1 ? 'text-danger' : '' ?>">
										<?= $kgi["status"] == 1 ? $kgi["nextCheck"] : '' ?>
									</td>
									<td colspan="row">
										<span data-bs-toggle="modal" data-bs-target="#kgi-issue" onclick="javascript:showKgiComment(<?= $kgiId ?>)">
											<img src="<?= Yii::$app->homeUrl ?>image/comment.png" class="comment-td-dropdown">
										</span>
										<span class="dropdown menulink" href="#" role="but ton" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa fa-ellipsis-v on-cursor" aria-hidden="true"></i> </span>
										<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<li data-bs-toggle="modal" data-bs-target="#update-kgi-modal" onclick="javascript:updateKgi(<?= $kgiId ?>)" style="display: <?= $display ?>;">
												<a class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
											</li>
											<li data-bs-toggle="modal" data-bs-target="#kgi-view" onclick="javascript:kgiHistory(<?= $kgiId ?>)">
												<a class="dropdown-item"><i class="fa fa-eye" aria-hidden="true"></i></a>
											</li>
											<li onclick="javascript:copyKgi(<?= $kgiId ?>)" title="Copy" style="display: <?= $display ?>;">
												<a class="dropdown-item" href="#">
													<i class="fa fa-copy" aria-hidden="true"></i>
												</a>
											</li>
											<li data-bs-toggle="modal" data-bs-target="#delete-kgi" onclick="javascript:prepareDeleteKgi(<?= $kgiId ?>)" style="display: <?= $display ?>;">
												<a class="dropdown-item"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>
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
		<div class="col-12 navigation-next">
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link page-navigation" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Previous</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">1</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">2</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">3</a></li>
					<li class="page-item"><a class="page-link page-navigation" href="#">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
				</ul>
			</nav>
		</div>
	</div>
	<input type="hidden" value="create" id="acType">
	<?php
	$form = ActiveForm::begin([
		'id' => 'create-kgi',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kgi/management/create-kgi'

	]); ?>
	<?= $this->render('modal_create', [
		"units" => $units,
		"companies" => $companies,
		"months" => $months
	]) ?>
	<?php ActiveForm::end(); ?>

	<?php
	$form = ActiveForm::begin([
		'id' => 'update-kgi',
		'method' => 'post',
		'options' => [
			'enctype' => 'multipart/form-data',
		],
		'action' => Yii::$app->homeUrl . 'kgi/management/update-kgi'

	]); ?>
	<?= $this->render('modal_update', [
		"units" => $units,
		"companies" => $companies,
		"months" => $months,
		"isManager" => $isManager
	]) ?>
	<?php ActiveForm::end(); ?>
	<?= $this->render('modal_view') ?>

</div>
<?= $this->render('modal_delete') ?>
<?= $this->render('modal_issue') ?>
<?= $this->render('modal_team_history') ?>
<?= $this->render('modal_employee_history') ?>
<?= $this->render('modal_kfi') ?>