<html>

<title>3 years Chart</title>

<Head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/pl.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="../css/chart.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
	<!-- C3 -->
	<!-- <link href="../template/css/plugins/c3/c3.min.css" rel="stylesheet"> -->
	<!-- <link href="https://unpkg.com/c3/c3.min.css" rel="stylesheet"> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

	<style>
		.line {
			width: 40%;
			/* border-bottom: 4px solid rgba(255, 99, 132, 1); */
			position: absolute;
			margin-top: 0.5rem;
		}

		.dashed {
			width: 40%;
			/* border-bottom: 4px dashed rgba(255, 99, 132, 1); */
			position: absolute;
			margin-top: 0.5rem;
		}

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
			/* background-color: #f0f0f0; */
			/* Add margin between items */
		}

		#chart-container {
			width: 100%;
			/* or specify a fixed width */
			height: 400px;
			/* or specify a fixed height */
		}
	</style>

</Head>

<body class="background-Planning">
	<div class="col-12">
		<div class="col-12 alert ">
			<div class="row">
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
				<div class="col-12 mt-5">
					<div class="alert alert2-secondary3">
						<div class="row">
							<div class="col-lg-2 col-12">
								<div class="row">
									<div class="col-2 ">
										<span class="badge bg-primary-summary">PL</span>
									</div>
									<div class="col-10">
										Profit & Loss Forecast
									</div>
								</div>
							</div>
							<div class="col-lg-10 col-12 text-end ">
								<button type="button" class="btn btn-light text-primary font-size-12" data-bs-toggle="modal" data-bs-target="#DataDistionary">
									<i class="fa fa-info-circle" aria-hidden="true"></i> Data Dictionary
								</button>
								<div class="btn-group ml-15 " role="group">
									<a href="annual_graph.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-primary font-size-12" style="border-color:blue;">
										<i class="fa fa-bar-chart" aria-hidden="true"></i>
									</a>
									<a type="button" class="btn btn-outline-secondary font-size-12" style="border-left: 0;border-color:lightgray;">
										Performance Chart
									</a>
									<a href="chart_ipl_analysis.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">IPL Analysis</a>
									<a href="chart_annual_compare.php?branch=<?php echo $_GET['branch']; ?>" type="button" class="btn btn-outline-secondary font-size-12" style="border-color:lightgray;">PLF Overview</a>
								</div>
							</div>
						</div>
						<div class="alert-secondary secondary-CurrentYear mt-10">
							<div class="row">
								<div class="col-6">
									<div class="row">
										<div class="col-4 text-secondary pb-6">
											<div class="row">
												<div class="col-6 pt-8 pl-18 pr-0 font-size-12">
													<img src="../image/calendar.png" style="width: 13px;">
													Year
												</div>
												<div class="col-6 pt-5 pl-0" id="show_year">
												</div>
											</div>
										</div>
										<div class="col-4 text-secondary">
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
								<div class="col-6 text-secondary text-end pt-8 font-size-12 pr-20">
									<strong> F.Y. 2023 (Annual)</strong>
								</div>
							</div>
						</div>
						<div class="row mt-15">
							<div class="col-lg-9">
								<div class="col-12 text-primary">
									<a href="fs_index.php?branch=<?php echo $_GET['branch']; ?>" class="no-underline-primary font-size-13"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Data Table</a>
								</div>
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

					</div>
				</div>
				<div class="col-12 mt-5">
					<div class="card" id="card_chart">
						<canvas id="myChart"></canvas>
					</div>
					<div class="row mt-10 text-center">
						<div>
							<button type="button" class="btn btn-primary" onclick="getChart()">Generate</button>
						</div>
					</div>

					<div class="row">
						<?php
						$categories = array(
							"Sales",
							"Variable Expense",
							"Labor Cost",
							"Fixed Expense (Other)",
							"Non-Operating Income",
							"Non-Operating Expense",
							"Interest and Devident Income",
							"Interest Expense"
						);

						$colors = array(
							'rgba(255, 99, 132, 1)', // Red
							'rgba(54, 162, 235, 1)', // Blue
							'rgba(255, 206, 86, 1)', // Yellow
							'rgba(75, 192, 192, 1)', // Green
							'rgba(153, 102, 255, 1)', // Purple
							'rgba(255, 159, 64, 1)', // Orange
							'rgba(255, 0, 255, 1)', // Magenta
							'rgba(255, 99, 132, 1)'
						);

						for ($i = 0; $i < 8; $i++) {
						?>

							<div class="col-3">
								<div class="card">
									<div class="card-header bg-104">
										<div class="row">
											<div class="col">
												<?php echo $categories[$i]; ?>
											</div>
											<div class="col-2 text-end">
												<input type="checkbox" name="breakdown_index[]" id="breakdown_index<?php echo $i; ?>" value=<?php echo $i; ?> checked>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-6">
												Actual
											</div>
											<div class="col-6">
												<div class="line" style="border-bottom: 4px solid <?php echo $colors[$i]; ?>;"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												Forecasted
											</div>
											<div class="col-6">
												<div class="dashed" style="border-bottom: 4px dashed <?php echo $colors[$i]; ?>;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>



				<!-- <div class="col-12 mt-5">
						<div class="scroll-container col-lg-12">

							<?php
							$categories = array(
								"Sales",
								"Variable Expense",
								"Labor Cost",
								"Fixed Expense (Other)",
								"Non-Operating Income",
								"Non-Operating Expense",
								"Interest and Devident Income",
								"Interest Expense"
							);

							$colors = array(
								'rgba(255, 99, 132, 1)', // Red
								'rgba(54, 162, 235, 1)', // Blue
								'rgba(255, 206, 86, 1)', // Yellow
								'rgba(75, 192, 192, 1)', // Green
								'rgba(153, 102, 255, 1)', // Purple
								'rgba(255, 159, 64, 1)', // Orange
								'rgba(255, 0, 255, 1)', // Magenta
								'rgba(255, 99, 132, 1)'
							);

							for ($i = 0; $i < 8; $i++) {
							?>

								<div class="card scroll-content col-3 p-0">
									<div class="card-header bg-104">
										<div class="row">
											<div class="col">
												<?php echo $categories[$i]; ?>
											</div>
											<div class="col text-end">
												<input type="checkbox" name="<?php echo $categories[$i]; ?>" id="<?php echo $categories[$i]; ?>" checked>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-6">
												Actual
											</div>
											<div class="col-6">
												<div class="line" style="border-bottom: 4px solid <?php echo $colors[$i]; ?>;"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-6">
												Forecasted
											</div>
											<div class="col-6">
												<div class="dashed" style="border-bottom: 4px dashed <?php echo $colors[$i]; ?>;"></div>
											</div>
										</div>
									</div>
								</div>

							<?php
							}
							?>

						</div>
					</div> -->

			</div>

		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

	<!-- Chart c3-->
	<!-- <script src="../template/js/plugins/d3/d3.min.js"></script> -->
	<!-- <script src="../template/js/plugins/c3/c3.min.js"></script> -->
	<!-- <script src="https://unpkg.com/c3"></script>
	<script src="https://d3js.org/d3.v7.min.js"></script> -->

	<!-- ChartJS-->
	<!-- <script src="../template/js/plugins/chartJs/Chart.min.js"></script> -->
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

		function handler(chart) {
			chart.options.plugins.legend.position = 'bottom';
			chart.update();
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
				url: 'ajax/annual_graph_test/get_year.php',
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

			var breakdown_index = $('input[name="breakdown_index[]"]:checked').map(function() {
				return $(this).val();
			}).get();

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
				url: 'ajax/annual_graph_test/get_annual_graph.php',
				type: 'POST',
				dataType: 'json',
				data: {
					start_year: start_year,
					branchId: branchId,
					rate: rate,
				},
				success: function(data) {
					console.log(data);
					Swal.close();

					var array_data = data;

					// console.log(array_data);

					xAxisArray = array_data[0]['data'];
					// console.log(xAxisArray);

					const colors = [
						'rgba(255, 99, 132, 1)', // Red
						'rgba(54, 162, 235, 1)', // Blue
						'rgba(255, 206, 86, 1)', // Yellow
						'rgba(75, 192, 192, 1)', // Green
						'rgba(153, 102, 255, 1)', // Purple
						'rgba(255, 159, 64, 1)', // Orange
						'rgba(255, 0, 255, 1)', // Magenta
						'rgba(255, 99, 132, 1)'
					];

					var datasets = [];
					var datasets_budget = [];

					breakdown_index.forEach((indexString, i) => {
						breakdown_index[i] = parseInt(indexString) + 1;

						var index = breakdown_index[i];

						datasets.push({
							label: array_data[index]['data'][0],
							data: array_data[index]['data'].slice(1),
							borderColor: colors[index - 1],
							backgroundColor: colors[index - 1],
							borderWidth: 1
						});

						datasets_budget.push({
							label: array_data[index]['data_budget'][0],
							data: array_data[index]['data_budget'].slice(1),
							borderColor: colors[index - 1],
							borderWidth: 1,
							borderDash: [5] // Apply dashed border
						});
					});

					var combinedDatasets = datasets.concat(datasets_budget);

					var ctx = document.getElementById('myChart').getContext('2d');
					let myChartchk = Chart.getChart('myChart');

					if (myChartchk != undefined) {
						myChartchk.destroy();
					}
					// Create the chart
					var myChart = new Chart(ctx, {

						type: 'line',
						data: {
							labels: xAxisArray,
							datasets: combinedDatasets
						},
						options: {
							responsive: true,
							maintainAspectRatio: false,
							plugins: {
								legend: {
									position: 'bottom',
									display: false
								},
								title: {
									display: true,
									text: 'Annual Chart ' + start_year
								}
							},
							interaction: {
								mode: 'index',
								intersect: false,
							},

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
	</script>