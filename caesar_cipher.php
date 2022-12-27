<?php
	function caesar_cipher($word, $shift) {
		$word_length = strlen($word);
		$res = "";

		for($i = 0; $i < $word_length; $i++) {
			$char_ord = ord($word[$i]) + $shift;
			
			// Shift char if it is greater than Z or z
			if ((ctype_upper($word[$i]) && $char_ord > ord("Z")) ||
				ctype_lower($word[$i]) && $char_ord > ord("z")) {
				$char_ord -= 26;
			}

			$res .= chr($char_ord);
		}

		return $res;
	}
	
	echo caesar_cipher("azghup", 25);
?>

