<?php

use common\models\ModelMaster;

$this->title = 'Employee';
?>

<div class="col-12 mt-90 all-employee0">
	<div class="row">
		<div class="col-lg-2 col-md-12 col-6">
			<div class="col-12 employee-one">
				Employee
			</div>
		</div>
		<div class="col-lg-2 col-md-12 col-12">
			<div class="col-12 mt-10">
				<a href="<?= Yii::$app->homeUrl ?>setting/employee/create" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i> Create</a>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-2 mt-10 fil0">
			<button type="button" class="btn btn-outline-secondary"><i class="fa fa-filter" aria-hidden="true"></i></button>
		</div>
		<div class="col-lg-3 col-md-4 col-10 mt-10">
			<div class="input-group mb-3 input-group0">
				<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
					<li><a class="dropdown-item" href="#">Separated link</a></li>
				</ul>
				<input type="text" class="form-control" aria-label="Text input with dropdown button">
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-12 mt-10">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" class="btn btn-primary btn-curr">All</button>
				<button type="button" class="btn btn-primary btn-curr"><i class="fa fa-briefcase" aria-hidden="true"></i> Current</button>
				<button type="button" class="btn btn-primary btn-curr">Resigned <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
	<div class="col-12 mt-20">
		<div class="card example-1 scrollbar-ripe-malinka">
			<div class="card-body">
				<div class="row">
					<?php
					if (isset($employees) && count($employees) > 0) {
						foreach ($employees as $employee) :
					?>
							<div class="col-lg-2 col-md-6 col-8">
								<div class="alert alert-employee pr-10 pl-10" role="alert">
									<div class="row" style="margin-top: -13px;">
										<div class="col-lg-10 col-md-10 col-10 text-end">
											<?php
											if ($employee["statusName"] == "Active") {
												$text = 'success0';
											} else {
												$text = 'danger';
											}
											?>
											<span class="badge rounded-pill bg-<?= $text ?>" style="font-size: 7px;"><?= $employee["statusName"] ?></span>
										</div>
										<div class="col-lg-2 col-md-2 col-2 text-end">
											<div class="col-12 employee-ellipsis">
												<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-6">
											<div class="col-12">
												<img src="<?= Yii::$app->homeUrl ?><?= $employee["picture"] ?>" class="image-employee">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-6">
											<div class="col-12 emplo-tadawoki">
												<?= $employee["employeeFirstname"] ?>
											</div>
											<div class="col-12 emplo-tadawoki">
												<?= $employee["employeeSurename"] ?>
											</div>
											<div class="col-12 emplo-permanent">
												<span class="badge bg-info text-dark"><?= $employee["employeeConditionName"] ?></span>
											</div>
										</div>
									</div>

									<div class="alert alert1-employee1 mt-10" role="alert">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-6">
												<div class="col-12 lead-programmer">
													lead Programmer
												</div>
												<div class="col-12 lead-it mt-3">
													IT & Development
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-6">
												<div class="col-12 lead-programmer">
													<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
												</div>
												<div class="col-12 lead-it mt-3">
													<?= ModelMaster::dateNumberDash($employee['hireDate']) ?>
												</div>
											</div>
										</div>
										<div class="col-12 mt-5">
											<div class="row">
												<div class="col-lg-2 col-md-6 col-2">
													<div class="col-12" style="margin-top: -10px;">
														<i class="fa fa-envelope-o envelope-send" aria-hidden="true"></i>
													</div>
												</div>
												<div class="col-lg-10 col-md-6 col-10 pr-0 pl-0">
													<div class="col-12 employee-email mt-3 ">
														<?= $employee["companyEmail"] ?>
													</div>
												</div>
												<div class="col-lg-2 col-md-6 col-2">
													<div class="col-12" style="margin-top: -10px;">
														<i class="fa fa-phone envelope-send" aria-hidden="true"></i>
													</div>
												</div>
												<div class="col-lg-10 col-md-6 col-10  pr-0 pl-0">
													<div class="col-12 envelope-mail">
														<?= $employee["telephoneNumber"] ?>
													</div>
												</div>
												<div class="col-lg-2 col-md-6 col-2">
													<div class="col-12" style="margin-top: -10px;">
														<i class="fa fa-user envelope-send" aria-hidden="true"></i>
													</div>
												</div>
												<div class="col-lg-10 col-md-6 col-10  pr-0 pl-0">
													<div class="col-12 employee-email mt-3">
														<?= $employee["employeeNumber"] ?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 employee-view">
										<a href="<?= Yii::$app->homeUrl ?>setting/employee/employee-profile/<?= ModelMaster::encodeParams(['employeeId' => $employee['employeeId']]) ?>" style="text-decoration: none;">
											View Profile
										</a>
									</div>
								</div>
							</div>

						<?php
						endforeach;
					} else { ?>
						<div class="col-12 text-center font-b font-size-16"> Employee not found.</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>