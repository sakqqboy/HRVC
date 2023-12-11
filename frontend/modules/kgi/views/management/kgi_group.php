<?php

use frontend\models\hrvc\GroupHasKgi;

if (isset($kgiGroups) && count($kgiGroups) > 0) {
	foreach ($kgiGroups as $kgiGroup) :
		$isInGroup = GroupHasKgi::IsKgiInGroup($kgiId, $kgiGroup['kgiGroupId']);
?>
		<div class="col-12 font-size-13 mt-10">
			<input type="checkbox" class="mr-5" value="<?= $kgiGroup['kgiGroupId'] ?>" name="kgiGroup[]" <?= $isInGroup == 1 ? 'checked' : '' ?>>
			<?= $kgiGroup["kgiGroupName"] ?>
		</div>
	<?php
	endforeach;
} else { ?>
	<div class="col-12 font-size-14 mt-10">
		<span class="text-secondary"> There isn't KGI Group in this company ! ! !</span>
	</div>
<?php

}

?>