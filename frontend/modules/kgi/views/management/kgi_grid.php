<?php

use yii\bootstrap5\ActiveForm;
?>
<div class="col-12 mt-90 pd-Performance">
	<div class="col-12">
		<i class="fa fa-tachometer font-size-20" aria-hidden="true"></i> <strong class="font-size-20"> Performance Indicator Matrices (PIM)</strong>
	</div>
	<div class="col-12 mt-20">
		<?= $this->render('header_filter') ?>
		<div class="tab-pane" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab">
			<div class="alert alert-white-4">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12 key1">
						<div class="row">
							<div class="col-6 key1">
								Key Goal Indicators
							</div>
							<div class="col-6">
								<button type="button" class="btn btn-primary font-size-14" data-bs-toggle="modal" data-bs-target="#staticBackdrop5"><i class="fa fa-magic" aria-hidden="true"></i> Create New KGI</button>

							</div>
						</div>
					</div>

					<div class="col-lg-5 col-md-12 col-12 New-KFI">
						<div class="col-12">
							<div class="input-group">
								<span class="input-group-text"><i class="fa fa-filter" aria-hidden="true"></i></span>
								<select class="form-select font-size-13" aria-label="Example select">
									<option selected value="">Company</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
								<select class="form-select font-size-13" aria-label="Example select">
									<option selected value="">Branch</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
								<select class="form-select font-size-13" aria-label="Example select">
									<option selected value="">Month</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
								<select class="form-select font-size-13" aria-label="Example select">
									<option selected value="">Type</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
								</select>
								<select class="form-select font-size-13" aria-label="Example select">
									<option selected value="">Status</option>
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
									<a href="<?= Yii::$app->homeUrl ?>kgi/management/index" class="btn btn-outline-primary font-size-13"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
									<a class="btn btn-primary font-size-13"><i class="fa fa-th-large" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show active" id="pills-Group" role="tabpanel" aria-labelledby="pills-Group-tab">
					<div class="card example-5 scrollbar-ripe-malinka">
						<div class="col-12 card card-radius">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-12 clients-employee">
									<i class="fa fa-flag" aria-hidden="true"></i> The Number Of Clients Per Employee
								</div>
								<div class="col-lg-1 col-md-6 col-12">
									<span class="badge rounded-pill bg-warning text-dark">Completed</span>
								</div>
								<div class="col-lg-1 col-md-6 col-12 month-feb">
									FEBRUARY
								</div>
								<div class="col-lg-1 col-md-6 col-12">
									<span class="badge rounded-pill bg-white">
										<div class="flex mb-5 -space-x-4">
											<img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
											<img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
											<img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
											<a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
										</div>
									</span>
								</div>
								<div class="col-lg-1 col-md-6 col-12 text-end">
									<span class="badge rounded-pill bg-bsc"><i class="fa fa-users" aria-hidden="true"></i> 3</span>
								</div>
								<div class="col-lg-2 col-md-6 col-12">
									<div class="flex-tokyo">
										Tokyo Consulting Firm Limited
									</div>
									<p class="tokyo-ima"> <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh</p>
								</div>
								<div class="col-lg-2 col-md-6 col-12 text-end">
									<button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
									<button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</div>
								<div class="mt-20"></div>
								<div class="col-lg-2 col-md-6 col-12">
									<div class="col-12">
										<span class="badge rounded-pill slds-badge">
											Deadline <span class="text-dark font-size-10">: Mon,Feb 28,2024</span>
										</span>
									</div>
									<div class="col-12 top-teamcontent">
										Team Content
									</div>
									<div class="col-12 font-size-12 pt-10">
										This is a sample KGI content
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-12 sample-bordersolid">
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 font-size-12 pt-5">
												Quant Ratio
											</div>
											<div class="col-12 Quality-diamond">
												<i class="fa fa-diamond" aria-hidden="true"></i> Quality
											</div>
											<div class="col-12 font-size-12 pt-10">
												Update Interval
											</div>
											<div class="col-12 Quality-monthly0">
												Monthly
											</div>
										</div>
										<div class="col-md-6 pt-10">
											<div class="col-12">
												Priority
											</div>
											<div class="col-12">
												<div class="circle-update">A</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
									<div class="row">
										<div class="col-md-4">
											<div class="col-12 target-progress">
												<i class="fa fa-bullseye" aria-hidden="true"></i> Target
											</div>
											<div class="col-12 target-million">
												1,000,000
											</div>
										</div>
										<div class="col-md-4">
											<div class="col-12 target-plush">
												>
											</div>
										</div>
										<div class="col-md-4">
											<div class="col-12 target-progress">
												Result <i class="fa fa-trophy" aria-hidden="true"></i>
											</div>
											<div class="col-12 target-million">
												902,566
											</div>
										</div>
									</div>
									<div class="col-12 mt-20">
										<div class="progress">
											<div class="progress-bar" style="width:25%; background:#2F80ED;"></div>
											<span class="badge rounded-pill  pro-load2">25%</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 refresh0">
												<i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
											</div>
											<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
												Tue, Mar 12, 2023
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 pencil-nextupdate">
												Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</div>
											<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
												Tue, Mar 12, 2023
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-12 card-bordersolid">
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 dashed1">
												<strong class="text-dark font-size-13"> Issue</strong>
												<p class="font-size-11 text-dark">Now use Lorem Ipsum as their default model text, and a search</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 dashed1">
												<strong class="text-dark font-size-13"> Solution</strong>
												<p class="font-size-11 text-dark">Now use Lorem Ipsum as their default model text, and a search </p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 card card-radius">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-12 clients-employee">
									<i class="fa fa-flag" aria-hidden="true"></i> The Number Of Clients Per Employee
								</div>
								<div class="col-lg-1 col-md-6 col-12">
									<span class="badge rounded-pill bg-warning text-dark">Completed</span>
								</div>
								<div class="col-lg-1 col-md-6 col-12 month-feb">
									FEBRUARY
								</div>
								<div class="col-lg-1 col-md-6 col-12">
									<span class="badge rounded-pill bg-white">
										<div class="flex mb-5 -space-x-4">
											<img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar1.png" class="image-avatar1">
											<img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar2.png" class="image-avatar1">
											<img class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800" src="<?= Yii::$app->homeUrl ?>image/avatar3.png" class="image-avatar1">
											<a class="flex items-center justify-center w-10 h-10 text-xs font-medium text-dark bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800" href="#">9</a>
										</div>
									</span>
								</div>
								<div class="col-lg-1 col-md-6 col-12 text-end">
									<span class="badge rounded-pill bg-bsc"><i class="fa fa-users" aria-hidden="true"></i> 3</span>
								</div>
								<div class="col-lg-2 col-md-6 col-12">
									<div class="flex-tokyo">
										Tokyo Consulting Firm Limited
									</div>
									<p class="tokyo-ima"> <img src="<?= Yii::$app->homeUrl ?>image/is.jpg" class="image-flex"> Dhaka, Bangladesh</p>
								</div>
								<div class="col-lg-2 col-md-6 col-12 text-end">
									<button class="btn btn-outline-secondary font-size-10"><i class="fa fa-eye" aria-hidden="true"></i></button>
									<button class="btn btn-outline-danger font-size-10"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
								</div>
								<div class="mt-20"></div>
								<div class="col-lg-2 col-md-6 col-12">
									<div class="col-12">
										<span class="badge rounded-pill slds-badge">
											Deadline <span class="text-dark font-size-10">: Mon,Feb 28,2024</span>
										</span>
									</div>
									<div class="col-12 top-teamcontent">
										Team Content
									</div>
									<div class="col-12 font-size-12 pt-10">
										This is a sample KGI content
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-12 sample-bordersolid">
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 font-size-12 pt-5">
												Quant Ratio
											</div>
											<div class="col-12 Quality-diamond">
												<i class="fa fa-diamond" aria-hidden="true"></i> Quality
											</div>
											<div class="col-12 font-size-12 pt-10">
												Update Interval
											</div>
											<div class="col-12 Quality-monthly0">
												Monthly
											</div>
										</div>
										<div class="col-md-6 pt-10">
											<div class="col-12">
												Priority
											</div>
											<div class="col-12">
												<div class="circle-update">A</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-12 progress-bordersolid">
									<div class="row">
										<div class="col-md-4">
											<div class="col-12 target-progress">
												<i class="fa fa-bullseye" aria-hidden="true"></i> Target
											</div>
											<div class="col-12 target-million">
												1,000,000
											</div>
										</div>
										<div class="col-md-4">
											<div class="col-12 target-plush">
												>
											</div>
										</div>
										<div class="col-md-4">
											<div class="col-12 target-progress">
												Result <i class="fa fa-trophy" aria-hidden="true"></i>
											</div>
											<div class="col-12 target-million">
												902,566
											</div>
										</div>
									</div>
									<div class="col-12 mt-20">
										<div class="progress">
											<div class="progress-bar" style="width:25%; background:#2F80ED;"></div>
											<span class="badge rounded-pill  pro-load2">25%</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 refresh0">
												<i class="fa fa-refresh" aria-hidden="true"></i> Latest Update
											</div>
											<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
												Tue, Mar 12, 2023
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 pencil-nextupdate">
												Next Update <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</div>
											<div class="col-12 font-size-12 pt-5" style="font-weight: 700;">
												Tue, Mar 12, 2023
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-12 card-bordersolid">
									<div class="row">
										<div class="col-md-6">
											<div class="col-12 dashed1">
												<strong class="text-dark font-size-13"> Issue</strong>
												<p class="font-size-11 text-dark">Now use Lorem Ipsum as their default model text, and a search </p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="col-12 dashed1">
												<strong class="text-dark font-size-13"> Solution</strong>
												<p class="font-size-11 text-dark">Now use Lorem Ipsum as their default model text, and a search</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>