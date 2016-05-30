<?php

namespace App\Http\Utilities;

class City
{

	protected static $cities = [
		"Shanghai" => [
			"Huangpu",
			"Xuhui",
			"Changning",
			"Jingan",
			"Putuo",
			"Hongkou",
			"Yangpu",
		],
		"Beijing" => [
			"Haidian",
			"Chaoyang"
		],
		"Guangzhou" => [
			"Tianhe"
		]
	];

	public static function all()
	{
		return static::$cities;
	}
}