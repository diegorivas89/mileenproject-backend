<?php 

/**
* 
*/
class Property extends Eloquent 
{
	protected $fillable = array("title","description","age","user_id","property_type_id","environment_id","title","description","address","latitude","longitude","currency","price","expenses","age");

}

?>