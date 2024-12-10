<?php

use frontend\models\hrvc\Translator;


$language = Translator::find()
	->select('english,vietnam')
	->where(["status" => 1])
	->asArray()
	->all();
$vietnam = [];

if (count($language) > 0) {
	foreach ($language as $lang) :
		$vietnam[$lang["english"]] = $lang["vietnam"];
	endforeach;
}
return $vietnam;
