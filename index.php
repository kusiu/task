<?php 

 /**
   * Class City
   * 
   * @author     Andrew Kus
   */
class City {

	/**
	 * Keep coordinates of the city
	 */
	private $city = array();

	public function __construct($city) {
		
		$cities = $this->getCities();
		$this->city = $cities[$city];

	}

	/**
	 * Returns cities 
	 *
	 * @return array 
	 */
	private function getCities() {

		return array(
			'Birmingham' => array(
				52.4666670,
				1.8833330
			),
			'Bradford' => array(
				53.8000000,
				1.7521000
			),
			'Bristol' => array(
				51.4500000,
				2.5833000
			),
			'Edinburgh' => array(
				55.9531000,
				3.1889000
			),
			'Glasgow' => array(
				55.8580000,
				4.2590000
			),
			'Leeds' => array(
				53.7997000,
				1.5492000
			),
			'Liverpool' => array(
				53.4000000,
				3.0000000
			),
			'London' => array(
				51.5072000,
				0.1275000
			),
			'Manchester' => array(
				53.4667000,
				2.3333000
			),
			'Sheffield' => array(
				53.3836000,
				1.4669000
			)
		);
	}

	/**
	 * Calculate a distance between two coordinates
	 * Default in miles
	 *
	 * @param float $lat1 lattitute from first location
	 * @param float $long1 long from first location
	 * @param float $lat2 lattitute from second location
	 * @param float $long2 long from second location
	 * @return float Distance 
	 */
	public function distance($lat1, $lng1, $lat2, $lng2, $miles = true)
	{
		$pi80 = M_PI / 180;
		$lat1 *= $pi80;
		$lng1 *= $pi80;
		$lat2 *= $pi80;
		$lng2 *= $pi80;

		$r = 6372.797;
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$km = $r * $c;

		return ($miles ? ($km * 0.621371192) : $km);
	}

	/**
	 * Returns list of the nearest cities by distance
	 *
	 * @param int $distance distance in miles, default is 100
	 * @return $result array 
	 */
	public function getCitiesByDistance($distance = 100) {

		$result = array();
		$currentCity = $this->city;

		foreach ($this->getCities() as $city => $coordinates) {


			$calculatedDistance = $this->distance($currentCity[0], $currentCity[1], $coordinates[0], $coordinates[1]);
			
			if ($calculatedDistance <= $distance && $calculatedDistance != 0) {
				
				array_push($result, array($calculatedDistance, $city));

			}
			
		}

		asort($result);

		echo "<pre>";
		print_r($result);
		echo "<pre>";

	}


}

$iverpool = new City('Liverpool');
$liverpool->getCitiesByDistance(100);

