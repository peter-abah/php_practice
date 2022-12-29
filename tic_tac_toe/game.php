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
		
			if ($gameStatus->isDraw) {
				echo "DRAW";
			} else {
				echo "{$gameStatus->winner} wins.";
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

				[$x, $y] = $this->getMove();
				$this->board[$y][$x] = $currentPlayer->marker;

				$gameStatus = new GameStatus(board: $board, currentMarker: $currentPlayer->marker);
				$this->currentPlayerIndex = ($this->currentPlayerIndex + 1) % 2;
			} while (!$gameStatus->isGameOver);

			return $gameStatus;
		}

		private function getMove() : array {
			$currentPlayer = $this->players[$this->currentPlayerIndex];

			do {
				$input = readline("{$currentPlayer->token}' turn: Enter move (x y)");
				[$x, $y] = explode(" ", $input);
				[$x, $y] = [(int) $x, (int) $y];

				// Validate move is not out of bounds and a move has not being played on that position
		  } while ($x < 0 || $x >= 3 || $y < 0 || $y >= 3 || $this->board[$y][$x]);
			
			return [$x, $y];
		}
	}
?>
