<?php

/**
*
*/
class Neighborhood extends MileenModel
{
	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'name' => 'string',
		);
	}

	/**
	 * Retorna los barrios adyacentes
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getAdjacents()
	{
		$adjacents = Adjacent::select('adjacent_neighborhood_id')
							->where('neighborhood_id', '=', $this->id)
							->get();

		$collection = new \Illuminate\Support\Collection();

		foreach ($adjacents as $adjacent) {
			try {
				$collection->push(self::findOrFail($adjacent->adjacent_neighborhood_id));
			} catch (\Exception $e) {
				continue;
			}
		}

		return $collection;
	}

	/**
	 * Retorna el precio por metro cuadrado para el barrio, no tiene en cuenta la moneda
	 *
	 * @return int
	 */
	public function getPriceByM2($currency = '$', $operation = null)
	{
		$properties = $this->getProperties($operation);

		$acum = 0;
		foreach ($properties as $property) {
			//echo $property->title." - ".$property->price." - ".$property->currency." - ".$currency." - ".Currency::convert($property->price, $property->currency, $currency)."\n";
			$acum += Currency::convert($property->price, $property->currency, $currency) / $property->size;

		}

		if ($properties->count() == 0){
			return 0;
		}

		return round($acum / $properties->count());
	}

	public function getProperties($operation = null)
	{
		if (isset($operation)){
			return Property::whereRaw('neighborhood_id = ? AND state != ? AND operation_type_id = ?', array($this->id,\Property::deleted, $operation))->get();
		}
		return Property::whereRaw('neighborhood_id = ? AND state != ? ', array($this->id,\Property::deleted))->get();
	}
}

?>
