<?php 

/**
* 
*/
class MileenModel extends Eloquent
{
	public function toArray()
	{
		$fields = parent::toArray();
		foreach ($this->getSchema() as $field => $type){
			if (array_key_exists($field, $fields)){
				switch($type){
					case 'int':
						$fields[$field] = intval($fields[$field]);
						break;
					default:
						break;
				}
			}
		}

		return $fields;
	}
}

?>