<?php
	require_once "game.php";
	
function getGameMode() {
		$prompt = <<< DOC
			Choose game mode.
			1. vs Human
			2. vs Computer (random)
			Enter 1 or 2 to choose mode.\n
			DOC;

		$input = readline($prompt);
		$mode = $input === "1" ? Game::GAME_MODE_VS_HUMAN : Game::GAME_MODE_VS_COMPUTER;
		return $mode;
	}

	function main() {
		$gameMode = getGameMode();
		$game = new Game($gameMode);
		$game->start();
	}

	main();
?>
