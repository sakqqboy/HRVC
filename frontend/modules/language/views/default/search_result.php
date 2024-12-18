<table class="table table-striped ">
	<thead>
		<tr>
			<th>No.</th>
			<th>English</th>
			<th>Japanese</th>
			<th>Thai</th>
			<th>Chinese</th>
			<th>Vietnam</th>
			<th>Spanish</th>
			<th>Indonesian</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($languages) && count($languages) > 0) {
			$i = 1;
			foreach ($languages as $lang) : ?>
				<tr id="tran<?= $lang["translatorId"] ?>">
					<td><?= $i ?></td>
					<td><?= $lang["english"] ?></td>
					<td><?= $lang["japanese"] ?></td>
					<td><?= $lang["thai"] ?></td>
					<td><?= $lang["chinese"] ?></td>
					<td><?= $lang["vietnam"] ?></td>
					<td><?= $lang["spanish"] ?></td>
					<td><?= $lang["indonesian"] ?></td>
					<td class="text-center">
						<a href="<?= Yii::$app->homeUrl ?>language/default/update?translatorId=<?= $lang["translatorId"] ?>" class="btn btn-bg-white-xs">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							<!-- <img src="<?= Yii::$app->homeUrl ?>/images/icons/Settings/refresh-black.svg" class="pim-icon" style="margin-top: -1px;"> -->
						</a>
						<a class="btn btn-bg-red-xs mt-5" href="javascript:deleteTran(<?= $lang["translatorId"] ?>)">
							<i class="fa fa-times" aria-hidden="true"></i>
						</a>

					</td>
				</tr>
		<?php
				$i++;
			endforeach;
		}
		?>
	</tbody>
</table>