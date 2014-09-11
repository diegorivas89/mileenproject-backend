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
		"title",
		"description",
		"address",
		"latitude",
		"longitude",
		"currency",
		"price",
		"expenses",
		"age"
	);

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


  public function getEnvironment()
  {
    return Environment::find($this->environment_id);
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

}

?>
