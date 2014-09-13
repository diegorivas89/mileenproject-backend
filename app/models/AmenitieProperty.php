<?php 

/**
* 
*/
class AmenitieProperty extends MileenModel
{
	public static function storeAmenitiesForProperty($propertyId, $amenities)
	{
		foreach ($amenities as $id => $value) {
			$amenitie = new AmenitieProperty();
			$amenitie->property_id = $propertyId;
			$amenitie->amenitie_type_id = $id;
			$amenitie->save();
		}
	}
}

?>