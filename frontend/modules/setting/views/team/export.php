<table>
	<tr>
		<td>Department</td>
	</tr>
	<?php
	$i = 0;
	while ($i < 500) { ?>
		<tr>
			<td><?= isset($departments[$i]) ? $departments[$i] : '' ?></td>
		</tr>
	<?php
		$i++;
	}
	?>
</table>