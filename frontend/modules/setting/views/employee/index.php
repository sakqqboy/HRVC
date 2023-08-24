<?php
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
					$i = 0;
					while ($i < 10) {
					?>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="alert alert-employee" role="alert">
								<div class="row ">
									<div class="col-lg-11 col-md-10 col-10 text-end pt-0 ">
										<span class="badge rounded-pill bg-success0">Active</span>
									</div>
									<div class="col-lg-1 col-md-2 col-2 text-end pl-0">
										<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
									</div>
								</div>
								<div class="row" style="margin-top: -23px;">
									<div class="col-lg-5 col-md-6 col-6 ">
										<div class="col-12 pr-0 ">
											<img src="<?= Yii::$app->homeUrl ?>image/employee1.png" class="image-employee">
										</div>
									</div>
									<div class="col-lg-7 col-md-6 col-6 mt-19 ">
										<div class="col-12 font-b font-size-12 mt-5">
											Tadawoki
										</div>
										<div class="col-12 font-b font-size-12 mt-2">
											Watanabe
										</div>
										<div class="col-12 emplo-permanent mt-3">
											<span class="badge bg-info text-dark">Permanent</span>
										</div>
									</div>
								</div>
								<div class="alert alert1-employee1 mt-20" role="alert">
									<div class="row">
										<div class="col-lg-7 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												lead Programmer
											</div>
											<div class="col-12 lead-it">
												IT & Development
											</div>
										</div>
										<div class="col-lg-5 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
											</div>
											<div class="col-12 lead-it">
												17/02/2000
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="row">
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-envelope-o" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													dibbo.du..t@tokyoconsultinggroup.com
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-phone" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													+88078896454123
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-user" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													EID 14
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 employee-view">
									View Profile
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="alert alert-employee" role="alert">
								<div class="row ">
									<div class="col-lg-11 col-md-10 col-10 text-end pt-0 ">
										<span class="badge rounded-pill bg-danger">Resigned</span>
									</div>
									<div class="col-lg-1 col-md-2 col-2 text-end pl-0">
										<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
									</div>
								</div>
								<div class="row" style="margin-top: -23px;">
									<div class="col-lg-5 col-md-6 col-6 ">
										<div class="col-12 pr-0 ">
											<img src="<?= Yii::$app->homeUrl ?>image/employee2.png" class="image-employee">
										</div>
									</div>
									<div class="col-lg-7 col-md-6 col-6 mt-19 ">
										<div class="col-12 font-b font-size-12 mt-5">
											Tadawoki
										</div>
										<div class="col-12 font-b font-size-12 mt-2">
											Watanabe
										</div>
										<div class="col-12 emplo-permanent mt-3">
											<span class="badge bg-info text-dark">Permanent</span>
										</div>
									</div>
								</div>
								<div class="alert alert1-employee1 mt-20" role="alert">
									<div class="row">
										<div class="col-lg-7 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												lead Programmer
											</div>
											<div class="col-12 lead-it">
												IT & Development
											</div>
										</div>
										<div class="col-lg-5 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
											</div>
											<div class="col-12 lead-it">
												17/02/2000
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="row">
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-envelope-o" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													dibbo.du..t@tokyoconsultinggroup.com
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-phone" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													+88078896454123
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-user" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													EID 14
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 employee-view">
									View Profile
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="alert alert-employee" role="alert">
								<div class="row ">
									<div class="col-lg-11 col-md-10 col-10 text-end pt-0 ">
										<span class="badge rounded-pill bg-success0">Active</span>
									</div>
									<div class="col-lg-1 col-md-2 col-2 text-end pl-0">
										<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
									</div>
								</div>
								<div class="row" style="margin-top: -23px;">
									<div class="col-lg-5 col-md-6 col-6 ">
										<div class="col-12 pr-0 ">
											<img src="<?= Yii::$app->homeUrl ?>image/employee3.png" class="image-employee">
										</div>
									</div>
									<div class="col-lg-7 col-md-6 col-6 mt-19 ">
										<div class="col-12 font-b font-size-12 mt-5">
											Tadawoki
										</div>
										<div class="col-12 font-b font-size-12 mt-2">
											Watanabe
										</div>
										<div class="col-12 emplo-permanent mt-3">
											<span class="badge bg-info text-dark">Permanent</span>
										</div>
									</div>
								</div>
								<div class="alert alert1-employee1 mt-20" role="alert">
									<div class="row">
										<div class="col-lg-7 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												lead Programmer
											</div>
											<div class="col-12 lead-it">
												IT & Development
											</div>
										</div>
										<div class="col-lg-5 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
											</div>
											<div class="col-12 lead-it">
												17/02/2000
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="row">
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-envelope-o" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													dibbo.du..t@tokyoconsultinggroup.com
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-phone" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													+88078896454123
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-user" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													EID 14
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 employee-view">
									View Profile
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="alert alert-employee" role="alert">
								<div class="row ">
									<div class="col-lg-11 col-md-10 col-10 text-end pt-0 ">
										<span class="badge rounded-pill bg-success0">Active</span>
									</div>
									<div class="col-lg-1 col-md-2 col-2 text-end pl-0">
										<strong><i class="fa fa-ellipsis-v" aria-hidden="true"></i></strong>
									</div>
								</div>
								<div class="row" style="margin-top: -23px;">
									<div class="col-lg-5 col-md-6 col-6 ">
										<div class="col-12 pr-0 ">
											<img src="<?= Yii::$app->homeUrl ?>image/employee1.png" class="image-employee">
										</div>
									</div>
									<div class="col-lg-7 col-md-6 col-6 mt-19 ">
										<div class="col-12 font-b font-size-12 mt-5">
											Tadawoki
										</div>
										<div class="col-12 font-b font-size-12 mt-2">
											Watanabe
										</div>
										<div class="col-12 emplo-permanent mt-3">
											<span class="badge bg-info text-dark">Permanent</span>
										</div>
									</div>
								</div>
								<div class="alert alert1-employee1 mt-20" role="alert">
									<div class="row">
										<div class="col-lg-7 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												lead Programmer
											</div>
											<div class="col-12 lead-it">
												IT & Development
											</div>
										</div>
										<div class="col-lg-5 col-md-6 col-6">
											<div class="col-12 lead-programmer">
												<i class="fa fa-calendar" aria-hidden="true"></i> Hiring Date
											</div>
											<div class="col-12 lead-it">
												17/02/2000
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="row">
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-envelope-o" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													dibbo.du..t@tokyoconsultinggroup.com
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-phone" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													+88078896454123
												</div>
											</div>
											<div class="col-lg-2 col-md-6 col-2 mt-10">
												<div class="col-12">
													<i class="fa fa-user" aria-hidden="true"></i>
												</div>
											</div>
											<div class="col-lg-10 col-md-6 col-10 mt-10">
												<div class="col-12 employee-email">
													EID 14
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 employee-view">
									View Profile
								</div>
							</div>
						</div>
					<?php
						$i++;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>