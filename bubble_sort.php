<?php
	// function to implement bubble sort
function bubble_sort(& $array) {
		$array_count = count($array);

		for ($i = 0; $i < $array_count; $i++) {
			$has_swapped = false;

			for ($j = 1; $j < $array_count; $j++) {
				if ($array[$j] < $array[$j - 1]) {
					[$array[$j], $array[$j - 1]] = [$array[$j - 1], $array[$j]];
					$has_swapped = true;
				}
			}

			if (!$has_swapped) break;
		}
	}
	
	$array = [4,3,78,2,0,2];
	bubble_sort($array);
	echo var_dump($array);
?>
