<?php

namespace Schellingerht\TicTacToe\Jury;

use Schellingerht\TicTacToe\Player\PlayerInterface;

/**
 * Interface JuryInterface
 *
 * Jury logic for checking the winner
 *
 * @package Schellingerht\TicTacToe\Jury
 */
interface JuryInterface
{
    /**
     * Check if given player has won
     *
     * @param PlayerInterface $player
     * @return bool
     */
    public function check(PlayerInterface $player): bool;

    /**
     * Get the winner
     *
     * @return string
     */
    public function winner(): string;
}