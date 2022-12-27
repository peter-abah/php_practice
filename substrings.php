<?php
	/* This function takes a string and an array of words.
	 * It returns a hash (associative array) with the keys as words that are substrings of the string and the values as count of occurences
	 */
  function substrings($string, $dictionary) {
		$res = array();

		foreach($dictionary as $word) {
			$count = substr_count($string, $word);
			if ($count > 0) {
				$res[$word] = $count;
			}
		}

		return $res;
	}

	$dictionary = ["below","down","go","going","horn","how","howdy","it","i","low","own","part","partner","sit"];
	$res = substrings("Howdy partner, sit down! How's it going?", $dictionary);
	echo var_dump($res);
?>
