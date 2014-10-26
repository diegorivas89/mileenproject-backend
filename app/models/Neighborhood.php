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
		$adjacents = Adjacents::select('adjacent_neighborhood_id')->where('neighborhood_id', '=', $this->id)->get();

		$collection = new \Illuminate\Support\Collection();

		foreach ($adjacents as $adjacent) {
			$collection->add(self::find($adjacent));
		}

		return $collection;
	}

	/**
	 * Retorna el precio por metro cuadrado para el barrio, no tiene en cuenta la moneda
	 *
	 * @return int
	 */
	public function priceByM2()
	{
		$properties = Property::where('neighborhood_id', '=', $this->id)->get();

		$acum = 0;
		foreach ($properties as $property) {
			$acum += $property->price / $property->size;
		}

		return round($acum / $properties->count());
	}
}

?>
