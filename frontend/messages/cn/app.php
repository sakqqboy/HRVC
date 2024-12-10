<?php

use frontend\models\hrvc\Translator;


$language = Translator::find()
	->select('english,chinese')
	->where(["status" => 1])
	->asArray()
	->all();
$chinese = [];

if (count($language) > 0) {
	foreach ($language as $lang) :
		$chinese[$lang["english"]] = $lang["chinese"];
	endforeach;
}
return $chinese;
