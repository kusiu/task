<?php 

/**
   * Class Text
   * 
   * @author     Andrew Kus
   * 
   */
class Text {

	/**
	 * Reverse string
	 *
	 * @param  $text string
	 * @return $text string 
	 */
	public function reverse($text) {

		$words = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $text, -1, PREG_SPLIT_NO_EMPTY);

		$reversedText = array();

		foreach ($words as $word) {
			$reversedText[] = strrev($word);
		}

		return implode($reversedText, " ");

	}

}

$text = new Text();
echo $text->reverse('lovely task from otsuoG');