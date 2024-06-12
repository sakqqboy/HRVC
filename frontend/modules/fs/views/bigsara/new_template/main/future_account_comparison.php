<html>

<title>Future Account Comparison</title>

<Head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/pl.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/chart.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">


	<style>
		.icon-red {
			padding: 5px 5px;
			color: white;
			background-color: red;
			border-radius: 5px;
		}

		.icon-darkblue {
			padding: 5px 5px;
			color: white;
			background-color: darkblue;
			border-radius: 5px;
		}

		.icon-green {
			padding: 5px 5px;
			color: white;
			background-color: rgb(0, 128, 128);
			border-radius: 5px;
		}

		.icon-gray {
			padding: 5px 5px;
			color: white;
			background-color: rgb(113, 113, 113);
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

		.card-yellow {
			background-color: rgb(255, 242, 218);
			border: 2px solid rgb(253, 234, 199);
			/* border-color: rgb(169, 198, 212); */
		}

		.card-sea {
			background-color: rgb(245, 255, 255);
			border: 2px solid rgb(223, 251, 251);
			/* border-color: rgb(169, 198, 212); */
		}

		.card-taro {
			background-color: rgb(251, 246, 255);
			border: 2px solid rgb(228, 222, 235);
			/* border-color: rgb(235, 238, 243); */
		}

		.card-lime {
			background-color: rgb(229, 255, 229);
			border: 2px solid rgb(227, 248, 227);
			/* border-color: rgb(230, 244, 230); */
			/* height: max-content; */
		}

		.card-gray {
			background-color: rgb(242, 242, 242);
			border: 2px solid rgb(233, 233, 233);
			/* border-color: rgb(233, 233, 233); */
		}

		.card-violet {
			background-color: rgb(251, 246, 255);
			border: 2px solid rgb(225, 218, 232);
			/* border-color: rgb(225, 218, 232); */
		}

		.alert-sea {
			background-color: rgb(218, 255, 254);
			border: 1px solid rgb(110, 178, 178);
		}

		.alert-lime {
			background-color: rgb(180, 255, 179);
			border: 1px solid rgb(0, 124, 0);
		}

		.alert-yellow {
			background-color: rgb(255, 250, 219);
			border: 1px solid rgb(255, 217, 28);
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
						<a href="golden_ratio.php?branch=<?php echo $_GET['branch']; ?>" class="nav-link text-dark"><img src="../images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
					</li>
					<li class="nav-item" role="presentation">
						<a href="future_account_comparison.php?branch=<?php echo $_GET['branch']; ?>" class="nav-link active"><img src="../images/icons/Light/Light/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="card mt-10 border-0 p-3">
			<h5>Future Account Comparison</h5>
			<div class="card border-0 p-1 background-Planning" id="profit_sensitivity">
			
			</div>
			<div class="card border-0" style="background-color: rgb(250, 253, 255);">
				<div class="row">
					<div class="col-9">
						<div class="col-12 py-1 px-2">
							<div class="row py-1" style="background-color: #dee2e6;border-radius:2px;">
								<div class="col-8 d-flex" id="show_filter">
								</div>
								<div class="col-4 d-flex justify-content-end">
									<!-- <div class="btn-group">
										<button type="button" class="btn btn-sm btn-outline-secondary py-0" onclick="load_month()">Month</button>
										<button type="button" class="btn btn-sm btn-secondary py-0" onclick="load_annual()">Annual</button>
										<button type="button" class="btn btn-sm btn-outline-secondary py-0" onclick="load_comparison()">Comparison</button>
									</div> -->
									<div class="btn-group btn-group-sm" role="group">
										<input type="radio" class="btn-check" name="graph_type" id="Annual" autocomplete="off" value="1" checked>
										<label class="btn btn-outline-secondary py-0" for="Annual">Annual</label>

										<input type="radio" class="btn-check" name="graph_type" id="Accumulate" autocomplete="off" value="2">
										<label class="btn btn-outline-secondary py-0" for="Accumulate">Accumulate</label>

										<input type="radio" class="btn-check" name="graph_type" id="Comparison" autocomplete="off" value="3">
										<label class="btn btn-outline-secondary py-0" for="Comparison">Monthly</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-3">
						<div class="col-12 py-1 px-2">
							<div class="row py-1 px-2" style="background-color: #dee2e6;border-radius:2px;">
								Future & Business Competitiveness Rank
							</div>
						</div>
					</div>
				</div>

				<div id="show_data">

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
			url: 'ajax/future_account_comparison/get_filter.php',
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
				var url = 'ajax/future_account_comparison/get_data_annual.php';
			} else if (checkedRadio.val() == 2) {
				var url = 'ajax/future_account_comparison/get_data_accumulate.php';
			} else if (checkedRadio.val() == 3) {
				var url = 'ajax/future_account_comparison/get_data_comparison.php';
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
			url: "ajax/future_account_comparison/get_profit_sensitivity.php",
			type: 'POST',
			dataType: 'html',
			data: {
				rate: rate,
				start_year: start_year,
				start_month: start_month,
				branchId: branchId
			},
			success: function(response) {
				Swal.close();
				$('#profit_sensitivity').html(response);
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