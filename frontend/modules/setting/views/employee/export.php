<table>
	<tr>
		<td>Company</td>
		<td>Branch</td>
		<td>Department</td>
		<td>Team</td>
		<td>TeamPosition</td>
		<td>Title</td>
		<td>Employee Condition</td>
		<td>Right</td>
		<td>Gender</td>
		<td>Language</td>
	</tr>
	<?php
	$i = 0;
	while ($i < 500) { ?>
		<tr>
			<td><?= isset($companies[$i]) ? $companies[$i]["companyName"] : '' ?></td>
			<td><?= isset($branches[$i]) ? $branches[$i]["branchName"] : '' ?></td>
			<td><?= isset($departments[$i]) ? $departments[$i]["departmentName"] : '' ?></td>
			<td><?= isset($teams[$i]) ? $teams[$i]["teamName"] : '' ?></td>
			<td><?= isset($teamPositions[$i]) ? $teamPositions[$i]["teamPositionName"] : '' ?></td>
			<td>
				<?php
				if (isset($titles[$i])) {
					$textTitle = $titles[$i]["titleName"] . ':' . $titles[$i]["departmentName"];
				} else {
					$textTitle = "";
				}
				?>
				<?= $textTitle ?>
			</td>
			<td><?= isset($employeeCondition[$i]) ? $employeeCondition[$i]["employeeConditionName"] : '' ?></td>
			<td><?= isset($rights[$i]) ? $rights[$i]["roleName"] : '' ?></td>
			<td><?= isset($gender[$i]) ? $gender[$i] : '' ?></td>
			<td><?= isset($language[$i]) ? $language[$i]['name'] : '' ?></td>
		</tr>
	<?php
		$i++;
	}
	?>
</table>