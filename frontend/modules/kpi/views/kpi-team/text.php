<div class="col-12 mt-70 pt-20 pim-content1">
	<?php
	if (count($dataKPI) > 0) { ?>
		<p><b>Some Kpi History status not update</b></p>
		<table class="table">
			<thead>
				<tr>
					<th>kpiId</th>
					<th>kpiHistoryId</th>
					<th>Master Month</th>
					<th>Month</th>
					<th>Master Year</th>
					<th>Year</th>
					<th>Kpi Status</th>
					<th>kpiHistory Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($dataKPI) > 0) {
					foreach ($dataKPI as $history): ?>
						<tr>
							<td><?= $history["kpiId"] ?></td>
							<td><?= $history["kpiHistoryId"] ?></td>
							<td><?= $history["cMonth"] ?></td>
							<td><?= $history["month"] ?></td>
							<td><?= $history["cYear"] ?></td>
							<td><?= $history["year"] ?></td>
							<td><?= $history["kpiStatus"] ?></td>
							<td><?= $history["kpiHistoryStatus"] ?></td>
						</tr>
				<?php

					endforeach;
				}
				?>
			</tbody>
		</table>
	<?php
	}

	if (count($dataKpiTeam) > 0) { ?>
		<p><b>Some Kpi Team don't same with master KPI</b></p>
		<table class="table">
			<thead>
				<tr>
					<th>kpiId</th>
					<th>kpiHistoryId</th>
					<th>Master Month</th>
					<th>Month</th>
					<th>Master Year</th>
					<th>Year</th>
					<th>Kpi Status</th>
					<th>kpiHistory Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($dataKpiTeam) > 0) {
					foreach ($dataKpiTeam as $kpiTeam): ?>
						<tr>
							<td><?= $kpiTeam["kpiId"] ?></td>
							<td><?= $kpiTeam["kpiTeamId"] ?></td>
							<td><?= $kpiTeam["cMonth"] ?></td>
							<td><?= $kpiTeam["month"] ?></td>
							<td><?= $kpiTeam["cYear"] ?></td>
							<td><?= $kpiTeam["year"] ?></td>
							<td><?= $kpiTeam["kpiStatus"] ?></td>
							<td><?= $kpiTeam["kpiHistoryStatus"] ?></td>
						</tr>
				<?php

					endforeach;
				}
				?>
			</tbody>
		</table>
	<?php
	}
	if (count($dataKpiEmployee) > 0) { ?>
		<p><b>Some Kpi Employee don't same with master KPI</b></p>
		<table class="table">
			<thead>
				<tr>
					<th>kpiId</th>
					<th>kpiHistoryId</th>
					<th>Master Month</th>
					<th>Month</th>
					<th>Master Year</th>
					<th>Year</th>
					<th>Kpi Status</th>
					<th>kpiHistory Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($dataKpiEmployee) > 0) {
					foreach ($dataKpiEmployee as $kpiEmployee): ?>
						<tr>
							<td><?= $kpiEmployee["kpiId"] ?></td>
							<td><?= $kpiEmployee["kpiEmployeeId"] ?></td>
							<td><?= $kpiEmployee["cMonth"] ?></td>
							<td><?= $kpiEmployee["month"] ?></td>
							<td><?= $kpiEmployee["cYear"] ?></td>
							<td><?= $kpiEmployee["year"] ?></td>
							<td><?= $kpiEmployee["kpiStatus"] ?></td>
							<td><?= $kpiEmployee["kpiHistoryStatus"] ?></td>
						</tr>
				<?php

					endforeach;
				}
				?>
			</tbody>
		</table>
	<?php
	}

	if (count($dataKGI) > 0) { ?>
		<p><b>Some Kgi History status not update</b></p>
		<table class="table">
			<thead>
				<tr>
					<th>kgiId</th>
					<th>kgiHistoryId</th>
					<th>Master Month</th>
					<th>Month</th>
					<th>Master Year</th>
					<th>Year</th>
					<th>Kgi Status</th>
					<th>kgiHistory Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($dataKGI) > 0) {
					foreach ($dataKGI as $history): ?>
						<tr>
							<td><?= $history["kgiId"] ?></td>
							<td><?= $history["kgiHistoryId"] ?></td>
							<td><?= $history["cMonth"] ?></td>
							<td><?= $history["month"] ?></td>
							<td><?= $history["cYear"] ?></td>
							<td><?= $history["year"] ?></td>
							<td><?= $history["kgiStatus"] ?></td>
							<td><?= $history["kgiHistoryStatus"] ?></td>
						</tr>
				<?php

					endforeach;
				}
				?>
			</tbody>
		</table>
	<?php
	}

	if (count($dataKgiTeam) > 0) { ?>
		<p><b>Some Kgi Team don't same with master KGI</b></p>
		<table class="table">
			<thead>
				<tr>
					<th>kgiId</th>
					<th>kgiHistoryId</th>
					<th>Master Month</th>
					<th>Month</th>
					<th>Master Year</th>
					<th>Year</th>
					<th>Kgi Status</th>
					<th>kgiHistory Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($dataKgiTeam) > 0) {
					foreach ($dataKgiTeam as $kgiTeam): ?>
						<tr>
							<td><?= $kgiTeam["kgiId"] ?></td>
							<td><?= $kgiTeam["kgiTeamId"] ?></td>
							<td><?= $kgiTeam["cMonth"] ?></td>
							<td><?= $kgiTeam["month"] ?></td>
							<td><?= $kgiTeam["cYear"] ?></td>
							<td><?= $kgiTeam["year"] ?></td>
							<td><?= $kgiTeam["kgiStatus"] ?></td>
							<td><?= $kgiTeam["kgiHistoryStatus"] ?></td>
						</tr>
				<?php

					endforeach;
				}
				?>
			</tbody>
		</table>
	<?php
	}
	if (count($dataKgiEmployee) > 0) { ?>
		<p><b>Some Kgi Employee don't same with master KGI</b></p>
		<table class="table">
			<thead>
				<tr>
					<th>kgiId</th>
					<th>kgiHistoryId</th>
					<th>Master Month</th>
					<th>Month</th>
					<th>Master Year</th>
					<th>Year</th>
					<th>Kgi Status</th>
					<th>kgiHistory Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (count($dataKgiEmployee) > 0) {
					foreach ($dataKgiEmployee as $kgiEmployee): ?>
						<tr>
							<td><?= $kgiEmployee["kgiId"] ?></td>
							<td><?= $kgiEmployee["kgiEmployeeId"] ?></td>
							<td><?= $kgiEmployee["cMonth"] ?></td>
							<td><?= $kgiEmployee["month"] ?></td>
							<td><?= $kgiEmployee["cYear"] ?></td>
							<td><?= $kgiEmployee["year"] ?></td>
							<td><?= $kgiEmployee["kgiStatus"] ?></td>
							<td><?= $kgiEmployee["kgiHistoryStatus"] ?></td>
						</tr>
				<?php

					endforeach;
				}
				?>
			</tbody>
		</table>
	<?php
	}
	?>
</div>