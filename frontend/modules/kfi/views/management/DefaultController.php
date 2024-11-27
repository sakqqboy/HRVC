<?php

namespace frontend\modules\Home\controllers;

use common\models\intranet\Traintype;
use common\models\ModelMaster;
use frontend\models\intranet\FiscalYear;
use frontend\models\intranet\Goal;
use frontend\models\intranet\WorkOrderUnit;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `home` module
 */
class DashboardController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex($hash = null)
	{
		$year = "2546";
		$description = "";
		$dataTrain = [];
		$totalTrain = [];
		$percentTrain = [];
		$chartTrain = [];
		$chartDistrict = [];
		$labelSliding = [];
		$dataFacTrain = [];
		$totalFacTrain = [];
		$percentFacTrain = [];
		$chartFacTrain = [];
		$chartFacDistrict = [];
		$labelFac = [];
		$totalQuantityFac = 0;
		$totalCmmsFac = 0;
		$totalQuantitySliding = 0;
		$totalCmmsSliding = 0;
		$alert = "";
		$k = base64_decode(base64_decode($hash));
		$params = ModelMaster::decodeParams($hash);

		if (isset($params["year"])) {
			$year = $params["year"];
			$fiscalYear = FiscalYear::find()->select("year,fiscalDescription")->where(["year" => $year])->asArray()->one();
			if (isset($fiscalYear)) {
				$description = $fiscalYear["fiscalDescription"];
			} else {
				$fiscalYear = FiscalYear::find()->select("year,fiscalDescription")->where(["status" => 1])->asArray()->one();
				if (isset($fiscalYear)) {
					$description = $fiscalYear["fiscalDescription"];
					$year = $fiscalYear["year"];
					$alert = "ไม่มีข้อมูลในปี " . $params["year"];
				}
			}
		} else {
			if (Yii::$app->session->get("year") != 'null' && Yii::$app->session->get("year") != '') {
				$year = Yii::$app->session->get("year");
				$fiscalYear = FiscalYear::find()->select('year,fiscalDescription')->where(["year" => $year])->asArray()->one();
				//throw new Exception(2);
				if (isset($fiscalYear)) {
					$year = $fiscalYear["year"];
					$description = $fiscalYear["fiscalDescription"];
				} else {
					$fiscalYear = FiscalYear::find()->select("year,fiscalDescription")->where(["status" => 1])->asArray()->one();
					if (isset($fiscalYear)) {
						$description = $fiscalYear["fiscalDescription"];
						$year = $fiscalYear["year"];
					}
				}
			} else {
				$fiscalYear = FiscalYear::find()->select("year,fiscalDescription")->where(["status" => 1])->asArray()->one();
				if (isset($fiscalYear)) {
					$description = $fiscalYear["fiscalDescription"];
					$year = $fiscalYear["year"];
					$session = Yii::$app->session;
					$session->set('year', $year);
				} else {
					$year = '2564';
				}
			}
		}
		//$session = Yii::$app->session;
		//$session->set('year', $year);
		//throw new Exception($year);
		$goalTrain = Goal::find()
			->select("a.activityType,a.status,a.activityName,goal.activityId,goal.quantity,goal.cmms,goal.year,goal.trainTypeId,d.districtShortName,d.districtType")
			->JOIN("LEFT JOIN", "activity a", "a.activityId=goal.activityId")
			->JOIN("LEFT JOIN", "district d", "d.districtId=goal.districtId")
			->where([
				"a.activityType" => 1,
				"goal.status" => 1,
				//"d.districtType" => [2, 3],
				"goal.year" => $year,
			])
			->asArray()
			->orderBy("goal.trainTypeId,goal.quantity DESC")
			->all();
		if (isset($goalTrain) && count($goalTrain) > 0) {
			foreach ($goalTrain as $goal) :
				//$trainName = $this->getTrainName($goal["trainTypeId"]);
				if ($goal["trainTypeId"] == 1) {
					$trainName = "รถจักร";
				}
				if ($goal["trainTypeId"] == 2) {
					$trainName = "รถดีเซลราง";
				}
				if ($goal["trainTypeId"] == 3) {
					$trainName = "รถโดยสาร";
				}
				if ($goal["trainTypeId"] == 4) {
					$trainName = "รถสินค้า";
				}
				// throw new Exception($trainName);
				if ($goal["districtType"] == 2 || $goal["districtType"] == 3) { //ด้านลากเลื่อน
					if (isset($dataTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["cmms"])) {
						$dataTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["cmms"] += $goal["cmms"];
					} else {
						$dataTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["cmms"] = $goal["cmms"];
					}
					if (isset($dataTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["quantity"])) {
						$dataTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["quantity"] += $goal["quantity"];
					} else {
						$dataTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["quantity"] = $goal["quantity"];
					}
					if (isset($totalTrain[$trainName]["cmms"])) {
						$totalTrain[$trainName]["cmms"] += $goal["cmms"];
					} else {
						$totalTrain[$trainName]["cmms"] = $goal["cmms"];
					}
					if (isset($totalTrain[$trainName]["quantity"])) {
						$totalTrain[$trainName]["quantity"] += $goal["quantity"];
					} else {
						$totalTrain[$trainName]["quantity"] = $goal["quantity"];
					}
					$totalCmmsSliding += $goal["cmms"];
					$totalQuantitySliding += $goal["quantity"];
				} else { //ด้านโรงงาน
					if ($goal["districtShortName"] != "ผผผ.ศจ.") {
						if (isset($dataFacTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["cmms"])) {
							$dataFacTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["cmms"] += $goal["cmms"];
						} else {
							$dataFacTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["cmms"] = $goal["cmms"];
						}
						if (isset($dataFacTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["quantity"])) {
							$dataFacTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["quantity"] += $goal["quantity"];
						} else {
							$dataFacTrain[$goal["trainTypeId"]][$goal["districtShortName"]]["quantity"] = $goal["quantity"];
						}
						if (isset($totalFacTrain[$trainName]["cmms"])) {
							$totalFacTrain[$trainName]["cmms"] += $goal["cmms"];
						} else {
							$totalFacTrain[$trainName]["cmms"] = $goal["cmms"];
						}
						if (isset($totalFacTrain[$trainName]["quantity"])) {
							$totalFacTrain[$trainName]["quantity"] += $goal["quantity"];
						} else {
							$totalFacTrain[$trainName]["quantity"] = $goal["quantity"];
						}
						$totalCmmsFac += $goal["cmms"];
						$totalQuantityFac += $goal["quantity"];
					}
				}
			endforeach;
		}
		if (count($totalTrain) > 0) {
			$i = 0;
			$j = 1;
			foreach ($totalTrain as $trainName => $value) :
				$percentTrain[$trainName] = $value["quantity"] > 0 ? ($value["cmms"] / $value["quantity"]) * 100 : 0;
				$quantity[$i] = $value["quantity"];
				$cmms[$i] = $value["cmms"];
				$labelSliding[$i] = $trainName;
				$i++;
				$j++;
			endforeach;
			$chartTrain[0] = [
				'type' => 'column',
				'name' => "เป้าหมาย",
				'data' => $quantity // Your dataset
			];
			$chartTrain[1] = [
				'type' => 'column',
				'name' => "ผลงานจาก CMMS",
				'data' => $cmms // Your dataset
			];
		}
		if (count($dataTrain) > 0) {
			foreach ($dataTrain as $trainType => $district) :
				foreach ($district as $districtName => $value) :

					$percentDistrict =  $value["quantity"] > 0 ? ($value["cmms"] / $value["quantity"]) * 100 : 0;
					$chartDistrict[$trainType][] = [$districtName, $percentDistrict];

				endforeach;
			endforeach;
		}
		if (count($totalFacTrain) > 0) {
			$i = 0;
			$j = 1;
			foreach ($totalFacTrain as $trainName => $value) :
				if ($trainName != "รถสินค้า") {
					$percentFacTrain[$trainName] = $value["quantity"] > 0 ? ($value["cmms"] / $value["quantity"]) * 100 : 0;
					$quantityFac[$i] = $value["quantity"];
					$cmmsFac[$i] = $value["cmms"];
					$labelFac[$i] = $trainName;
					$i++;
					$j++;
				}
			endforeach;
			$chartFacTrain[0] = [
				'type' => 'column',
				'name' => "เป้าหมาย",
				'data' => $quantityFac // Your dataset
			];
			$chartFacTrain[1] = [
				'type' => 'column',
				'name' => "ผลงานจาก CMMS",
				'data' => $cmmsFac // Your dataset
			];
		}
		if (count($dataFacTrain) > 0) {
			foreach ($dataFacTrain as $trainType => $district) :
				foreach ($district as $districtName => $value) :
					if ($districtName != "ผผผ.ศจ.") {
						$percentFacDistrict =  $value["quantity"] > 0 ? ($value["cmms"] / $value["quantity"]) * 100 : 0;
						//$chartFacDistrict[$trainType][] = [$districtName, $percentFacDistrict];
						$chartFacDistrict[$trainType][] = ["เป้า", $value["quantity"]];
						$chartFacDistrict[$trainType][] = ["CMMS", $value["cmms"]];
					}
				endforeach;
			endforeach;
		}
		// throw new Exception(print_r($chartFacDistrict, true));
		return    $this->render('index', [
			"chartTrain" => $chartTrain,
			"chartDistrict" => $chartDistrict,
			"dataTrain" => $dataTrain,
			"totalTrain" => $totalTrain,
			"labelSliding" => $labelSliding,
			"percentTrain" => $percentTrain,
			"chartFacTrain" => $chartFacTrain,
			"chartFacDistrict" => $chartFacDistrict,
			"dataFacTrain" => $dataFacTrain,
			"totalFacTrain" => $totalFacTrain,
			"labelFac" => $labelFac,
			"percentFacTrain" => $percentFacTrain,
			"totalQuantityFac" => $totalQuantityFac,
			"totalCmmsFac" => $totalCmmsFac,
			"totalQuantitySliding" => $totalQuantitySliding,
			"totalCmmsSliding" => $totalCmmsSliding,
			"description" => $description,
			"year" => $year,
			"alert" => $alert
		]);
	}
	public function actionAllYear()
	{
		$fiscalYear = FiscalYear::find()->where(1)->asArray()->orderBy("year DESC")->all();
		$text = "";
		if (isset($fiscalYear) && count($fiscalYear) > 0) {
			foreach ($fiscalYear as $year) :
				$endCode = ModelMaster::encodeParams(["year" => $year["year"]]);
				$url = Yii::$app->homeUrl . 'home/dashboard/' . $endCode;
				$text .= "<a href='" . $url . "'><div class='year-list text-left'><b>" . $year["year"] . "</b></div></a>";
			endforeach;
		}

		$res["text"] = $text;
		return json_encode($res);
	}
	public function getTrainName($trainTypeId)
	{
		$trainName = "";
		//throw new exception($trainTypeId);
		if ($trainTypeId == 1) {
			$trainName = "รถจักร";
		}
		if ($trainTypeId == 2) {
			$trainName = "รถดีเซลราง";
		}
		if ($trainTypeId == 3) {
			$trainName = "รถโดยสาร";
		}
		if ($trainTypeId == 4) {
			$trainName = "รถสินค้า";
		}

		throw new exception($trainName);
		return $trainName;
	}
}