<?php

namespace backend\modules\masterdata\controllers;

use backend\models\hrvc\Title;
use Exception;
use yii\web\Controller;

/**
 * Default controller for the `masterdata` module
 */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
class TitleController extends Controller
{
	public function actionTitleList()
	{
		$titles = Title::find()
			->select('title.titleId,title.titleName,title.layerId,title.jobDescription,l.layerName,l.shortTag as lShort,
			title.shortTag as tShort,d.departmentName,title.departmentId,b.branchName,b.branchId')
			->JOIN("LEFT JOIN", "layer l", "l.layerId=title.layerId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=title.departmentId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
			->where(["title.status" => 1, "l.status" => 1, "b.status" => 1])
			->asArray()
			->all();
		return json_encode($titles);
	}
	public function actionTitleDetail($id)
	{
		$titles = Title::find()
			->where(["titleId" => $id])
			->asArray()
			->one();
		return json_encode($titles);
	}
	public function actionSearchTitleList($departmentId)
	{
		$titles = Title::find()
			->select('title.titleId,title.titleName,title.layerId,l.layerName,l.shortTag as lShort,
			title.shortTag as tShort,d.departmentName,title.departmentId,b.branchName,b.branchId')
			->JOIN("LEFT JOIN", "layer l", "l.layerId=title.layerId")
			->JOIN("LEFT JOIN", "department d", "d.departmentId=title.departmentId")
			->JOIN("LEFT JOIN", "branch b", "b.branchId=d.branchId")
			->where(["title.status" => 1, "l.status" => 1, "b.status" => 1, "title.departmentId" => $departmentId])
			->asArray()
			->all();
		return json_encode($titles);
	}
	public function actionTitleDepartment($departmentId)
	{
		$titles = Title::find()
			->select('titleId,titleName')
			->where(["departmentId" => $departmentId, "status" => 1])
			->orderBy("titleName")
			->asArray()
			->all();
		return json_encode($titles);
	}
}
