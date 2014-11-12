<?php

/**
*
*/
class Ad extends MileenModel
{
	protected $fillable = array(
		'id',
		'title',
		'description',
		'target_url',
		'banner',
	);
	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'title' => 'string',
			'description' => 'description',
			'target_url' => 'string',
			'banner' => 'string',
		);
	}

	public static function getAd()
	{
		if (Config::get('ads.random')){
			//retornar un aviso de la db random
			return self::first();
		}else{
			return new Ad(Config::get('ads.default_ad'));
		}
	}
}

?>