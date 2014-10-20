<?php 


 /**
   * Class ISO
   * 
   * @author     Andrew Kus
   * 
   */
class ISO {

	/**
	 * Keep country codes in the property
	 */
	private $countryCodes = array();

	/*
	 * Constructor
	*/
	public function __construct() {
		
		$this->countryCodes = $this->getListOfCountryCode();

	}
	
	/**
	 * Returns list of the country codes
	 *
	 * @return $countryCodes array 
	 */
	private function getListOfCountryCode() {

		$countryCodes = array();

		$countries = json_decode(file_get_contents('countries.json'), true);

		foreach ($countries as $country) {
			/// Make string uppercase (just in case) and assign to the array
			$countryCodes[] = strtoupper($country['cca3']);
		}

		// Sort country codes in alphabetical order
		asort($countryCodes);

		return $countryCodes;

	}

	/**
	 * Returns country code property 
	 *
	 * @return $countryCode array 
	 */
	public function getCountryCodes() {

		return $this->countryCodes;

	}

	/**
	 * Change text as following:
	 *
	 * For any country code containing the letter B, print "Bish", instead of the country code.
	 * For any country code containing the letter N, print "Nish", instead of the country code.
	 * For any country code containing both B and N, print "BishNish", instead of the country code.
	 * 
	 * @param  $text string
	 * @return $text string 
	 */
	public function changeText($text) {

		if (preg_match('/B/i', $text) && preg_match('/N/i', $text)) {
			return 'BishNish';
		} else if (preg_match('/B/i', $text)) {
			return 'Bish';
		} else if (preg_match('/N/i', $text)) {
			return 'Nish';
		}
		return $text;

	}

}

// Task no. 1
$iso = new ISO();
$countryCodes = $iso->getCountryCodes();

foreach ($countryCodes as $countryCode) {
	echo $iso->changeText($countryCode) . "<br />";
}
