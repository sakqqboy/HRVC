<div class="row">
	<div class="col-lg-9 col-md-6 col-12 detail-salary">
		<i class="fa fa-database" aria-hidden="true"></i> Salary & Allowance
	</div>
	<div class="col-lg-3 col-md-6 col-12 in-details">
		VIEW IN DETAILS
	</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-4 col-md-6 col-12 danger-details">
		<div class="row">
			<div class="col-6 pl-30 font-size-14">
				Currency
			</div>
			<div class="col-6 salary-bold">
				JPY (¥)
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Total Salary
			</div>
			<div class="col-6 pt-20 salary-bold">
				¥ 49,000,000
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Basic Salary
			</div>
			<div class="col-6 pt-20 salary-bold">
				¥ 48,000,000
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Transportation
			</div>
			<div class="col-6 pt-20 salary-bold">
				¥ 500,000
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Title Allowance
			</div>
			<div class="col-6 pt-20 salary-bold">
				¥ 300,000
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Qualification Allowance
			</div>
			<div class="col-6 pt-20 salary-bold">
				¥ 200,000
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Food Allowance
			</div>
			<div class="col-6 pt-20 salary-bold">
				N/A
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Other Allowance
			</div>
			<div class="col-6 pt-20 salary-bold">
				N/A
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Other Allowance
			</div>
			<div class="col-6 pt-20 salary-bold">
				N/A
			</div>
			<div class="col-6 pl-30 pt-20 font-size-14">
				Other Allowance
			</div>
			<div class="col-6 pt-20 salary-bold">
				N/A
			</div>
		</div>
	</div>
	<div class="col-lg-8 col-md-6 col-12 a-shadowbd">
		<div class="shadow p-3 bg-body rounded linechart0">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
			</script>

			<canvas id="sampleChart" style="height: 200px;"></canvas>
			<div id="output"> </div>
			<script>
				let output = document.getElementById('output');
				let canvas = document.getElementById("sampleChart");
				let line1Data = [9, 10, 12, 11, 11, 15, 12, 12, 12, 13, 19, 22, 31, 36, 39, 40, 41, 45, 50, 55, 59, 60];
				let line2Data = [0, 0, 10, 0, 0, 10, 0, 00, 50, 10, 15, 10, 11, 15, 9, 19, 12, 24, 10, 10];

				var xValues = ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th', '20th'];
				new Chart(canvas, {
					type: "line",
					data: {
						labels: xValues,
						datasets: [{
							borderColor: "red",
							pointBackgroundColor: "red",
							fill: false,
							data: line1Data,
							label: "Total Salary"


						}, {
							borderColor: "orange",
							pointBackgroundColor: "orange",
							fill: false,
							data: line2Data,
							lineTension: 0,
							label: "Increase Ratio"
						}]
					},
					options: {
						scales: {
							xAxes: [{
								ticks: {
									min: 0,
									max: 20
								}
							}],
							yAxes: [{
								ticks: {
									min: 0,
									max: 60
								}
							}],
						}
					},

				});
			</script>
		</div>
	</div>
</div>