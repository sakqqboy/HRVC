<?php

use frontend\models\hrvc\Translator;


$language = Translator::find()
	->select('english,spanish')
	->where(["status" => 1])
	->asArray()
	->all();
$spanish = [];

if (count($language) > 0) {
	foreach ($language as $lang) :
		$spanish[$lang["english"]] = $lang["spanish"];
	endforeach;
}
return $spanish;
