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
			<td><?= isset($titles[$i]) ? $titles[$i]["titleName"] : '' ?></td>
			<td><?= isset($employeeCondition[$i]) ? $employeeCondition[$i]["employeeConditionName"] : '' ?></td>
			<td><?= isset($rights[$i]) ? $rights[$i]["roleName"] : '' ?></td>
			<td><?= isset($gender[$i]) ? $gender[$i] : '' ?></td>
		</tr>
	<?php
		$i++;
	}
	?>
</table>