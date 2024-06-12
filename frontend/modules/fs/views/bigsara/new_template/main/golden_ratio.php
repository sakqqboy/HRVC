<html>

<title>Golden Ratio</title>

<Head>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/chart.css?v=<?= date("YmdHis"); ?>" rel="stylesheet"> -->


	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/pl.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/chart.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">

	<style>
		.p-icon {
			padding: 5px 5px;
			color: white;
			background-color: red;
			border-radius: 5px;
		}

		.popup {
			z-index: 100;
			position: absolute;
		}

		.badge-breakdown {
			position: absolute;
			top: 10px;
			right: 10px;
			border-color: black;
		}

		.card-blue {
			background-color: rgb(203, 237, 255);
			border-color: rgb(169, 198, 212);
		}

		.card-taro {
			background-color: rgb(229, 239, 255);
			border-color: rgb(235, 238, 243);
		}

		.card-green {
			background-color: rgb(245, 255, 255);
			border-color: rgb(226, 243, 244);
		}

		.card-lime {
			background-color: rgb(229, 255, 229);
			border-color: rgb(230, 244, 230);
			height: max-content;
		}

		.card-gray {
			background-color: rgb(233, 233, 233);
			border-color: rgb(233, 233, 233);
		}

		.card-violet {
			background-color: rgb(251, 246, 255);
			border-color: rgb(225, 218, 232);
		}

		.alert-sea {
			background-color: rgb(218, 255, 254);
			border: 1px solid rgb(127, 225, 225);
		}

		.alert-blue {
			background-color: rgb(156, 224, 253);
			border: 1px solid rgb(148, 209, 237);
		}

		.alert-lime {
			background-color: rgb(180, 255, 179);
			border: 1px solid rgb(170, 234, 170);
		}

		.alert-yellow {
			background-color: rgb(255, 249, 219);
			border: 1px solid rgb(255, 235, 135);
		}

		.alert-violet {
			background-color: rgb(240, 225, 255);
			border: 1px solid rgb(220, 180, 255);
		}
	</style>
</Head>

