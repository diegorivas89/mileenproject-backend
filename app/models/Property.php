<?php

/**
*
*/
class Property extends Eloquent
{
	protected $fillable = array("title","description","age","user_id","property_type_id","environment_id","title","description","address","latitude","longitude","currency","price","expenses","age");

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
