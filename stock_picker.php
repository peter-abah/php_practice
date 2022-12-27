<?php
	/* This algorithm is the same as "Best time to buy and sell stock on leetcode". */
	/* It receives an array of prices and returns the indices of time to buy and sell stock that will yield the maximum profit */
	/* It returns [-1, -1] if there is no valid answer */	
	function stock_picker($prices) {
		$prices_count = count($prices);
		$res = [0, 0];
		$max = 0;
		$min_index = 0;

		for ($i = 1; $i < $prices_count; $i++) {
			$profit = $prices[$i] - $prices[$min_index];
			if ($profit > $max) {
				$max = $profit;
				$res = [$min_index, $i];
			}

			$min_index = $prices[$i] < $prices[$min_index] ? $i : $min_index;
		}

		return $res;
	}

	echo var_dump(stock_picker([17,3,6,9,15,8,6,1,10]));
?>
