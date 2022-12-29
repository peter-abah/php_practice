<?php
	abstract class Player {
		public $marker;

		public function __construct($marker) {
			$this->marker = $marker;
		}

		public abstract function getMove(array $board): array;
	}

	class HumanPlayer extends Player {
		public function getMove(array $board) : array {
			do {
				$input = readline("{$this->marker}' turn: Enter move (x y)");
				[$x, $y] = explode(" ", $input);
				[$x, $y] = [(int) $x, (int) $y];

				// Validate move is not out of bounds and a move has not being played on that position
		  } while ($x < 0 || $x >= 3 || $y < 0 || $y >= 3 || $board[$y][$x]);
			
			return [$x, $y];
		}
	}

	class ComputerPlayer extends Player {
		public function getMove(array $board) : array {
			// Plays random moves for now
			$freePositions = getFreeBoardPostions($board);
			return freePositions[rand(0, count($freePositions) - 1)];
		}

		/* Returns positions in board that are empty */
		private function getFreeBoardPostions(array $board) : array {
			$result = [];

			for ($y = 0; $y < 3; $y++) {
				for ($x = 0; $x < 3; $x++) {
					if (!$board[$y][$x]) array_push($result, [$x, $y]);
				}
			}

			return result;
		}
	}
?>
