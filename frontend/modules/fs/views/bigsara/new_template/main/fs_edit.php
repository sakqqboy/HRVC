<?php
include("../config/main_function.php");

if (checkUser($_SESSION["__id"]) == 0) {
	echo "<script>alert('Session expired. Please log in again.'); location.href = 'https://bigsara-fordev.com/tokyo_new/new_template/';</script>";
}

if (checkBranch($_GET['branch'], $_SESSION["__id"]) == 0) {
	echo "<script>alert('You do not have permission to access this page.  Please log in again.'); location.href = 'https://bigsara-fordev.com/tokyo_new/new_template/';</script>";
}
?>

<html>

<title>Financial Planning view</title>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/pl.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">

	<style>
		.scroll-container {
			overflow-x: auto;
			/* width: 100%; */
			/* Adjust this width as needed */
			white-space: nowrap;
			padding-bottom: 1%;
		}

		.scroll-content {
			display: inline-block;
			/* Set height of content items */
			background-color: #f0f0f0;
			/* Add margin between items */
		}
	</style>
</head>


<body class="background-Planning">

	<div class="col-12">
		<div class="col-12 alert background-Planning">
			<div class="row">
				<div class="col-6 planning d-flex">
					<div>
						<a href="fs_data.php?branch=<?php echo $_GET['branch']; ?>&&breakdown=<?php echo $_GET['breakdown']; ?>&&start_year=<?php echo $_GET['start_year']; ?>" class="text-dark text-decoration-none">
							< Back </a>
					</div>
					<div class="ms-4 fw-bolder" style="cursor: pointer;" onclick="window.location.href='https://bigsara-fordev.com/tokyo_new/new_template/main/index.php'">
						<img src="../images/icons/Dark/48px/FinanicalPlanning.png" class="images_Dark_FinanicalPlanning">
						Financial Planning
					</div>
				</div>
				<div class="col-6 d-flex justify-content-end align-content-center" id="show_branch">

				</div>
			</div>
			<div class="col-12 mt-10">
				<div class="shadow pb-5 pt-5 mb-5 bg-body rounded alert2-secondary3">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a href="index.php" class="nav-link active"><img src="../images/icons/Light/Light/48px/PL-Forecast.png" class="images_performance_PL"> PL Forcast</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="golden_ratio.php?branch=<?php echo $_GET['branch']; ?>" class="nav-link text-dark"><img src="../images/icons/Dark/48px/Golden-Ratio.png" class="images_performance_PL"> Golden Ratio</a>
						</li>
						<li class="nav-item" role="presentation">
							<a href="future_account_comparison.php?branch=<?php echo $_GET['branch']; ?>" class="nav-link text-dark"><img src="../images/icons/Dark/48px/Designation-1.png" class="images_performance_PL"> Forecast Accounts</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="col-12 mt-15">
				<div class="alert alert2-secondary3 pr-5">
					<!-- <ol class="breadcrumb">
						<li class="breadcrumb-item ">
							<a class="text-dark text-decoration-none" href="index.php">Dashboard</a>
						</li>
						<li class="breadcrumb-item">
							<a class="text-dark text-decoration-none" href="fs_index.php?branch=<?php echo $_GET['branch']; ?>">PL Portal Summary</a>
						</li>
						<li class="breadcrumb-item">
							<a class="text-dark text-decoration-none" href="fs_data.php?branch=<?php echo $_GET['branch']; ?>&&breakdown=<?php echo $_GET['breakdown']; ?>&&start_year=<?php echo $_GET['start_year']; ?>">PL Portal Data</a>
						</li>
						<li class="breadcrumb-item">
							<a class="text-dark text-decoration-none">PL Portal Edit</a>
						</li>
					</ol> -->
					<div class="row">
						<div class="row mb-5">
							<div class="col-2">
								<div class="row">
									<div class="col-2 ">
										<span class="badge bg-primary-summary">PL</span>
									</div>
									<div class="col-10">
										Profit & Loss Forecast
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<button class="btn btn-success pt-2 pb-2 font-size-12" onclick="downloadSample()"> <img src="../images/icons/Dark/48px/download-up.png" class="download-up_png"> Download Sample </button>
								<button type="button" class="btn btn-primary pb-2 pt-2 font-size-12" onclick="getModalImportData()"><img src="../images/icons/Dark/48px/import-white.png" class="download-up_png"> <span class="font-size-10"> IMPORT ACCOUNT </span></button>
							</div>
							<div class="col-3">
								<select class="form-select example-tok">
									<option selected value="">Select</option>
									<option value="1">Tokyo Consulting Group</option>
									<option value="2">Tokyo Consulting firm</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-4">
								<div class="row" style="background-color: #dee2e6;">
									<div class="col-2 text-secondary pl-5 pr-2 pt-5 text-end">
										<img src="../image/calendar.png" style="width: 13px;"> &nbsp;
										<span class="font-size-12">Year</span>
									</div>
									<div class="col pt-3 pb-3" id="show_year">

									</div>
									<div class="col text-secondary pl-5 pr-2 pt-5 text-end">
										<img src="../image/graphlinechart.png" style="width: 13px;"> &nbsp;
										<span class="font-size-12">Breakdown</span>
									</div>
									<div class="col-4 pt-3 pb-3" id="show_breakdown">

									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="row" style="background-color: #dee2e6;">
									<div class="col-12 font-size-11 text-end pt-2 pb-3" id="group_btn">
										<a class="btn btn-light font-size-9 no-border mr-5 font-b" onclick="showData('',this)">All</a>
										<a class="btn btn-outline-secondary font-size-9 no-border font-b" onclick="showData(1,this)">Q1</a>
										<a class="btn btn-outline-secondary font-size-9 no-border font-b" onclick="showData(2,this)">Q2</a>
										<a class="btn btn-outline-secondary font-size-9 no-border font-b" onclick="showData(3,this)">Q3</a>
										<a class="btn btn-outline-secondary font-size-9 no-border font-b" onclick="showData(4,this)">Q4</a>
									</div>
								</div>
							</div>
						</div>

						<div class="show" id="show_data"></div>
						<div class="show" id="show_data_q1" style="display: none;"></div>
						<div class="show" id="show_data_q2" style="display: none;"></div>
						<div class="show" id="show_data_q3" style="display: none;"></div>
						<div class="show" id="show_data_q4" style="display: none;"></div>
					</div>
				</div>
			</div>
		</div>

