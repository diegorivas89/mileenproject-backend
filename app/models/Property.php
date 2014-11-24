<?php

use \Carbon\Carbon;

/**
*
*/
class Property extends MileenModel
{

	const active = 'active';
	const paused = 'paused';
	const deleted = 'deleted';

	protected $fillable = array(
		"title",
		"description",
		"age",
		"user_id",
		"property_type_id",
		"environment_id",
		"operation_type_id",
		"neighborhood_id",
		"publication_type_id",
		"size",
		"covered_size",
		"title",
		"description",
		"address",
		"latitude",
		"longitude",
		"currency",
		"price",
		"expenses",
		"age",
		"video_url",
		'credit_card_number',
		'security_code',
		'card_owner',
		'expiration_date'
	);

	public static function getValidationRules($key = null){
		$rules = array(
			'title' => array('required', 'min:5','max:128'),
			'description' => array('required', 'min:5'),
			'user_id' => array('required','numeric'),
			'property_type_id' => array('required','numeric'),
			'publication_type_id' => array('required','numeric'),
			'environment_id' => array('required','numeric' ),
			'address' => array('required' ),
			'latitude' => array('required','numeric' ),
			'longitude' => array('required','numeric' ),
			'currency' => array('required'),
			'price' => array('required','numeric','min:1','max:99999999' ),
			'expenses' => array('required','numeric' ),
			'age' => array('required','numeric' ,'min:0'),
			'size' => array('required','numeric' ,'min:0'),
			'covered_size' => array('required','numeric' ,'min:0'),
			'video_url' => array('url'),
			'state' => 'in:active, paused, deleted',
			'credit_card_number' => 'regex:/^[0-9 \s]*[^2]$/',
		);

		if (isset($key)){
			return $rules[$key];
		}

		return $rules;
	}

	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'title' => 'string',
			'price' => 'int',
			'currency' => 'string',
			'address' => 'string',
			'size' => 'int',
			'covered_size' => 'int',
			'environment_id' => 'int',
			'publication_type_id' => 'int',
			'state' => 'string',
		);
	}


	public function getEnvironment($fields = Array())
	{
		if ($fields){
			return Environment::select($fields)->where("id", $this->environment_id)->first();
		}else{
			return Environment::select('id', 'name')->find($this->environment_id);
		}
	}

	public function getPublicationType($fields = Array())
	{
		if ($fields){
			return PublicationType::select($fields)->find($this->publication_type_id);
		}else{
			return PublicationType::select('id', 'name')->find($this->publication_type_id);
		}
	}

	public function getPropertyType()
	{
		return PropertyType::select('id', 'name')->find($this->property_type_id);
	}

	public function getOperationType()
	{
		return OperationType::select('id', 'name')->find($this->operation_type_id);
	}

	public function getNeighborhood()
	{
		return Neighborhood::select('id', 'name')->find($this->neighborhood_id);
	}

	public function getImages()
	{
		return Image::select('id', 'name')->where("property_id", "=", $this->id)->orderBy('id', 'asc')->get();
	}

	public function getMainImageUrl($default = '')
	{
		$image = Image::select('id', 'name')->where("property_id", "=", $this->id)->orderBy('id', 'asc')->first();
		if (isset($image)){
			return $image->getUrl();
		}else{
			return $default;
		}
	}

	public function getAmenities()
	{
		$amenities = AmenitieProperty::select("amenitie_type_id")->where("property_id", $this->id)->get();
		$amenitiesName = array();
		foreach ($amenities as $index => $value) {
			$amenitiesName[] = (AmenitieType::find($value->amenitie_type_id)->name);
		}
		return $amenitiesName;
	}

	public function getUser()
	{
		try{
			return User::select('id', 'name', 'email', 'telephone')->findOrFail($this->user_id);
		}catch (\Exception $e){
			return new User();
		}
	}

	public function hasExpired()
	{
		return $this->daysUntilExpiry() <= 0;
	}

	public function daysUntilExpiry()
	{
		$publication = $this->getPublicationType(['validity_period']);

		$days = $this->created_at->diffInDays(Carbon::now(), false);

		return $publication->validity_period - $days;
	}

	public function possiblesStates()
	{
		return ['active', 'paused'];
	}

	public function deleteImages()
	{
		$images = Image::where('property_id', $this->id)->get();

		foreach ($images as $image){
			$image->delete();
		}
	}

}

?>
