<?php

use frontend\models\hrvc\Translator;

$language = Translator::find()
	->select('english,thai')
	->where(["status" => 1])->asArray()->all();
$thai = [];
if (count($language) > 0) {
	foreach ($language as $lang) :
		$thai[$lang["english"]] = $lang["thai"];
	endforeach;
}
return $thai;
