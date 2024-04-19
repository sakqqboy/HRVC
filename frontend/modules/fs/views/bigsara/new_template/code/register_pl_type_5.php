<html>

<title>PL register type</title>

<Head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">


</Head>

<body>
	<div class="alert background-Planning mt-10 font-family">
		<div class="row mt-10">
			<div class="col-2 pb-100">
				<?php
				include 'pl_menu.php';
				?>
			</div>
			<div class="col-10 pt-10 pr-10 pl-10 font-family" style="background-color: white;">
				<div class="row">
					<div class="col-8 font-size-16 font-b">
						Register PL Types
					</div>
					<div class="col-4 text-end">
						<div class="row">
							<div class="col-10 pr-0 pl-0">
								<input class="form-control" type="search" placeholder="PL category breakdown">
							</div>
							<div class="col-2 pl-0">
								<a href="" class="btn btn-outline-secondary">
									<i class="fa fa-refresh" aria-hidden="true" style="font-size: 23px;"></i>
								</a>
							</div>
						</div>

					</div>
				</div>
				<div class="col-12 content-box mt-10">
					<div class="nav-top-menu-pl pl-20">
						<div class="row">
							<div class="col-3  pt-10 pb-10 font-size-12">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								Import PL Type
							</div>
							<div class="col-3  pt-10 pb-10 pl-0 font-size-12">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								PL Category Breakdown
							</div>
							<div class="col-3 pt-10 pb-10 font-size-12">
								<i class="fa fa-check-circle" aria-hidden="true"></i>
								Cash Flow Category
							</div>
						</div>
					</div>
					<div class="col-12 text-center mt-10 pt-20 pb-20 pl-40" style="background-color: white;border-radius:10px;">
						<div class="offset-3 col-lg-6">
							<div class="row">
								<div class="col-4 text-start pt-5 font-size-14">PL Category Breakdown</div>
								<div class="col-5 pr-0 pl-0"><input type="text" class="form-control"></div>
								<div class="col-2  pt-5 pl-0">
									<button class="btn purple-button font-size-12">Add</button>
								</div>
							</div>
						</div>
						<div class="row mt-30">
							<?php
							for ($i = 1; $i < 12; $i++) { ?>
								<div class="col-4 mb-20">
									<?php
									if ($i == 1) {
									?>
										<div class="col-1 text-success font-size-30 text-start selected-pl">
											<i class="fa fa-check-circle" aria-hidden="true"></i>
										</div>
									<?php
									}
									?>
									<div class="col-12 pl-item pl-20 pr-20 pb-10">
										<div class="col-12 text-end font-size-12"><?= $i ?></div>
										<div class="row mt-5">
											<div class="col-10  text-start font-size-12 mt-5">
												MANUFACTRING
											</div>
											<div class="col-2  font-size-12 text-end pr-0">
												<a href="" class="btn btn-outline-danger" style="font-size: 12px;">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php

							}
							?>
						</div>
					</div>

				</div>

			</div>

		</div>

	</div>
	</div>
</body>

</html>