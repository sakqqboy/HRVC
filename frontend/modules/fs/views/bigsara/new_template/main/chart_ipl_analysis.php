<html>

<title>Ipl analysis</title>

<Head>
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
								<a href="chart_ipl_analysis.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-primary font-size-12" style="border-color:blue;">IPL Analysis</a>
								<a href="chart_annual_compare.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-secondary font-size-12" style="border-left: 0;border-color:lightgray;">PLF Overview</a>
							</div>
						</div>

					</div>
					<div class="row mt-10">
						<div class="col-lg-2 col-12 pl-0">
							<div class="col-12 alert-secondary secondary-CurrentYear font-b font-size-12 mb-15 pt-8 pr-10 pb-10 pl-15">
								PL Content
							</div>

							<?php
							$categories = ["Sales", "Variable Expense", "Gross Profit (or Loss)", "Labor Cost", "Fixed Expense (Other)", "Fixed Expense", "Operating Profit (or Loss)", "Non-Operating Income", "Non-Operating Expense", "Ordinary Profit (or Loss)", "Break-Even Sales", "Marginal Profit Ratio"];

							$i = 0;
							foreach ($categories as $value) {
							?>
								<div class="breakdown p-1 mb-10 <?php echo $i == 0 ? ' border border-primary' : ''; ?>" style="background-color: lightgray;cursor: pointer;" id="div_breakdown_<?php echo $i; ?>" onclick="check_breakdown(<?php echo $i; ?>);">
									<div class="row">
										<div class="col-10 pl-20">
											<?php echo $value; ?>
										</div>
										<div class="col-2 pr-20 text-center">
											<input class="form-check-input" type="radio" id="breakdown_index_<?php echo $i; ?>" name="breakdown_index" value="<?php echo $i; ?>" style="border-radius: 100%;" <?php echo $i == 0 ? 'checked' : ''; ?>>
										</div>
									</div>
								</div>
							<?php
								$i++;
							}
							?>

						</div>
						<div class="col-lg-10 col-12 pr-0 pl-0">
							<div class="col-12 pl-10 pr-0 alert-secondary secondary-CurrentYear">
								<div class="row">
									<div class="col-3 text-secondary pb-6">
										<div class="row">
											<div class="col-6 pt-8 pl-18 pr-0 font-size-12">
												<img src="../image/calendar.png" style="width: 13px;">
												Current Year
											</div>
											<div class="col-6 pt-5 pl-0" id="show_year">

											</div>
										</div>
									</div>
									<div class="col-3 text-secondary">
										<div class="row">
											<div class="col-6 pt-8 pl-18 pr-10 font-size-12 text-end">
												<img src="../image/roundup.png"> Round Up
											</div>
											<div class="col-6 pt-5 pl-0">
												<select class="form-select text-primary" style="height: 25px;font-size:10px;" id="rate" name="rate" onchange="getChart()">
													<option value="1">Normal</option>
													<option value="1000">Thousand</option>
													<option value="1000000">Million</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row mt-10">
								<div class="col-lg-3 text-primary">
									<a href="fs_index.php?branch=<?php echo $_GET['branch']; ?>" class="no-underline-primary font-size-13"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table</a>
								</div>
								<div class="col font-size-16 text-center">
									<strong> Individual P&L Analysis</strong>
								</div>
								<div class="col-lg-3 text-end">
									<a href="" class="button-link border-buttom pb-5 bg-light no-underline-black ">
										<img src="../image/ca-1.png" style="width: 30px;">
									</a>
									<a href="" class="button-link border-buttom pb-5 no-underline-black ml-5">
										<img src="../image/network.png">
									</a>
								</div>
							</div>
							<div class="col-12">
								<div class="col-12" style="height: 350px;" id="show_chart">
									<canvas id="mixed_chart"></canvas>
								</div>
							</div>
							<div class="col-12">
								<div class="alert light-shadow-2" role="alert">
									<div class="row">
										<div class="col-lg-3" onclick="check_graph('current');">
											<div class="light-shadow-3 pt-3 pb-5 pl-10 pr-10">
												<div class="row">
													<div class="col-9 pt-5 font-size-14 font-b">
														Current Year-2022
													</div>
													<div class="col-3 text-end pt-5">
														<input type="checkbox" checked name="current" id="current">
													</div>
												</div>
											</div>
											<div class="mt-5 bg-white pt-5 pl-5 pr-3 pb-10" style="border:none;">
												<div class="row font-size-12">
													<div class="col-7 pl-20 pt-8">
														Actual
													</div>
													<div class="col-5">
														<div class="col-12 pt-8 text-center">
															<button type="button" class="example-iplAnalysis1"></button>
														</div>
													</div>
													<div class="col-7 pl-20 pt-10">
														Target
													</div>
													<div class="col-5 pt-10">
														<div class="col-12 text-center">
															<button type="button" class="example-iplAnalysis2"></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3" onclick="check_graph('previous');">
											<div class="light-shadow-3 pt-3 pb-5 pl-10 pr-10">
												<div class="row">
													<div class="col-9 pt-5 font-size-14 font-b">
														Previous Year
													</div>
													<div class="col-3 text-end pt-5">
														<input type="checkbox" checked name="previous" id="previous">
													</div>
												</div>
											</div>
											<div class="mt-5 bg-white pt-5 pl-5 pr-3 pb-10" style="border:none; min-height:73px;">
												<div class="row font-size-12">
													<div class="col-7 pl-20 pt-8">
														Actual
													</div>
													<div class="col-5">
														<a href=""> <img src="../image/graphlinechart.png" class="graph-linechart"></a>

													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3" onclick="check_graph('forecasted');">
											<div class="light-shadow-3 pt-3 pb-5 pl-10 pr-10">
												<div class="row">
													<div class="col-9 pt-5 font-size-14 font-b">
														Forecasted Year
													</div>
													<div class="col-3 text-end pt-5">
														<input type="checkbox" checked name="forecasted" id="forecasted">
													</div>
												</div>
											</div>
											<div class="mt-5 bg-white pt-5 pl-5 pr-3 pb-10" style="border:none; min-height:73px;">
												<div class="row font-size-12">
													<div class="col-5 pl-20 pt-8">
														Target
													</div>
													<div class="col-7 pt-8">
														<button type="button" class="examplebox-red"></button>
														<button type="button" class="examplebox-red"></button>
														<button type="button" class="examplebox-red"></button>
														<button type="button" class="examplebox-red"></button>
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
							<img src="../images/icons/Dark/48px/Accumulated.png" class="Dark_Monthly"> Accumulate
						</div>
						<div class="col-6 Accumulate_text">
							<img src="../images/icons/Dark/48px/Monthly.png" class="Dark_Monthly"> Monthly
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
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
			url: 'ajax/chart_ipl_analysis/get_year.php',
			type: 'POST',
			dataType: 'html',
			data: {
				branchId: branchId,
				start_year: start_year_url
			},
			success: function(data) {
				Swal.close();
				$('#show_year').html(data);
				getChart();
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

	function getChart() {

		var start_year = $('#start_year').val();
		var rate = $('#rate').val();
		var breakdown_index = parseInt($("input[name='breakdown_index']:checked").val());

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
			url: 'ajax/chart_ipl_analysis/get_data.php',
			type: 'POST',
			dataType: 'json',
			data: {
				start_year: start_year,
				branchId: branchId,
				rate: rate,
				breakdown_index: breakdown_index
			},
			success: function(data) {

				Swal.close();
				var array_data = data;
				var array_datasets = [];

				if ($('#previous').is(':checked')) {
					array_datasets.push({
						label: "Actual of Previous Year",
						type: "line",
						data: array_data.last_actual_amount,
						fill: true,
						borderColor: "#008BF0",
						tension: 0.4
					});
				}

				if ($('#forecasted').is(':checked')) {
					array_datasets.push({
						label: "Target of Forcasted Year",
						type: "line",
						data: array_data.next_target_amount,
						fill: false,
						backgroundColor: "transparent",
						borderColor: "red", ///แดง/
						borderDash: [4, 4],
						tension: 0.4
					});
				}

				if ($('#current').is(':checked')) {
					array_datasets.push({
						type: "bar",
						label: "Actual of Current Year",
						data: array_data.actual_amount,
						backgroundColor: "#A9EC9F", //เขียวอ่อน///
					}, {
						type: "bar",
						label: "Target of Current Year",
						data: array_data.target_amount,
						backgroundColor: "#01724E", //เขียวเข้ม//
						backgroundColorHover: "#3e95cd"
					});
				}

				var data = {
					labels: array_data.monthName,
					datasets: array_datasets
				};

				$('#mixed_chart').remove();
				$('#show_chart').append('<canvas id="mixed_chart"><canvas>');
				var ctx2 = document.getElementById("mixed_chart").getContext("2d");
				new Chart(ctx2, {
					type: 'scatter',
					data: data,
					options: {
						scales: {
							y: {
								beginAtZero: true
							}
						},
						legend: {
							display: false
						},
						responsive: true,
						maintainAspectRatio: false,
					}
				});
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

	function check_breakdown(breakdown_index) {
		$('#breakdown_index_' + breakdown_index).prop('checked', true);
		$(".breakdown").removeClass("border border-primary");
		$('#div_breakdown_' + breakdown_index).addClass("border border-primary");

		getChart();
	}

	function check_graph(type) {
		if ($('#' + type).is(':checked')) {
			$('#' + type).prop('checked', false);
		} else {
			$('#' + type).prop('checked', true);
		}
		getChart();
	}
</script>