<table>
	<tr>
		<td>Layer</td>
		<td>Department</td>
	</tr>
	<?php
	$i = 0;
	while ($i < 500) { ?>
		<tr>
			<td><?= isset($layers[$i]) ? $layers[$i]["layerName"] : '' ?></td>
			<td><?= isset($departments[$i]) ? $departments[$i] : '' ?></td>
		</tr>
	<?php
		$i++;
	}
	?>
</table>