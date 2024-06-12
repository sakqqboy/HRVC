<?php

namespace frontend\modules\evaluation\controllers;

use common\helpers\Path;
use common\models\ModelMaster;
use Exception;
use frontend\models\hrvc\Frame;
use frontend\models\hrvc\Group;
use frontend\models\hrvc\Rank;
use frontend\models\hrvc\Title;
use Yii;
use yii\db\Expression;
use yii\web\Controller;

class RankController extends Controller
{
	public function beforeAction($action)
	{
		if (!Yii::$app->user->id) {
			return $this->redirect(Yii::$app->homeUrl . 'site/login');
		}
		$groupId = Group::currentGroupId();
		if ($groupId == null) {
			return $this->redirect(Yii::$app->homeUrl . 'setting/group/create-group');
		}
		return true; //go to origin request
	}
	public function actionIndex($hash)
	{
		$param = ModelMaster::decodeParams($hash);
		$termId = $param["termId"];
		$api = curl_init();
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/term-detail?termId=' . $termId);
		$terms = curl_exec($api);
		$terms = json_decode($terms, true);

		$frameId = $terms["frameId"];
		$frameName = Frame::frameName($frameId);
		$environmentId = Frame::getEnvironmentId($frameId);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/environment/environment-detail?environmentId=' . $environmentId);
		$environmentDetail = curl_exec($api);
		$environmentDetail = json_decode($environmentDetail, true);

		curl_setopt($api, CURLOPT_URL, Path::Api() . 'evaluation/rank/index?termId=' . $termId);
		$ranks = curl_exec($api);
		$ranks = json_decode($ranks, true);

		curl_close($api);
		return $this->render('index', [
			"terms" => $terms,
			"environmentDetail" => $environmentDetail,
			"frameName" => $frameName,
			"termId" => $termId,
			"ranks" => $ranks
		]);
	}
	public function actionSaveRank()
	{
		$rank = new Rank();
		$rank->rankName = $_POST["rankName"];
		$rank->min = $_POST["min"];
		$rank->max = $_POST["max"];
		$rank->termId = $_POST["termId"];
		$rank->increasement = $_POST["increasement"];
		$rank->bonusRate = $_POST["bonus"];
		$rank->status = 1;
		$rank->createDateTime = new Expression('NOW()');
		$rank->updateDateTime = new Expression('NOW()');
		if ($rank->save(false)) {
			return $this->redirect(Yii::$app->homeUrl . 'evaluation/rank/index/' . ModelMaster::encodeParams([
				"termId" => $_POST["termId"]
			]));
		}
	}
	public static function actionRankName()
	{
		$rankName = $_POST["rankName"];
		$termId = $_POST["termId"];
		$rank = Rank::find()->where(["rankName" => $rankName, "termId" => $termId])->asArray()->one();
		$canSave1 = 0; //if has same rank name in save term
		$canSave2 = 0;
		if (isset($rank) && !empty($rank)) {
			$canSave1 = 0;
		} else {
			$canSave1 = 1;
		}
		$min = $_POST["min"];
		$max = $_POST["max"];
		$rankRate = Rank::find()
			->where(["termId" => $termId, "min" => $min, "max" => $max])
			->asArray()
			->one();
		if (isset($rankRate) && !empty($rankRate)) { //if has same rate in same term
			$canSave2 = 0;
		} else {
			$canSave2 = 1;
		}
		if ($canSave2 == 1 && $canSave2 == 1) {
			$res["status"] = true;
		} else {
			$res["status"] = false;
			if ($canSave1 == 0) {
				$res["text"] = "This name is already exist in this term.";
			}
			if ($canSave1 == 0) {
				$res["text"] = "This period is already exist in this term.";
			}
		}
		return json_encode($res);
	}
	public static function actionDeleteRank()
	{
		$rankId = $_POST["rankId"];
		Rank::deleteAll(["rankId" => $rankId]);
		$res["status"] = true;
		return json_encode($res);
	}
}
