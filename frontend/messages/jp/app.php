<?php

use frontend\models\hrvc\Translator;


$language = Translator::find()
	->select('english,japanese')
	->where(["status" => 1])
	->asArray()
	->all();
$japanese = [];
if (count($language) > 0) {
	foreach ($language as $lang) :
		$japanese[$lang["english"]] = $lang["japanese"];
	endforeach;
}
return $japanese;
