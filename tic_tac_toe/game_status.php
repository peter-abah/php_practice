<?php
	class GameStatus {
		public bool $isDraw;
		public bool $isGameOver;
		public ?string $winner;

		private $board;

		public function __construct(array $board) {
			$this->board = $board;

			$this->isDraw = $this->checkDraw();
			$this->winner = $this->checkWinner();
			$this->isGameOver = $this->isDraw || !!$this->winner;
		}

		private function checkDraw() : bool {
			for ($y = 0; $y < 3; $y++) {
				for ($x = 0; $x < 3; $x++) {
					if (!$this->board[$y][$x]) return false;
				}
			}

			return true;
		}

		private function checkWinner() : ?string {
			// Check rows
			for ($y = 0; $y < 3; $y++) {
				// checks if row is the same
				// array flip merges the values if they are the same since there can not be duplicate keys
				if (count(array_unique($this->board[$y])) === 1) {
					return $this->board[$y][0];
				}
			}

			// Check columns
			for ($x = 0; $x < 3; $x++) {
				if (($this->board[0][$x] === $this->board[1][$x]) &&
					($this->board[0][$x] === $this->board[2][$x])) {
					return $this->board[0][$x];
				}
			}

			// Check diagonals
			$b = & $this->board; // shortens the name so the following code will not be too long
			$diagonalPositions = [
				[$b[0][0], $b[1][1], $b[2][2]],
				[$b[0][2], $b[1][1], $b[2][0]]
			];

			foreach ($diagonalPositions as $pos) {
				if (count(array_unique($pos)) === 1) {
					return pos[0];
				}
			}
			
			// No winner
			return NULL;
		}
	}
?>