</body>

<div class="modal fade" id="Modalfitter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content modal-fitter">
			<div class="modal-header" style="border: none;">
				<div id="ModalfitterLabel">
					<img src="../images/icons/Dark/48px/FilterPlus.png" class="picture-FilterPlus-bonus"> <span class="Data_Filterfinancial1"> Data Filter</span>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="col-12 mt-20">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="Previous">
							<label class="form-check-label" for="flexCheckDefault">
								<span class="AC-Primary"> AC </span> &nbsp;&nbsp; <span class="font-size-14"> Previous
									Year Actual</span>
							</label>
						</div>
					</div>
					<div class="col-12 mt-20">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Previous">
							<label class="form-check-label" for="flexCheckDefault">
								<span class="AC-Success"> AC </span> &nbsp;&nbsp; <span class="font-size-14"> Current
									Year Actual</span>
							</label>
						</div>
					</div>
					<div class="col-12 mt-20">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Previous">
							<label class="form-check-label" for="flexCheckDefault">
								<span class="T-Warning"> T </span> &nbsp;&nbsp; <span class="font-size-14"> Current Year
									Target</span>
							</label>
						</div>
					</div>
					<div class="col-12 mt-20">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="Previous">
							<label class="form-check-label" for="flexCheckDefault">
								<span class="T-bule"> T </span> &nbsp;&nbsp; <span class="font-size-14">
									&nbsp;Next year
									Target</span>
							</label>
						</div>
					</div>
					<div class="text-Done" data-bs-dismiss="modal" aria-label="done">
						Done
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="DataDistionary" tabindex="-1" aria-labelledby="DataDistionaryLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content modal-DataDistionary">
			<div class="modal-header" style="border: none;">
				<div id="DataDistionaryLabel">
					Data Dictionary
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6 Accumulate_text">
						<img src="../images/icons/Dark/48px/Accumulated.png" class="Dark_Monthly">
						Accumulate
					</div>
					<div class="col-6 Accumulate_text">
						<img src="../images/icons/Dark/48px/Monthly.png" class="Dark_Monthly">
						Monthly
					</div>
					<hr class="mt-5">
				</div>
				<div class="row">
					<div class="col-4 text-end">
						<span class="AC-Primary"> AAR </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Accumulate Actual Ratio
					</div>
					<div class="col-4 text-end">
						<span class="AC-Success"> AAR </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Accumulate Actual Ratio
					</div>
					<div class="col-4 text-end">
						<span class="T-Warning"> AT </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Accumulate Target
					</div>
					<div class="col-4 text-end">
						<span class="T-Warning"> ATR </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Accumulate Target ratio
					</div>
					<div class="col-4 text-end">
						<span class="T-bule"> ATR </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Accumulate Target ratio
					</div>
					<hr>

					<div class="col-4 text-end">
						<span class="AC-Success"> AC </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Actual
					</div>
					<div class="col-4 text-end">
						<span class="T-Warning"> T </span>
					</div>
					<div class="col-8 AC-Accumulate">
						Actual
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="RoundUp" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropRoundUp" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="col-12 pt-20">
							<img src="../images/icons/Dark/48px/Round-Up.png" class="images_Round-Up"> <span class="text_Roundup">Round Up</span>
						</div>
					</div>
					<div class="col-lg-6 pt-10">
						<form>
							<input class="chosen-value" type="text" value="search" id="">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="staticBackdropCurrency" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelCurrency" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="container">
				<div class="modal-header">
					<div class="modal-title" id="staticBackdropLabel"> <span class="Currency_Conversion_Rate">Currency
							Conversion Rate</span> </div>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-5 col-md-6 col-6">
							<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
							<div class="select_picker">
								<div class="select_Fromplanning">
									<div class="set_fontFrom">From</div>
								</div>
								<div class="row">
									<select class="selectpicker mt-5" data-show-subtext="true" data-live-search="true">
										<option>John Smith</option>
										<option>Alex Johnson</option>
										<option>Kevin Warren</option>
										<option>Super Mario</option>
										<option>Allen Martinez</option>
										<option>Marvin Liberty</option>
									</select>

								</div>
							</div>
							<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
							<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
							<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
							<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js">
							</script>
						</div>
						<div class="col-lg-2 col-md-6 col-6">
							<div class="col-12 random_country">
								<i class="fa fa-exchange To_selectweight mt-2" aria-hidden="true"></i>
							</div>
						</div>
						<div class="col-lg-5 col-md-6 col-6">
							<div class="select_picker">
								<div class="select_Fromplanning">
									<div class="set_fontFrom">To</div>
								</div>
								<div class="row">
									<select class="selectpicker mt-5" data-show-subtext="true" data-live-search="true">
										<option>John Smith</option>
										<option>Alex Johnson</option>
										<option>Kevin Warren</option>
										<option>Super Mario</option>
										<option>Allen Martinez</option>
										<option>Marvin Liberty</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-30">
						<div class="col-lg-5 col-md-5 col-5">
							<div class="set_fontFrom">Mount</div>
							<input type="text" class="form-control mt-5 pb-2 pt-2" placeholder="1" disabled>
						</div>
						<div class="col-lg-2  col-md-5 col-5">
							<div class="col-12 random_country">
								<div class="To_selectweight">
									<img src="../image/rendom.png" class="images_random1 mt-5">
								</div>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-5">
							<div class="set_fontFrom">Set Amount</div>
							<input type="text" class="form-control mt-5 pb-2 pt-2" placeholder="115">
						</div>
					</div>
					<div class="col-12 result_country">
						1 BTH (฿) = 115 BDT (৳)
					</div>
					<div class="col-12 text-end">
						<button type="button" class="btn-convert border-0 pb-2 pt-2" data-bs-dismiss="modal" aria-label="submit">Convert</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalImportData" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div id="showModalImportData"></div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

