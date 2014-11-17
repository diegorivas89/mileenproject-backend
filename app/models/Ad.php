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
		//if (Config::get('ads.random')){
		if (Input::has('mode') && Input::get('mode') == 'fixed'){
			return new Ad(Config::get('ads.default_ad'));
		}else{
			$fields = ['id', 'title', 'description', 'target_url', 'banner'];
			//retornar un aviso de la db random
			return Ad::orderByRaw("RAND()")->select($fields)->first();
		}
	}
}

?>