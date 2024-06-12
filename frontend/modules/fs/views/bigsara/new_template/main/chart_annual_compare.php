<html>

<title>Annual comparison</title>

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
</Head>

<body class="background-Planning">
	<div class="col-12">
		<div class="col-12 alert ">
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
				<div class="alert alert2-secondary3">
					<div class="row">
						<div class="col-lg-2 col-12 pl-0">
							<div class="row">
								<div class="col-2 ">
									<span class="badge bg-primary-summary">PL</span>
								</div>
								<div class="col-10">
									Profit & Loss Forecast
								</div>
							</div>
						</div>
						<div class="col-lg-10 col-12 text-end pr-0">
							<button type="button" class="btn btn-light text-primary font-size-12" data-bs-toggle="modal" data-bs-target="#DataDistionary">
								<i class="fa fa-info-circle" aria-hidden="true"></i> Data Dictionary
							</button>
							<div class="btn-group ml-15 " role="group">
								<a href="annual_graph.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">
									<i class="fa fa-bar-chart" aria-hidden="true"></i>
								</a>
								<a type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">
									Performance Chart
								</a>
								<a href="chart_ipl_analysis.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">IPL Analysis</a>
								<a href="chart_annual_compare.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-primary font-size-12" style="border-color:blue;">PLF Overview</a>
							</div>
						</div>

					</div>
					<div class="col-12 mt-15">
						<div class="row " style="background-color: #dee2e6;border-radius:2px;">
							<div class="col-1 font-b font-size-13 pt-5">
								PL Content
							</div>
							<div class="col-1 text-secondary pl-5 pr-2 pt-3">
								<img src="../image/calendar.png" style="width: 13px;"> &nbsp;
								<span class="font-size-12">Current Year</span>
							</div>
							<div class="col-2 pt-3 pb-3" id="show_year">
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 10px;">
						<div class="d-flex justify-content-start font-size-14 text-primary float-start">
							<a href="fs_index.php?branch=<?php echo $_GET['branch']; ?>" class="no-underline-primary font-size-13">
								<i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table
							</a>
						</div>
						<div class="d-flex justify-content-center font-size-16">
							<strong>Annual Comparison Chart</strong>
						</div>
					</div>

				</div>

				<div id="show_data"></div>

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
			url: 'ajax/chart_annual_compare/get_year.php',
			type: 'POST',
			dataType: 'html',
			data: {
				branchId: branchId,
				start_year: start_year_url
			},
			success: function(data) {
				Swal.close();
				$('#show_year').html(data);
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
		let start_year = $("#start_year").val();
		let rate = $("#rate").val();
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
			url: 'ajax/chart_annual_compare/get_data.php',
			type: 'POST',
			dataType: 'html',
			data: {
				start_year: start_year,
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