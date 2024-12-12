<?php

use frontend\models\hrvc\Translator;


$language = Translator::find()
	->select('english,indonesian')
	->where(["status" => 1])
	->asArray()
	->all();
$indonesian = [];

if (count($language) > 0) {
	foreach ($language as $lang) :
		$indonesian[$lang["english"]] = $lang["indonesian"];
	endforeach;
}
return $indonesian;