</html>

<script src="../js/upload.js?v=<?= date("YmdHis"); ?>"></script>

<script>
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	const branchId = urlParams.get('branch');
	const breakdown_url = urlParams.get('breakdown');
	const start_year_url = urlParams.get('start_year');

	$(document).ready(function() {
		getBarnch();
		get_year();
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

	function get_year() {
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
			url: 'ajax/fs_data/get_year.php',
			type: 'POST',
			dataType: 'html',
			data: {
				branchId: branchId,
				start_year: start_year_url
			},
			success: function(data) {
				Swal.close();
				$('#show_year').html(data);
				getBreakdown();
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

	function getBreakdown() {
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
			url: 'ajax/fs_data/get_breakdown.php',
			type: 'POST',
			dataType: 'html',
			data: {
				branchId: branchId,
				breakdown_id: breakdown_url
			},
			success: function(data) {
				Swal.close();
				$('#show_breakdown').html(data);
				getLoadData();
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

	function getLoadData() {
		getData('');
		getData(1);
		getData(2);
		getData(3);
		getData(4);
	}

	function getData(quarter) {
		let start_year = $("#start_year").val();
		let breakdown_id = $("#breakdown_id").val();
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
			url: 'ajax/fs_edit/get_data.php',
			type: 'POST',
			dataType: 'html',
			data: {
				start_year: start_year,
				branchId: branchId,
				breakdown_id: breakdown_id,
				quarter: quarter
			},
			success: function(data) {
				Swal.close();
				if (quarter != '') {
					$("#show_data_q" + quarter).html(data);
				} else {
					$('#show_data').html(data);
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
					title: 'แจ้งเตือน !',
					text: "พบปัญหาการบันทึก กรุณาติดต่อผู้ดูแลระบบ" + msg,
					icon: 'error',
					showConfirmButton: false,
					timer: 1500
				});
			}
		});

	}

	function showData(quarter, button) {
		if (quarter != '') {
			$("#group_btn").find(".btn").removeClass("btn-light").addClass("btn-outline-secondary");
			$(button).removeClass("btn-outline-secondary").addClass("btn-light");
			$(".show").hide();
			$("#show_data_q" + quarter).show();
		} else {
			$("#group_btn").find(".btn").removeClass("btn-light").addClass("btn-outline-secondary");
			$(button).removeClass("btn-outline-secondary").addClass("btn-light");
			$(".show").hide();
			$("#show_data").show();
		}
	}

	function downloadSample() {
		let start_year = $("#start_year").val();
		let breakdown_id = $("#breakdown_id").val();
		window.open('ajax/fs_edit/export_excel.php?branch=' + branchId + '&&breakdown=' + breakdown_id + '&&year=' + start_year);
	}

	function getModalImportData() {
		let breakdown_id = $("#breakdown_id").val();
		$.ajax({
			beforeSend: function() {
				$("#modalImportData").modal("show");
				let loading = '<div class="text-center"><img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... LOADING ...</h5></div>';

				$('#showModalImportData').html(loading);

			},
			url: 'ajax/fs_edit/get_modal_import_data.php',
			type: 'POST',
			dataType: 'html',
			data: {
				branchId: branchId,
				breakdown_id: breakdown_id
			},
			cache: false,
			success: function(data) {
				$('#showModalImportData').html(data);
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

	function importPLData() {

		var formData = new FormData($("#form_ImportPLData")[0]);
		formData.append("branchId", branchId);

		Swal.fire({
			title: "Warning!!",
			text: "Please fill out the information completely.",
			icon: "warning"
		});

		Swal.fire({
			title: "Please confirm to complete the transaction.",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes"
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					beforeSend: function() {
						swal.fire({
							html: '<img src="../image/loading.gif" width="200px" height="200px" /><br/><h5 style="color:#93dbe9;">... UPLOADING ...</h5>',
							showConfirmButton: false,
							onRender: function() {
								$('.swal2-content').prepend(sweet_loader);
							}
						});
					},
					type: 'POST',
					url: 'ajax/fs_edit/import_data.php',
					data: formData,
					processData: false,
					contentType: false,
					// catch: false,
					dataType: 'json',
					success: function(data) {
						if (data.response == 0) {
							Swal.fire({
								icon: "error",
								title: "An error occurred !",
								text: "Please check the file.",
								showConfirmButton: false,
								timer: 1500
							}).then((data) => {
								// window.open("ajax/register_pl_data_add/ErrorFiles.xlsx", '_blank');
							});
						}
						if (data.response == 1) {
							Swal.fire({
								icon: "success",
								title: "Your work has been saved",
								showConfirmButton: false,
								timer: 1500
							}).then((data) => {
								location.reload();
							});
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
				})
			} else {
				return false;
			}
		});

	}

	function updateData(account_id, type, month, year, value, attr) {

		$.ajax({
			url: 'ajax/fs_edit/update_data.php',
			type: 'POST',
			dataType: 'json',
			data: {
				account_id: account_id,
				type: type,
				month: month,
				year: year,
				value: value
			},
			success: function(data) {
				if (data.result != 1) {
					Swal.fire({
						title: 'Error !',
						text: "There was a recording problem. Please contact the system administrator. ErrorCode[" + data.result + "]",
						icon: 'error',
						showConfirmButton: false,
						timer: 1500
					});
				} else {
					attr.val(parseFloat(value).toFixed(2));
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
</script>