<body class="background-Planning">

	<div class="col-12 alert background-Planning">
		<div class="row">
			<div class="col-6 planning" style="cursor: pointer;" onclick="window.location.href='https://bigsara-fordev.com/tokyo_new/new_template/main/index.php'">
				<img src="../images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning">
				Financial Planning
			</div>
			<div class="col-6 d-flex justify-content-end align-content-center" id="show_branch">

			</div>
		</div>
		<div class="col-12 mt-10">
			<div class="shadow pb-5 pt-5 mb-5 bg-body rounded alert2-secondary3">
				<ul class="nav nav-pills" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<a href="index.php" class="nav-link text-dark"><img src="../images/icons/Dark/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
					</li>
					<li class="nav-item" role="presentation">
						<a href="golden_ratio.php?branch=<?php echo $_GET['branch']; ?>" class="nav-link active"><img src="../images/icons/Light/Light/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
					</li>
					<li class="nav-item" role="presentation">
						<a href="future_account_comparison.php?branch=<?php echo $_GET['branch']; ?>" class="nav-link text-dark"><img src="../images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="row mt-10">
			<div class="col-12">
				<div class="card border-0 p-0">
					<div class="card-body">
						<h5 style="display: inline-block;">Golden Ratio</h5>
						<button type="button" class="btn btn-sm btn-primary" style="display: inline-block;">Register</button>
						<div class="row">
							<div class="col-4 pr-0">
								<div class="col-12 py-1 px-2">
									<div class="row py-1 px-2" style="background-color: #dee2e6;border-radius:2px;">
										<div class="col-3 text-secondary">
											<img src="../image/calendar.png" style="width: 13px;"> &nbsp;
											<span class="font-size-12">Current Year</span>
										</div>
										<div class="col-4" id="show_filter">
										</div>
									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="col-12 py-1 px-2">
									<div class="row py-1 px-2" style="background-color: #dee2e6;border-radius:2px;">
										<div class="col-4 align-self-start">
											<div class="d-flex justify-content-start">
												<div class="text-secondary">
													<img src="../image/roundup.png" style="width: 13px;"> &nbsp;
													<span class="font-size-12">Round Up</span>
												</div>
												<div class="col-4 ps-3">
													<select class="form-select text-primary" style="height: 25px;font-size:10px;" id="rate" name="rate" onchange="getData()">
														<option value="1">Normal</option>
														<option value="1000">Thousand</option>
														<option value="1000000">Million</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-8 d-flex justify-content-end">
											<div class="btn-group btn-group-sm" role="group">
												<input type="radio" class="btn-check" name="graph_type" id="igr" autocomplete="off" value="1" checked>
												<label class="btn btn-outline-secondary py-0" for="igr">Ideal Golden Ratio</label>

												<input type="radio" class="btn-check" name="graph_type" id="aly" autocomplete="off" value="2">
												<label class="btn btn-outline-secondary py-0" for="aly">Accual Last Year</label>

												<input type="radio" class="btn-check" name="graph_type" id="cyt" autocomplete="off" value="3">
												<label class="btn btn-outline-secondary py-0" for="cyt">Current Year Target</label>

												<input type="radio" class="btn-check" name="graph_type" id="nyt" autocomplete="off" value="4">
												<label class="btn btn-outline-secondary py-0" for="nyt">New Year Target</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div id="show_data"></div>

					</div>
				</div>
			</div>
		</div>
	</div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const branchId = urlParams.get('branch');
	const start_year_url = urlParams.get('start_year');

	$(document).ready(function() {
		getBarnch();
		get_filter();

		$('input[name="graph_type"].btn-check').change(function() {
			get_filter();
		});

	});

	function getBarnch() {
		$.ajax({
			type: "post",
			url: "ajax/fs_index/get_branch.php",
			data: {
				branchId: branchId
			},
			dataType: "json",
			success: function(response) {
				if (response.result == 1) {
					let text = `<h5 class='text-dark'>${response.companyName} -</h5> &nbsp;<h5 class='text-primary'>${response.branchName}</h5>`;
					$('#show_branch').html(text);
				}
			},
			error: function(jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect. Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error. ' + jqXHR.responseText;
				}

				Swal.fire({
					title: 'Warning !',
					text: "There was a recording problem. Please contact the system administrator. " + msg,
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});

	}

	function get_filter() {
		$.ajax({
			beforeSend: function() {
				swal.fire({
					html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5>',
					showConfirmButton: false,
					onRender: function() {
						$('.swal2-content').prepend(sweet_loader);
					}
				});
			},
			url: 'ajax/golden_ratio/get_year.php',
			type: 'POST',
			dataType: 'html',
			data: {
				branchId: branchId,
				start_year: start_year_url
			},
			success: function(data) {
				Swal.close();
				$('#show_filter').html(data);
				getData();
			},
			error: function(jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect. Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error. ' + jqXHR.responseText;
				}

				Swal.fire({
					title: 'Warning !',
					text: "There was a recording problem. Please contact the system administrator. " + msg,
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});
	}

	function getData() {
		var checkedRadio = $('input[name="graph_type"].btn-check:checked');
		if (checkedRadio.length > 0) {
			// console.log('Checked radio button value:', checkedRadio.val());
			if (checkedRadio.val() == 1) {
				var url = 'ajax/golden_ratio/get_data_igr.php';
			} else if (checkedRadio.val() == 2) {
				var url = 'ajax/golden_ratio/get_data_aly.php';
			} else if (checkedRadio.val() == 3) {
				var url = 'ajax/golden_ratio/get_data_cyt.php';
			} else if (checkedRadio.val() == 4) {
				var url = 'ajax/golden_ratio/get_data_nyt.php';
			}
		} else {
			console.log('No radio button with the name graph_type and class btn-check is checked.');
		}

		let rate = $("#rate").val();
		let start_year = $("#start_year").val();
		let start_month = $("#start_month").val();
		$.ajax({
			beforeSend: function() {
				swal.fire({
					html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5>',
					showConfirmButton: false,
					onRender: function() {
						$('.swal2-content').prepend(sweet_loader);
					}
				});
			},
			url: url,
			type: 'POST',
			dataType: 'html',
			data: {
				rate: rate,
				start_year: start_year,
				start_month: start_month,
				branchId: branchId
			},
			success: function(data) {
				Swal.close();
				$('#show_data').html(data);
			},
			error: function(jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect. Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error. ' + jqXHR.responseText;
				}

				Swal.fire({
					title: 'Warning !',
					text: "There was a recording problem. Please contact the system administrator. " + msg,
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});

	}
</script>