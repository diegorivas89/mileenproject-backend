<?php

/**
*
*/
class Property extends MileenModel 
{

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
		"video_url"
	);

	public static function getValidationRules(){
		return array(
			'title' => array('required', 'min:5'),
			'description' => array('required', 'min:5'),
			'user_id' => array('required','numeric'),
			'property_type_id' => array('required','numeric'),
			'publication_type_id' => array('required','numeric'),
			'environment_id' => array('required','numeric' ),
			'address' => array('required' ),
			'latitude' => array('required','numeric' ),
			'longitude' => array('required','numeric' ),
			'currency' => array('required'),
			'price' => array('required','numeric' ),
			'expenses' => array('required','numeric' ),
			'age' => array('required','numeric' ,'min:5'),
			'size' => array('required','numeric' ,'min:2')
		);
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
		);
	}


	public function getEnvironment($fields = Array())
	{
		if ($fields){
			return Environment::select($fields)->where("id", $this->environment_id)->first();
		}else{
			return Environment::find($this->environment_id);
		}
	}

	public function getPropertyType()
	{
		return PropertyType::find($this->property_type_id);
	}

	public function getOperationType()
	{
		return OperationType::find($this->operation_type_id);
	}

	public function getNeighborhood()
	{
		return Neighborhood::find($this->neighborhood_id);
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
}

?>
