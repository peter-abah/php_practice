<?php
	require_once "player.php";
	require_once "game_status.php";

	class Game {
		public const GAME_MODE_VS_COMPUTER = "computer";
		public const GAME_MODE_VS_HUMAN = "human";

		public array $board;
		public array $players;
		private int $currentPlayerIndex;

		public function __construct(string $gameMode) {
			$this->board = [
				array_fill(0, 3, NULL),
				array_fill(0, 3, NULL),
				array_fill(0, 3, NULL)
			];
			$this->players = $this->initPlayers($gameMode);
			$this->currentPlayerIndex = 0;
		}

		public function start() {
			$gameStatus = $this->gameLoop();
		
			$this->displayBoard();	
			if ($gameStatus->isDraw) {
				echo "DRAW\n";
			} else {
				echo "{$gameStatus->winner} wins.\n";
			}
		}

		private function initPlayers(string $gameMode) : array {
			switch ($gameMode) {
				case self::GAME_MODE_VS_COMPUTER:
					return [
						new HumanPlayer("X"),
						new ComputerPlayer("O")
					];
				case self::GAME_MODE_VS_HUMAN:
					return [
						new HumanPlayer("X"),
						new HumanPlayer("O")
					];
				default:
					$error_message = "Invalid game mode. Game mode can be either be '{self::GAME_MODE_VS_COMPUTER}' or '{self::GAME_MODE_VS_HUMAN}'";
					throw new Exception($error_message);
			}
		}

		private function gameLoop() : GameStatus {
			do {
				$currentPlayer = $this->players[$this->currentPlayerIndex];

				$this->displayBoard();
				[$x, $y] = $currentPlayer->getMove($this->board);
				$this->board[$y][$x] = $currentPlayer->marker;

				$gameStatus = new GameStatus($this->board);
				$this->currentPlayerIndex = ($this->currentPlayerIndex + 1) % 2;
			} while (!$gameStatus->isGameOver);

			return $gameStatus;
		}

		private function displayBoard() {
			for ($y = 0; $y < 3; $y++) {
				$row = [];
				for ($x = 0; $x < 3; $x++) {
					if ($this->board[$y][$x]) {
						array_push($row, " {$this->board[$y][$x]} ");
					} else {
						array_push($row, "   ");
					}
				}
				echo implode("|", $row);
				echo "\n";
			}

			echo "\n";
		}
	}
?>
