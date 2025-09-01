<?php

namespace frontend\components;

class Api
{
	public static function connectApi($url)
	{
		$api = curl_init($url);
		curl_setopt($api, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($api, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			"Content-Type: application/json",
			"TcgHrvcAuthorization: 9f1b3c4d5e6a7b8c9d0e1f2a3b4c5d6e"
		];

		curl_setopt($api, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($api);
		if (curl_errno($api)) {
			$error = curl_error($api);
			curl_close($api);
			return ['status' => 'error', 'message' => $error];
		}
		curl_close($api);
		return json_decode($response, true);
	}
}
